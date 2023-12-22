<?php

namespace App\Livewire\Admin\Sale;

use App\Livewire\Admin\Sale\Salecreditordebitlivewire;
use App\Livewire\Admin\Sale\Salecustomerlivewire;
use App\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Customer\Customer;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Sale\Sale;
use App\Models\Admin\Sale\Saleitem;
use App\Models\Miscellaneous\Trackmessagehelper;
use DB;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Livewire\Component;

class Salecreateoreditlivewire extends Component
{
    use miscellaneousLivewireTrait, datatableLivewireTrait,
    Salecustomerlivewire, Salecreditordebitlivewire;

    public $formdata = [

        'customer_id' => null,
        'customer_name' => null,
        'customer_phone' => null,
        'customer_email' => null,

        'received_amount' => 0,
        'remaining_amount' => 0,
        'sub_total' => 0,
        'discount' => 0,
        'total_items' => 0,
        'total' => 0,
        'extra_charges' => 0,
        'note' => '',
        'roundoff' => 0,
        'grandtotal' => 0,
        'mode' => 0,
    ];

    // sale

    public $sale;

    // Product

    public $product_selected;
    public $product = [];
    public $searchproductlist = [];

    public $highlightIndex;

    protected function rules(): array
    {

        return [

            'product' => 'required',
            'product.*.product_id' => 'required|integer',
            'product.*.product_name' => 'required|string',
            'product.*.product_rate' => 'required|min:1',
            'product.*.product_quantity' => 'required|integer|min:1',
            'product.*.product_subtotal' => 'required',
            'product.*.product_purchaseprice' => 'required',

            'form.customer_id' => 'nullable|integer',
            'form.customer_phone' => 'nullable|digits:10',

            'form.customer_name' => 'nullable|string|min:2|max:70',

            'form.customer_email' => 'nullable|email',

            'form.sub_total' => 'required',
            'form.received_amount' => 'required|not_in:0',
            'form.remaining_amount' => 'required',
            'form.extra_charges' => 'nullable',
            'form.discount' => 'nullable',
            'form.total_items' => 'nullable',
            'form.total' => 'required|numeric',
            'form.roundoff' => 'required',
            'form.grandtotal' => 'required',
            'form.mode' => 'required|integer|min:1|max:3',

            'form.note' => 'nullable|min:5|max:255',
        ];
    }

    protected $messages = [

        'product.*.product_id.required' => 'Product ID is Required',
        'product.*.product_name.required' => 'Name is Required',
        'product.*.product_rate.required' => 'Rate is Required',
        'product.*.product_quantity.required' => 'Quantity is Required',
        'product.*.product_quantity.min' => 'Quantity is Invalid',
        'product.*.product_subtotal.required' => 'Subtotal is Required',
        'product.*.product_purchaseprice.required' => 'Actual Price is Required',
        'product' => 'Please Add a Product',

        'form.received_amount.not_in' => 'Recieved Amount must be Greater than or Equal to Total Amount',
        'form.total' => 'required',

    ];

    public function mount($id): void
    {
        if ($id) {
            $this->sale = Sale::with('saleitem')->find($id);

            foreach ($this->sale->saleitem as $key => $eachsaleitem) {
                array_push($this->product,
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
            $this->form = $this->sale->only('received_amount', 'remaining_amount', 'sub_total', 'discount', 'total_items', 'total', 'extra_charges', 'note', 'roundoff', 'grandtotal', 'mode');
            if ($this->sale->customer_id) {
                $customer = Customer::find($this->sale->customer_id);

                $this->customerphone = $customer->phone;
                $this->form['customer_name'] = $customer->name;
                $this->form['customer_email'] = $customer->email;
            }

        } else {
            $this->form = $this->formdata;
        }
    }

    public function searchproductreset()
    {
        $this->product_selected = '';
        $this->searchproductlist = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->searchproductlist) - 1) {
            $this->highlightIndex = 0;
            return;
        }

        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {

        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->searchproductlist) - 1;
            return;
        }

