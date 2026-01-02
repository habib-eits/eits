<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web Routes for your application. These
| Routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HR;



use App\Http\Controllers\KM;
use App\Http\Controllers\User;
use App\Http\Controllers\Accounts;
use App\Http\Controllers\Employee;
use App\Http\Controllers\Documents;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BOQController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminDashboard;

//HR
use App\Http\Controllers\AgentDashboard;
use App\Http\Controllers\AjaxController;

use App\Http\Controllers\ChartOfAccount;


// CRM CONTROLLERS
use App\Http\Controllers\LeadController;

use App\Http\Controllers\StaffController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\BranchController;
 use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CompanyController;


use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\FollowupController;
use App\Http\Controllers\SaleOrderController;
use App\Http\Controllers\SuperAdminDashboard;
use App\Http\Controllers\SubServiceController;
use App\Http\Controllers\LeadActivityController;



Route::get('/emails', [Accounts::class, 'sendEmail2']);

Route::get('/base1/', [KM::class, 'base1']);
Route::post('/base2/', [KM::class, 'base2']);




Route::get('/', [Accounts::class, 'Login']);
Route::get('/Login', [Accounts::class, 'Login']);
Route::post('/UserVerify', [Accounts::class, 'UserVerify']);
Route::get('/CreateHashPassword/{password}', [Accounts::class, 'CreateHashPassword']);



