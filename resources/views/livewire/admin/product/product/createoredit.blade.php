<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($this->model_id) ? 'UPDATE' : 'CREATE' }}
                        PRODUCT </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body bg-white">
                    <div class="row g-3">
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'form.name',
                            'labelname' => 'PRODUCT NAME',
                            'labelidname' => 'nameid',
                            'required' => true,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'form.sku',
                            'labelname' => 'SKU',
                            'labelidname' => 'skuid',
                            'required' => true,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'fieldname' => 'form.productcategory_id',
                            'labelname' => 'PRODUCT CATEGORY ',
                            'labelidname' => 'productcategory_id',
                            'option' => $this->productcategory,
                            'default_option' => 'Select a Product category',
                            'required' => true,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'form.purchaseprice',
                            'labelname' => 'PURCHASE PRICE',
                            'labelidname' => 'purchasepriceid',
                            'required' => true,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'form.sellingprice',
                            'labelname' => 'SELLING PRICE',
                            'labelidname' => 'sellingpriceid',
                            'required' => true,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'fieldname' => 'form.uom_id',
                            'labelname' => 'UOM',
                            'labelidname' => 'uom_id',
                            'option' => $this->uom,
                            'default_option' => 'Select a UOM',
                            'required' => true,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'file',
                            'fieldname' => 'image',
                            'labelname' => 'IMAGE',
                            'labelidname' => 'imageid',
                            'required' => false,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])

                        @if ($image)
                            <div class="col-md-2">
                                <img src="{{ $image->temporaryUrl() }}" style="width: 80px" height="70px">
                            </div>
                        @elseif ($existingimage)
                            <div class="col-md-2">
                                <img src="{{ url('storage/' . $existingimage) }}" class="img-fluid rounded"
                                    style="width: 80px" height="70px">
                            </div>
                        @endif

                        {{-- @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'form.cgst',
                            'labelname' => 'CGST',
                            'labelidname' => 'cgstid',
                            'required' => false,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ]) --}}

                        <div class="col-md-4">
                            <label for="cgstid" class="form-label">CGST</label>
                            <input wire:model.blur="form.cgst" type="number" class="form-control" id="cgstid"
                                step="any">
                            @error('form.cgst')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'form.sgst',
                            'labelname' => 'SGST',
                            'labelidname' => 'sgstid',
                            'required' => false,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ]) --}}

                        <div class="col-md-4">
                            <label for="sgstid" class="form-label">SGST</label>
                            <input wire:model.blur="form.sgst" type="number" class="form-control" id="sgstid"
                                step="any">
                            @error('form.sgst')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'form.igst',
                            'labelname' => 'IGST',
                            'labelidname' => 'igstid',
                            'required' => false,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'form.cess',
                            'labelname' => 'CESS',
                            'labelidname' => 'cessid',
                            'required' => false,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'form.hsncode',
                            'labelname' => 'HSN CODE',
                            'labelidname' => 'hsncodeid',
                            'required' => false,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'formswitch',
                            'fieldname' => 'form.active',
                            'labelname' => 'ACTIVE',
                            'labelidname' => 'activeid',
                            'required' => false,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'form.note',
                            'labelname' => 'NOTE',
                            'labelidname' => 'noteid',
                            'required' => false,
                            'readonly' => false,
                            'col' => 'col-md-4',
                        ])

                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($this->model_id) ? 'Update' : 'Create' }}
                        <span wire:loading.delay class="spinner-border spinner-border-sm" role="status"
                            aria-hidden="true">
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
