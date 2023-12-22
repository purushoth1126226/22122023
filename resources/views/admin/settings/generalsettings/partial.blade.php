<div class="{{ $col }} mx-auto mb-1">
    <nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">

        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'company' ? 'active' : '' }}"
            href="{{ route('admincompanysetting') }}">Company</a>

        <a wire:navigate class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'email' ? 'active' : '' }}"
            aria-current="page" href="{{ route('adminemailsetting') }}">Email</a>

        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'gateway' ? 'active' : '' }}"
            href="{{ route('admingateway') }}">Gateway</a>

        <a wire:navigate class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'sms' ? 'active' : '' }}"
            href="{{ route('adminsmssetting') }}">SMS</a>

        <a wire:navigate class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'fcm' ? 'active' : '' }}"
            href="{{ route('adminfcmsetting') }}">FCM</a>

        <a wire:navigate
            class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'theme' ? 'active' : '' }}"
            href="{{ route('adminthemesetting') }}">Theme</a>
    </nav>
</div>