Route::group(['middleware' => ['CheckAdmin']], function () {

    // Route::get('/Dashboard', [Accounts::class, 'Dashboard']);
    Route::get('/admin-dashboard', AdminDashboard::class);
    Route::get('/super-admin-dashboard', SuperAdminDashboard::class);
    Route::get('/agent-dashboard', AgentDashboard::class);


    Route::get('/Prayer/', [KM::class, 'Prayer']);



    // Route::get('/Invoice', [Accounts::class, 'Invoice']);

    Route::get('/InvoiceCreate', [Accounts::class, 'InvoiceCreate']);
    // Route::get('/ajax_invoice', [Accounts::class, 'ajax_invoice']);

    Route::post('/InvoiceSave', [Accounts::class, 'InvoiceSave']);
    Route::get('/InvoiceEdit/{id}', [Accounts::class, 'InvoiceEdit']);
    // Route::get('/InvoicePDF/{id}', [Accounts::class, 'InvoicePDF']);
    Route::get('/InvoiceView/{id}', [Accounts::class, 'InvoiceView']);

    Route::post('/InvoiceUpdate', [Accounts::class, 'InvoiceUpdate']);
    Route::get('/InvoiceDelete/{id}', [Accounts::class, 'InvoiceDelete']);

    Route::post('/Ajax_Balance', [Accounts::class, 'Ajax_Balance']);
    Route::post('/Ajax_VHNO', [Accounts::class, 'Ajax_VHNO']);
    Route::post('/ajax_invoice_vhno', [Accounts::class, 'ajax_invoice_vhno']);


    Route::get('/Voucher', [Accounts::class, 'Voucher']);
    Route::get('/VoucherCreate/{vouchertype}', [Accounts::class, 'VoucherCreate']);
    Route::post('/VoucherSave', [Accounts::class, 'VoucherSave']);
    Route::get('/ajax_voucher', [Accounts::class, 'ajax_voucher']);
    Route::get('/VoucherEdit/{id}', [Accounts::class, 'VoucherEdit']);
    Route::post('/VoucherUpdate', [Accounts::class, 'VoucherUpdate']);
    Route::get('/VoucherDelete/{id}', [Accounts::class, 'VoucherDelete']);
    Route::get('/VoucherView/{id}', [Accounts::class, 'VoucherView']);

    Route::get('/JV/', [Accounts::class, 'JV']);
    Route::post('/JVSave/', [Accounts::class, 'JVSave']);


    Route::get('/Item', [Accounts::class, 'Item']);
    Route::post('/ItemSave', [Accounts::class, 'ItemSave']);
    Route::get('/ItemEdit/{id}', [Accounts::class, 'ItemEdit']);
    Route::post('/ItemUpdate/', [Accounts::class, 'ItemUpdate']);
    Route::get('/ItemDelete/{id}', [Accounts::class, 'ItemDelete']);

    Route::get('/ExpenseReport/', [Accounts::class, 'ExpenseReport']);
    Route::post('/ExpenseReport1/', [Accounts::class, 'ExpenseReport1']);


    Route::get('/User', [User::class, 'Show']);
    Route::post('/UserSave', [User::class, 'UserSave']);
    Route::get('/UserEdit/{id}', [User::class, 'UserEdit']);
    Route::post('/UserUpdate/', [User::class, 'UserUpdate']);
    Route::get('/UserDelete/{id}', [User::class, 'UserDelete']);



    Route::get('/Supplier', [Accounts::class, 'Supplier']);
    Route::post('/SaveSupplier', [Accounts::class, 'SaveSupplier']);
    Route::get('/SupplierEdit/{id}', [Accounts::class, 'SupplierEdit']);
    Route::post('/SupplierUpdate/', [Accounts::class, 'SupplierUpdate']);
    Route::get('/SupplierDelete/{id}', [Accounts::class, 'SupplierDelete']);
    Route::get('/SupplierDetail/{id?}', [Accounts::class, 'SupplierDetail']);
    Route::post('/SupplierDetailSave', [Accounts::class, 'SupplierDetailSave']);
    Route::get('/SupplierDetailDelete/{id?}', [Accounts::class, 'SupplierDetailDelete']);



    Route::get('/Parties', [Accounts::class, 'Parties']);
    Route::get('ajax_parties', [Accounts::class, 'ajax_parties'])->name('ajax.parties');
    Route::post('/SaveParties', [Accounts::class, 'SaveParties']);
    Route::get('/PartiesEdit/{id}', [Accounts::class, 'PartiesEdit']);
    Route::post('/PartiesUpdate/', [Accounts::class, 'PartiesUpdate']);
    Route::post('/PartiesUpdate1/', [Accounts::class, 'PartiesUpdate1']);
    Route::get('/PartiesDelete/{id}', [Accounts::class, 'PartiesDelete']);



    Route::get('/CheckUserRole1/{userid},{tablename},{action}', [Accounts::class, 'CheckUserRole1']);




    Route::get('/table', [Accounts::class, 'table']);
    Route::get('/datatable', [Accounts::class, 'datatable']);



    // Petty Cash

    Route::get('/PettyCashCreate', [Accounts::class, 'PettyCashCreate']);
    Route::get('/PettyCash', [Accounts::class, 'PettyCash']);
    Route::get('/ajax_pettycash', [Accounts::class, 'ajax_pettycash']);
    Route::post('/PettyCashSave', [Accounts::class, 'PettyCashSave']);
    Route::get('/PettyCashEdit/{id}', [Accounts::class, 'PettyCashEdit']);
    Route::post('/PettyCashUpdate', [Accounts::class, 'PettyCashUpdate']);
    Route::post('/Ajax_PVHNO', [Accounts::class, 'Ajax_PVHNO']);


    Route::get('/ChartOfAcc/', [ChartOfAccount::class, 'ChartOfAcc']);
    Route::post('/ChartOfAccountSave/', [ChartOfAccount::class, 'ChartOfAccountSave']);
    Route::post('/ChartOfAccountSaveL3/', [ChartOfAccount::class, 'ChartOfAccountSaveL3']);
    Route::get('/ChartOfAccountDelete/{ChartOfAccountID}', [ChartOfAccount::class, 'ChartOfAccountDelete']);
    Route::get('/ChartOfAccountEdit/{id}', [ChartOfAccount::class, 'ChartOfAccountEdit']);
    Route::post('/ChartOfAccountUpdate/', [ChartOfAccount::class, 'ChartOfAccountUpdate']);

    Route::get('/PartyLedger/', [Accounts::class, 'PartyLedger']);
    Route::post('/PartyLedger1/', [Accounts::class, 'PartyLedger1']);
    Route::post('/PartyLedger1PDF/', [Accounts::class, 'PartyLedger1PDF']);

    Route::post('/PartySalesLedger1PDF/', [Accounts::class, 'PartySalesLedger1PDF']);
    Route::post('/PartyLedger2PDF/', [Accounts::class, 'PartyLedger2PDF']);
    Route::post('/PartyLedgerAccount1PDF/', [Accounts::class, 'PartyLedgerAccount1PDF']);

    Route::post('/PartySalesLedger2PDF/', [Accounts::class, 'PartySalesLedger2PDF']);



    Route::get('/SupplierLedger/', [Accounts::class, 'SupplierLedger']);
    Route::get('/AdjustmentBalance/', [Accounts::class, 'AdjustmentBalance']);
    Route::post('/AdjustmentBalanceSave/', [Accounts::class, 'AdjustmentBalanceSave']);

    Route::get('/SupplierBalance/', [Accounts::class, 'SupplierBalance']);
    Route::post('/SupplierBalance1/', [Accounts::class, 'SupplierBalance1']);
    Route::post('/SupplierBalance1PDF/', [Accounts::class, 'SupplierBalance1PDF']);


    Route::get('/PartyList/', [Accounts::class, 'PartyList']);
    Route::get('/PartyListPDF/', [Accounts::class, 'PartyListPDF']);
    Route::get('/OutStandingInvoice/', [Accounts::class, 'OutStandingInvoice']);
    Route::post('/OutStandingInvoice1/', [Accounts::class, 'OutStandingInvoice1']);
    Route::post('/OutStandingInvoice1PDF/', [Accounts::class, 'OutStandingInvoice1PDF']);


    Route::get('/PartyWiseSale/', [Accounts::class, 'PartyWiseSale']);
    Route::post('/PartyWiseSale1/', [Accounts::class, 'PartyWiseSale1']);
    Route::post('/PartyWiseSale1PDF/', [Accounts::class, 'PartyWiseSale1PDF']);

    Route::get('/YearlyPartyBalance/', [Accounts::class, 'YearlyPartyBalance']);
    Route::post('/YearlyPartyBalance1/', [Accounts::class, 'YearlyPartyBalance1']);




    Route::get('/PartyBalance/', [Accounts::class, 'PartyBalance']);
    Route::post('/PartyBalance1/', [Accounts::class, 'PartyBalance1']);
    Route::post('/PartyBalance1PDF/', [Accounts::class, 'PartyBalance1PDF']);
    Route::post('/PartyBalanceAreawise2PDF/', [Accounts::class, 'PartyBalanceAreawise2PDF']);
    Route::post('/PartySaleItemWise/', [Accounts::class, 'PartySaleItemWise']);




    Route::get('/PartyYearlyBalance/', [Accounts::class, 'PartyYearlyBalance']);
    Route::post('/PartyYearlyBalance1/', [Accounts::class, 'PartyYearlyBalance1']);
    Route::post('/PartyYearlyBalance1PDF/', [Accounts::class, 'PartyYearlyBalance1PDF']);


    // supplier reports

    Route::get('/SupplierLedger/', [Accounts::class, 'SupplierLedger']);
    Route::post('/SupplierLedger1/', [Accounts::class, 'SupplierLedger1']);
    Route::post('/SupplierLedger1PDF/', [Accounts::class, 'SupplierLedger1PDF']);
    Route::post('/SupplierBillLedger2PDF/', [Accounts::class, 'SupplierBillLedger2PDF']);

    Route::get('/SupplierWiseSale/', [Accounts::class, 'SupplierWiseSale']);
    Route::post('/SupplierWiseSale1/', [Accounts::class, 'SupplierWiseSale1']);
    Route::post('/SupplierWiseSale1PDF/', [Accounts::class, 'SupplierWiseSale1PDF']);

    Route::get('/TaxReport/', [Accounts::class, 'TaxReport']);
    Route::post('/TaxReport1/', [Accounts::class, 'TaxReport1']);
    Route::post('/TaxReport1PDF/', [Accounts::class, 'TaxReport1PDF']);

    Route::get('/SalemanReport/', [Accounts::class, 'SalemanReport']);
    Route::post('/SalemanReport1/', [Accounts::class, 'SalemanReport1']);
    Route::post('/SalemanReport1PDF/', [Accounts::class, 'SalemanReport1PDF']);

    Route::get('/AirlineSummary/', [Accounts::class, 'AirlineSummary']);
    Route::post('/AirlineSummary1/', [Accounts::class, 'AirlineSummary1']);
    Route::post('/AirlineSummary1PDF/', [Accounts::class, 'AirlineSummary1PDF']);

    // accounts report

    Route::get('/VoucherReport/', [Accounts::class, 'VoucherReport']);
    Route::post('/VoucherReport1/', [Accounts::class, 'VoucherReport1']);
    Route::post('/VoucherReport1PDF/', [Accounts::class, 'VoucherReport1PDF']);

    Route::get('/CashbookReport/', [Accounts::class, 'CashbookReport']);
    Route::post('/CashbookReport1/', [Accounts::class, 'CashbookReport1']);
    Route::post('/CashbookReport1PDF/', [Accounts::class, 'CashbookReport1PDF']);

    Route::get('/DaybookReport/', [Accounts::class, 'DaybookReport']);
    Route::post('/DaybookReport1/', [Accounts::class, 'DaybookReport1']);
    Route::post('/DaybookReport1PDF/', [Accounts::class, 'DaybookReport1PDF']);


    Route::get('/GeneralLedger/', [Accounts::class, 'GeneralLedger']);
    Route::post('/GeneralLedger1/', [Accounts::class, 'GeneralLedger1']);
    Route::post('/GeneralLedger1PDF/', [Accounts::class, 'GeneralLedger1PDF']);

    Route::get('/TrialBalance/', [Accounts::class, 'TrialBalance']);
    Route::post('/TrialBalance1/', [Accounts::class, 'TrialBalance1']);
    Route::post('/TrialBalance1PDF/', [Accounts::class, 'TrialBalance1PDF']);


    Route::get('/TrialBalanceActivity/', [Accounts::class, 'TrialBalanceActivity']);
    Route::post('/TrialBalanceActivity1/', [Accounts::class, 'TrialBalanceActivity1']);
    Route::post('/TrialBalanceActivity1PDF/', [Accounts::class, 'TrialBalanceActivity1PDF']);

    Route::get('/BalanceSheet/', [Accounts::class, 'BalanceSheet']);
    Route::post('/BalanceSheet1/', [Accounts::class, 'BalanceSheet1']);
    Route::post('/BalanceSheet1PDF/', [Accounts::class, 'BalanceSheet1PDF']);

    Route::get('/BalanceSheetDetail/{ChartOfAccountID}/{StartDat}/{EndDate}', [Accounts::class, 'BalanceSheetDetail']);
    Route::get('/JournalEntries/{ChartOfAccountID}/{StartDat}/{EndDate}', [Accounts::class, 'JournalEntries']);


    Route::get('/TicketRegister/', [Accounts::class, 'TicketRegister']);
    Route::post('/TicketRegister1/', [Accounts::class, 'TicketRegister1']);
    Route::post('/TicketRegister1PDF/', [Accounts::class, 'TicketRegister1PDF']);

    Route::get('/InvoiceSummary/', [Accounts::class, 'InvoiceSummary']);
    Route::post('/InvoiceSummary1/', [Accounts::class, 'InvoiceSummary1']);
    Route::post('/InvoiceSummary1PDF/', [Accounts::class, 'InvoiceSummary1PDF']);

    Route::get('/ProfitAndLoss/', [Accounts::class, 'ProfitAndLoss']);
    Route::post('/ProfitAndLoss1/', [Accounts::class, 'ProfitAndLoss1']);
    Route::post('/ProfitAndLoss1PDF/', [Accounts::class, 'ProfitAndLoss1PDF']);




    Route::get('/tmp/', [Accounts::class, 'tmp']);

    Route::get('/Logout', [Accounts::class, 'Logout']);




    Route::get('/Role/{UserID}', [Accounts::class, 'Role']);
    Route::post('/RoleSave', [Accounts::class, 'RoleSave']);
    Route::get('/RoleView/{UserID}', [Accounts::class, 'RoleView']);
    Route::post('/RoleUpdate', [Accounts::class, 'RoleUpdate']);

    Route::get('/checkUserRole/{UserID}', [Accounts::class, 'checkUserRole']);


    Route::get('/UserProfile', [Accounts::class, 'UserProfile']);
    Route::get('/ChangePassword', [Accounts::class, 'ChangePassword']);
    Route::post('/UpdatePassword', [Accounts::class, 'UpdatePassword']);



    Route::get('/SalesInvoiceCreate/', [Accounts::class, 'SalesInvoiceCreate']);
    Route::post('/SaleInvoiceSave/', [Accounts::class, 'SaleInvoiceSave']);
    Route::get('/SaleInvoiceEdit/{id}', [Accounts::class, 'SaleInvoiceEdit']);
    Route::post('/SaleInvoiceUpdate/', [Accounts::class, 'SaleInvoiceUpdate']);
    Route::get('/SaleInvoiceDelete/{id}', [Accounts::class, 'SaleInvoiceDelete']);
    Route::get('/SaleInvoiceView/{id}', [Accounts::class, 'SaleInvoiceView']);
    Route::get('/SaleInvoiceViewPDF/{id}/{brancid}', [Accounts::class, 'SaleInvoiceViewPDF']);
    Route::get('/createInvoice/{id}', [Accounts::class, 'createInvoice']);
    
    Route::get('/InvoiceCreateAuto/{id}/{paymentno}', [Accounts::class, 'InvoiceCreateAuto']);
    Route::get('/DNCreateAuto/{id}', [Accounts::class, 'DNCreateAuto']);





    Route::get('/DeliveryChallan/', [Accounts::class, 'DeliveryChallan']);


    Route::get('/Payment/', [Accounts::class, 'Payment']);
    Route::get('/ajax_payment', [Accounts::class, 'ajax_payment']);

    Route::get('/PaymentCreate/', [Accounts::class, 'PaymentCreate']);

    Route::get('/Ajax_PartyInvoices/{id}', [Accounts::class, 'Ajax_PartyInvoices']);
    Route::get('/PaymentViewPDF/{id}', [Accounts::class, 'PaymentViewPDF']);


    Route::get('/DeliveryChallan/', [Accounts::class, 'DeliveryChallan']);
    Route::get('/ajax_deliverychallan/', [Accounts::class, 'Ajax_DeliveryChallan']);
    Route::get('/DeliveryChallanCreate/', [Accounts::class, 'DeliveryChallanCreate']);
    Route::post('/DeliveryChallanSave/', [Accounts::class, 'DeliveryChallanSave']);
    Route::get('/DeliveryChallanView/{id}', [Accounts::class, 'DeliveryChallanView']);
    Route::get('/DeliveryChallanViewPDF/{id}/{brancid}', [Accounts::class, 'DeliveryChallanViewPDF']);
    Route::get('/DeliveryChallanEdit/{id}', [Accounts::class, 'DeliveryChallanEdit']);
    Route::post('/DeliveryChallanUpdate/', [Accounts::class, 'DeliveryChallanUpdate']);



    Route::get('/DeliveryChallanDelete/{id}', [Accounts::class, 'DeliveryChallanDelete']);


    Route::get('/PaymentCreate/', [Accounts::class, 'PaymentCreate']);
    Route::post('/PaymentSave/', [Accounts::class, 'PaymentSave']);
    Route::get('/PaymentDelete/{id}', [Accounts::class, 'PaymentDelete']);

    // bulk payment from parties

    Route::get('/BulkPaymentCreate/', [Accounts::class, 'BulkPaymentCreate']);
    Route::post('/BulkPaymentSearch/', [Accounts::class, 'BulkPaymentSearch']);
    Route::post('/BulkPaymentSave/', [Accounts::class, 'BulkPaymentSave']);



    Route::get('/CreditNote/', [Accounts::class, 'CreditNote']);
    Route::get('/ajax_creditnote', [Accounts::class, 'ajax_creditnote']);

    Route::get('/CreditNoteCreate', [Accounts::class, 'CreditNoteCreate']);
    Route::post('/CreditNoteSave', [Accounts::class, 'CreditNoteSave']);
    Route::get('/CreditNoteEdit/{id}', [Accounts::class, 'CreditNoteEdit']);
    Route::post('/CreditNoteUpdate', [Accounts::class, 'CreditNoteUpdate']);
    Route::get('/CreditNoteDelete/{id}', [Accounts::class, 'CreditNoteDelete']);
    Route::get('/CreditNoteView/{id}', [Accounts::class, 'CreditNoteView']);
    Route::get('/CreditNoteViewPDF/{id}', [Accounts::class, 'CreditNoteViewPDF']);



    // ..............Bill / Purchase.............
    Route::get('/Bill/', [Accounts::class, 'Bill']);
    Route::get('/ajax_bill/', [Accounts::class, 'Ajax_bill']);
    Route::get('/BillCreate/', [Accounts::class, 'BillCreate']);
    Route::post('/BillSave/', [Accounts::class, 'BillSave']);
    Route::get('/BillEdit/{id}', [Accounts::class, 'BillEdit']);
    Route::post('/BillUpdate/', [Accounts::class, 'BillUpdate']);
    Route::get('/BillDelete/{id}', [Accounts::class, 'BillDelete']);
    Route::get('/BillView/{id}', [Accounts::class, 'BillView']);
    Route::get('/BillViewPDF/{id}', [Accounts::class, 'BillViewPDF']);

    // ..............Purchase Return .............
    Route::get('/DebitNote/', [Accounts::class, 'DebitNote']);
    Route::get('/ajax_debitnote/', [Accounts::class, 'ajax_debitnote']);
    Route::get('/DebitNoteCreate/', [Accounts::class, 'DebitNoteCreate']);
    Route::post('/DebitNoteSave/', [Accounts::class, 'DebitNoteSave']);
    Route::get('/DebitNoteEdit/{id}', [Accounts::class, 'DebitNoteEdit']);
    Route::post('/DebitNoteUpdate/', [Accounts::class, 'DebitNoteUpdate']);
    Route::get('/DebitNoteDelete/{id}', [Accounts::class, 'DebitNoteDelete']);
    Route::get('/DebitNoteView/{id}', [Accounts::class, 'DebitNoteView']);
    Route::get('/DebitNoteViewPDF/{id}', [Accounts::class, 'DebitNoteViewPDF']);

    // ..............Estimate.............
    Route::get('/Estimate/', [EstimateController::class, 'Estimate']);

    Route::get('/EstimateCreate/', [EstimateController::class, 'EstimateCreate']);
    Route::get('/CreateEstimateRevision/{id}', [EstimateController::class, 'createEstimateRevision']);
    Route::post('/ajax_estimate_vhno/', [EstimateController::class, 'ajax_estimate_vhno']);

    Route::post('/EstimateSave/', [EstimateController::class, 'EstimateSave']);
    Route::get('/ajax_estimate/', [EstimateController::class, 'ajax_estimate']);

    Route::get('/EstimateDelete/{id}', [EstimateController::class, 'EstimateDelete']);
    Route::get('/EstimateView/{id}', [EstimateController::class, 'EstimateView']);
    Route::get('/EstimateEdit/{id}', [EstimateController::class, 'EstimateEdit']);
    Route::post('/EstimateUpdate/', [EstimateController::class, 'EstimateUpdate']);
    Route::get('/BlankReport/', [Accounts::class, 'BlankReport']);
    Route::get('/EstimateViewPDF/{id}/{brancid}', [EstimateController::class, 'EstimateViewPDF']);
    Route::get('/EstimateApprove/{id}', [EstimateController::class, 'EstimateApprove']);
    Route::get('/PaymentPlan/{id}', [EstimateController::class, 'PaymentPlan']);
    Route::post('/EstimatePaymentReceived/', [EstimateController::class, 'EstimatePaymentReceived']);

     // ..............Job Section.............
    Route::get('/Job/', [JobController::class, 'Job']);

    Route::get('/JobCreate/', [JobController::class, 'JobCreate']);

    Route::post('/JobSave/', [JobController::class, 'JobSave']);
    Route::get('/ajax_job/', [JobController::class, 'ajax_job']);

    Route::get('/JobView/{id?}', [JobController::class, 'JobView']);
    Route::get('/JobEdit/{id}', [JobController::class, 'JobEdit']);
    Route::post('/JobUpdate/', [JobController::class, 'JobUpdate']);
    Route::get('/JobDelete/{id}', [JobController::class, 'JobDelete']);
    
    
    Route::post('/JobEmployeeSave/',[JobController::class,'JobEmployeeSave'])->name('jobstaff.store');
    Route::post('/JobEmployeeSave/',[JobController::class,'JobEmployeeSave'])->name('jobstaff.store');
    Route::get('/JobEmployeeDelete/{id}',[JobController::class,'JobEmployeeDelete'])->name('jobemployee.delete');
    Route::get('/JobEmployeeEdit/{id}',[JobController::class,'JobEmployeeEdit']);
    Route::post('/JobEmployeeUpdate',[JobController::class,'JobEmployeeUpdate'])->name('jobstaff.update');





Route::post('/JobToolAssign/',[JobController::class,'JobToolAssign'])->name('jobtool.assign');
Route::get('/JobToolDelete/{id}',[JobController::class,'JobToolDelete']);


Route::get('/JobCompletionReport/{jobid}',[JobController::class,'JobCompletionReport']);

    //.............Complete Journal..............
    Route::get('/completejournal', [ReportController::class, 'completejournal']);


    // ............Company............
    Route::get('/Company', [CompanyController::class, 'Company']);
    Route::post('/SaveCompany', [CompanyController::class, 'SaveCompany']);
    Route::get('/CompanyEdit/{id}', [CompanyController::class, 'CompanyEdit']);
    Route::post('/CompanyUpdate/', [CompanyController::class, 'CompanyUpdate']);
    Route::get('/CompanyDelete/{id}', [CompanyController::class, 'CompanyDelete']);

    // //................. PAYMENT FOR PURCHASES....................

    Route::get('/PurchasePayment/', [Accounts::class, 'PurchasePayment']);
    Route::get('/ajax_purchasepaymenttable', [Accounts::class, 'ajax_purchasepaymenttable']);
    Route::get('/PurchasePaymentCreate/', [Accounts::class, 'PurchasePaymentCreate']);
    Route::POST('/Ajax_SupplierInvoices/', [Accounts::class, 'Ajax_SupplierInvoices']);

    Route::post('/PurchasePaymentSave/', [Accounts::class, 'PurchasePaymentSave']);
    Route::get('/PurchasePaymentDelete/{id}', [Accounts::class, 'PurchasePaymentDelete']);
    Route::get('/PurchasePaymentView/{id}', [Accounts::class, 'PurchasePaymentView']);
    // // Ajax_SupplierInvoices


    //...................purchaseorder...........................
    Route::get('/PurchaseOrder/', [Accounts::class, 'PurchaseOrder']);
    Route::get('/ajax_purchaseorder/', [Accounts::class, 'ajax_purchaseorder']);
    Route::get('/PurchaseOrderCreate/', [Accounts::class, 'PurchaseOrderCreate']);
    Route::post('/PurchaseOrderSave/', [Accounts::class, 'PurchaseOrderSave']);
    Route::get('/PurchaseOrderEdit/{id}', [Accounts::class, 'PurchaseOrderEdit']);
    Route::post('/PurchaseOrderUpdate/', [Accounts::class, 'PurchaseOrderUpdate']);
    Route::get('/PurchaseOrderDelete/{id}', [Accounts::class, 'PurchaseOrderDelete']);
    Route::get('/PurchaseOrderView/{id}', [Accounts::class, 'PurchaseOrderView']);
    Route::get('/PurchaseOrderViewPDF/{id}/{brancid}', [Accounts::class, 'PurchaseOrderViewPDF']);
    Route::get('/createDeliveryNote/{id}', [Accounts::class, 'createDeliveryNote']);



    // ..............attachment iframe for all invoices ......
    Route::get('/Attachment', [Accounts::class, 'Attachment']);
    Route::post('AttachmentSave', [Accounts::class, 'AttachmentSave']);
    Route::get('AttachmentDelete/{id}/{filename}', [Accounts::class, 'AttachmentDelete']);

    Route::get('AttachmentRead', [Accounts::class, 'AttachmentRead']);



    //  ................Trail Report.............
    Route::get('/trialreportsearch', [ReportController::class, 'trialreportsearch']);
    Route::post('/trialreport', [ReportController::class, 'trialreport']);


    // ..................journal report...................

    Route::get('/generalReport', [ReportController::class, 'generalReport']);
    Route::get('/showGeneralReport', [ReportController::class, 'showGeneralReport']);
    Route::post('/searchjournal', [ReportController::class, 'searchByDate']);


    Route::get('/DailyIncomeExpense/', [Accounts::class, 'DailyIncomeExpense']);
    Route::post('/DailyIncomeExpense1PDF/', [Accounts::class, 'DailyIncomeExpense1PDF']);


    //  ............Payable..............
    Route::get('/payablesearch', [ReportController::class, 'payablesearch']);
    Route::post('/payable', [ReportController::class, 'payable']);


    //  ............Paymentsmade..............
    Route::get('/paymentsmadesearch', [ReportController::class, 'paymentsmadesearch']);
    Route::post('/paymentsmade', [ReportController::class, 'paymentsmade']);


    //  ............receiveabledetail..............
    Route::get('/receiveabledetailsearch', [ReportController::class, 'receiveabledetailsearch']);
    Route::post('/receiveabledetail', [ReportController::class, 'receiveabledetail']);

    //  ............receiveabledetailsummary..............
    Route::get('/receiveabledetailsummarysearch', [ReportController::class, 'receiveabledetailsummarysearch']);
    Route::post('/receiveabledetailsummary', [ReportController::class, 'receiveabledetailsummary']);

    //  ............Vendor Credits..............
    Route::get('/vendorcreditsearch', [ReportController::class, 'vendorcreditsearch']);
    Route::post('/vendorcredits', [ReportController::class, 'vendorcredits']);

    Route::get('/kashif/', [Accounts::class, 'kashif']);
    Route::get('/kupload/', [Accounts::class, 'kupload']);

    Route::get('/ReconcileReport/', [Accounts::class, 'ReconcileReport']);
    Route::post('/ReconcileReport1/', [Accounts::class, 'ReconcileReport1']);


    Route::get('/ReconcileUpdate/{status}/{id}', [Accounts::class, 'ReconcileUpdate']);



    Route::get('/Inventory/', [Accounts::class, 'Inventory']);
    Route::post('/Inventory1/', [Accounts::class, 'Inventory1']);

    Route::post('/Inventory1PDF/', [Accounts::class, 'Inventory1PDF']);
    Route::get('/lnventoryDetail/{itemid}/{startdate}/{enddate}', [Accounts::class, 'lnventoryDetail']);

    Route::get('/km/{id}', [Accounts::class, 'km']);


    // =====================================Expense Section=====================================
    Route::get('/Expense', [Accounts::class, 'Expense']);
    Route::get('/ExpenseCreate/', [Accounts::class, 'ExpenseCreate']);
    Route::get('/ajax_Expense', [Accounts::class, 'ajax_Expense']);

    Route::post('/ExpenseSave', [Accounts::class, 'ExpenseSave']);
    Route::get('/ExpenseEdit/{id}', [Accounts::class, 'ExpenseEdit']);
    Route::get('/ExpensePDF/{id}', [Accounts::class, 'ExpensePDF']);
    Route::get('/ExpenseView/{id}', [Accounts::class, 'ExpenseView']);

    Route::post('/ExpenseUpdate', [Accounts::class, 'ExpenseUpdate']);
    Route::get('/ExpenseDelete/{id}', [Accounts::class, 'ExpenseDelete']);

    Route::get('/TaxReportSupplier/', [Accounts::class, 'TaxReportSupplier']);
    Route::post('/TaxReportSupplier1/', [Accounts::class, 'TaxReportSupplier1']);
    Route::post('/TaxReportSupplier1PDF/', [Accounts::class, 'TaxReportSupplier1PDF']);


    Route::get('/TaxOverallReport/', [Accounts::class, 'TaxOverallReport']);
    Route::post('/TaxOverallReport1/', [Accounts::class, 'TaxOverallReport1']);
    Route::post('/TaxOverallReport1PDF/', [Accounts::class, 'TaxOverallReport1PDF']);


    // import item from excel
    Route::post('/ItemImport/', [Accounts::class, 'ItemImport']);
    Route::get('/base64/', [Accounts::class, 'base64']);



    Route::get('/PartyAgingPDF/', [Accounts::class, 'PartyAgingPDF']);




    // document category
    Route::get('/DocumentCategory', [Documents::class, 'DocumentCategory']);
    Route::Post('/DocumentCategorySave', [Documents::class, 'DocumentCategorySave']);
    Route::get('/DocumentCategoryDelete/{id}', [Documents::class, 'DocumentCategoryDelete']);
    Route::get('/DocumentCategoryEdit/{id}', [Documents::class, 'DocumentCategoryEdit']);
    Route::post('/DocumentCategoryUpdate/', [Documents::class, 'DocumentCategoryUpdate']);


    //Document section
    Route::get('/Document/{id?}', [Documents::class, 'Document']);
    Route::post('/DocumentSave', [Documents::class, 'DocumentSave']);
    Route::get('/DocumentDelete/{id}/{file}', [Documents::class, 'DocumentDelete']);



    Route::get('/DBDump/', [Accounts::class, 'DBDump']);


    Route::get('Backup', function () {

        /* php artisan migrate */
        \Artisan::call('database:backup');
        dd("Done");
    });




    Route::post('/DBDump/', [Accounts::class, 'DBDump']);
    Route::post('/Excel/', [Accounts::class, 'Excel']);

    Route::get('/SalesmanExport/{city}', [Accounts::class, 'SalesmanExport']);

    Route::get('/CitywiseReport/', [Accounts::class, 'CitywiseReport']);


    //...................SalesOrders...........................
    Route::get('/SaleOrder/', [SaleOrderController::class, 'SaleOrder']);
    Route::get('/SaleOrderCreate/', [SaleOrderController::class, 'SaleOrderCreate']);
    Route::post('/SaleOrderSave/', [SaleOrderController::class, 'SaleOrderSave']);
    Route::get('/ajax_saleorder/', [SaleOrderController::class, 'ajax_saleorder']);
    Route::get('/SaleOrderDelete/{id}', [SaleOrderController::class, 'SaleOrderDelete']);
    Route::get('/SaleOrderView/{id}', [SaleOrderController::class, 'SaleOrderView']);
    Route::get('/SaleOrderEdit/{id}', [SaleOrderController::class, 'SaleOrderEdit']);
    Route::post('/SaleOrderUpdate/', [SaleOrderController::class, 'SaleOrderUpdate']);
    Route::get('/SaleOrderViewPDF/{id}', [SaleOrderController::class, 'SaleOrderViewPDF']);
    Route::get('/SaleOrderApprove/{id}', [SaleOrderController::class, 'SaleOrderApprove']);
    Route::get('/createLPO/{id}', [SaleOrderController::class, 'createLPO']);



    Route::get('/Employee',[HR::class,'Employee']);
Route::get('/ajax_employee',[HR::class,'ajax_employee']);
Route::get('/HRDashboard',[HR::class,'Dashboard'])->name('kashif');
Route::get('/EmployeeCreate',[HR::class,'EmployeeCreate']);
Route::post('/EmployeeSave',[HR::class,'EmployeeSave']);
Route::get('/EmployeeDelete/{id}',[HR::class,'EmployeeDelete']);
Route::get('/Login',[HR::class,'Login']);
Route::get('/EmployeeDetail/{id?}',[HR::class,'EmployeeDetail']);
Route::get('/EmployeeEdit/{id}',[HR::class,'EmployeeEdit']);
Route::post('/EmployeeUpdate',[HR::class,'EmployeeUpdate']);


 route::get('/EmployeeDocuments/',[HR::class,'EmployeeDocuments']);
 route::post('/EmployeeDocumentUpload/',[HR::class,'EmployeeDocumentUpload']);
 route::get('/EmployeeDocumentDelete/{id}',[HR::class,'EmployeeDocumentDelete']);

 route::get('/EmployeeSalary/',[HR::class,'EmployeeSalary']);
 route::get('/EmployeeComission/{EmployeeID}/{MonthName}',[HR::class,'EmployeeComission']);
 route::get('/EmployeeLetters/',[HR::class,'EmployeeLetters']);
 route::post('/letter_issue_preview/',[HR::class,'letter_issue_preview']);
 route::post('/letter_issue_save/',[HR::class,'letter_issue_save']);
 route::get('/issue_letter_delete/{id}',[HR::class,'issue_letter_delete']);
 route::get('/issue_letter_edit/{id}',[HR::class,'issue_letter_edit']);
 route::post('/issue_letter_update',[HR::class,'issue_letter_update']);
 route::get('/issue_letter_print/{issue_letter_id}',[HR::class,'issue_letter_print']);


 route::post('/EmpSalarySave/',[HR::class,'EmpSalarySave']);
 route::post('/EmpSalaryUpdate/',[HR::class,'EmpSalaryUpdate']);
 route::post('/EmpAllowanceSave/',[HR::class,'EmpAllowanceSave']);
 route::get('/EmpAllowanceDelete/{id}',[HR::class,'EmpAllowanceDelete']);
 route::get('/EmployeeLoan/',[HR::class,'EmployeeLoan']);
 route::post('/LoanSave/',[HR::class,'LoanSave']);
 route::get('/LoanDelete/{id}',[HR::class,'LoanDelete']);
 route::get('/LoanInstallmentDelete/{id}',[HR::class,'LoanInstallmentDelete']);

 route::get('/Leave/',[HR::class,'Leave']);
 route::post('/LeaveSave/',[HR::class,'LeaveSave']);
 route::get('/ajax_leave',[HR::class,'ajax_leave']);
 route::get('/LeaveEdit/{id}',[HR::class,'LeaveEdit']);
 route::post('/LeaveUpdate',[HR::class,'LeaveUpdate']);

 route::get('/LeaveDelete/{id}',[HR::class,'LeaveDelete']);
 route::get('/LeaveDetail/{id}',[HR::class,'LeaveDetail']);

 route::get('/EmployeeLeaveReport/',[HR::class,'EmployeeLeaveReport']);
 route::get('/EmployeeAttendance/',[HR::class,'EmployeeAttendance']);
 route::get('/EmployeeWarningLeter/',[HR::class,'EmployeeWarningLeter']);
 route::get('/EmployeeTeam',[HR::class,'EmployeeTeam']);
route::get('/SalarySlip/{id?}',[HR::class,'SalarySlip']);

route::get('/VisaAlert',[HR::class,'VisaAlert']);
 route::get('/PassportAlert',[HR::class,'PassportAlert']);
 route::get('/LeaveAlert',[HR::class,'LeaveAlert']);
 route::get('/AttendanceAlert',[HR::class,'AttendanceAlert']);


 route::get('/Salary/',[HR::class,'Salary']);
 route::post('/Salary2/',[HR::class,'Salary2']);
 route::post('/SaveSalary/',[HR::class,'SaveSalary']);
 route::get('/ViewSalary/',[HR::class,'ViewSalary']);
 route::post('/SearchSalary/',[HR::class,'SearchSalary']);
 route::get('/SalaryPrint/{MonthName}/{BranchID}',[HR::class,'SalaryPrint']);
 route::get('/SalaryDelete/{id}',[HR::class,'SalaryDelete']);
 route::get('/SalaryEdit/{id}',[HR::class,'SalaryEdit']);
 route::post('/SalaryUpdate',[HR::class,'SalaryUpdate']);

Route::get('/Fleet/',[HR::class,'Fleet']);
Route::post('/FleetSave/',[HR::class,'FleetSave']);
Route::get('/FleetEdit/{id}',[HR::class,'FleetEdit']);
Route::post('/FleetUpdate/',[HR::class,'FleetUpdate']);
route::get('/FleetDelete/{id}',[HR::class,'FleetDelete']);
route::get('/FleetDetail/{id?}',[HR::class,'FleetDetail']);
Route::post('/FleetDetailSave/',[HR::class,'FleetDetailSave']);
route::get('/FleetDetailDelete/{id}',[HR::class,'FleetDetailDelete']);

 // branch section
 route::get('/Branches',[HR::class,'Branches']);
 route::Post('/BranchSave',[HR::class,'BranchSave']);
 route::get('/BranchDelete/{id}',[HR::class,'BranchDelete']);
 route::get('/BranchEdit/{id}',[HR::class,'BranchEdit']);
 route::post('/BranchUpdate/',[HR::class,'BranchUpdate']);

  // Department section
 route::get('/Departments',[HR::class,'Departments']);
 route::Post('/DepartmentSave',[HR::class,'DepartmentSave']);
 route::get('/DepartmentDelete/{id}',[HR::class,'DepartmentDelete']);
 route::get('/DepartmentEdit/{id}',[HR::class,'DepartmentEdit']);
 route::post('/DepartmentUpdate/',[HR::class,'DepartmentUpdate']);

 
 // Department section
 route::get('/JobTitle',[HR::class,'JobTitle']);
 route::Post('/JobTitleSave',[HR::class,'JobTitleSave']);
 route::get('/JobTitleDelete/{id}',[HR::class,'JobTitleDelete']);
 route::get('/JobTitleEdit/{id}',[HR::class,'JobTitleEdit']);
 route::post('/JobTitleUpdate/',[HR::class,'JobTitleUpdate']);
 

 route::get('/Letter/',[HR::class,'Letter']);
 route::post('/save_letter/',[HR::class,'save_letter']);
 route::get('/letter_delete/{id}',[HR::class,'letter_delete']);
 route::get('/letter_edit/{LetterID}',[HR::class,'letter_edit']);
 route::post('/letter_update/',[HR::class,'letter_update']);

  route::get('/Team',[HR::class,'Team']);


Route::get('/Attendance/',[HR::class,'Attendance']);
Route::get('/AttendanceCreate/',[HR::class,'AttendanceCreate']);
Route::post('/AttendanceSave/',[HR::class,'AttendanceSave']);
Route::get('/AttendanceDelete/{date}',[HR::class,'AttendanceDelete']);
Route::get('/AttendanceView/{date}',[HR::class,'AttendanceView']);


Route::post('/ajax_party_validate',[Accounts::class,'ajax_party_validate']);
Route::post('/ajax_party_save',[Accounts::class,'ajax_party_save']);

// CRM LINKS

     // --------------------------------Compaign Routes----------------------------
    Route::get('campaigns', [CampaignController::class, 'index'])->name('campaign.index');
    Route::post('campaignCreate', [CampaignController::class, 'store'])->name('campaign.store');
    Route::get('campaignEdit/{id}', [CampaignController::class, 'edit'])->name('campaign.edit');
    Route::post('campaignUpdate', [CampaignController::class, 'update'])->name('campaign.update');
    Route::get('campaignDelete/{id}', [CampaignController::class, 'delete'])->name('campaign.delete');

     // --------------------------------Branch Routes----------------------------
    Route::get('branches', [BranchController::class, 'index'])->name('branch.index');
    // Route::get('createbranch', [BranchController::class, 'create'])->name('branch.create');
    Route::post('storebranch', [BranchController::class, 'store'])->name('branch.store');
    Route::get('branchEdit/{id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::post('branchUpdate', [BranchController::class, 'update'])->name('branch.update');
    Route::get('branchDelete/{id}', [BranchController::class, 'delete'])->name('branch.delete');

    // --------------------------------Lead Routes----------------------------
    Route::get('leads', [LeadController::class, 'index'])->name('lead.index');
    Route::get('ajax_leads', [LeadController::class, 'ajax_leads'])->name('ajax_leads');
    Route::get('createlead', [LeadController::class, 'create'])->name('lead.create');
    Route::post('storelead', [LeadController::class, 'store'])->name('lead.store');
    Route::get('viewlead/{id}', [LeadController::class, 'show'])->name('lead.show');
    Route::get('editlead/{id}', [LeadController::class, 'edit'])->name('lead.edit');
    Route::post('updatelead/{id}', [LeadController::class, 'update'])->name('lead.update');
    Route::post('addLeadNote/', [LeadController::class, 'addLeadNote'])->name('lead.addNote');
    Route::get('leadDelete/{id}', [LeadController::class, 'delete'])->name('lead.delete');
    Route::post('bulkDeleteLeads', [LeadController::class, 'bulkDeleteLeads'])->name('lead.bulkDelete');
    Route::post('bulkReassignLeads', [LeadController::class, 'bulkReassignLeads'])->name('lead.bulkReassign');
    Route::post('bulkReassignNewLeads', [LeadController::class, 'bulkReassignNewLeads'])->name('lead.bulkReassignNew');
    Route::post('importlead', [LeadController::class, 'import'])->name('lead.import');
    Route::get('download/{file}', [LeadController::class, 'downloadFile'])->name('downloadFile');
    
   // routes/web.php
   Route::get('/fetch-leads', [LeadController::class, 'fetchLeads'])->name('fetch-leads');

    
    
    
    Route::get('ajaxGetAgents/{id?}', [AjaxController::class, 'ajaxGetAgents']);

    // --------------------------------Notifications----------------------------

    Route::get('ajaxGetLeads/', [AjaxController::class, 'ajaxGetLeads'])->name('check-database');
    Route::get('ajaxGetBookingPayment/', [AjaxController::class, 'ajaxGetBookingPayment'])->name('check-booking');

    Route::get('today-pending-bookings/', [AjaxController::class, 'ajaxGetTodayPendingBookings'])->name('notification.todayPeningBookings');
    Route::get('pending-bookings/', [AjaxController::class, 'ajaxGetPendingBookings'])->name('notification.peningBookings');

    
    // --------------------------------Notifications----------------------------



    // --------------------------------Lead Activity Routes----------------------------

    Route::resource('lead-activity', LeadActivityController::class);
    Route::resource('followups', FollowupController::class);




    // --------------------------------Staff Routes----------------------------
    Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
    // Route::get('createstaffmember', [StaffController::class, 'create'])->name('staff.create');
    Route::post('storestaffmember', [StaffController::class, 'store'])->name('staff.store');
    Route::get('staffMemberEdit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::post('staffMemberUpdate', [StaffController::class, 'update'])->name('staff.update');
    Route::get('staffMemberDelete/{id}', [StaffController::class, 'delete'])->name('staff.delete');


    // --------------------------------Services Routes----------------------------
    Route::get('services', [ServiceController::class, 'index'])->name('service.index');
    Route::post('serviceCreate', [ServiceController::class, 'store'])->name('service.store');
    Route::get('serviceEdit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('serviceUpdate', [ServiceController::class, 'update'])->name('service.update');
    Route::get('serviceDelete/{id}', [ServiceController::class, 'delete'])->name('service.delete');
    Route::get('ajaxGetServices/{id?}', [AjaxController::class, 'ajaxGetServices']);

    Route::get('servicesStatusReport', [ServiceController::class, 'servicesStatusReport']);
    Route::post('servicesStatusReport1', [ServiceController::class, 'servicesStatusReport1']);
   
    // --------------------------------SubServices Routes----------------------------
    Route::get('subServices', [SubServiceController::class, 'index'])->name('subService.index');
    Route::post('subServiceCreate', [SubServiceController::class, 'store'])->name('subService.store');
    Route::get('subServiceEdit/{id}', [SubServiceController::class, 'edit'])->name('subService.edit');
    Route::post('subServiceUpdate', [SubServiceController::class, 'update'])->name('subService.update');
    Route::get('subServiceDelete/{id}', [SubServiceController::class, 'delete'])->name('subService.delete');
    Route::get('ajaxGetSubservices/{id?}', [AjaxController::class, 'ajaxGetSubservices']);

    // --------------------------------Status Routes----------------------------
    Route::get('statuses', [StatusController::class, 'index'])->name('status.index');
    Route::post('statusCreate', [StatusController::class, 'store'])->name('status.store');
    Route::get('statusEdit/{id}', [StatusController::class, 'edit'])->name('status.edit');
    Route::post('statusUpdate', [StatusController::class, 'update'])->name('status.update');
    Route::get('statusDelete/{id}', [StatusController::class, 'delete'])->name('status.delete');

      // --------------------------------Qualified Status Routes----------------------------
    Route::get('qualifiedStatuses', [StatusController::class, 'qualifiedStatusIndex'])->name('qualifiedStatus.index');
    Route::post('qualifiedStatusCreate', [StatusController::class, 'qualifiedStatusStore'])->name('qualifiedStatus.store');
    Route::get('qualifiedStatusEdit/{id}', [StatusController::class, 'qualifiedStatusEdit'])->name('qualifiedStatus.edit');
    Route::post('qualifiedStatusUpdate', [StatusController::class, 'qualifiedStatusUpdate'])->name('qualifiedStatus.update');
    Route::get('qualifiedStatusDelete/{id}', [StatusController::class, 'qualifiedStatusDelete'])->name('qualifiedStatus.delete');

    Route::get('/Booking', [BookingController::class, 'index']);
    // Route::get('/calendar', [BookingController::class, 'calendar']);
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::get('/ajax_followup', [CalendarController::class, 'ajax_followup']);
    Route::post('/followup/update/{id}', [CalendarController::class, 'updateFollowup']);


    Route::get('/ajax_booking', [BookingController::class, 'ajax_booking']);
    Route::get('/BookingCreate/{id}', [BookingController::class, 'BookingCreate'])->name('booking.create');
    Route::post('/BookingSave', [BookingController::class, 'BookingSave']);

    Route::post('/BookingStore', [BookingController::class, 'store']);
    Route::post('/BookingUpdate', [BookingController::class, 'update']);
    Route::get('/BookingDelete/{id}', [BookingController::class, 'destroy']);
    Route::post('/BookingDraged/', [BookingController::class, 'BookingDraged']);

    Route::get('/BookingEdit/{id}', [BookingController::class, 'BookingEdit']);
    Route::post('/BookingUpdate1', [BookingController::class, 'BookingUpdate1']);

    Route::get('/BookingPayment/',[BookingController::class,'BookingPayment']);
    Route::get('/BookingStatus/{id}',[BookingController::class,'BookingStatus']);
    Route::get('/BookingView/{id}',[BookingController::class,'BookingView']);

        
// END OF CRM LINKS
    Route::get('/boq/create-revision/{id}', [BOQController::class, 'createRevision']);
    Route::get('/boq/create-boq/{lead}', [BOQController::class, 'createBOQ'])->name('boq-create');
    Route::get('/boq/create-invoice/{boq_id}', [BOQController::class, 'createInvoice'])->name('boq-invoice-create');
    // Route::get('/boq/update-boq/{id}/{lead_id}', [BOQController::class, 'createBOQ'])->name('boq-update');

    Route::resource('boq', BOQController::class);
    Route::get('/ajax_boq/', [BOQController::class, 'ajax_boq']);
    // Route::get('/boqViewPDF/{EstimareID}/{branchid}', [BOQController::class, 'boqViewPDF'])->name('boq-viewPDF');
    Route::get('/boqViewPDF/{EstimateMasterID}/{BranchID}/{download?}', [BOQController::class, 'boqViewPDF'])->name('boqViewPDF');

    Route::POST('/boq/item-delete', [BOQController::class, 'deleteBoqItem'])->name('boqItemDelete');


    Route::get('/InvoicePDF/{id}', [InvoiceController::class, 'InvoicePDF']);
    Route::get('/ReceiptPDF/{id}', [InvoiceController::class, 'ReceiptPDF']);
    Route::get('/Invoice', [InvoiceController::class, 'Invoice']);
    
    Route::get('/InvoiceCreate', [InvoiceController::class, 'InvoiceCreate']);
    Route::get('/ajax_invoice', [InvoiceController::class, 'ajax_invoice']);
    
    Route::get('/receipt-list', [InvoiceController::class, 'ReceiptList']);
    Route::get('/receipt-edit/{id}', [InvoiceController::class, 'editReceipt'])->name('editReceipt');
    Route::put('/receipt-update/{id}', [InvoiceController::class, 'updateReceipt'])->name('updateReceipt');
    Route::get('/sub-receiptPDF/{id}', [InvoiceController::class, 'subReceiptPDF'])->name('subReceiptPDF');


    Route::resource('invoice', InvoiceController::class);


    Route::resource('state', StateController::class);
    
    
        Route::get('boq-export/{id}', [BOQController::class, 'boqExport'])->name('boqExport');


});






// middleware end
