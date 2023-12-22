<div class="{{ $col }} mx-auto mb-1">
    <nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">

        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'adminproductcategory' ? 'active' : '' }}"
            aria-current="page" href="{{ route('adminproductcategory') }}">Product Category</a>

        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'adminuom' ? 'active' : '' }}"
            aria-current="page" href="{{ route('adminuom') }}">UOM</a>

        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'adminexpensecategory' ? 'active' : '' }}"
            aria-current="page" href="{{ route('adminexpensecategory') }}">Expense Category</a>
    </nav>
</div>
