<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\ReportsController;
//--HR & Admin
use App\Http\Controllers\Admin\BackViewController;
use App\Http\Controllers\Admin\InfoEmployeeController;
use App\Http\Controllers\Admin\LeaveApplicationController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\SalaryController;
//--Inventory
use App\Http\Controllers\Inventory\PurchaseController;
use App\Http\Controllers\Inventory\StoreTransferController;
use App\Http\Controllers\Inventory\StockPositionController;
//--Sales
use App\Http\Controllers\Sales\SalesQuotationController;
use App\Http\Controllers\Sales\SalesController;
use App\Http\Controllers\Sales\SalesReturnController;
//--Warranty
use App\Http\Controllers\Warranty\ComplaintIssueController;
use App\Http\Controllers\Warranty\RequisitionController;
use App\Http\Controllers\Warranty\ServiceBillController;
use App\Http\Controllers\Warranty\SparePartController;
use App\Http\Controllers\Warranty\JobCardController;


//--Master Data
use App\Http\Controllers\Master\MastDepartmentController;
use App\Http\Controllers\Master\MastDesignationController;
use App\Http\Controllers\Master\MastLeaveController;
use App\Http\Controllers\Master\MastEmployeeTypeController;
use App\Http\Controllers\Master\HolidayController;
use App\Http\Controllers\Master\MastWorkStationController;

use App\Http\Controllers\Master\MastUnitController;
use App\Http\Controllers\Master\MastItemCategoryController;
use App\Http\Controllers\Master\MastItemGroupController;
use App\Http\Controllers\Master\MastItemRegisterController;
use App\Http\Controllers\Master\MastSupplierController;
use App\Http\Controllers\Master\MastItemModelsController;

use App\Http\Controllers\Master\MastCompliantTypeController;
use App\Http\Controllers\Master\MastTechnicianController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('auth.login');
// });

//==================// Location //==================//
Route::get('/location', [LocationController::class, 'index'])->name('location');
Route::get('/get-districts', [LocationController::class, 'getDistricts'])->name('get_districts');
Route::get('/get-upazila', [LocationController::class, 'getUpazilas'])->name('get_upazila');
Route::get('/get-thana', [LocationController::class, 'getThanas'])->name('get_thana');


//____________________// START \\_________________//
Route::middleware([ 'auth:sanctum','verified', config('jetstream.auth_session')])->group(function () {
    Route::get('/', [BackViewController::class, 'dashboard'])->name('dashboard')->middleware('auth');
    Route::get('/coming_soon', [BackViewController::class, 'coming_soon'])->name('coming_soon')->middleware('auth');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});


