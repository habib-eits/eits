<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{ URL('/agent-dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-speedometer-slow mb-0"></i>

                        <span key="t-dashboards">Dashboard</span>
                    </a>

                </li>

                {{-- <li>
                    <a href="{{ URL('/Item') }}" class="waves-effect">
                        <i class="bx bx bx-basket"></i>

                        <span key="t-dashboards">Items</span>
                    </a>

                </li> --}}
                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-cart-outline"></i>
                        <span key="t-ecommerce">Sale</span>
                    </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li> <a href="{{ URL('/SaleOrder') }}" key="t-products">Sale Order</a></li>
                        <li> <a href="{{ URL('/PurchaseOrder') }}" key="t-products">Purchase Order</a></li>
                        <li> <a href="{{ URL('/DeliveryChallan') }}" key="t-products">Delivery Notes</a></li>
                        <li> <a href="{{ URL('/Invoice') }}" key="t-products">Invoices</a></li>

                        <li> <a href="{{ URL('/Parties') }}" key="t-products">Customers</a></li>
                        <li> <a href="{{ URL('/Estimate') }}" key="t-products">Quotation</a></li>
                        <!-- <li> <a href="{{ URL('/Job') }}" key="t-products">Job </a></li> -->
                        <li> <a href="{{ URL('/Payment') }}" key="t-products">Payment Received</a></li>
                        <li> <a href="{{ URL('/BulkPaymentCreate') }}" key="t-products">Bulk Payment Received</a></li>
                        <li> <a href="{{ URL('/CreditNote') }}" key="t-products">Credit Notes</a></li>


                    </ul>
                </li> --}}

                 
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-shopping-outline"></i>
                        <span key="t-ecommerce">CRM</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li> <a href="{{ URL('/leads') }}" key="t-products">Leads</a></li>
                        <li> <a href="{{ URL('/Booking') }}" key="t-products">Bookings</a></li>
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
                        <li> <a href="{{ URL('/PurchaseOrder') }}" key="t-products">Purchase Order</a></li>
                        {{-- <li> <a href="{{ URL('/DeliveryChallan') }}" key="t-products">Delivery Notes</a></li> --}}
                        <li> <a href="{{ URL('/Invoice') }}" key="t-products">Invoices</a></li>
                        {{-- <li> <a href="{{ URL('/receipt-list') }}" key="t-products">Receipts</a></li> --}}

                       
                        <li> <a href="{{ URL('/Estimate') }}" key="t-products">Quotation</a></li>
                        <li> <a href="{{ URL('/boq') }}" key="t-products">BOQ</a></li>
                       


                    </ul>
                </li>
               


<!-- CRM LINKS -->
                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-shopping-outline"></i>
                        <span key="t-ecommerce">Purchases</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li> <a href="{{ URL('/Supplier') }}" key="t-products">Vendors</a></li>
                        <li> <a href="{{ URL('/Expense') }}" key="t-products">Expense</a></li>
                        <li> <a href="{{ URL('/Bill') }}" key="t-products">Bills</a></li>
                        <li> <a href="{{ URL('/PurchasePayment') }}" key="t-products">Payments Made</a></li>
                      
                        <li> <a href="{{ URL('/DebitNote') }}" key="t-products">Debit Note Credit</a></li>
                    </ul>
                </li> --}}

  

             
          
         
           



 
             
           


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
