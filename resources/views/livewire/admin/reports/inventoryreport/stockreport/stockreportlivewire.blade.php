<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color p-1">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">STOCK CREDIT DEBIT REPORTS</span>
                </div>
                <div class="bd-highlight d-flex gap-1">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1"href="{{ route('adminreports') }}"
                        role="button">Back</a>
                </div>
            </div>

        </div>
        <div class="card-body p-0">
            <div class="row g-3 align-items-center p-2">
                <div class="col-auto">
                    <label for="startdateid" class="col-form-label fw-bold fs-6"> From Date :
                    </label>

                </div>
                <div class="col-auto">
                    <input type="date" wire:model="from_date" class="form-control form-control-sm" id="startdateid">
                </div>


                <div class="col-auto">
                    <label for="enddateid" class="col-form-label fw-bold fs-6">
                        To Date : </label>
                </div>
                <div class="col-auto">
                    <input type="date" wire:model="to_date" class="form-control form-control-sm" id="enddateid">
                </div>

                <div class="col-auto">
                    <input type="text" wire:model="searchTerm" id="searchitem" class="form-control form-control-sm"
                        placeholder="Search" aria-describedby="passwordHelpInline">
                </div>

                <div class="col-auto text-start mt-3">
                    <button wire:click="export" class="btn btn-sm btn-success fw-bold"> Excel
                        <i class="bi bi-arrow-down"></i></button>
                    <button wire:click="pdf" class="btn btn-sm btn-success fw-bold"> PDF
                        <i class="bi bi-arrow-down"></i></button>
                    <button wire:click="clear" class="btn btn-sm btn-secondary"> Clear</button>
                </div>


            </div>
            <div class="table-responsive">
                <table id="purchasereportreport_id" class="table text-center table-hover m-0 p-0">
                    <thead class="text-white theme_bg_color">
                        <tr>
                            <th>SI.NO</th>
                            <th>PRODUCT NAME</th>
                            <th>CREDIT</th>
                            <th>DEBIT</th>
                            <th>BALANCE</th>
                            <th>TYPE</th>
                            <th>DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->stockreport as $eachstockreport)
                            <tr class="{{ $eachstockreport->c_or_d == 'C' ? 'table-success' : 'table-danger' }}">
                                <td>
                                    {{ $loop->iteration }}</td>
                                <td class="text-center">{{ $eachstockreport->product->name }}</td>
                                <td class="text-center">{{ $eachstockreport->credit }}</td>
                                <td class="text-center">{{ $eachstockreport->debit }}</td>
                                <td class="text-center">{{ $eachstockreport->balance }}</td>
                                <td class="text-center">
                                    @switch($eachstockreport->stockcdable_type)
                                        @case('App\Models\Admin\Product\Product')
                                            Product
                                        @break

                                        @case('App\Models\Admin\Purchase\Purchase')
                                            Purchase
                                        @break

                                        @case('App\Models\Admin\Sale\Sale')
                                            Sale
                                        @break

                                        @default
                                            -
                                    @endswitch

                                </td>
                                <td class="text-center">{{ $eachstockreport->created_at->format('d-m-Y h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-2">
                {!! $this->stockreport->links() !!}
            </div>
        </div>
    </div>
</div>
