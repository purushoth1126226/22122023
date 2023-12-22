<aside class="text-white shadow-lg rounded" id="sidebar-wrapper">
    <div class="sidebar-brand">
        <div class="d-flex mt-3 mt-md-0" style="height: 48px;">
            <span class="fs-6 ms-2 fw-bold fst-italic text-white">
                <i class="bi bi-clipboard-minus-fill" style="font-size: 2rem; color: white;"></i>
            </span>

            {{-- <img src="/logo/eltech_logo.png" class="mt-1" width="150" height="60"> --}}

            <span class="fs-4 mt-2 ms-3 fw-bold text-white">
                {{ config('app.name', '8Queens') }}
            </span>
        </div>
    </div>
    <ul class="sidebar-nav">

        <li>
            <a wire:navigate href="{{ route('admindashboard') }}" id="admindashboard_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-house-door-fill ms-2 me-4 fs-6 "></i>Dashboard
            </a>
        </li>


        <li>
            <a wire:navigate href="{{ route('adminsupplier') }}" id="adminsupplier_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-truck ms-2 me-4 fs-6"></i>Supplier
            </a>
        </li>

        <li>
            <a wire:navigate href="{{ route('adminproduct') }}" id="adminproduct_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-handbag ms-2 me-4 fs-6"></i>Product
            </a>
        </li>

        <li>
            <a wire:navigate href="{{ route('adminsale') }}" id="adminsale_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-currency-rupee ms-2 me-4 fs-6"></i>Sale
            </a>
        </li>
        <li>

        <li>
            <a wire:navigate href="{{ route('adminpurchase') }}" id="adminpurchase_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-box-seam ms-2 me-4 fs-6"></i>Purchase
            </a>
        </li>


        <li>
            <a wire:navigate href="{{ route('adminexpense') }}" id="adminexpense_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-database ms-2 me-4 fs-6"></i>Expense
            </a>
        </li>

        <li>
            <a wire:navigate href="{{ route('admincustomer') }}" id="admincustomer_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-person-check ms-2 me-4 fs-6"></i>Customer
            </a>
        </li>

        {{-- <li>
            <a  wire:navigate  href="{{ route('adminproduct') }}" id="adminproduct_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-sliders ms-2 me-4 fs-6"></i>Product Master
            </a>
        </li>


        <li>
            <a  wire:navigate  href="{{ route('adminpartner') }}" id="adminpartner_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-person-check ms-2 me-4 fs-6"></i>Financing Partner
            </a>
        </li>

        <li>
            <a  wire:navigate  href="{{ route('admindealer') }}" id="admindealer_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-person-workspace ms-2 me-4 fs-6"></i>Dealer
            </a>
        </li>
--}}
        <li>
            <a wire:navigate href="{{ route('adminreports') }}" id="adminreports_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-journal ms-2 me-4 fs-6 "></i>Reports
            </a>
        </li>

        <li>
            <a wire:navigate href="{{ route('adminsettings') }}" id="adminsettings_sidenav"
                class="nav-link text-white border-0 fw-bold p-1" style="font-size: 1.0rem!important;">
                <i class="bi bi-gear-fill ms-2 me-4 fs-6 "></i>Settings
            </a>
        </li>


        <li>
            <a href="{{ route('adminlogout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();"
                id="logout" class="nav-link text-white border-0 text-danger fw-bold p-1"
                style="font-size: 1.0rem!important;">
                <i class="bi bi-power ms-2 me-4 fs-5"></i>Logout
            </a>
        </li>
        <form id="logout-form-sidebar" action="{{ route('adminlogout') }}" method="GET" style="display: none;">
            @csrf
        </form>
    </ul>
</aside>
