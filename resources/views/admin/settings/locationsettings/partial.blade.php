<div class="{{ $col }} mx-auto mb-1">
    <nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
        <a wire:navigate class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'state' ? 'active' : '' }}"
            aria-current="page" href="{{ route('state') }}">State</a>

        <a wire:navigate class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'city' ? 'active' : '' }}"
            href="{{ route('city') }}">City</a>
    </nav>
</div>
