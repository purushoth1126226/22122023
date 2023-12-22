<div class="{{ $col }} mx-auto mb-1">
    <nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">

        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'adminproduct' ? 'active' : '' }}"
            aria-current="page" href="{{ route('adminproduct') }}">Product</a>

        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'adminstockadjustment' ? 'active' : '' }}"
            aria-current="page" href="{{ route('adminstockadjustment') }}">Stock Adjustment</a>
    </nav>
</div>