Route::group(['middleware' => ['auth']], function(){
    /**______________________________________________________________________________________________
     * HR & ADMIN => Employee Register
     * ______________________________________________________________________________________________
     */
    //--Employee List
    Route::get('info_employee/list', [InfoEmployeeController::class, 'employee_list'])->name('info_employee.list');
    Route::get('info_employee/details/{id}', [InfoEmployeeController::class, 'employee_details'])->name('info_employee.details');
    Route::get('info_employee/edit/{id}', [InfoEmployeeController::class, 'employee_edit'])->name('info_employee.edit');
    Route::post('info_employee/update/{id}', [InfoEmployeeController::class, 'employee_update'])->name('info_employee.update');
    //--Employee Register
    Route::get('employee/register/create', [InfoEmployeeController::class, 'employee_create'])->name('employee_register.create');
    Route::post('employee/register/store', [InfoEmployeeController::class, 'employee_register'])->name('employee_register.store');
    Route::get('employee/register/destroy/{id}', [InfoEmployeeController::class, 'employee_destroy'])->name('employee_register.destroy');
    Route::post('/change-password/{id}', [InfoEmployeeController::class, 'profileUpdate'])->name('change.password');
    //--Personal Information
    Route::get('employee/info_prsonal/create/{id}', [InfoEmployeeController::class, 'personal_create'])->name('info_employee_prsonal.create');
    Route::post('employee/info_prsonal/store/{id}', [InfoEmployeeController::class, 'personal_store'])->name('info_employee_prsonal.store');
    //--Related Information
    Route::get('employee/info_related/create/{id}', [InfoEmployeeController::class, 'related_create'])->name('info_employee_related.create');
    Route::post('employee/info_related/store/{id}', [InfoEmployeeController::class, 'related_store'])->name('info_employee_related.store');

    Route::delete('info_related/education/destroy/{id}', [InfoEmployeeController::class, 'info_education_destroy'])->name('info_education.destroy');
    Route::delete('info_related/experience/destroy/{id}', [InfoEmployeeController::class, 'info_experience_destroy'])->name('info_experience.destroy');
    Route::delete('info_related/info_bank/destroy/{id}', [InfoEmployeeController::class, 'info_bank_destroy'])->name('info_bank.destroy');
    Route::delete('info_related/info_nominee/destroy/{id}', [InfoEmployeeController::class, 'info_nominee_destroy'])->name('info_nominee.destroy');

    /**______________________________________________________________________________________________
     * HR & ADMIN => Leave
     * ______________________________________________________________________________________________
     */
    Route::get('leave/self', [LeaveApplicationController::class, 'leave_application'])->name('leave_self.create');
    Route::get('get/employee_code', [LeaveApplicationController::class, 'getEmployeeCode'])->name('get_employee_code');
    Route::post('leave_application/store', [LeaveApplicationController::class, 'store'])->name('leave_application.store');
    Route::get('emergency_leave/application', [LeaveApplicationController::class, 'emergency_leave'])->name('emergency_leave.create');
    Route::post('leave_application/store', [LeaveApplicationController::class, 'store'])->name('leave_application.store');
    Route::get('get/emargency_leave_repot', [LeaveApplicationController::class,'getLeaveApplication_report'])->name('get_emargency_leave_repot');
    //--Leave Department Approve
    Route::get('dept/approve_list', [LeaveApplicationController::class, 'dept_approve_list'])->name('dept_approve_list.create');
    Route::PATCH('leave_dept/approve/{id}', [LeaveApplicationController::class, 'dept_approve'])->name('leave_dept.approve');
    //--Leave HR Approve
    Route::get('hr/approve_list', [LeaveApplicationController::class, 'hr_approve_list'])->name('hr_approve_list.create');
    Route::PATCH('leave_hr/approve/{id}', [LeaveApplicationController::class, 'hr_approve'])->name('leave_hr.approve');
    Route::PATCH('leave_application/canceled/{id}', [LeaveApplicationController::class, 'decline'])->name('leave_application.canceled');

    /**______________________________________________________________________________________________
     * HR & ADMIN => Attendances
     * ______________________________________________________________________________________________
     */
    Route::get('manual_attendances/index', [AttendanceController::class, 'index'])->name('manual_attendances.index');
    Route::post('manual_attendances/store', [AttendanceController::class, 'store'])->name('manual_attendances.store');
    Route::delete('manual_attendances/delete/{id}', [AttendanceController::class, 'destroy'])->name('manual_attendances.destroy');
    Route::post('attendances/attendanceId_store', [AttendanceController::class, 'setUpAttendanceID'])->name('setup-attendance-store');

    Route::get('attendance/approve_list', [AttendanceController::class, 'attendance_approve_list'])->name('attendance_approve.create');
    Route::PATCH('attendance/approve/{id}', [AttendanceController::class, 'attendance_approve'])->name('attendance.approve');
    Route::PATCH('attendance/canceled/{id}', [AttendanceController::class, 'decline'])->name('attendance.canceled');

    Route::get('get/attendance/filter', [AttendanceController::class, 'filterDate'])->name('get-attendance-filter');
    //--Attendances Imports or Exports Excel
    Route::post('attendance/upload', [AttendanceController::class, 'uploadAttendance'])->name('attendance.upload');
    Route::get('attendance/export', [AttendanceController::class, 'exportAttendance'])->name('attendance.export');

    /**______________________________________________________________________________________________
     * HR & ADMIN => Salary
     * ______________________________________________________________________________________________
     */
    Route::get('salary-structure/index', [SalaryController::class, 'salaryStructureIndex'])->name('salary-structure.index');
    Route::post('salary-structure/store', [SalaryController::class, 'salaryStructureStore'])->name('salary-structure.store');
    Route::get('get/salary-stucture', [SalaryController::class, 'getSalaryStucture'])->name('get-salary-stucture');

    Route::get('salary-process/index', [SalaryController::class, 'salaryProcessIndex'])->name('salary-process.index');
    Route::get('get/salary-process/filter', [SalaryController::class, 'salaryProcessFilter'])->name('salary-process-filter');
    Route::post('salary-process/store', [SalaryController::class, 'salaryProcessStore'])->name('salary-process.store');

    Route::get('salary-sheet/index', [SalaryController::class, 'salarySheetIndex'])->name('salary-sheet.index');
    Route::post('salary-sheet/distribution', [SalaryController::class, 'salarySheetDistribution'])->name('salary-sheet.distribution');
    Route::get('get/salary-sheet/filter', [SalaryController::class, 'salarySheetFilter'])->name('salary-sheet.filter');
    Route::get('salary-pay-slip/{id}/download', [SalaryController::class, 'salaryPaySlipDownload'])->name('salary-pay-slip.download');

    Route::get('salary-pay-slip/index', [SalaryController::class, 'salaryPaySlipIndex'])->name('salary-pay-slip.index');

    /**______________________________________________________________________________________________
     * Inventory => GRN
     * ______________________________________________________________________________________________
     */
    Route::get('inv/grn-purchase/index', [MovementController::class, 'grnPurchaseIndex'])->name('grn-purchase.index');
    Route::get('inv/grn-purchase/details/{id}', [MovementController::class, 'grnPurchaseDetails'])->name('grn-purchase-details');
    Route::post('inv/grn/purchase/store', [MovementController::class, 'grnPurchaseStore'])->name('grn-purchase.store');
    Route::get('inv/get-purchase/details', [MovementController::class, 'getPurchaseDetails'])->name('get_purchase_details');

    Route::get('inv/check-serial-number', [MovementController::class, 'checkSerialNumber'])->name('checkSerialNumber');
    Route::get('inv/purchase-parsial/{id}/details', [MovementController::class, 'parsialPurchaseDetails'])->name('purchase-details-parsial');
    /**______________________________________________________________________________________________
     * Inventory => Sales Delivery
     * ______________________________________________________________________________________________
     */
    Route::get('inv/sales-delivery/index', [MovementController::class, 'salesDeliveryIndex'])->name('sales-delivery.index');
    Route::get('inv/sales-delivery/details/{id}', [MovementController::class, 'salesDeliveryDetails'])->name('sales-delivery-details');
    Route::post('inv/sales-delivery/store', [MovementController::class, 'salesDeliveryStore'])->name('sales-delivery.store');
    Route::get('inv/get-sales-delivery/details', [MovementController::class, 'getSalesDetails'])->name('get_sales_details');

    Route::get('inv/sales-delivery-parsial/{id}/details', [MovementController::class, 'parsialSalesDeliveryDetails'])->name('sales-delivery-details-parsial');
    Route::get('inv/get-serial-no', [MovementController::class,'getSerialNumber'])->name('get-serial-no');
    Route::get('get-sales-delivery/slno', [MovementController::class,'getSalesDeliverySlNo'])->name('get-sales-delivery-slno');
    /**______________________________________________________________________________________________
     * Inventory => Store Delivery
     * ______________________________________________________________________________________________
     */
    Route::get('inv/store-delivery/index', [MovementController::class, 'storeDeliveryIndex'])->name('store-delivery.index');
    Route::get('inv/store-delivery/details/{id}', [MovementController::class, 'storeDeliveryDetails'])->name('store-delivery-details');
    Route::post('inv/store-delivery/store', [MovementController::class, 'storeDeliveryStore'])->name('store-delivery.store');
    Route::get('inv/get-store-delivery/details', [MovementController::class, 'getStoreTransferDetails'])->name('get_store_transfer_details');

    Route::get('inv/store-delivery-parsial/{id}/details', [MovementController::class, 'parsialstoreDeliveryDetails'])->name('store-delivery-details-parsial');
    /**______________________________________________________________________________________________
     * Inventory => Purchase
     * ______________________________________________________________________________________________
     */
    Route::get('/purchase/cat_id={cat_id}',[PurchaseController::class,'index'])->name('inv_purchase.index');
    Route::post('/purchase/store/cat_id={cat_id}', [PurchaseController::class, 'store'])->name('inv_purchase.store');
    Route::get('purchase/edit',[PurchaseController::class,'edit'])->name('inv_purchase_edit');
    Route::delete('inv_purchase/destroy/{id}', [PurchaseController::class, 'inv_purchase_destroy'])->name('inv_purchase.destroy');
    Route::delete('inv_approve_purchase/{id}', [PurchaseController::class, 'approve_purchase'])->name('inv_approve_purchase');
    Route::get('/get-delete-master/purchase',[PurchaseController::class,'getDeleteMaster'])->name('getDelete-master-purchase');
    //--Purchase Approve
    Route::get('inv_purchase/approve_list', [PurchaseController::class, 'purchase_approve_list'])->name('inv_purchase_approve.create');
    Route::PATCH('inv_purchase/approve/{id}', [PurchaseController::class, 'approve_purchase'])->name('inv_purchase.approve');
    Route::PATCH('inv_purchase/canceled/{id}', [PurchaseController::class, 'decline'])->name('inv_purchase.canceled');
    Route::get('inv/get-purchase/approve/details', [PurchaseController::class, 'getPurchaseApproveDetails'])->name('get_purchase_approve_details');

    Route::get('/get-part-id',[PurchaseController::class,'getPartNumber'])->name('get-part-id');
    Route::get('/get-part-number',[PurchaseController::class,'getPartNo'])->name('get-part-number');
    Route::get('get/edit-part-id',[PurchaseController::class,'getEditPartNo'])->name('edit-part-id');
    /**______________________________________________________________________________________________
     * Inventory => Store Transfer
     * ______________________________________________________________________________________________
     */
    Route::get('store/transfer/cat_id={cat_id}',[StoreTransferController::class,'index'])->name('store_transfer.index');
    Route::post('store/transfer/store/cat_id={cat_id}', [StoreTransferController::class, 'store'])->name('store_transfer.store');
    Route::get('store/transfer/edit',[StoreTransferController::class,'edit'])->name('store_transfer.edit');
    Route::delete('store/transfer/destroy/{id}', [StoreTransferController::class, 'storeDetailsDestroy'])->name('store_transfer.destroy');
    Route::get('/get-delete-master/storeTransfer',[StoreTransferController::class,'getDeleteMaster'])->name('getDelete-master-storeTransfer');

    //--Store Transfer Approve
    Route::get('store/transfer/approve_list', [StoreTransferController::class, 'storeTransferApprove'])->name('store_transfer_approve.create');
    Route::PATCH('store/transfer/approve/{id}', [StoreTransferController::class, 'approve'])->name('store_transfer.approve');
    Route::PATCH('store/transfer/canceled/{id}', [StoreTransferController::class, 'decline'])->name('store_transfer.canceled');
    Route::PATCH('store/transfer/receive/{id}', [StoreTransferController::class, 'receive'])->name('store_transfer.receive');
    Route::get('get/store-transfer/approve/details', [StoreTransferController::class, 'getStoreTransferApproveDetails'])->name('get_store_transfer_approve_details');
    /**______________________________________________________________________________________________
     * Inventory => Stock Position
     * ______________________________________________________________________________________________
     */
     Route::get('stock-position/index',[StockPositionController::class,'index'])->name('stock-position.index');

    /**______________________________________________________________________________________________
     * Inventory => Reports
     * ______________________________________________________________________________________________
     */
     Route::get('parsial-purchase/details',[ReportsController::class,'parsialPurchaseDetails'])->name('parsial-purchase-details');
     Route::get('download/purchase-receive/{id}/pdf', [ReportsController::class, 'generatePurchaseReceive'])->name('purchase-receive.download');
     Route::get('download/parsial-purchase/recived/{data}/{id}',[ReportsController::class,'generatePurchaseReceiveDetails'])->name('parsial-purchase-recived.download');

     //-----------------------------SALES DELIVERY
     Route::get('parsial-sales/details',[ReportsController::class,'salesDeliveryDetails'])->name('parsial-sales-details');
     Route::get('download/sales-delivery/{id}/pdf', [ReportsController::class, 'generateSalesDelivery'])->name('sales-delivery.download');
     Route::get('download/sales-delivery/details/{data}/{id}',[ReportsController::class,'generateSalesDeliveryDetails'])->name('parsial-sales-delivery.download');

     //-----------------------------REQUSTION DELIVERY
     Route::get('parsial-store/parsial',[ReportsController::class,'storeDelivery'])->name('parsial-store-delivery');
     Route::get('download/store-delivery/{id}/pdf/download', [ReportsController::class, 'generateStoreDelivery'])->name('store-delivery.download');
     Route::get('download/store-delivery/details/{data}/{id}',[ReportsController::class,'generateStoreDeliveryDetails'])->name('parsial-store-delivery.download');


    /**______________________________________________________________________________________________
     * Sales => Sales Quotation
     * ______________________________________________________________________________________________
     */
    Route::get('sales_quotation/cat_id={cat_id}',[SalesQuotationController::class,'index'])->name('sales_quotation.index');
    Route::post('sales_quotation/store/cat_id={cat_id}', [SalesQuotationController::class, 'store'])->name('sales_quotation.store');
    Route::get('sales_quotation/edit',[SalesQuotationController::class,'edit'])->name('sales_quotation.edit');
    Route::delete('sales_quotation/destroy/{id}', [SalesQuotationController::class, 'quotation_destroy'])->name('sales_quotation.destroy');
    Route::get('/get-delete-master/sales_quotation',[SalesQuotationController::class,'getDeleteMaster'])->name('getDelete-master-sales_quotation');
    //--Sales Approve
    Route::get('sales_quotation/approve_list', [SalesQuotationController::class, 'quotation_approve_list'])->name('sales_quotation_approve.index');
    Route::post('sales_quotation/approve', [SalesQuotationController::class, 'approve'])->name('sales_quotation.approve');
    Route::PATCH('sales_quotation/canceled/{id}', [SalesQuotationController::class, 'decline'])->name('sales_quotation.canceled');
    Route::get('get/sales-quotation/details', [SalesQuotationController::class, 'getQuotationDetails'])->name('get_quotation_details');
    //--Get Data
    Route::get('get-customer/data',[SalesQuotationController::class,'getCustomerData'])->name('get-customer-data');

    /**______________________________________________________________________________________________
     * Sales => Sales
     * ______________________________________________________________________________________________
     */
     Route::get('sales/cat_id={cat_id}',[SalesController::class,'index'])->name('sales.index');
     Route::post('sales/store/cat_id={cat_id}', [SalesController::class, 'store'])->name('sales.store');
     Route::get('sales/edit',[SalesController::class,'edit'])->name('sales.edit');
     Route::delete('sales/destroy/{id}', [SalesController::class, 'sales_destroy'])->name('sales.destroy');
     Route::get('/get-delete-master/sales',[SalesController::class,'getDeleteMaster'])->name('getDelete-master-sales');
     //--Sales Approve
    Route::get('sales/approve_list', [SalesController::class, 'sales_approve_list'])->name('sales_approve.create');
    Route::PATCH('sales/approve/{id}', [SalesController::class, 'approve'])->name('sales.approve');
    Route::PATCH('sales/canceled/{id}', [SalesController::class, 'decline'])->name('sales.canceled');
    Route::get('sales/get-sales/approve/details', [SalesController::class, 'getSalesApproveDetails'])->name('get_sales_approve_details');
    /**______________________________________________________________________________________________
     * Sales => Sales Return
     * ______________________________________________________________________________________________
     */
     Route::get('sales/sales-return/index',[SalesReturnController::class,'index'])->name('sales-return.index');
     Route::post('sales/sales-return/store', [SalesReturnController::class, 'store'])->name('sales-return.store');
     Route::get('sales/get/sales-delivery/details',[SalesReturnController::class,'getSalesDeliveryDetails'])->name('get_sales_delivery_details');
     Route::get('sales/get/sales-return-details/check',[SalesReturnController::class,'getReturnDetailsCheck'])->name('get-retunr-details-check');
    /**______________________________________________________________________________________________
     * Sales => Sales Receive
     * ______________________________________________________________________________________________
     */
     Route::get('sales/sales-receive/index',[MovementController::class,'salesReceiveIndex'])->name('sales-receive.index');
     Route::get('sales/sales-receive/details/{id}',[MovementController::class,'salesReceiveDetails'])->name('sales-receive-details');
     Route::post('sales/sales-receive/store', [MovementController::class, 'salesReceiveStore'])->name('sales-receive.store');

     Route::get('sales/get-sales-return/details', [MovementController::class, 'getSalesReturnDetails'])->name('get_sales_return_details');
     Route::get('sales/get-sales-receive-page/details', [MovementController::class, 'getSalesReceivePage'])->name('get-sales-receive-page');
    /**______________________________________________________________________________________________
     * Warranty & Service => Complaint issue
     * ______________________________________________________________________________________________
     */
    Route::get('warranty/complaint-issue/index',[ComplaintIssueController::class,'index'])->name('warranty-complaint.index');
    Route::get('warranty/customer-list/show',[ComplaintIssueController::class,'showCustomerList'])->name('warranty-customer-list.show');
    Route::post('warranty/complaint-issue/store',[ComplaintIssueController::class,'store'])->name('warranty-complaint.store');

    Route::get('get/warranty/complaint-issue/show',[ComplaintIssueController::class,'getCompliantData'])->name('get-compliant-show');
    Route::get('get/warranty/customer-details',[ComplaintIssueController::class,'getCustomerDetails'])->name('get-customer-details');
    /**______________________________________________________________________________________________
     * Warranty & Service => Job Card
     * ______________________________________________________________________________________________
     */
    Route::get('warranty/prepare/job-card',[JobCardController::class,'jobCardIndex'])->name('warranty-prepare-card.index');
    Route::get('warranty/jobcard-store',[JobCardController::class,'jobCardStore'])->name('warranty-jobcard.store');
    Route::get('get/complaint-details',[JobCardController::class,'getComplaintDetails'])->name('get-complaint-details');

    //Technician Movement
    Route::get('warranty/technician-movement/index',[JobCardController::class,'movement'])->name('warranty-movement.index');

    Route::get('technician_add',[JobCardController::class,'technicianAdd'])->name('technician.add');
    Route::post('store_job_card',[JobCardController::class,'storeJobCard'])->name('store_job_card');
    Route::post('store_job_visit',[JobCardController::class,'storeJobVisit'])->name('store_job_visit');

    /**______________________________________________________________________________________________
     * Warranty & Service => Technician Movement
     * ______________________________________________________________________________________________
     */


    /**______________________________________________________________________________________________
     /**______________________________________________________________________________________________
     * Warranty & Service => Tools Requisition
     * ______________________________________________________________________________________________
     */
    Route::get('warranty/tools-requisition/index',[RequisitionController::class,'indexTools'])->name('tools-requisition.index');

    Route::get('warranty/tools-requisition/list',[RequisitionController::class,'toolsList'])->name('tools-list');

    Route::get('technician_add',[RequisitionController::class,'technicianAdd'])->name('technician.add');

    Route::post('warranty/tools-requisition/store', [RequisitionController::class, 'storeTools'])->name('tools-requisition.store');

    Route::get('requisition/edit',[RequisitionController::class,'edit'])->name('inv_requisition_edit');
    Route::delete('inv_purchase/destroy/{id}', [RequisitionController::class, 'inv_purchase_destroy'])->name('inv_purchase.destroy');

    /**______________________________________________________________________________________________
     * Warranty & Service => Spare Part Requisition
     * ______________________________________________________________________________________________
     */
    Route::get('warranty/sparepart-requisition/index',[RequisitionController::class,'indexSparePart'])->name('spare-parts-requisition.index');
    Route::post('warranty/sparepart-requisition/store', [RequisitionController::class, 'storeTools'])->name('sparepart-requisition.store');
    Route::post('warranty/sparepart-requisition/store', [SparePartController::class, 'spareTools'])->name('sparepart.store');

    Route::get('/get-spare-part',[SparePartController::class,'getComplanitData'])->name('get-spare-part');

    Route::get('warranty/spare-part-requisition/list',[SparePartController::class,'sparePartList'])->name('spare-part-list');
    /**______________________________________________________________________________________________
     * Warranty & Service => Service Bill
     * ______________________________________________________________________________________________
     */
    Route::get('warranty/service-bill/index',[ServiceBillController::class,'index'])->name('service-bill.index');

    Route::get('/get_bill',[ServiceBillController::class,'getBill'])->name('get-bill');
    Route::get('get/selse-edit-part-id',[ServiceBillController::class,'getSalesDetails'])->name('selse-edit-part-id');
    Route::post('/calculate-total', [ServiceBillController::class,'calculateTotal'])->name('calculate-total');

});

