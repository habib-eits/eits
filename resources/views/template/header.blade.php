<header id="page-topbar" class="shadow-sm">

    <div class="navbar-header">

        <div class="d-flex">

            <!-- LOGO -->

            <div class="navbar-brand-box">

                <a href="{{URL('/dashboard')}}" class="logo logo-dark">

                    <span class="logo-sm">

                        <img src="{{URL('/')}}/assets/images/square.svg" alt="" height="30">

                    </span>

                    <span class="logo-lg">

                        <img src="{{URL('/')}}/assets/images/square.svg" alt="" height="10"> Falak

                    </span>

                </a>

                <a href="{{URL('/Dashboard')}}" class="logo logo-light">

                    <span class="logo-sm">

                        <img src="{{URL('/')}}/assets/images/square.svg" alt="" height="30">

                    </span>

                    <span class="logo-lg ">

                        <h5 class="mt-4 text-white"> Extensive Books</h5>

                    </span>

                </a>

            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">

                <i class="fa fa-fw fa-bars"></i>

            </button>

            <!-- App Search-->
            @if(session::get('UserType') == 'SuperAdmin')
            <form class="app-search  d-none d-xl-block">

                <div class="position-relative">

                    <div class="d-flex gap-2 flex-wrap">





                        <div class="btn-group">

                            <button type="button" class="  btn btn-outline-light dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class=" text-success far fa-bookmark

                                font-size-16 align-middle me-2"></i>Favorite <i class="mdi mdi-chevron-down"></i></button>

                            <div class="dropdown-menu" style="margin: 0px;">



                                <a class="dropdown-item" href="{{URL('/SalesInvoiceCreate')}}"><i
                                        class="bx bx-plus "></i> Invoice</a>

                                <div class="dropdown-divider"></div>



                                <a class="dropdown-item" href="{{URL('/VoucherCreate/BP')}}"><i class="bx bx-plus "></i>
                                    BP-Bank Payment</a>

                                <a class="dropdown-item" href="{{URL('/VoucherCreate/BR')}}"><i class="bx bx-plus "></i>
                                    BR-Bank Receipt</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{URL('/VoucherCreate/CP')}}"><i class="bx bx-plus "></i>
                                    CP-Cash Payment</a>

                                <a class="dropdown-item" href="{{URL('/VoucherCreate/CR')}}"><i class="bx bx-plus "></i>
                                    CR-Cash Receipt</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{URL('/JV')}}"><i class="bx bx-plus "></i> Journal
                                    Voucher</a>





                            </div>

                        </div><!-- /btn-group -->

                        <div class="btn-group">

                            <button type="button" class="  btn btn-outline-light dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">Party Reports <i
                                    class="mdi mdi-chevron-down"></i></button>

                            <div class="dropdown-menu" style="margin: 0px;">

                                <a class="dropdown-item" href="{{URL('/Invoice')}}">Invoice</a>

                                <a class="dropdown-item" href="{{URL('/PartyLedger')}}">Party Ledger</a>

                                <a class="dropdown-item" href="{{URL('/PartyBalance')}}">Party Balance</a>

                                <a class="dropdown-item" href="{{URL('/PartyYearlyBalance')}}">Yearly Report</a>

                                <a class="dropdown-item" href="{{URL('/PartyAgingPDF')}}">Aging Report</a>

                                <!-- <a class="dropdown-item" href="#">Party Analysis</a> -->

                                <a class="dropdown-item" href="{{URL('/PartyList')}}">Party List</a>

                                <a class="dropdown-item" href="{{URL('/PartyWiseSale')}}">Partywise Sale (SOA)</a>

                                <a class="dropdown-item" href="{{URL('/OutStandingInvoice')}}">Outstanding Invoices</a>

                                <a class="dropdown-item" href="{{URL('/TaxReport')}}">Tax Report</a>

                                <a class="dropdown-item" href="{{URL('/CitywiseReport')}}">Saleman Party Balances</a>

                            </div>

                        </div><!-- /btn-group -->



                        <div class="btn-group">

                            <button type="button" class="btn btn-outline-light dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">Supplier Reports <i
                                    class="mdi mdi-chevron-down"></i></button>

                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="{{URL('/SupplierLedger')}}">Supplier Ledger</a>

                                <a class="dropdown-item" href="{{URL('/SupplierBalance')}}">Supplier Balance</a>

                                <a class="dropdown-item" href="{{URL('/Invoice')}}">Sale Invoice</a>

                                <a class="dropdown-item" href="{{URL('/SalemanReport')}}">Sales Man Report</a>

                                <a class="dropdown-item" href="{{URL('/TaxReportSupplier')}}">Tax Report</a>

                                <a class="dropdown-item" href="{{URL('/SupplierWiseSale')}}">Purchase Report</a>

                            </div>

                        </div><!-- /btn-group -->

                        <div class="btn-group">

                            <button type="button" class="btn btn-outline-light dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">Accounts Reports <i
                                    class="mdi mdi-chevron-down"></i></button>

                            <div class="dropdown-menu">

                                <a class="dropdown-item  " href="{{URL('/VoucherReport')}}">Voucher</a>

                                <a class="dropdown-item" href="{{URL('/CashbookReport')}}">Cash Book</a>

                                <div class="dropdown-divider"></div>

                                <!-- <a class="dropdown-item" href="#">Sales man wise cash book</a> -->

                                <a class="dropdown-item" href="{{URL('/DailyIncomeExpense')}}">Daily Income /
                                    Expense</a>





                                <a class="dropdown-item" href="{{URL('/DaybookReport')}}">Day book</a>

                                <a class="dropdown-item" href="{{URL('/GeneralLedger')}}">General Ledger</a>



                                <a class="dropdown-item" href="{{URL('/TrialBalance')}}">Trial Balance</a>



                                <a class="dropdown-item" href="{{URL('/trialreportsearch')}}">Trial Balance New
                                    Report</a>





                                <a class="dropdown-item" href="{{URL('/TrialBalanceActivity')}}">Trial with
                                    acitivity</a>

                                <!-- <a class="dropdown-item" href="#">yearly summary</a> -->

                                <a class="dropdown-item" href="{{URL('/ProfitAndLoss')}}">profit and loss</a>

                                <a class="dropdown-item" href="{{URL('/BalanceSheet')}}">balance sheet</a>

                                <a class="dropdown-item" href="{{URL('/PartyBalance')}}">party balance</a>

                                <!--     <a class="dropdown-item" href="#">ageing report</a>

                            <a class="dropdown-item" href="#">cash flow</a> -->

                                <a class="dropdown-item" href="{{URL('/TaxOverallReport')}}">Tax Report</a>

                                <a class="dropdown-item" href="{{URL('/ReconcileReport')}}">Bank Reconciliation</a>

                                <a class="dropdown-item" href="{{URL('/InvoiceSummary')}}">invoice summary list</a>

                                <a class="dropdown-item" href="{{URL('/Inventory')}}">Stock Inventory</a>

                                <a class="dropdown-item" href="{{URL('/ExpenseReport')}}">Expense Report</a>



                            </div>

                        </div><!-- /btn-group -->



                    </div>

                </div>

            </form>
            @endif


        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">

                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <i class="mdi mdi-magnify"></i>

                </button>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">



                    <form class="p-3">

                        <div class="form-group m-0">

                            <div class="input-group">

                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">

                                <div class="input-group-append">

                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>





            <!-- <div class="dropdown d-none d-lg-inline-block ms-1">

    <button type="button" class="btn header-item noti-icon waves-effect"

    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

    <i class="bx bx-customize"></i>

    </button>

    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

        <div class="px-lg-2">

            <div class="row g-0">

                <div class="col">

                    <a class="dropdown-icon-item" href="#">

                        <img src="{{asset('assets/images/brands/github.png')}}" alt="Github"> 

                        <span>Leads</span>

                    </a>

                </div>

                <div class="col">

                    <a class="dropdown-icon-item" href="#">

                         <img src="assets/images/brands/bitbucket.png" alt="bitbucket"> 

                        <span>Booking <br>Payment</span>

                    </a>

                </div>

                <div class="col">

                    <a class="dropdown-icon-item" href="#">

                         <img src="assets/images/brands/dribbble.png" alt="dribbble"> 

                        <span>Dribbble</span>

                    </a>

                </div>

            </div>

            <div class="row g-0">

                <div class="col">

                    <a class="dropdown-icon-item" href="#">

                         <img src="assets/images/brands/dropbox.png" alt="dropbox"> 

                        <span>Dropbox</span>

                    </a>

                </div>

                <div class="col">

                    <a class="dropdown-icon-item" href="#">

                         <img src="assets/images/brands/mail_chimp.png" alt="mail_chimp"> 

                        <span>Mail Chimp</span>

                    </a>

                </div>

                <div class="col">

                    <a class="dropdown-icon-item" href="#">

                         <img src="assets/images/brands/slack.png" alt="slack"> 

                        <span>Slack</span>

                    </a>

                </div>

            </div>


                   <div class="row g-0">

                <div class="col">

                    <a class="dropdown-icon-item" href="#">

                         <img src="assets/images/brands/dropbox.png" alt="dropbox"> 

                        <span>Dropbox</span>

                    </a>

                </div>

                <div class="col">

                    <a class="dropdown-icon-item" href="#">

                         <img src="assets/images/brands/mail_chimp.png" alt="mail_chimp"> 

                        <span>Mail Chimp</span>

                    </a>

                </div>

                <div class="col">

                    <a class="dropdown-icon-item" href="#">

                         <img src="assets/images/brands/slack.png" alt="slack"> 

                        <span>Slack</span>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div> 
 -->



            <!-- leads -->
            <div class="dropdown d-inline-block">

                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">

                    <i class="bx bx-bell bx-tada"></i>

                    <span class="badge bg-danger rounded-pill">
                        <div id="bell">0</div>
                    </span>

                </button>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">

                    <div class="p-3">

                        <div class="row align-items-center">

                            <div class="col">

                                <h6 class="m-0" key="t-notifications"> Today Pending Bookings </h6>

                            </div>

                            <div class="col-auto">

                                <a href="{{URL('Booking?filter_creation_date=Today&filter_last_updated=')}}" class="small" key="t-view-all"> View All</a>

                            </div>

                        </div>

                    </div>

                    <div data-simplebar style="max-height: 230px;">



                        <!-- start -->




                        <div id="grid">

                        </div>





                        <!-- end -->



                    </div>

                    <div class="p-2 border-top d-grid">

                        <a class="btn btn-sm btn-link font-size-14 text-center" href="{{URL('Booking?filter_creation_date=Today&filter_last_updated=')}}">

                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span>

                        </a>

                    </div>

                </div>

            </div>
            <!-- end of leads -->


            <!-- booking alert who time is passed and status is pending -->

            <div class="dropdown d-inline-block">

                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">

                    <i class="bx bx-calendar"></i>

                    <span class="badge bg-danger rounded-pill">
                        <div id="booking_payment">0</div>
                    </span>

                </button>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">

                    <div class="p-3">

                        <div class="row align-items-center">

                            <div class="col">

                                <h6 class="m-0" key="t-notifications"> Pending Bookings </h6>

                            </div>

                            <div class="col-auto">

                                <a href="{{URL('Booking')}}" class="small" key="t-view-all"> View All</a>

                            </div>

                        </div>

                    </div>

                    <div data-simplebar style="max-height: 230px;">



                        <!-- start -->




                        <div id="grid_booking">

                        </div>





                        <!-- end -->



                    </div>

                    <div class="p-2 border-top d-grid">

                        <a class="btn btn-sm btn-link font-size-14 text-center" href="{{URL('Booking')}}">

                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span>

                        </a>

                    </div>

                </div>

            </div>

            <!-- end of booking alert -->











            <div class="dropdown d-inline-block">

                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <img class="rounded-circle header-profile-user" src="{{URL('/')}}/assets/images/users/avatar-1.jpg"
                        alt="Header Avatar">

                    <span class="d-none d-xl-inline-block ms-1 " key="t-henry">Setting</span>

                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>

                </button>

                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->

                    <a class="dropdown-item" href="{{URL('/UserProfile')}}">

                        <i class="bx bx-user font-size-16 align-middle me-1"></i>

                        <span key="t-profile">Profile</span></a>





                    <a class="dropdown-item d-block" href="{{URL('/ChangePassword')}}"><i
                            class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Change
                            Password</span></a>





                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item text-danger" href="{{URL('/Logout')}}"><i
                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                            key="t-logout">Logout</span></a>

                </div>

            </div>



        </div>

    </div>

</header>