        $this->highlightIndex--;
    }

    protected function updatesale($data): void
    {

        $saledata = $this->sale;
        $this->amountcreditanddebit($saledata, 'UPDATE');
        $this->sale->update($data['form']);

        foreach ($data['product'] as $key => $updateproduct) {
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
        Trackmessagehelper::trackmessage(auth()->user(), $this->sale, 'salecreateoredit', session()->getId(), 'WEB', 'Sale was Updated');
        $this->toaster('success', 'Sale was Updated Successfully!!');
    }

    protected function createsale($data): void
    {
        $sale = Sale::create($data['form']);
        $this->amountcreditanddebit($sale, 'CREATE');
        foreach ($data['product'] as $key => $storeproduct) {
            $this->stockcreditanddebit($sale, $storeproduct);
            $sale->saleitem()->create([
                'product_id' => $storeproduct['product_id'],
                'product_name' => $storeproduct['product_name'],
                'purchaseprice' => $storeproduct['product_purchaseprice'],
                'price' => $storeproduct['product_rate'],
                'quantity' => $storeproduct['product_quantity'],
                'total' => $storeproduct['product_rate'] * $storeproduct['product_quantity'],
            ]);
        }
        Trackmessagehelper::trackmessage(auth()->user(), $sale, 'salecreateoredit', session()->getId(), 'WEB', 'Sale Created');
        $this->toaster('success', 'Sale Created Successfully!!');
    }

    public function storesale(): Redirector
    {
        $validatedData = $this->validate();
        try {

            DB::beginTransaction();
            $this->sale ? $this->updatesale($validatedData) : $this->createsale($validatedData);
            DB::commit();
            return redirect()->route('adminsale');
            $this->submitbutton = true;

        } catch (Exception $e) {
            $this->exceptionerror(auth()->user(), 'admin_sales_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror(auth()->user(), 'admin_sales_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror(auth()->user(), 'admin_sales_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function searchproduct()
    {

        $this->searchproductlist = Product::where('active', true)
            ->where(fn($q) =>
                $q->where('name', 'like', '%' . $this->product_selected . '%')
                    ->orWhere('sku', 'like', '%' . $this->product_selected . '%'))
            ->whereNotIn('id', collect($this->product)->pluck('product_id'))
            ->take(6)
            ->get();
    }

    public function enterproduct()
    {
        $product = $this->searchproductlist[$this->highlightIndex] ?? null;
        if ($product) {
            $higlightproduct = $this->searchproductlist[$this->highlightIndex];
            $this->onclickproduct($higlightproduct);
        }
    }

    public function onclickproduct(Product $product)
    {
        array_push($this->product,
            [
                'product_saleitemid' => null,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_quantity' => 1,
                'product_rate' => $product->sellingprice,
                'product_subtotal' => $product->sellingprice,
                'product_purchaseprice' => $product->purchaseprice,
            ]);

        $this->overallcalc();

        $this->product_selected = '';
        $this->searchproductlist = [];

    }

    public function productcalculation($key)
    {

        $this->product[$key]['product_subtotal'] = ($this->product[$key]['product_quantity'] ? $this->product[$key]['product_quantity'] : 0)
             * ($this->product[$key]['product_rate'] ? $this->product[$key]['product_rate'] : 0);

        $this->overallcalc();

    }

    public function removeitem($key)
    {
        if ($this->sale) {
            Saleitem::where('sale_id', $this->sale)
                ->where('product_id', $this->product[$key]['product_id'])
                ->delete();
        }
        unset($this->product[$key]);
        $this->overallcalc();

        $this->submitbutton = false;
    }

    public function submit($mode)
    {

        $this->form['mode'] = $mode;
        $this->storesale();
    }

    public function overallcalc()
    {

        $this->form['sub_total'] = collect($this->product)->pluck('product_subtotal')->sum();

        $this->form['total'] = $this->form['sub_total']
             + ($this->form['extra_charges'] ? $this->form['extra_charges'] : 0)
             - ($this->form['discount'] ? $this->form['discount'] : 0);

        $this->form['total_items'] = count($this->product);

        $this->form['roundoff'] = round($this->form['total']) - $this->form['total'];
        $this->form['grandtotal'] = round($this->form['total']);

        if ($this->form['received_amount'] != '') {
            $this->form['remaining_amount'] = $this->form['received_amount'] - $this->form['grandtotal'];
        }
    }

    public function render(): view
    {
        return view('livewire.admin.sale.salecreateoreditlivewire');
    }
}