Route::group(['middleware' => ['auth']], function(){
    /**______________________________________________________________________________________________
     * HR & ADMIN MASTER
     * ______________________________________________________________________________________________
     */
    Route::resource('mast_department', MastDepartmentController::class);
    Route::resource('mast_designation', MastDesignationController::class);
    Route::resource('mast_leave', MastLeaveController::class);
    Route::resource('must_employee_category', MastEmployeeTypeController::class);

    /**______________________________________________________________________________________________
     * INVENTORY MASTER
     * ______________________________________________________________________________________________
     */
    Route::resource('mast_item_category', MastItemCategoryController::class);
    Route::resource('mast_item_group', MastItemGroupController::class);
    Route::resource('mast_item_register', MastItemRegisterController::class);
    Route::resource('mast_unit', MastUnitController::class);
    Route::resource('mast_working_station', MastWorkStationController::class);
    Route::resource('mast_holidays', HolidayController::class);
    Route::resource('mast_supplier', MastSupplierController::class);
    Route::resource('mast_item_models', MastItemModelsController::class);

    Route::get('get-part/name',[MastItemRegisterController::class,'getPartName'])->name('get-part-name');
    Route::get('get-unit/name',[MastItemRegisterController::class,'getUnitName'])->name('get-unit-name');
    Route::get('get-item/models',[MastItemRegisterController::class,'getItemModels'])->name('get-item-models');
    Route::get('/pdf/download', [MastItemRegisterController::class, 'generateBarcode'])->name('item_pdf.download');
    Route::get('/item_export/excel', [MastItemRegisterController::class, 'export'])->name('item_export.excel');
    /**______________________________________________________________________________________________
     * SALES MASTER
     * ______________________________________________________________________________________________
     */
    Route::get('customer/cat_id={cat_id}',[SalesController::class,'indexCustomer'])->name('customer.index');
    Route::get('customer/create/cat_id={cat_id}',[SalesController::class,'createCustomer'])->name('customer.create');
    Route::post('customer/store',[SalesController::class,'storeCustomer'])->name('customer.store');
    /**______________________________________________________________________________________________
     * WARRENTY MASTER
     * ______________________________________________________________________________________________
     */
    Route::resource('mast_compliant_type', MastCompliantTypeController::class);
    // Setup Technician
    Route::post('setup-technician/update',[MastTechnicianController::class,'setupTechnician'])->name('setup.technician');
    // Technician Update
    Route::get('technician/index',[MastTechnicianController::class,'index'])->name('tecnician.index');
    Route::post('technician-update',[MastTechnicianController::class,'updateTechnician'])->name('technician.update');
    Route::get('get/employee-personal-info',[MastTechnicianController::class,'getEmployeeInfo'])->name('get-employee-personal-info');
});
/**______________________________________________________________________________________________
 * Dwonload File => PDF, EXCEL ETC
 * ______________________________________________________________________________________________
 */

/**______________________________________________________________________________________________
 * Dwonload File => PDF, EXCEL ETC
 * ______________________________________________________________________________________________
 */


//__________________________ TEST AJAX MODEL_____________________________//
use App\Http\Controllers\TodoController;
Route::get('/todos', [TodoController::class, 'index']);
Route::get('todos/{todo}/edit', [TodoController::class, 'edit']);
Route::post('todos/store', [TodoController::class, 'store']);
Route::delete('todos/destroy/{todo}', [TodoController::class, 'destroy']);

Route::get('get-procedure', function () {$id = 1; $post = DB::select("CALL get_users_by_id(".$id.")");dd($post);});
