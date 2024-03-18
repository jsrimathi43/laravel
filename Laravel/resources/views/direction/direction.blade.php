@extends('layouts.app')

@section('content')
    <!-------------------------------- Contact us page section --------------------------------------->



    <section class="about-us-page-section">
        <div class="container-fluid">
            <div class="row about-page-banner">
                <div class="col-12 col-lg-12 px-0 about-page-banner-img">
                    <img src="{{ asset('img/restaurant-about-bg1.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
        <div class="about-page-banner-text">
            <h2 class="">Contact us</h2>
        </div>
    </section>

    <section class="contact-us-section">
        <div class="container">
            <div class="row contact-map-body">
                <div class="col-12 col-lg-12 contact-map">
                    <img src="{{ asset('img/map-rest.png') }}" class="img-fluid" alt="map">
                </div>
            </div>
            <div class="row contact-page-content">
                <div class="col-12 col-lg-7 contact-page-content-body">
                    <h3 class="pb-2">Catch us here 24/7</h3>
                    <p>
                        It is important to take care of the patient, to be followed by the doctor, but it is a time of great
                        pain and suffering.
                        For to come to the smallest detail, no one should practice any kind of work unless he derives some
                        benefit from it.
                    </p>

                    <div class="row contact-page-location-body">
                        <div class="col-12 col-lg-6">
                            <div class="d-flex align-items-center py-2 address">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="19"
                                        viewBox="0 0 14 19" fill="none">
                                        <path
                                            d="M6.2806 18.2901C0.983281 10.6105 0 9.82235 0 7C0 3.13399 3.13399 0 7 0C10.866 0 14 3.13399 14 7C14 9.82235 13.0167 10.6105 7.7194 18.2901C7.37177 18.7922 6.6282 18.7922 6.2806 18.2901ZM7 9.91667C8.61084 9.91667 9.91667 8.61084 9.91667 7C9.91667 5.38916 8.61084 4.08333 7 4.08333C5.38916 4.08333 4.08333 5.38916 4.08333 7C4.08333 8.61084 5.38916 9.91667 7 9.91667Z"
                                            fill="#DD5903" />
                                    </svg>
                                    Ufnau Strasse 92 Memmingen, Free State of Bavaria(BY), 87687
                                </span>
                            </div>
                            <div class="d-flex align-items-center py-2 phone">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M15.5437 11.3062L12.0437 9.80614C11.8941 9.74242 11.728 9.72899 11.5701 9.76788C11.4123 9.80677 11.2714 9.89587 11.1686 10.0218L9.61861 11.9156C7.18598 10.7686 5.22828 8.81089 4.08132 6.37827L5.97511 4.82824C6.10126 4.72564 6.19055 4.58473 6.22945 4.42684C6.26836 4.26896 6.25477 4.10269 6.19074 3.95322L4.69071 0.453162C4.62043 0.292037 4.49613 0.160484 4.33925 0.0811864C4.18237 0.00188915 4.00273 -0.0201818 3.83132 0.0187795L0.58126 0.768793C0.415998 0.806955 0.26855 0.900007 0.162983 1.03276C0.0574151 1.16552 -3.80697e-05 1.33013 1.8926e-08 1.49974C1.8926e-08 9.51551 6.49699 16 14.5003 16C14.6699 16.0001 14.8346 15.9427 14.9674 15.8371C15.1002 15.7315 15.1933 15.5841 15.2315 15.4187L15.9815 12.1687C16.0202 11.9964 15.9977 11.8161 15.9178 11.6587C15.8379 11.5012 15.7056 11.3766 15.5437 11.3062Z"
                                            fill="#DD5903" />
                                    </svg>
                                </span>
                                <a href="tel:+49 30 727392606" class="nav-link">
                                    +49 30 727392606
                                </a>
                            </div>
                            <div class="d-flex align-items-center py-2 phone">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="13"
                                        viewBox="0 0 17 13" fill="none">
                                        <path
                                            d="M16.3509 4.12761C16.4779 4.0267 16.6667 4.12109 16.6667 4.2806V10.9375C16.6667 11.8001 15.9668 12.5 15.1042 12.5H1.5625C0.69987 12.5 0 11.8001 0 10.9375V4.28386C0 4.1211 0.185546 4.02995 0.315755 4.13086C1.04492 4.69727 2.01171 5.41667 5.33203 7.82878C6.01888 8.33008 7.17773 9.38473 8.33333 9.37821C9.49545 9.38804 10.6771 8.31054 11.3379 7.82878C14.6582 5.41667 15.6218 4.69401 16.3509 4.12761ZM8.33333 8.33333C9.08857 8.34636 10.1758 7.38281 10.7227 6.98568C15.0423 3.85091 15.3711 3.57747 16.3671 2.79622C16.556 2.64974 16.6667 2.42187 16.6667 2.18099V1.5625C16.6667 0.69987 15.9668 0 15.1042 0H1.5625C0.69987 0 0 0.69987 0 1.5625V2.18099C0 2.42187 0.110677 2.64648 0.299479 2.79622C1.29557 3.57421 1.62435 3.85091 5.94401 6.98568C6.49088 7.38281 7.57813 8.34636 8.33333 8.33333Z"
                                            fill="#DD5903" />
                                    </svg>
                                </span>
                                <a href="mailto:test@gmail.com" class="nav-link">
                                    test@gmail.com
                                </a>
                            </div>
                            <div class="py-3 contact-page-social">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link facebk">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                                    viewBox="0 0 17 16" fill="none">
                                                    <path
                                                        d="M16.0974 8.04868C16.0974 3.60243 12.4949 0 8.04868 0C3.60243 0 0 3.60243 0 8.04868C0 12.0659 2.94329 15.3957 6.79108 16V10.3753H4.74645V8.04868H6.79108V6.27538C6.79108 4.25834 7.99189 3.14418 9.83108 3.14418C10.7119 3.14418 11.6329 3.30126 11.6329 3.30126V5.28097H10.6178C9.61818 5.28097 9.30629 5.9015 9.30629 6.53793V8.04868H11.5385L11.1815 10.3753H9.30629V16C13.1541 15.3957 16.0974 12.0659 16.0974 8.04868Z"
                                                        fill="white" />
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link twtr">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="15"
                                                    viewBox="0 0 19 15" fill="none">
                                                    <path
                                                        d="M16.5703 3.73827C16.582 3.90232 16.582 4.06641 16.582 4.23047C16.582 9.23435 12.7735 15 5.81251 15C3.66796 15 1.67579 14.3789 0 13.3008C0.304699 13.3359 0.597638 13.3477 0.91406 13.3477C2.68356 13.3477 4.31249 12.75 5.61328 11.7305C3.94922 11.6953 2.55468 10.6055 2.0742 9.10547C2.3086 9.1406 2.54296 9.16405 2.78907 9.16405C3.12891 9.16405 3.46877 9.11715 3.78516 9.03516C2.05079 8.68357 0.749969 7.16015 0.749969 5.32031V5.27345C1.25386 5.5547 1.83984 5.73048 2.46089 5.75389C1.44136 5.07419 0.773416 3.91405 0.773416 2.60154C0.773416 1.89842 0.960881 1.25389 1.28903 0.691389C3.15232 2.98826 5.95311 4.48824 9.09371 4.65233C9.03513 4.37108 8.99996 4.07814 8.99996 3.78516C8.99996 1.6992 10.6875 0 12.7851 0C13.875 0 14.8593 0.45703 15.5507 1.19531C16.4062 1.03126 17.2265 0.714835 17.9531 0.281252C17.6718 1.16018 17.0742 1.89846 16.289 2.36718C17.0508 2.28519 17.789 2.0742 18.4687 1.78126C17.9532 2.53123 17.3086 3.19917 16.5703 3.73827Z"
                                                        fill="white" />
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link yutb">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12"
                                                    viewBox="0 0 18 12" fill="none">
                                                    <path
                                                        d="M16.7101 1.87759C16.5138 1.13853 15.9355 0.556469 15.2012 0.358938C13.8702 0 8.53334 0 8.53334 0C8.53334 0 3.19647 0 1.8655 0.358938C1.13122 0.5565 0.552906 1.13853 0.356625 1.87759C0 3.21719 0 6.01213 0 6.01213C0 6.01213 0 8.80706 0.356625 10.1467C0.552906 10.8857 1.13122 11.4435 1.8655 11.6411C3.19647 12 8.53334 12 8.53334 12C8.53334 12 13.8702 12 15.2012 11.6411C15.9355 11.4435 16.5138 10.8857 16.7101 10.1467C17.0667 8.80706 17.0667 6.01213 17.0667 6.01213C17.0667 6.01213 17.0667 3.21719 16.7101 1.87759ZM6.78788 8.54972V3.47453L11.2485 6.01219L6.78788 8.54972Z"
                                                        fill="white" />
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 clock-sec">
                            <div class="d-flex align-items-center py-2 clk-time">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M8 0C3.6 0 0 3.6 0 8C0 12.4 3.6 16 8 16C12.4 16 16 12.4 16 8C16 3.6 12.4 0 8 0ZM12 8.57143H8C7.65714 8.57143 7.42857 8.34286 7.42857 8V2.85714C7.42857 2.51429 7.65714 2.28571 8 2.28571C8.34286 2.28571 8.57143 2.51429 8.57143 2.85714V7.42857H12C12.3429 7.42857 12.5714 7.65714 12.5714 8C12.5714 8.34286 12.3429 8.57143 12 8.57143Z"
                                            fill="#DD5903" />
                                    </svg>
                                    Mon - Thu: 10 AM - 02 AM
                                </span>
                            </div>
                            <div class="d-flex align-items-center py-2 clk-time">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M8 0C3.6 0 0 3.6 0 8C0 12.4 3.6 16 8 16C12.4 16 16 12.4 16 8C16 3.6 12.4 0 8 0ZM12 8.57143H8C7.65714 8.57143 7.42857 8.34286 7.42857 8V2.85714C7.42857 2.51429 7.65714 2.28571 8 2.28571C8.34286 2.28571 8.57143 2.51429 8.57143 2.85714V7.42857H12C12.3429 7.42857 12.5714 7.65714 12.5714 8C12.5714 8.34286 12.3429 8.57143 12 8.57143Z"
                                            fill="#DD5903" />
                                    </svg>
                                    Fri - Sun: 10 AM - 02 AM
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5 contact-page-form-section">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form class="cnt-form-page" method="POST" action="{{ route('myaccount.directions') }}">
                        @csrf
                        <div class="row g-3 cnt-form-body">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="your-name" name="name"
                                    placeholder="Name*" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="your-surname" name="email"
                                    placeholder="Email*" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="your-name" name="phone"
                                    placeholder="Telephone*" required>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" id="your-message" name="message" rows="5" placeholder="News*" required></textarea>
                            </div>
                            <div class="col-12 contact-page-form">
                                <div class="row">
                                    <div class="col-md-4 cnt-btn">
                                        <button type="submit" class="btn btn-dark w-100 fw-bold">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <!-------------------------------- End Contact us page section --------------------------------------->
@endsection
