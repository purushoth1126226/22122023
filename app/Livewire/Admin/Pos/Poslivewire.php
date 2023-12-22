<?php

namespace App\Livewire\Admin\Pos;

use App\Livewire\Admin\Pos\Possalecreditordebitlivewire;
use App\Livewire\Admin\Pos\Possalecustomerlivewire;
use App\Livewire\Admin\Pos\Possaledatatablelivewire;
use App\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Customer\Customer;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Sale\Sale;
use App\Models\Admin\Sale\Saleitem;
use App\Models\Admin\Settings\Mastersettings\Productcategory;
use App\Models\Miscellaneous\Trackmessagehelper;
use DB;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Poslivewire extends Component
{
    use miscellaneousLivewireTrait, Possaledatatablelivewire,
    Possalecustomerlivewire, Possalecreditordebitlivewire;

    public $formdata = [
        'customer_id' => null,
        'customer_name' => null,
        'customer_phone' => null,

        'received_amount' => 0,
        'remaining_amount' => 0,
        'sub_total' => 0,
        'discount' => 0,
        'total_items' => 0,
        'total' => 0,
        'extra_charges' => 0,
        'grandtotal' => 0,
        'mode' => 0,
    ];

    public $sale;

    public $productlist = [];
    public $productcategory_id = 0;

    protected $listeners = ['formreset'];

    protected function rules(): array
    {
        return [
            'productlist' => 'required',
            'productlist.*.product_id' => 'required|integer',
            'productlist.*.product_name' => 'required|string',
            'productlist.*.product_rate' => 'required|min:1',
            'productlist.*.product_quantity' => 'required|integer|min:1',
            'productlist.*.product_subtotal' => 'required',

            'form.customer_name' => 'nullable|string|min:2|max:70',
            'form.customer_id' => 'nullable|integer',
            'form.customer_phone' => 'nullable|digits:10',

            'form.total_items' => 'required|integer',
            'form.mode' => 'required|integer|min:1|max:3',
            'form.sub_total' => 'required|numeric',
            'form.received_amount' => 'required|numeric|not_in:0',
            'form.remaining_amount' => 'required|numeric',
            'form.extra_charges' => 'nullable|numeric',
            'form.discount' => 'nullable|numeric',
            'form.total' => 'required|numeric',
            'form.grandtotal' => 'required|numeric',
        ];
    }

    protected $messages = [
        'productlist.*.product_id.required' => 'Product ID is Required',
        'productlist.*.product_name.required' => 'Name is Required',
        'productlist.*.product_rate.required' => 'Rate is Required',
        'productlist.*.product_quantity.required' => 'Quantity is Required',
        'productlist.*.product_quantity.min' => 'Quantity is Invalid',
        'productlist.*.product_subtotal.required' => 'Subtotal is Required',
        'productlist.*.product_purchaseprice.required' => 'Actual Price is Required',
        'productlist' => 'Please Add a Product',

        'form.customer_phone' => 'Phone must be 10 digits',
        'form.total_items' => 'Total items is required',
        'form.received_amount' => 'Recieved Amount must be Greater than or Equal to Total Amount',
        'form.total' => 'required',
    ];

    public function mount($id): void
    {
        if ($id) {
            $this->sale = Sale::with('saleitem', 'customer')->find($id);

            foreach ($this->sale->saleitem as $key => $eachsaleitem) {
                array_push($this->productlist,
                    [
                        'product_saleitemid' => $eachsaleitem->id,
                        'product_id' => $eachsaleitem->product_id,
                        'product_name' => $eachsaleitem->product_name,
                        'product_quantity' => $eachsaleitem->quantity,
                        'product_rate' => $eachsaleitem->price,
                        'product_subtotal' => $eachsaleitem->total,
                        'product_purchaseprice' => $eachsaleitem->purchaseprice,
                    ]);
            }
            $this->form = $this->sale->only('total_items', 'sub_total', 'discount', 'total', 'extra_charges', 'grandtotal', 'received_amount', 'remaining_amount');

            if ($this->sale->customer) {
                $this->customer = $this->sale->customer;
                $this->customerphone = $this->sale->customer->phone;
                $this->form['customer_id'] = $this->sale->customer_id;
                $this->form['customer_name'] = $this->sale->customer->name;
                $this->form['customer_email'] = $this->sale->customer->email;
            }
        } else {
            $this->form = $this->formdata;
        }
    }

    public function onclickproduct(Product $product)
    {
        $existingproduct = collect($this->productlist)->where('product_id', $product->id)->keys();

        if ($existingproduct->count() > 0) {

            $this->productlist[$existingproduct[0]]['product_quantity'] += 1;
            $this->productlist[$existingproduct[0]]['product_subtotal'] = $this->productlist[$existingproduct[0]]['product_quantity'] * $this->productlist[$existingproduct[0]]['product_rate'];

        } else {
            array_push($this->productlist,
                [
                    'product_saleitemid' => null,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_quantity' => 1,
                    'product_rate' => $product->sellingprice,
                    'product_subtotal' => $product->sellingprice,
                    'product_purchaseprice' => $product->purchaseprice,
                ]);
        }
        $this->overallcalc();
    }

    public function additem($key)
    {
        $this->productlist[$key]['product_quantity'] += 1;
        $this->productlist[$key]['product_subtotal'] = $this->productlist[$key]['product_quantity'] * $this->productlist[$key]['product_rate'];
        $this->overallcalc();
    }

    public function storesale()
    {

        $validatedData = $this->validate();
        // dd($validatedData);
        try {

            DB::beginTransaction();
            if (!$this->customer && $validatedData['form']['customer_name']) {
                $validatedData['form']['customer_phone'] = $this->customerphone;
                $customer = Customer::create([
                    'name' => $validatedData['form']['customer_name'],
                    'phone' => $validatedData['form']['customer_phone'],
                ]);
                $validatedData['form']['customer_id'] = $customer->id;
            }

            $sale = $this->sale ? $this->updatesale($validatedData) : $this->createsale($validatedData);
            DB::commit();

            $this->formreset();
            $this->submitbutton = true;

        } catch (Exception $e) {
            $this->exceptionerror(auth()->user(), 'admin_salepos_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror(auth()->user(), 'admin_salepos_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror(auth()->user(), 'admin_salepos_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function updatesale($data)
    {
        $saledata = $this->sale;
        $this->amountcreditanddebit($saledata, 'UPDATE');
        $this->sale->update($data['form']);

        foreach ($data['productlist'] as $key => $updateproduct) {
            $this->stockcreditanddebit($saledata, $updateproduct);
            $this->sale
                ->saleitem()
                ->updateOrCreate(
                    ['sale_id' => $this->sale->id, 'product_id' => $updateproduct['product_id']],
                    [
                        'product_name' => $updateproduct['product_name'],
                        'quantity' => $updateproduct['product_quantity'],
                        'price' => $updateproduct['product_rate'],
                        'total' => $updateproduct['product_subtotal'],
                        'purchaseprice' => $updateproduct['product_purchaseprice'],
                    ]
                );
        }
        Trackmessagehelper::trackmessage(auth()->user(), $this->sale, 'saleupdatepos', session()->getId(), 'WEB', 'Sale POS was Updated');
    }

    protected function createsale($data)
    {
        $sale = Sale::create($data['form']);
        $this->amountcreditanddebit($sale, 'CREATE');

        foreach ($data['productlist'] as $key => $storeproduct) {
            $this->stockcreditanddebit($sale, $storeproduct);
            $sale->saleitem()
                ->create([
                    'product_id' => $storeproduct['product_id'],
                    'product_name' => $storeproduct['product_name'],
                    'purchaseprice' => $storeproduct['product_purchaseprice'],
                    'price' => $storeproduct['product_rate'],
                    'quantity' => $storeproduct['product_quantity'],
                    'total' => $storeproduct['product_rate'] * $storeproduct['product_quantity'],
                ]);
        }
        Trackmessagehelper::trackmessage(auth()->user(), $sale, 'salecreatepos', session()->getId(), 'WEB', 'Sale POS Created');
        $this->print($sale->id);
    }

    protected function databind($saleid, $type): void
    {
        $this->showdata = Sale::with('saleitem', 'customer')->find($saleid);
    }

    public function pagerefresh()
    {
        return redirect()->route('salepos');
    }

    public function print($printid)
    {
        $this->databind($printid, 'print');
        $this->dispatch('printmodal');
    }

    public function subitem($key)
    {
        $this->productlist[$key]['product_quantity'] -= 1;
        if ($this->productlist[$key]['product_quantity'] < 1) {
            $this->productlist[$key]['product_quantity'] = 1;

            $this->productlist[$key]['product_subtotal'] = $this->productlist[$key]['product_quantity'] * $this->productlist[$key]['product_rate'];
        }
        $this->productlist[$key]['product_subtotal'] = $this->productlist[$key]['product_quantity'] * $this->productlist[$key]['product_rate'];
        $this->overallcalc();
    }

    public function removeitem($key, $salesitemid)
    {
        ($salesitemid) ? Saleitem::find($salesitemid)->delete() : null;
        unset($this->productlist[$key]);
        $this->overallcalc();
    }

    public function productcalculation($key)
    {
        $this->productlist[$key]['product_subtotal'] = ($this->productlist[$key]['product_quantity'] ? $this->productlist[$key]['product_quantity'] : 0)
             * ($this->productlist[$key]['product_rate'] ? $this->productlist[$key]['product_rate'] : 0);

        $this->overallcalc();
    }

    public function submit($mode)
    {
        $this->form['mode'] = $mode;
        $this->storesale();
    }

    public function overallcalc()
    {
        $this->form['sub_total'] = collect($this->productlist)->pluck('product_subtotal')->sum();

        $this->form['total'] = $this->form['sub_total']
             + ($this->form['extra_charges'] ? $this->form['extra_charges'] : 0)
             - ($this->form['discount'] ? $this->form['discount'] : 0);

        $this->form['total_items'] = count($this->productlist);

        $this->form['grandtotal'] = round($this->form['total']);

        if ($this->form['received_amount'] != '') {
            $this->form['remaining_amount'] = $this->form['received_amount'] - $this->form['grandtotal']; // -minus red color , plus green color
        }
    }

    #[Computed]
    public function product()
    {
        return Product::query()
            ->where('active', true)
            ->when($this->productcategory_id, fn($q) => $q->where("productcategory_id", $this->productcategory_id))
            ->where(fn($query) =>
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('productcategory', fn($q) => $q->where('name', 'like', '%' . $this->searchTerm . '%'))
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
    }

    #[Computed]
    public function productcategory()
    {
        return Productcategory::where('active', true)
            ->pluck('name', 'id');
    }

    public function render(): View
    {
        return view('livewire.admin.pos.poslivewire');
    }
}
