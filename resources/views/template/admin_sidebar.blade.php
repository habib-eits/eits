<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>

                    <a href="{{ URL('/admin-dashboard') }}" class="waves-effect">

                        <i class="mdi mdi-speedometer-slow mb-0"></i>

                        <span key="t-dashboards">Dashboard</span>
                    </a>

                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-shopping-outline"></i>
                        <span key="t-ecommerce">CRM</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li> <a href="{{ URL('/leads') }}" key="t-products">Leads</a></li>
                        {{-- <li> <a href="{{ URL('/Booking') }}" key="t-products">Bookings</a></li> --}}
                        <li> <a href="{{ URL('/calendar') }}" key="t-products">Calendar</a></li>
                        <li> <a href="{{ URL('/Parties') }}" key="t-products">Customers</a></li>
                        <li> <a href="{{ route('followups.index') }}" key="t-products">Followups</a></li>



                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-cart-outline"></i>
                        <span key="t-ecommerce">Sales</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li> <a href="{{ URL('/SaleOrder') }}" key="t-products">Sale Order</a></li> --}}
                        {{-- <li> <a href="{{ URL('/PurchaseOrder') }}" key="t-products">Purchase Order</a></li> --}}
                        {{-- <li> <a href="{{ URL('/DeliveryChallan') }}" key="t-products">Delivery Notes</a></li> --}}
                        <li> <a href="{{ URL('/Invoice') }}" key="t-products">Invoices</a></li>
                        {{-- <li> <a href="{{ URL('/receipt-list') }}" key="t-products">Receipts</a></li> --}}


                        <li> <a href="{{ URL('/Estimate') }}" key="t-products">Quotation</a></li>
                        <li> <a href="{{ URL('/boq') }}" key="t-products">BOQ</a></li>



                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-ecommerce">Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">


                        <li><a href="{{ URL('/servicesStatusReport') }}" key="t-products">Lead Service Status Report</a>
                        </li>






                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-shopping-outline"></i>
                        <span key="t-ecommerce">CRM Setting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">


                        <li> <a href="{{ URL('/campaigns') }}" key="t-products">Compaigns</a></li>
                        <li> <a href="{{ URL('/branches') }}" key="t-products">Branches</a></li>
                        <!-- <li>  <a   href="{{ URL('/') }}" key="t-products" >Recurring Bills</a></li> -->
                        <li> <a href="{{ URL('/services') }}" key="t-products">Serivces</a></li>
                        <li> <a href="{{ URL('/subServices') }}" key="t-products">Sub Services</a></li>
                        <li> <a href="{{ URL('/statuses') }}" key="t-products">Leads Status</a></li>
                        <li> <a href="{{ URL('/qualifiedStatuses') }}" key="t-products">Qualified Status</a></li>
                        <li> <a href="{{ URL('/User') }}" key="t-products">User</a></li>
                        <li> <a href="{{ URL('/Company') }}" key="t-products">Company</a></li>
                        <li> <a href="{{ URL('/state') }}" key="t-products">States</a></li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <!-- <i class="mdi mdi-folder font-size-16 text-warning me-2"></i> -->
                                <span key="t-ecommerce">Documents</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">


                                <li><a href="{{ URL('/DocumentCategory') }}" key="t-products">Make Folder</a></li>
                                <li><a href="{{ URL('/Document') }}" key="t-products">Documents</a></li>
                                <li><a href="{{ URL('/Backup') }}" key="t-products">DB Backup</a></li>


                            </ul>
                        </li>

                    </ul>
                </li>








                <li>
                    <a href="{{ URL('/Logout') }}" class="waves-effect">
                        <i class="bx bx-power-off"></i>
                        <span key="t-calendar">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
