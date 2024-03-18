<div class="col-lg-4 account-sidemenu">
    <ul class="nav flex-column">
        @if (Auth::check())
        <li class="nav-item">
           Hello, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('myaccount/dashboard') ? 'active' : '' }}" aria-current="page"
                href="{{ url('myaccount/dashboard') }}">Dashboard</a>
        </li>
        @php
            $segment2 = Request::segment(2);
            $segment4 = Request::segment(4);
            $segment3 = Request::segment(3);
            $pages = ['orderAddress', $segment4,'orderShippingAddress'];
            $ordersview = ['ordersview', $segment3];
        @endphp
        <li class="nav-item">
            <a class="nav-link @if (in_array($segment2, $ordersview)) active @endif"
                href="{{ url('myaccount/ordersview') }}">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('myaccount/accountdetailsview') ? 'active' : '' }}"
                href="{{ url('myaccount/accountdetailsview') }}">Account details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('myaccount.logout') ? 'active' : '' }}"
                href="{{ route('myaccount.logout') }}">Logout</a>
        </li>
        @endif
    </ul>
</div>

