<div class="{{ $col }} mx-auto mb-1">
    <nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'stockreport' ? 'active' : '' }}"
            aria-current="page" href="{{ route('stockreport') }}">Stock Reports</a>

        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'currentstockreport' ? 'active' : '' }}"
            href="{{ route('currentstockreport') }}">Current Stock Reports</a>

    </nav>
</div>
