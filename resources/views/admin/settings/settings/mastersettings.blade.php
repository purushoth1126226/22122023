<h5>Master Setting</h5>
<div class="pb-4 pt-2">
    <div class="row g-3 row-cols-1 row-cols-md-2">

        <div class="col-md-2">
            <a wire:navigate.hover href="{{ route('adminproductcategory') }}"
                class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm bg-white">
                    <i class="bi bi-file-check" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Product Category</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a wire:navigate.hover href="{{ route('adminuom') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm bg-white">
                    <i class="bi bi-rulers" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">UOM</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a wire:navigate.hover href="{{ route('adminexpensecategory') }}"
                class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm bg-white">
                    <i class="bi bi-cash-stack" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Expense Category</div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
