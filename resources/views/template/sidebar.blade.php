<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    
                    <a href="{{ URL('/super-admin-dashboard') }}" class="waves-effect">
                   
                        <i class="mdi mdi-speedometer-slow mb-0"></i>

                        <span key="t-dashboards">Dashboard</span>
                    </a>

                </li>
        
                <li>
                    <a href="{{ URL('/Item') }}" class="waves-effect">
                        <i class="bx bx bx-basket"></i>

                        <span key="t-dashboards">Items</span>
                    </a>

                </li>
             
         
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-cart-outline"></i>
                        <span key="t-ecommerce">Sales</span>
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



                    </ul>
                </li>


                <!-- CRM LINKS -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-shopping-outline"></i>
                        <span key="t-ecommerce">Purchases</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li> <a href="{{ URL('/Supplier') }}" key="t-products">Vendors</a></li>
                        <li> <a href="{{ URL('/Expense') }}" key="t-products">Expense</a></li>
                        <li> <a href="{{ URL('/Bill') }}" key="t-products">Bills</a></li>
                        <li> <a href="{{ URL('/PurchasePayment') }}" key="t-products">Payments Made</a></li>
                        <!-- <li>  <a   href="{{ URL('/') }}" key="t-products" >Recurring Bills</a></li> -->
                        <li> <a href="{{ URL('/DebitNote') }}" key="t-products">Debit Note Credit</a></li>
                    </ul>
                </li>
              
                <!-- END OF CRM LINKS -->
                <!-- hr links -->
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-ecommerce">HR</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li>
                            <a href="{{URL('/HRDashboard')}}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-dashboards">Dashboards</span>
                            </a>

                        </li>

                        <li>
                            <a href="{{URL('/Employee')}}" class="waves-effect">
                                <i class="bx bxs-user-plus"></i>
                                <span key="t-calendar">Employee</span>
                            </a>
                        </li>

                       

                        <li>
                            <a href="{{URL('/Attendance')}}" class="waves-effect">
                                <i class="mdi mdi-database-import-outline"></i>
                                <span key="t-calendar"> Mark Attendance</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-dollar-circle"></i>
                                <span key="t-ecommerce">Salary Section</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{URL('/Salary')}}" key="t-products">Make Salary</a></li>
                                <li><a href="{{URL('/ViewSalary')}}" key="t-products">Search Salary</a></li>


                            </ul>
                        </li>
                        <li>
                            <a href="{{URL('/Document')}}" class="waves-effect">
                                <i class="mdi mdi-database-import-outline"></i>
                                <span key="t-calendar">All Documents </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{URL('/Fleet')}}" class="waves-effect">
                                <i class="mdi mdi-car"></i>
                                <span key="t-calendar">Fleet Management </span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-hammer-wrench"></i>
                                <span key="t-ecommerce">Setting</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{URL('/Branches')}}" key="t-products">Branch</a></li>

                                <li><a href="{{URL('/DocumentCategory')}}" key="t-products">Document Category</a></li>
                                <li><a href="{{URL('/Departments')}}" key="t-products">Departments</a></li>
                                <li><a href="{{URL('/JobTitle')}}" key="t-products">Job Title</a></li>
                                <li><a href="{{URL('/Letter')}}" key="t-products">Letter Templates</a></li>
                                <li><a href="{{URL('/Team')}}" key="t-products">Team Structure</a></li>
                                <li><a href="{{URL('/Users')}}" key="t-products">Users</a></li>
                                <!-- <li><a href="{{URL('/Role')}}" key="t-products">User Rights & Control</a></li>  -->


                            </ul>
                        </li>

                        <li>
                            <a href="{{URL('/DailyReport')}}" class="waves-effect">
                                <i class="bx bx-file"></i>
                                <span key="t-calendar">Daily Report</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{URL('/NoticeBoard')}}" class="waves-effect">
                                <i class="bx bx-file"></i>
                                <span key="t-calendar">Notice Board</span>
                            </a>
                        </li>




                    </ul>
                </li>
            

                <!-- end of hr links -->


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-finance"></i>
                        <span key="t-ecommerce">Accounts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">


                        <li><a href="{{ URL('/Voucher') }}" key="t-products">Voucher</a></li>
                        <li><a href="{{ URL('/PettyCash') }}" key="t-products">Petty Cash</a></li>
                        <li><a href="{{ URL('/AdjustmentBalance') }}" key="t-products">Adjustment Balance</a></li>
                        <li><a href="{{ URL('/ChartOfAcc') }}" key="t-products">Chart of Account</a></li>






                    </ul>
                </li>

               

              
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-finance"></i>
                        <span key="t-ecommerce">Party Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">


                        <li><a href="{{ URL('/PartyLedger') }}" key="t-products">Party Ledger</a></li>
                        <li><a href="{{ URL('/PartyBalance') }}" key="t-products">Party Balance</a></li>
                        <li><a href="{{ URL('/PartyYearlyBalance') }}" key="t-products">Yearly Report</a></li>
                        <li><a href="{{ URL('/PartyAgingPDF') }}" key="t-products">Aging Report</a></li>
                        <!-- <li><a href="#" key="t-products" >Party Analysis</a></li> -->
                        <li><a href="{{ URL('/PartyList') }}" key="t-products">Party List</a></li>
                        <li><a href="{{ URL('/PartyWiseSale') }}" key="t-products">Partywise Sale (SOA)</a></li>
                        <li><a href="{{ URL('/OutStandingInvoice') }}" key="t-products">Outstanding Invoices</a></li>
                        <li><a href="{{ URL('/TaxReport') }}" key="t-products">Tax Report</a></li>


                        <li><a href="{{ URL('/CitywiseReport') }}" key="t-products">Saleman Party Balances</a></li>





                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-chart-areaspline"></i>
                        <span key="t-ecommerce">Supplier Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">


                        <li> <a href="{{ URL('/SupplierLedger') }}" key="t-products">Supplier Ledger</a></li>
                        <li> <a href="{{ URL('/SupplierBalance') }}" key="t-products">Supplier Balance</a></li>
                        <li> <a href="{{ URL('/Invoice') }}" key="t-products">Sale Invoice</a></li>
                        <li> <a href="{{ URL('/SalemanReport') }}" key="t-products">Sales Man Report</a></li>
                        <li> <a href="{{ URL('/TaxReport') }}" key="t-products">Tax Report</a></li>
                        <li> <a href="{{ URL('/SupplierWiseSale') }}" key="t-products">Purchase Report</a></li>


                    </ul>
                </li>




                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-chart-bell-curve-cumulative"></i>
                        <span key="t-ecommerce">Account Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">




                        <li><a key="t-products" href="{{ URL('/DailyIncomeExpense') }}">Daily Income / Expense</a>
                        </li>


                        <li><a key="t-products" href="{{ URL('/CashbookReport') }}">Cash Book</a></li>
                        <!--                  <li><a key="t-products" href="#">Sales man wise cash book</a></li>
                        -->
                        <li><a key="t-products" href="{{ URL('/DaybookReport') }}">Day book</a></li>
                        <li><a key="t-products" href="{{ URL('/GeneralLedger') }}">General Ledger</a></li>
                        <li><a key="t-products" href="{{ URL('/TrialBalance') }}">Trial Balance</a></li>
                        <li><a key="t-products" href="{{ URL('/TrialBalanceActivity') }}">Trial with Activity</a>
                        </li>
                        <li><a key="t-products" href="#">Yearly Summary</a></li>
                        <li><a key="t-products" href="{{ URL('/ProfitAndLoss') }}">Profit & Loss</a></li>
                        <li><a key="t-products" href="{{ URL('/BalanceSheet') }}">Balance Sheet</a></li>
                        <li><a key="t-products" href="{{ URL('/PartyBalance') }}">party balance</a></li>
                        <!--   <li><a key="t-products" href="#">ageing report</a></li>
                        <li><a key="t-products" href="#">cash flow</a></li> -->
                        <li><a key="t-products" href="{{ URL('/TaxOverallReport') }}">Tax Report</a></li>
                        <li><a key="t-products" href="{{ URL('/ReconcileReport') }}">Bank Reconciliation</a>

                        <li><a key="t-products" href="{{ URL('/InvoiceSummary') }}">Invoice Summary list</a></li>
                        <li><a key="t-products" href="{{ URL('/Inventory') }}">Stock Inventory</a>
                            <!-- <li><a key="t-products" href="{{ URL('/TicketRegister') }}">Invoice Detail</a></li> -->


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