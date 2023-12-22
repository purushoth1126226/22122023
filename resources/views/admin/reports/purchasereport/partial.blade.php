<div class="{{ $col }} mx-auto mb-1">
    <nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'purchasereport' ? 'active' : '' }}"
            aria-current="page" href="{{ route('purchasereport') }}">Purchase Reports</a>

        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'purchaseitemreport' ? 'active' : '' }}"
            href="{{ route('purchaseitemreport') }}">Purchaseitems Reports</a>

    </nav>
</div>
