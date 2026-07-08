<?php




// GLOBAL - CONTROLLERS
use App\Http\Controllers\HSDocController;
use App\Http\Controllers\HSDropdownController;
use App\Http\Controllers\HSOptionController;
use App\Http\Controllers\HSColConfigController;
use App\Http\Controllers\HSRptController;
use App\Http\Controllers\HSToolsController;
use App\Http\Controllers\PrintingController;
use App\Http\Controllers\FileAttachmentController;
use App\Http\Controllers\AllBIRController;
use App\Http\Controllers\TemplateLayoutController;




// GLOBAL REFERENCE - CONTROLLERS
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CutoffController;
use App\Http\Controllers\VATController;
use App\Http\Controllers\ATCController;
use App\Http\Controllers\CurrController;
use App\Http\Controllers\DForexController;
use App\Http\Controllers\BranchController;




// GENERAL LEDGER - TRANSACTION CONTROLLERS
use App\Http\Controllers\JournalVoucherController;

// GENERAL LEDGER - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\COAMasterController;
use App\Http\Controllers\COAClassController;
use App\Http\Controllers\FSConsolidationController;
use App\Http\Controllers\RCTypeController;
use App\Http\Controllers\RCMastController;
use App\Http\Controllers\SLMasterController;
use App\Http\Controllers\BankTypeController;
use App\Http\Controllers\BankMasterController;

// GENERAL LEDGER - INQUIRY CONTROLLERS
use App\Http\Controllers\GLBalanceController;



// GENERAL LEDGER - BANKRECON CONTROLLERS
use App\Http\Controllers\BankReconController;
use App\Http\Controllers\ARDSController;
use App\Http\Controllers\ARDSBalanceController;




// ACCOUNTS PAYABLE - TRANSACTION CONTROLLERS
use App\Http\Controllers\APVoucherController;
use App\Http\Controllers\APDMController;
use App\Http\Controllers\APCMController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\PCVController;

// ACCOUNTS PAYABLE - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\PayTermController;
use App\Http\Controllers\VendMasterController;
use App\Http\Controllers\CheckTemplateController;

// ACCOUNTS PAYABLE - INQUIRY CONTROLLERS
use App\Http\Controllers\APBalanceController;




// SALES - TRANSACTION CONTROLLERS
use App\Http\Controllers\SOController;
use App\Http\Controllers\DRController;
use App\Http\Controllers\SIController;
use App\Http\Controllers\CSIController;

// SALES - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\PriceMatrixController;

// SALES - INQUIRY CONTROLLERS
use App\Http\Controllers\SalesInqController;




// ACCOUNTS RECEIVABLE - TRANSACTION CONTROLLERS
use App\Http\Controllers\SVIController;
use App\Http\Controllers\SOAController;
use App\Http\Controllers\ARCMController;
use App\Http\Controllers\ARDMController;
use App\Http\Controllers\CRController;

// ACCOUNTS RECEIVABLE - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\SalesRepController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\CustTypeController;
use App\Http\Controllers\BillCodeController;
use App\Http\Controllers\BillTermController;
use App\Http\Controllers\CustMasterController;

// ACCOUNTS RECEIVABLE - INQUIRY CONTROLLERS
use App\Http\Controllers\ARController;
use App\Http\Controllers\ARBalanceController;




// PURCHASING - TRANSACTION CONTROLLERS
use App\Http\Controllers\POController;
use App\Http\Controllers\PRController;
use App\Http\Controllers\JOController;
use App\Http\Controllers\CanController;

// PURCHASING - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\JobCodesController;

// PURCHASING - INQUIRY CONTROLLERS
use App\Http\Controllers\PRInqController;
use App\Http\Controllers\POInqController;
use App\Http\Controllers\JOInqController;




// SECURITY - CONTROLLERS
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AccessRightsController;
use App\Http\Controllers\MasterAccessRightsController;
use App\Http\Controllers\ReportAccessRightsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AllTranApprovalController;




// FG INVENTORY - TRANSACTION CONTROLLERS
use App\Http\Controllers\FGRRController;
use App\Http\Controllers\FGRTVController;
use App\Http\Controllers\FGISController;
use App\Http\Controllers\FGSTController;
use App\Http\Controllers\FGAJController;
use App\Http\Controllers\FGPRController;

// FG INVENTORY - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\FGMastController;
use App\Http\Controllers\FGCategController;
use App\Http\Controllers\FGClassController;

// FG INVENTORY - INQUIRY CONTROLLERS
use App\Http\Controllers\FGInvBalanceController;
use App\Http\Controllers\FGInvStockCardController;




// MS INVENTORY - TRANSACTION CONTROLLERS
use App\Http\Controllers\MSRRController;
use App\Http\Controllers\MSRTVController;
use App\Http\Controllers\MSISController;
use App\Http\Controllers\MSSTController;
use App\Http\Controllers\MSAJController;




// MS INVENTORY - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\MSMastController;
use App\Http\Controllers\MSCategController;
use App\Http\Controllers\MSClassController;

// MS INVENTORY - INQUIRY CONTROLLERS
use App\Http\Controllers\MSInvBalanceController;
use App\Http\Controllers\MSInvStockCardController;




// RM INVENTORY - TRANSACTION CONTROLLERS
use App\Http\Controllers\RMRRController;
use App\Http\Controllers\RMRTVController;
use App\Http\Controllers\RMISController;
use App\Http\Controllers\RMSTController;
use App\Http\Controllers\RMAJController;





// RM INVENTORY - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\RMMastController;
use App\Http\Controllers\RMCategController;
use App\Http\Controllers\RMClassController;





// RM INVENTORY - INQUIRY CONTROLLERS
use App\Http\Controllers\RMInvBalanceController;
use App\Http\Controllers\RMInvStockCardController;




// INVENTORY - GLOBAL CONTROLLERS
use App\Http\Controllers\RRController;
use App\Http\Controllers\UOMController;
use App\Http\Controllers\WarehouseMastController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\QStatController;





// FIXED ASSETS - TRANSACTION CONTROLLERS
use App\Http\Controllers\FARRController;
use App\Http\Controllers\FATRController;
use App\Http\Controllers\FARCController;
use App\Http\Controllers\FAADController;
use App\Http\Controllers\FASPController;
use App\Http\Controllers\FAMGController;
use App\Http\Controllers\FADPController;
use App\Http\Controllers\FADSController;
use App\Http\Controllers\FARSController;

// FIXED ASSETS - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\FACategController; 
use App\Http\Controllers\FAClassController;
use App\Http\Controllers\FALocController;
use App\Http\Controllers\FAMastController;

// FIXED ASSETS - INQUIRY CONTROLLERS
use App\Http\Controllers\FAMoveController;




// LANDED COST - TRANSACTION CONTROLLERS
use App\Http\Controllers\LCController;

// LANDED COST - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\LCRefController;


//STORE-PORTAL
use App\Http\Controllers\StorePortalOrderController;
use App\Http\Controllers\CommissaryController;


// BUDGET - TRANSACTION CONTROLLERS
use App\Http\Controllers\BUDBBController;



// BUDGET - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\BudItemRefController;
use App\Http\Controllers\BUDMoveController;
use App\Http\Controllers\BUDRAController;
use App\Http\Controllers\BUDAUController;
use App\Http\Controllers\BUDCLController;




// PRODUCTION - REFERENCE FILE CONTROLLERS
use App\Http\Controllers\ProdBOMController;
use App\Http\Controllers\ProdParametersController;





// PRODUCTION - TRANSACTION CONTROLLERS
use App\Http\Controllers\WOController;
use App\Http\Controllers\WorkCenterController;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::options('{any}', function () {
    return response()->noContent();
})->where('any', '.*');


Route::get('/companies', [AuthController::class, 'companies']);
Route::post('/send-mail', [MailController::class, 'send']);




Route::middleware('tenant')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);

    /** ✅ ADDED (from attached api.php) — you had these commented out */
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/auth/heartbeat', [AuthController::class, 'heartbeat']);

    Route::post('/upsertCompany', [CompanyController::class, 'upsert']);
    Route::get('/getCompany', [CompanyController::class, 'get']);
    Route::get('/getGlobalTables', [CompanyController::class, 'getGlobalTables']);



    Route::get('/getUser', [UserController::class, 'get']);
    Route::get('/load', [UserController::class, 'load']);
    Route::get('/lookupUserAll', [UserController::class, 'lookupAll']);
    Route::post('/users/upsert', [UserController::class, 'upsert']);
    Route::post('/users/approve', [UserController::class, 'approveAccount']);
    Route::post('/users/delete', [UserController::class, 'delete']);
    Route::post('/users/request-password-reset', [UserController::class, 'requestPasswordReset']);
    Route::post('/users/change-password', [UserController::class, 'changePassword']);
    Route::post('/users/checkduplicate', [UserController::class, 'checkDuplicate']);
    Route::post('/users/checkinused', [UserController::class, 'checkInUsed']);
    // Profile Image
    Route::post('/user/profile-image', [UserController::class, 'uploadProfileImage']);
    Route::get('/user/profile-image/{userCode}', [UserController::class, 'getProfileImage']);
    Route::delete('/user/profile-image/{userCode}', [UserController::class, 'deleteProfileImage']);
    //HS Security
    Route::get('/security/policy',          [UserController::class, 'getPolicy']);
    Route::post('/security/policy/upsert',  [UserController::class, 'upsertPolicy']);
    Route::post('/getSecTrail', [UserController::class, 'getSecTrail']);
    Route::post('/users/release-locked', [UserController::class, 'releaseLockedAccount']);



    // Heart Strong
    Route::get('/getHSDoc', [HSDocController::class, 'get']);
    Route::get('/lookupHSDoc', [HSDocController::class, 'lookup']);

    Route::post('/getHSDropdown', [HSDropdownController::class, 'get']);
    Route::get('/getHSDropdownAll', [HSDropdownController::class, 'getAll']);
    Route::get('/getHSOption', [HSOptionController::class, 'get']);
    Route::get('/getHSColConfig', [HSColConfigController::class, 'get']);

    Route::get('/menu-items', [MenuController::class, 'items']);
    Route::get('/menu-routes', [MenuController::class, 'routes']);

    Route::get('/role', [AccessRightsController::class, 'loadRole']);
    Route::get('/getRole', [AccessRightsController::class, 'getRole']);
    Route::post('/deleteRole', [AccessRightsController::class, 'DeleteRole']);
    Route::get('/loadRole', [AccessRightsController::class, 'getUsers']);
    Route::get('/getRoleMenu', [AccessRightsController::class, 'getRoleMenu']);
    Route::get('/getUserRoles', [AccessRightsController::class, 'getUserRoles']);
    Route::post('/upsertRole', [AccessRightsController::class, 'UpsertRole']);
    Route::post('/upsertRoleMenu', [AccessRightsController::class, 'upsertRoleMenu']);
    Route::post('/UpsertUserRole', [AccessRightsController::class, 'UpsertUserRole']);
    Route::post('/upsert', [AccessRightsController::class, 'upsert']);
    Route::post('/deleteUserRole', [AccessRightsController::class, 'deleteUserRole']);
    Route::get('/getUserRoles', [AccessRightsController::class, 'getUserRoles']);
    Route::get('/checkDuplicateRole', [AccessRightsController::class, 'checkDuplicate']);
    Route::get('/checkInUsedRole', [AccessRightsController::class, 'checkInUsed']);

    Route::prefix('master-access-rights')->group(function () {
        Route::get('/load-master-data', [MasterAccessRightsController::class, 'loadMasterData']);
        Route::post('/get-user-master-data', [MasterAccessRightsController::class, 'getUserMasterData']);
        Route::post('/upsert-user-master-data', [MasterAccessRightsController::class, 'upsertUserMasterData']);
        Route::post('/delete-user-master-data', [MasterAccessRightsController::class, 'deleteUserMasterData']);
    });

    Route::prefix('report-access-rights')->group(function () {
        Route::get('load-report-data',         [ReportAccessRightsController::class, 'loadReportData']);
        Route::post('get-user-report-data',     [ReportAccessRightsController::class, 'getUserReportData']);
        Route::post('upsert-user-report-data',  [ReportAccessRightsController::class, 'upsertUserReportData']);
        Route::post('delete-user-report-data',  [ReportAccessRightsController::class, 'deleteUserReportData']);
    });

    //Printing
    Route::prefix('printing')->group(function () {
        Route::post('/handle', [PrintingController::class, 'handlePrinting']);
        Route::get('/pending', [PrintingController::class, 'loadPendingDocuments']);
        Route::post('/update-generated', [PrintingController::class, 'updateGeneratedDocument']);
        Route::get('/generate-id', [PrintingController::class, 'generateId']);
    });

    Route::get('/hsrpt', [HSRptController::class, 'index']);
    Route::get('/getHsrpt', [HSRptController::class, 'get']);
    Route::post('/initialize', [HSToolsController::class, 'initialize']);
    Route::get('/getHSTblColLen', [HSToolsController::class, 'getTblGetFieldLenght']);
    Route::post('/getDocTrail', [HSToolsController::class, 'getDocTrail']);
    Route::post('/getRefTrail', [HSToolsController::class, 'getRefTrail']);
    Route::post('/excelFileUpload', [HSToolsController::class, 'excelFileUpload']);



    Route::post('/printForm', [PrintingController::class, 'printForm']);
    Route::post('/printQuery', [PrintingController::class, 'printQuery']);
    Route::post('/printARReport', [PrintingController::class, 'printARReport']);
    Route::post('/printAPReport', [PrintingController::class, 'printAPReport']);
    Route::post('/printGLReport', [PrintingController::class, 'printGLReport']);
    Route::post('/exportHistoryReport', [PrintingController::class, 'exportHistoryReport']);
    Route::post('/upsertDocSign', [PrintingController::class, 'upsertDocSign']);
    Route::get('/getDocSign', [PrintingController::class, 'getDocSign']);





    Route::get('/getPOInquiry', [POInqController::class, 'getPOInquiry']);
    Route::get('/getJOInquiry', [JOInqController::class, 'getJOInquiry']);
    Route::post('/getPURReport', [PrintingController::class, 'getPUR_Report']);
    Route::post('/getFAReport', [PrintingController::class, 'getFA_Report']);
    Route::post('/getIMPReport', [PrintingController::class, 'getIMP_Report']);
    Route::post('/getBudgetReport', [PrintingController::class, 'getBudget_Report']);
    Route::post('/getSalesReport', [PrintingController::class, 'getSales_Report']);
    


    // --Revised export using React
    Route::post('/getARReport', [PrintingController::class, 'getAR_Report']);
    Route::post('/getAPReport', [PrintingController::class, 'getAP_Report']);
    Route::post('/getGLReport', [PrintingController::class, 'getGL_Report']);
    Route::post('/getFGINVReport', [PrintingController::class, 'getFGINV_Report']);
    Route::post('/getMSINVReport', [PrintingController::class, 'getMSINV_Report']);
    Route::post('/getRMINVReport', [PrintingController::class, 'getRMINV_Report']);

	


    //Dev Express Printing
    Route::post('/print-dxr-form', [PrintingController::class, 'printDxrForm']);
    Route::post('/open-dxr-viewer', [PrintingController::class, 'openDxrViewer']);
    Route::post('/print-dxr-report', [PrintingController::class, 'printDxrReport']);            






    Route::post('/attachFile', [FileAttachmentController::class, 'attachFile']);
    Route::delete('/deleteFile/{id}', [FileAttachmentController::class, 'deleteFile']);
    Route::get('/downloadAll/{documentID}', [FileAttachmentController::class, 'downloadAll']);
    Route::get('/downloadFile/{id}', [FileAttachmentController::class, 'downloadFile']);
    Route::get('/getAttachFile', [FileAttachmentController::class, 'get']);

    Route::get('/getOpenAPBalance', [APBalanceController::class, 'getOpenAPBalance']);
    Route::get('/getSelectedAPBalance', [APBalanceController::class, 'getSelectedAPBalance']);
    Route::get('/getAPInquiry', [APBalanceController::class, 'getAPInquiry']);
    Route::get('/getAPAging', [APBalanceController::class, 'getAPAging']);
    Route::get('/getAPAdvances', [APBalanceController::class, 'getAPAdvances']);
    Route::get('/getAPCheckRelasing', [APBalanceController::class, 'getAPCheckRelasing']);
    Route::post('/getAPCheckRelasing', [APBalanceController::class, 'getAPCheckRelasing']);
    Route::post('/updateAPCKRL', [APBalanceController::class, 'updateAPCKRL']);

    Route::get('/getOpenARBalance', [ARBalanceController::class, 'getOpenARBalance']);
    Route::get('/getSelectedARBalance', [ARBalanceController::class, 'getSelectedARBalance']);
    Route::get('/getARInquiry', [ARBalanceController::class, 'getARInquiry']);
    Route::get('/getARAging', [ARBalanceController::class, 'getARAging']);
    Route::get('/getARAdvances', [ARBalanceController::class, 'getARAdvances']);
    Route::get('/getARCWLCLInquiry', [ARBalanceController::class, 'getARCWLCLInquiry']);
    Route::post('/updateARCWLCL', [ARBalanceController::class, 'updateARCWLCL']);


    Route::get('/getGLInquiry', [GLBalanceController::class, 'getGLInquiry']);
    Route::get('/getSLInquiry', [GLBalanceController::class, 'getSLInquiry']);
    Route::get('/getTBSummary', [GLBalanceController::class, 'getTBSummary']);
    Route::get('/getUnpostedperMonth', [GLBalanceController::class, 'getUnpostedperMonth']);
    Route::get('/getYearEndProforma', [GLBalanceController::class, 'getYearEndProforma']);
    Route::get('/getBSIS_YTD', [GLBalanceController::class, 'getBSIS_YTD']);



    Route::get('/getPOInquiry', [POInqController::class, 'getPOInquiry']);
    Route::get('/getPRInquiry', [PRInqController::class, 'getPRInquiry']);





    Route::get('/getEWTInquiry', [AllBIRController::class, 'getEWTInquiry']);
    Route::get('/getCWTInquiry', [AllBIRController::class, 'getCWTInquiry']);
    Route::get('/getINTAXInquiry', [AllBIRController::class, 'getINTAXInquiry']);
    Route::get('/getOUTAXInquiry', [AllBIRController::class, 'getOUTAXInquiry']);
    Route::post('/generateBIRBooks', [AllBIRController::class, 'generateBIRBooks']);

    Route::get('/bankType', [BankTypeController::class, 'index']);
    Route::post('/upsertBankType', [BankTypeController::class, 'upsert']);
    Route::get('/lookupBankType', [BankTypeController::class, 'lookup']);
    Route::post('/deleteBankType', [BankTypeController::class, 'delete']);
    Route::post('/checkDuplicateBankType', [BankTypeController::class, 'checkDuplicate']);
    Route::post('/checkInUsedBankType', [BankTypeController::class, 'checkInUsed']);
    Route::get('/getBankType', [BankTypeController::class, 'get']);

    Route::get('/curr', [CurrController::class, 'index']);
    Route::post('/upsertCurr', [CurrController::class, 'upsert']);
    Route::get('/lookupCurr', [CurrController::class, 'lookup']);
    Route::get('/getCurr', [CurrController::class, 'get']);
    Route::post('/deleteCurr', [CurrController::class, 'delete']);
    Route::post('/checkDuplicateCurr', [CurrController::class, 'checkDuplicate']);
    Route::post('/checkInUsedCurr', [CurrController::class, 'checkInUsed']);

    Route::get('/vat', [VATController::class, 'index']);
    Route::post('/upsertVat', [VATController::class, 'upsert']);
    Route::get('/lookupVat', [VATController::class, 'lookup']);
    Route::get('/getVat', [VATController::class, 'get']);
    Route::post('/deleteVat', [VATController::class, 'delete']);
    Route::post('/checkInUsedVat', [VATController::class, 'checkInUsed']);
    Route::post('/checkDuplicateVat', [VATController::class, 'checkDuplicate']);
    Route::get('/loadVATClass', [VATController::class, 'LoadVATClass']);


    Route::get('/rcMast', [RCMastController::class, 'index']);
    Route::post('/upsertRCMast', [RCMastController::class, 'upsert']);
    Route::get('/lookupRCMast', [RCMastController::class, 'lookup']);
    Route::get('/getRCMast', [RCMastController::class, 'get']);
    Route::post('/deleteRCMast', [RCMastController::class, 'delete']);
    Route::post('/checkInUsedRCMast', [RCMastController::class, 'checkInUsed']);
    Route::post('/checkDuplicateRCMast', [RCMastController::class, 'checkDuplicate']);
    Route::get('/loadRCMast', [RCMastController::class, 'loadRCMast']);


    Route::get('/rcType', [RCTypeController::class, 'index']);
    Route::post('/upsertRcType', [RCTypeController::class, 'upsert']);
    Route::get('/lookupRCType', [RCTypeController::class, 'lookup']);
    Route::get('/getRcType', [RCTypeController::class, 'get']);
    Route::post('/deleteRcType', [RCTypeController::class, 'delete']);
    Route::post('/checkInUsedRcType', [RCTypeController::class, 'checkInUsed']);
    Route::post('/checkDuplicateRcType', [RCTypeController::class, 'checkDuplicate']);
    Route::get('/loadRCType', [RCTypeController::class, 'loadRcType']);






    Route::POST('/atc', [ATCController::class, 'index']);
    Route::post('/upsertATC', [ATCController::class, 'upsert']);
    Route::get('/lookupATC', [ATCController::class, 'lookup']);
    Route::post('/deleteATC', [ATCController::class, 'delete']);
    Route::post('/checkDuplicateATC', [ATCController::class, 'checkDuplicate']);
    Route::post('/checkInUsedATC', [ATCController::class, 'checkInUsed']);
    Route::get('/getATC', [ATCController::class, 'get']);




    Route::get('/cutOff', [CutoffController::class, 'index']);
    Route::post('/upsertCutOff', [CutoffController::class, 'upsert']);
    Route::get('/lookupCutOff', [CutoffController::class, 'lookup']);
    Route::get('/getCutOff', [CutoffController::class, 'get']);
    Route::post('/deleteCutOff', [CutoffController::class, 'delete']);
    Route::post('/checkInUsedCutOff', [CutoffController::class, 'checkInUsed']);
    Route::post('/checkDuplicateCutOff', [CutoffController::class, 'checkDuplicate']);
    Route::get('/loadCutOff', [CutoffController::class, 'index']);

    Route::get('/rCType', [RCTypeController::class, 'index']);
    Route::post('/upsertRCType', [RCTypeController::class, 'upsert']);



    Route::get('/DForex', [DForexController::class, 'index']);
    Route::get('/DForexSummary', [DForexController::class, 'loadSummary']);
    Route::post('/upsertDForex', [DForexController::class, 'upsert']);
    Route::get('/lookupDForex', [DForexController::class, 'lookup']);
    Route::get('/getDForex', [DForexController::class, 'get']);
    Route::post('/checkDuplicateDForex', [DForexController::class, 'checkDuplicate']);
    Route::post('/deleteDForex', [DForexController::class, 'delete']);
    Route::post('/getDForexByDate', [DForexController::class, 'getByDate']);
    


    Route::get('/salesRep', [SalesRepController::class, 'index']);
    Route::post('/upsertsalesRep', [SalesRepController::class, 'upsert']);
    Route::get('/lookupsalesRep', [SalesRepController::class, 'lookup']);
    Route::post('/deletesalesRep', [SalesRepController::class, 'delete']);
    Route::post('/checkDuplicatesalesRep', [SalesRepController::class, 'checkDuplicate']);
    Route::post('/checkInUsedsalesRep', [SalesRepController::class, 'checkInUsed']);
    Route::get('/getsalesRep', [SalesRepController::class, 'get']);
    Route::post('/checkDuplicatesalesRep', [SalesRepController::class, 'checkDuplicate']);
    Route::post('/checkInUsedsalesRep', [SalesRepController::class, 'checkInUsed']);



    
    Route::get('/bank', [BankMasterController::class, 'index']);
    Route::post('/upsertBank', [BankMasterController::class, 'upsert']);
    Route::get('/lookupBank', [BankMasterController::class, 'lookup']);
    Route::get('/getBank', [BankMasterController::class, 'get']);
    Route::post('/checkDuplicateBank', [BankMasterController::class, 'checkDuplicate']);
    Route::post('/deleteBank', [BankMasterController::class, 'delete']);
    Route::post('/checkInUsedBank', [BankMasterController::class, 'checkInUsed']);
    Route::get('/validateDuplicateCheck', [BankMasterController::class, 'validateDuplicateCheck']);
    

    Route::get('/cOA', [COAMasterController::class, 'index']);
    Route::post('/upsertCOA', [COAMasterController::class, 'upsert']);
    Route::post('/lookupCOA', [COAMasterController::class, 'lookup']);
    Route::get('/getCOA', [COAMasterController::class, 'get']);
    Route::post('/lookupGL', [COAMasterController::class, 'lookupGL']);
    Route::post('/editEntries', [COAMasterController::class, 'editEntries']);
    Route::post('/deleteCOA', [COAMasterController::class, 'delete']);
    Route::post('/checkDuplicateCOA', [COAMasterController::class, 'checkDuplicate']);
    Route::post('/checkInUsedCOA', [COAMasterController::class, 'checkInUsed']);
    Route::get('/glfsmatching', [COAMasterController::class, 'index']);


    Route::get('/fsconso', [FSConsolidationController::class, 'index']);
    Route::post('/upsertFSConso', [FSConsolidationController::class, 'upsert']);
    Route::get('/lookupFSConso', [FSConsolidationController::class, 'lookup']);
    Route::get('/getFSConso', [FSConsolidationController::class, 'get']);
    Route::post('/deleteFSConso', [FSConsolidationController::class, 'delete']);
    Route::post('/checkDuplicateFSConso', [FSConsolidationController::class, 'checkDuplicate']);
    Route::post('/checkInUsedFSConso', [FSConsolidationController::class, 'checkInUsed']);
    Route::post('/upsertGLFSMatching', [FSConsolidationController::class, 'upsertGLFSMatching']);





    Route::get('/cOAClass', [COAClassController::class, 'index']);
    Route::post('/upsertCOAClass', [COAClassController::class, 'upsert']);
    Route::post('/lookupCOAClass', [COAClassController::class, 'lookup']);


    Route::get('/branch', [BranchController::class, 'index']);
    Route::post('/upsertBranch', [BranchController::class, 'upsert']);
    Route::get('/lookupBranch', [BranchController::class, 'lookup']);
    Route::get('/getBranch', [BranchController::class, 'get']);
    Route::post('/deleteBranch', [BranchController::class, 'delete']);
    Route::post('/checkDuplicateBranch', [BranchController::class, 'checkDuplicate']);
    Route::post('/checkInUsedBranch', [BranchController::class, 'checkInUsed']);


    Route::get('/billCode', [BillCodeController::class, 'index']);
    Route::post('/upsertbillCode', [BillCodeController::class, 'upsert']);
    Route::get('/lookupBillCode', [BillCodeController::class, 'lookup']);
    Route::post('/deletebillCode', [BillCodeController::class, 'delete']);
    Route::post('/checkDuplicatebillCode', [BillCodeController::class, 'checkDuplicate']);
    Route::post('/checkInUsedbillCode', [BillCodeController::class, 'checkInUsed']);
    Route::get('/getbillCode', [BillCodeController::class, 'get']);

    Route::get('/payterm', [PayTermController::class, 'index']);
    Route::get('/lookupPayterm', [PayTermController::class, 'lookup']);
    Route::get('/getPayterm', [PayTermController::class, 'get']);

    Route::post('/upsertPayterm', [PayTermController::class, 'upsert']);
    Route::post('/deletePayterm', [PayTermController::class, 'delete']);
    Route::post('/checkDuplicatePayterm', [PayTermController::class, 'checkDuplicate']);
    Route::post('/checkInUsedPayterm', [PayTermController::class, 'checkInUsed']);

    Route::get('/billterm', [BillTermController::class, 'index']);
    Route::post('/upsertBillterm', [BillTermController::class, 'upsert']);
    Route::get('/lookupBillterm', [BillTermController::class, 'lookup']);
    Route::get('/getBillterm', [BillTermController::class, 'get']);
    Route::post('/checkDuplicateBillterm', [BillTermController::class, 'checkDuplicate']);
    Route::post('/checkInUsedBillterm', [BillTermController::class, 'checkInUsed']);
    Route::post('/deleteBillterm', [BillTermController::class, 'delete']);


    Route::get('/area', [AreaController::class, 'index']);
    Route::post('/upsertArea', [AreaController::class, 'upsert']);
    Route::get('/lookupArea', [AreaController::class, 'lookup']);
    Route::get('/getArea', [AreaController::class, 'get']);
    Route::post('/checkDuplicateArea', [AreaController::class, 'checkDuplicate']);
    Route::post('/checkInUsedArea', [AreaController::class, 'checkInUsed']);
    Route::post('/deleteArea', [AreaController::class, 'delete']);

    Route::get('/zone', [ZoneController::class, 'index']);
    Route::post('/upsertZone', [ZoneController::class, 'upsert']);
    Route::get('/lookupZone', [ZoneController::class, 'lookup']);
    Route::get('/getZone', [ZoneController::class, 'get']);
    Route::post('/checkDuplicateZone', [ZoneController::class, 'checkDuplicate']);
    Route::post('/checkInUsedZone', [ZoneController::class, 'checkInUsed']);
    Route::post('/deleteZone', [ZoneController::class, 'delete']);


    Route::get('/custType', [CustTypeController::class, 'index']);
    Route::post('/upsertCustType', [CustTypeController::class, 'upsert']);
    Route::get('/lookupCustType', [CustTypeController::class, 'lookup']);
    Route::get('/getCustType', [CustTypeController::class, 'get']);
    Route::post('/checkDuplicateCustType', [CustTypeController::class, 'checkDuplicate']);
    Route::post('/checkInUsedCustType', [CustTypeController::class, 'checkInUsed']);
    Route::post('/deleteCustType', [CustTypeController::class, 'delete']);






    Route::get('/vendMast', [VendMasterController::class, 'index']);
    Route::post('/upsertVendMast', [VendMasterController::class, 'upsert']);
    Route::get('/lookupVendMast', [VendMasterController::class, 'lookup']);
    Route::get('/getVendMast', [VendMasterController::class, 'get']);

    Route::get('/payee', [VendMasterController::class, 'index']);
    Route::post('/upsertPayee', [VendMasterController::class, 'upsert']);
    Route::get('/lookupPayee', [VendMasterController::class, 'lookup']);
    Route::post('/getPayee', [VendMasterController::class, 'get']);
    Route::post('/addPayeeDetail', [VendMasterController::class, 'addDetail']);
    Route::post('/deletePayee', [VendMasterController::class, 'delete']);
    Route::post('/checkDuplicatePayee', [VendMasterController::class, 'checkDuplicate']);
    Route::post('/checkDuplicatePayeeName', [VendMasterController::class, 'checkDuplicateName']);
    Route::post('/checkInUsedPayee', [VendMasterController::class, 'checkInUsed']);

    Route::get('/customer', [CustMasterController::class, 'index']);
    Route::post('/upsertCustomer', [CustMasterController::class, 'upsert']);
    Route::get('/lookupCustomer', [CustMasterController::class, 'lookup']);
    Route::post('/getCustomer', [CustMasterController::class, 'get']);
    Route::post('/deleteCustomer', [CustMasterController::class, 'delete']);
    Route::post('/addCustomerDetail', [CustMasterController::class, 'addDetail']);
    Route::post('/checkDuplicateCustomer', [CustMasterController::class, 'checkDuplicate']);
    Route::post('/checkInUsedCustomer', [CustMasterController::class, 'checkInUsed']);

    Route::get('/slType', [SLMasterController::class, 'slType']);
    Route::get('/sLMast', [SLMasterController::class, 'sLMast']);
    Route::get('/sLCoa', [SLMasterController::class, 'sLCoa']);
    Route::post('/upsertSLMast', [SLMasterController::class, 'upsertSLMast']);
    Route::post('/upsertSLType', [SLMasterController::class, 'upsertSLType']);
    Route::post('/upsertSLTypeGLMatching', [SLMasterController::class, 'upsertSLTypeGLMatching']);
    Route::post('/deleteSLMast', [SLMasterController::class, 'deleteSLMast']);
    Route::post('/deleteSLType', [SLMasterController::class, 'deleteSLType']);
    Route::get('/lookupSL', [SLMasterController::class, 'lookup']);
    Route::get('/getSL', [SLMasterController::class, 'get']);
    Route::post('/checkDuplicateSLMast', [SLMasterController::class, 'checkDuplicateSLMast']);
    Route::post('/checkDuplicateSLType', [SLMasterController::class, 'checkDuplicateSLType']);
    Route::post('/checkInUsedSLMast', [SLMasterController::class, 'checkInUsedSLMast']);
    Route::post('/checkInUsedSLType', [SLMasterController::class, 'checkInUsedSLType']);

    Route::get('/MSMast', [MSMastController::class, 'index']);
    Route::post('/upsertMSMast', [MSMastController::class, 'upsert']);
    Route::get('/lookupMSMast', [MSMastController::class, 'lookup']);
    Route::post('/getMSMast', [MSMastController::class, 'get']);
    Route::post('/checkDuplicateMSMast', [MSMastController::class, 'checkDuplicate']);
    Route::post('/checkInUsedMSMast',    [MSMastController::class, 'checkInUsed']);
    Route::post('/deleteMSMast',         [MSMastController::class, 'delete']);

    Route::get('/fgMast',           [FGMastController::class, 'index']);
    Route::post('/getFGMast',        [FGMastController::class, 'get']);
    Route::get('/lookupFGMast',      [FGMastController::class, 'lookup']);
    Route::post('/upsertFGMast',     [FGMastController::class, 'upsert']);
    Route::post('/deleteFGMast',     [FGMastController::class, 'delete']);
    Route::post('/checkDuplicateFGMast', [FGMastController::class, 'checkDuplicate']);
    Route::post('/checkInUsedFGMast',    [FGMastController::class, 'checkInUsed']);

    Route::get('/rmMast',                [RMMastController::class, 'index']);
    Route::post('/upsertRMMast',         [RMMastController::class, 'upsert']);
    Route::get('/lookupRMMast',          [RMMastController::class, 'lookup']);
    Route::post('/getRMMast',            [RMMastController::class, 'get']);
    Route::post('/checkDuplicateRMMast', [RMMastController::class, 'checkDuplicate']);
    Route::post('/checkInUsedRMMast',    [RMMastController::class, 'checkInUsed']);
    Route::post('/deleteRMMast',         [RMMastController::class, 'delete']);

    Route::get('/msCateg', [MSCategController::class, 'index']);
    Route::get('/lookupMSCateg', [MSCategController::class, 'lookup']);
    Route::get('/getMSCateg', [MSCategController::class, 'get']);
    Route::post('/upsertMSCateg', [MSCategController::class, 'upsert']);
    Route::post('/deleteMSCateg', [MSCategController::class, 'delete']);
    Route::post('/checkDuplicateMSCateg', [MSCategController::class, 'checkDuplicate']);
    Route::post('/checkInUsedMSCateg', [MSCategController::class, 'checkInUsed']);

    Route::get('/msClass', [MSClassController::class, 'index']);
    Route::get('/getMSClass', [MSClassController::class, 'get']);
    Route::get('/lookupMSClass', [MSClassController::class, 'lookup']);
    Route::post('/upsertMSClass', [MSClassController::class, 'upsert']);
    Route::post('/deleteMSClass', [MSClassController::class, 'delete']);
    Route::post('/checkDuplicateMSClass', [MSClassController::class, 'checkDuplicate']);
    Route::post('/checkInUsedMSClass', [MSClassController::class, 'checkInUsed']);
    Route::get('/getInvLookupMS', [MSInvBalanceController::class, 'getInvLookup']);
    Route::get('/getInvLookupFG', [FGInvBalanceController::class, 'getInvLookup']);
    Route::post('/getFGUpdateStockAllocation', [FGInvBalanceController::class, 'getFGUpdateStockAllocation']);

    
    Route::get('/fgCateg', [FGCategController::class, 'index']);
    Route::post('/getFGCateg', [FGCategController::class, 'get']);
    Route::post('/lookupFGCateg', [FGCategController::class, 'lookup']);
    Route::post('/upsertFGCateg', [FGCategController::class, 'upsert']);
    Route::post('/deleteFGCateg', [FGCategController::class, 'delete']);
    Route::post('/checkDuplicateFGCateg', [FGCategController::class, 'checkDuplicate']);
    Route::post('/checkInUsedFGCateg', [FGCategController::class, 'checkInUsed']);

    Route::get('/rmCateg', [RMCategController::class, 'index']);
    Route::get('/lookupRMCateg', [RMCategController::class, 'lookup']);
    Route::get('/getRMCateg', [RMCategController::class, 'get']);
    Route::post('/upsertRMCateg', [RMCategController::class, 'upsert']);
    Route::post('/deleteRMCateg', [RMCategController::class, 'delete']);
    Route::post('/checkDuplicateRMCateg', [RMCategController::class, 'checkDuplicate']);
    Route::post('/checkInUsedRMCateg', [RMCategController::class, 'checkInUsed']);
    Route::post('/validateRMCategBulk', [RMCategController::class, 'validateBulk']);

    Route::get('/rmClass', [RMClassController::class, 'index']);
    Route::get('/getRMClass', [RMClassController::class, 'get']);
    Route::get('/lookupRMClass', [RMClassController::class, 'lookup']);
    Route::post('/upsertRMClass', [RMClassController::class, 'upsert']);
    Route::post('/deleteRMClass', [RMClassController::class, 'delete']);
    Route::post('/checkDuplicateRMClass', [RMClassController::class, 'checkDuplicate']);
    Route::post('/checkInUsedRMClass', [RMClassController::class, 'checkInUsed']);


    Route::prefix('location')->group(function () {
    Route::get('/location',   [LocationController::class, 'load']);
    Route::get('/getLocation',    [LocationController::class, 'get']);           
    Route::get('/lookupLocation', [LocationController::class, 'lookup']);        
    Route::post('/upsertLocation', [LocationController::class, 'upsert']);
    Route::post('/deleteLocation', [LocationController::class, 'delete']);
    Route::post('/getByWarehouse', [LocationController::class, 'byWarehouse']);
    Route::post('/checkInUsedLocation', [LocationController::class, 'checkInUsed']);
    });


    Route::prefix('ms/inventory/stock-card')->group(function () {
        Route::get('/setup', [MSInvStockCardController::class, 'setup']);
        Route::get('/fifo-balance', [MSInvStockCardController::class, 'fifoBalance']);
        Route::get('/location-balance', [MSInvStockCardController::class, 'locationBalance']);
        Route::get('/stock-card', [MSInvStockCardController::class, 'stockCard']);
        Route::get('/stock-status', [MSInvStockCardController::class, 'stockStatus']);
    });

    
    Route::prefix('fg/inventory/stock-card')->group(function () {
        Route::get('/setup', [FGInvStockCardController::class, 'setup']);
        Route::get('/fifo-balance', [FGInvStockCardController::class, 'fifoBalance']);
        Route::get('/location-balance', [FGInvStockCardController::class, 'locationBalance']);
        Route::get('/stock-card', [FGInvStockCardController::class, 'stockCard']);
        Route::get('/stock-status', [FGInvStockCardController::class, 'stockStatus']);
    });


    Route::prefix('rm/inventory/stock-card')->group(function () {
        Route::get('/setup', [RMInvStockCardController::class, 'setup']);
        Route::get('/fifo-balance', [RMInvStockCardController::class, 'fifoBalance']);
        Route::get('/location-balance', [RMInvStockCardController::class, 'locationBalance']);
        Route::get('/stock-card', [RMInvStockCardController::class, 'stockCard']);
        Route::get('/stock-status', [RMInvStockCardController::class, 'stockStatus']);
    });



    Route::get('/prodBOM',                [ProdBOMController::class, 'index']);
    Route::post('/getProdBOM',            [ProdBOMController::class, 'get']);
    Route::get('/lookupProdBOMItem',      [ProdBOMController::class, 'lookupItem']);
    Route::post('/upsertProdBOM',         [ProdBOMController::class, 'upsert']);
    Route::post('/deleteProdBOM',         [ProdBOMController::class, 'delete']);
    Route::post('/checkDuplicateProdBOM', [ProdBOMController::class, 'checkDuplicate']);
    Route::post('/checkInUsedProdBOM',    [ProdBOMController::class, 'checkInUsed']);
   

    Route::prefix('workCenter')->group(function () {
    Route::get('/load', [WorkCenterController::class, 'index']);
    Route::post('/get', [WorkCenterController::class, 'get']);
    Route::get('/lookup', [WorkCenterController::class, 'lookup']); // Connects to SearchWorkCenterRef.jsx
    Route::post('/upsert', [WorkCenterController::class, 'upsert']);
    Route::post('/delete', [WorkCenterController::class, 'delete']);
    Route::post('/checkDuplicate', [WorkCenterController::class, 'checkDuplicate']);
    Route::post('/checkInUsed', [WorkCenterController::class, 'checkInUsed']);
});
    Route::get('/lookupWorkCenter', [WorkCenterController::class, 'lookup']);

  Route::prefix('prodParameters')->group(function () {
        Route::get('/load',   [ProdParametersController::class, 'index']);
        Route::post('/get',   [ProdParametersController::class, 'get']);
        Route::post('/upsert', [ProdParametersController::class, 'upsert']);
    });


    Route::get('/getInvLookupMS', [MSInvBalanceController::class, 'getInvLookup']);
    Route::get('/getInvLookupFG', [FGInvBalanceController::class, 'getInvLookup']);

    Route::get('/fgClass', [FGClassController::class, 'index']);
    Route::get('/getFGClass', [FGClassController::class, 'get']);
    Route::get('/lookupFGClass', [FGClassController::class, 'lookup']);
    Route::post('/upsertFGClass', [FGClassController::class, 'upsert']);
    Route::post('/deleteFGClass', [FGClassController::class, 'delete']);
    Route::post('/checkDuplicateFGClass', [FGClassController::class, 'checkDuplicate']);
    Route::post('/checkInUsedFGClass', [FGClassController::class, 'checkInUsed']);


    Route::get('/getPriceMatrix', [PriceMatrixController::class, 'get']);
    Route::get('/getPriceMatrixPrio', [PriceMatrixController::class, 'getPrio']);
    Route::post('/getPriceMatrixItemPrice', [PriceMatrixController::class, 'getItemPrice']);
    Route::post('/upsertPriceMatrix', [PriceMatrixController::class, 'upsert']);
    Route::post('/upsertPriceMatrixPrio', [PriceMatrixController::class, 'upsertPrio']);
    Route::post('/deletePriceMatrix', [PriceMatrixController::class, 'delete']);
    Route::post('/deletePriceMatrixPrio', [PriceMatrixController::class, 'deletePrio']);
    Route::get('/historyPriceMatrix', [PriceMatrixController::class, 'history']);
    Route::get('/historyPriceMatrixperItem', [PriceMatrixController::class, 'historyPerItem']);





    // Transactions
    Route::get('/jV', [JournalVoucherController::class, 'index']);
    Route::post('/upsertJV', [JournalVoucherController::class, 'upsert']);
    Route::post('/generateGLJV', [JournalVoucherController::class, 'generateGL']);
    Route::get('/getJV', [JournalVoucherController::class, 'get']);
    Route::get('/postingJV', [JournalVoucherController::class, 'posting']);
    Route::get('/reversalJV', [JournalVoucherController::class, 'reversal']);
    Route::post('/getJVHistory', [JournalVoucherController::class, 'history']);

    Route::get('/APV', [APVoucherController::class, 'index']);
    Route::post('/upsertAPV', [APVoucherController::class, 'upsert']);
    Route::get('/getAPV', [APVoucherController::class, 'get']);
    Route::post('/generateGLAPV', [APVoucherController::class, 'generateGL']);
    Route::post('/load-history', [APVoucherController::class, 'load']);
    Route::post('/postingAPV', [APVoucherController::class, 'PostTransaction']);
    Route::post('/getAPVHistory', [APVoucherController::class, 'history']);
    Route::get('/postingAPV', [APVoucherController::class, 'posting']);

    Route::get('/PO', [POController::class, 'index']);
    Route::post('/upsertPO', [POController::class, 'upsert']);
    Route::get('/getPO', [POController::class, 'get']);
    Route::post('/getPOOpen', [POController::class, 'getPOOpen']);
    Route::post('/getPOHistory', [POController::class, 'history']);
    Route::get('/getPOApproval', [POController::class, 'getPOApproval']);
    Route::post('/approvePO', [POController::class, 'approvePO']);
    Route::get('/getPORR_OpenSummary', [POController::class, 'getPORR_OpenSummary']);
    Route::get('/getFGPORR_OpenSummary', [POController::class, 'getFGPORR_OpenSummary']);
    Route::post('/getPORR_OpenDetail', [POController::class, 'getPORR_OpenDetail']);
    Route::post('/getFGPORR_OpenDetail', [POController::class, 'getFGPORR_OpenDetail']);
    Route::get('/getRMPORR_OpenSummary', [POController::class, 'getRMPORR_OpenSummary']);
    Route::post('/getRMPORR_OpenDetail', [POController::class, 'getRMPORR_OpenDetail']);

    Route::get('/JO', [JOController::class, 'index']);
    Route::post('/upsertJO', [JOController::class, 'upsert']);
    Route::get('/getJO', [JOController::class, 'get']);
    Route::post('/getJOHistory', [JOController::class, 'history']);
    Route::get('/getJOApproval', [JOController::class, 'getJOApproval']);
    Route::post('/approveJO', [JOController::class, 'approveJO']);


    Route::get('/RMRR', [RMRRController::class, 'index']);
    Route::post('/upsertRMRR', [RMRRController::class, 'upsert']);
    Route::post('/generateGLRMRR', [RMRRController::class, 'generateGL']);
    Route::get('/getRMRR', [RMRRController::class, 'get']);
    Route::get('/postingRMRR', [RMRRController::class, 'posting']);
    Route::get('/findRMRR', [RMRRController::class, 'find']);
    Route::post('/getRMRRHistory', [RMRRController::class, 'history']);

    
    Route::get('/RMRTV', [RMRTVController::class, 'index']);
    Route::post('/upsertRMRTV', [RMRTVController::class, 'upsert']);
    Route::post('/generateGLRMRTV', [RMRTVController::class, 'generateGL']);
    Route::get('/getRMRTV', [RMRTVController::class, 'get']);
    Route::get('/postingRMRTV', [RMRTVController::class, 'posting']);
    Route::post('/finalizeRMRTV', [RMRTVController::class, 'finalize']);
    Route::post('/getRMRTVHistory', [RMRTVController::class, 'history']);
    Route::get('/findRMRTV', [RMRTVController::class, 'find']);

    
    

    Route::post('/getRMAJ', [RMAJController::class, 'get']);
    Route::get('/getRMAJ', [RMAJController::class, 'get']);
    Route::get('/postingRMAJ', [RMAJController::class, 'posting']);
    Route::post('/upsertRMAJ', [RMAJController::class, 'upsert']);
    Route::post('/generateRMAJEntries', [RMAJController::class, 'generateGL']);
    Route::post('/getRMAJHistory', [RMAJController::class, 'history']);
    Route::post('/findRMAJ', [RMAJController::class, 'find']);
    Route::post('/validateRMAJUpload', [RMAJController::class, 'validateUpload']);
    Route::post('/checkRMAJBBUploaded', [RMAJController::class, 'checkBBUploaded']);
    Route::post('/finalizeRMAJ', [RMAJController::class, 'finalize']);



    Route::get('/RMST', [RMSTController::class, 'index']);
    Route::post('/upsertRMST', [RMSTController::class, 'upsert']);
    Route::post('/generateGLRMST', [RMSTController::class, 'generateGL']);
    Route::get('/getRMST', [RMSTController::class, 'get']);
    Route::get('/postingRMST', [RMSTController::class, 'posting']);
    Route::get('/findRMST', [RMSTController::class, 'find']);
    Route::post('/getRMSTHistory', [RMSTController::class, 'history']);

    Route::post('/cancelRMST',   [RMSTController::class, 'cancel']);



    Route::get('/PR', [PRController::class, 'index']);
    Route::post('/upsertPR', [PRController::class, 'upsert']);
    Route::get('/getPR', [PRController::class, 'get']);
    Route::post('/getPROpen', [PRController::class, 'getPROpen']);
    Route::post('/po/update', [POController::class, 'updatePrFromPO']);
    Route::post('/getPRHistory', [PRController::class, 'history']);
    Route::post('/getBranchItemBalance', [PRController::class, 'getBranchItemBalance']);
    Route::get('/getPRJO_OpenSummary', [PRController::class, 'getPRJO_OpenSummary']);
    Route::post('/getPRJO_OpenDetail', [PRController::class, 'getPRJO_OpenDetail']);
    Route::get('/getPRPO_OpenSummary', [PRController::class, 'getPRPO_OpenSummary']);
    Route::post('/getPRPO_OpenDetail', [PRController::class, 'getPRPO_OpenDetail']);
    Route::get('/getPRApproval', [PRController::class, 'getPRApproval']);
    Route::post('/approvePR', [PRController::class, 'approvePR']);


    
    Route::get('/MSRR', [MSRRController::class, 'index']);
    Route::post('/upsertMSRR', [MSRRController::class, 'upsert']);
    Route::post('/generateGLMSRR', [MSRRController::class, 'generateGL']);
    Route::get('/getMSRR', [MSRRController::class, 'get']);
    Route::get('/postingMSRR', [MSRRController::class, 'posting']);
    Route::get('/findMSRR', [MSRRController::class, 'find']);
    Route::post('/getMSRRHistory', [MSRRController::class, 'history']);
    Route::get('/getAPVRR_OpenSummary', [APVoucherController::class, 'getAPVRR_OpenSummary']);
    Route::get('/getAPVJO_OpenSummary', [APVoucherController::class, 'getAPVJO_OpenSummary']);
    Route::post('/getAPVRR_OpenDetail', [APVoucherController::class, 'getAPVRR_OpenDetail']);

    Route::get('/FGRR', [FGRRController::class, 'index']);
    Route::post('/upsertFGRR', [FGRRController::class, 'upsert']);
    Route::post('/generateGLFGRR', [FGRRController::class, 'generateGL']);
    Route::get('/getFGRR', [FGRRController::class, 'get']);
    Route::get('/postingFGRR', [FGRRController::class, 'posting']);
    Route::get('/findFGRR', [FGRRController::class, 'find']);
    Route::post('/getFGRRHistory', [FGRRController::class, 'history']);

    Route::get('/FGIS', [FGISController::class, 'index']);
    Route::post('/upsertFGIS', [FGISController::class, 'upsert']);
    Route::post('/generateGLFGIS', [FGISController::class, 'generateGL']);
    Route::get('/getFGIS', [FGISController::class, 'get']);
    Route::post('/getFGISHistory', [FGISController::class, 'history']);
    Route::get('/postingFGIS', [FGISController::class, 'posting']);
    Route::get('/findFGIS', [FGISController::class, 'find']);

    Route::get('/FGPR', [FGPRController::class, 'index']);
    Route::post('/upsertFGPR', [FGPRController::class, 'upsert']);
    Route::post('/generateGLFGPR', [FGPRController::class, 'generateGL']);
    Route::get('/getFGPR', [FGPRController::class, 'get']);
    Route::get('/postingFGPR', [FGPRController::class, 'posting']);
    Route::post('/getFGPRHistory', [FGPRController::class, 'history']);
    Route::post('/finalizeFGPR', [FGPRController::class, 'finalize']);
    Route::post('/cancelFGPR', [FGPRController::class, 'cancel']);
    Route::get('/getFGPRWO', [FGPRController::class, 'getWO']);

Route::get('/RMIS', [RMISController::class, 'index']);
Route::post('/upsertRMIS', [RMISController::class, 'upsert']);
Route::post('/generateGLRMIS', [RMISController::class, 'generateGL']);
Route::get('/getRMIS', [RMISController::class, 'get']);
Route::post('/getRMISHistory', [RMISController::class, 'history']);
Route::get('/postingRMIS', [RMISController::class, 'posting']);
Route::get('/findRMIS', [RMISController::class, 'find']);



    Route::get('/qstat', [QStatController::class, 'index']);          // Load
    Route::get('/lookupQStat', [QStatController::class, 'lookup']);   // Lookup modal
    Route::post('/getQStat', [QStatController::class, 'get']);        // Single
    Route::post('/upsertQStat', [QStatController::class, 'upsert']);  // Save
    Route::post('/deleteQStat', [QStatController::class, 'delete']);  // Delete
    Route::post('/checkInUsedQStat', [QStatController::class, 'checkInUsed']);
    Route::post('/checkDuplicateQStat', [QStatController::class, 'checkDuplicate']);



    Route::get('/jobCode', [JobCodesController::class, 'index']);
    Route::post('/upsertJobCode', [JobCodesController::class, 'upsert']);
    Route::get('/lookupJobCode', [JobCodesController::class, 'lookup']);
    Route::get('/getJobCode', [JobCodesController::class, 'get']);
    Route::post('/deleteJobCode', [JobCodesController::class, 'delete']);
    Route::post('/checkInUsedJobCode', [JobCodesController::class, 'checkInUsed']);
    Route::post('/checkDuplicateJobCode', [JobCodesController::class, 'checkDuplicate']);

    Route::get('/MSIS', [MSISController::class, 'index']);
    Route::post('/upsertMSIS', [MSISController::class, 'upsert']);
    Route::post('/generateGLMSIS', [MSISController::class, 'generateGL']);
    Route::post('/getMSISHistory', [MSISController::class, 'history']);
    Route::get('/getMSIS', [MSISController::class, 'get']);
    Route::get('/postingMSIS', [MSISController::class, 'posting']);
    Route::get('/findMSIS', [MSISController::class, 'find']);

    Route::get('/MSST', [MSSTController::class, 'index']);
    Route::post('/upsertMSST', [MSSTController::class, 'upsert']);
    Route::post('/generateGLMSST', [MSSTController::class, 'generateGL']);
    Route::get('/getMSST', [MSSTController::class, 'get']);
    Route::get('/postingMSST', [MSSTController::class, 'posting']);
    Route::post('/finalizeMSST', [MSSTController::class, 'finalize']);
    Route::get('/loadOpenSummaryMSSTWHINT', [MSSTController::class, 'loadOpenSummary']);
    Route::get('/loadOpenDetailMSSTWHINT', [MSSTController::class, 'loadOpenDetail']);
    Route::get('/retrieveSelectedMSSTWHINT', [MSSTController::class, 'retrieveSelectedWHINT']);
    Route::get('/findMSST', [MSSTController::class, 'find']);


    Route::get('/MSAJ', [MSAJController::class, 'index']);
    Route::post('/upsertMSAJ', [MSAJController::class, 'upsert']);
    Route::post('/generateGLMSAJ', [MSAJController::class, 'generateGL']);
    Route::get('/getMSAJ', [MSAJController::class, 'get']);
    Route::get('/postingMSAJ', [MSAJController::class, 'posting']);
    Route::post('/getMSAJHistory', [MSAJController::class, 'history']);
    Route::get('/findMSAJ', [MSAJController::class, 'find']);
    Route::post('/validateMSAJUpload', [MSAJController::class, 'validateUpload']);
    Route::post('/checkMSAJBBUploaded', [MSAJController::class, 'checkBBUploaded']);


    Route::get('/getInvLookupMS', [MSInvBalanceController::class, 'getInvLookup']);
    Route::get('/getInvLookupRM', [RMInvBalanceController::class, 'getInvLookup']);
    Route::get('/getInvLookupFG', [FGInvBalanceController::class, 'getInvLookup']);


    Route::get('/MSRTV', [MSRTVController::class, 'index']);
    Route::post('/upsertMSRTV', [MSRTVController::class, 'upsert']);
    Route::post('/generateGLMSRTV', [MSRTVController::class, 'generateGL']);
    Route::get('/getMSRTV', [MSRTVController::class, 'get']);
    Route::get('/postingMSRTV', [MSRTVController::class, 'posting']);
    Route::post('/finalizeMSRTV', [MSRTVController::class, 'finalize']);
    Route::post('/getMSRTVHistory', [MSRTVController::class, 'history']);
    Route::get('/findMSRTV', [MSRTVController::class, 'find']);
    

    Route::get('/FGST', [FGSTController::class, 'index']);
    Route::post('/upsertFGST', [FGSTController::class, 'upsert']);
    Route::post('/generateGLFGST', [FGSTController::class, 'generateGL']);
    Route::get('/getFGST', [FGSTController::class, 'get']);
    Route::get('/postingFGST', [FGSTController::class, 'posting']);
    Route::post('/getFGSTHistory', [FGSTController::class, 'history']);
    Route::get('/findFGST', [FGSTController::class, 'find']);
    Route::post('/finalizeFGST', [FGSTController::class, 'finalize']);







    Route::get('/FGRTV', [FGRTVController::class, 'index']);
    Route::post('/upsertFGRTV', [FGRTVController::class, 'upsert']);
    Route::post('/generateGLFGRTV', [FGRTVController::class, 'generateGL']);
    Route::get('/getFGRTV', [FGRTVController::class, 'get']);
    Route::get('/postingFGRTV', [FGRTVController::class, 'posting']);
    Route::post('/finalizeFGRTV', [FGRTVController::class, 'finalize']);
    Route::post('/getFGRTVHistory', [FGRTVController::class, 'history']);
    Route::get('/findFGRTV', [FGRTVController::class, 'find']);




    Route::post('/getFGAJ', [FGAJController::class, 'get']);
    Route::get('/getFGAJ', [FGAJController::class, 'get']);
    Route::get('/postingFGAJ', [FGAJController::class, 'posting']);
    Route::post('/upsertFGAJ', [FGAJController::class, 'upsert']);
    Route::post('/generateFGAJEntries', [FGAJController::class, 'generateGL']);
    Route::post('/generateGLFGAJ', [FGAJController::class, 'generateGL']);
    Route::post('/getFGAJHistory', [FGAJController::class, 'history']);
    Route::post('/findFGAJ', [FGAJController::class, 'find']);
    Route::post('/validateFGAJUpload', [FGAJController::class, 'validateUpload']);
    Route::post('/checkFGAJBBUploaded', [FGAJController::class, 'checkBBUploaded']);
    Route::post('/finalizeFGAJ', [FGAJController::class, 'finalize']);
    





     Route::prefix('warehouse')->group(function () {
        Route::get('/warehouse', [WarehouseMastController::class, 'load']); 
        Route::get('/getWarehouse',    [WarehouseMastController::class, 'get']);    
        Route::get('/lookupWarehouse', [WarehouseMastController::class, 'lookup']);   
        Route::post('/upsertWarehouse', [WarehouseMastController::class, 'upsert']);
        Route::post('/deleteWarehouse', [WarehouseMastController::class, 'delete']);
        Route::post('/checkDuplicateWH', [WarehouseMastController::class, 'checkDuplicateWH']);
        Route::post('/checkInUsedWH', [WarehouseMastController::class, 'checkInUsedWH']);
    });


    Route::prefix('location')->group(function () {
        Route::get('/location',   [LocationController::class, 'load']);
        Route::get('/getLocation',    [LocationController::class, 'get']);           
        Route::get('/lookupLocation', [LocationController::class, 'lookup']);        
        Route::post('/upsertLocation', [LocationController::class, 'upsert']);
        Route::post('/deleteLocation', [LocationController::class, 'delete']);
        Route::post('/getByWarehouse', [LocationController::class, 'byWarehouse']);
        Route::post('/checkInUsedLocation', [LocationController::class, 'checkInUsed']);

    });
    Route::post('/msLookup', [MSISController::class, 'msLookup']);


    Route::get('/uom', [UOMController::class, 'index']);
    Route::post('/upsertUom', [UOMController::class, 'upsert']);
    Route::get('/lookupUom', [UOMController::class, 'lookup']);
    Route::get('/getUom', [UOMController::class, 'get']);
    Route::post('/deleteUom', [UOMController::class, 'delete']);
    Route::post('/checkInUsedUom', [UOMController::class, 'checkInUsed']);
    Route::post('/checkDuplicateUom', [UOMController::class, 'checkDuplicate']);

    Route::get('/aPCM', [APCMController::class, 'index']);
    Route::post('/upsertAPCM', [APCMController::class, 'upsert']);
    Route::post('/generateGLAPCM', [APCMController::class, 'generateGL']);
    Route::get('/getAPCM', [APCMController::class, 'get']);
    Route::get('/postingAPCM', [APCMController::class, 'posting']);
    Route::post('/getAPCMHistory', [APCMController::class, 'history']);

    Route::get('/aPDM', [APDMController::class, 'index']);
    Route::post('/upsertAPDM', [APDMController::class, 'upsert']);
    Route::post('/generateGLAPDM', [APDMController::class, 'generateGL']);
    Route::get('/getAPDM', [APDMController::class, 'get']);
    Route::get('/postingAPDM', [APDMController::class, 'posting']);
    Route::post('/getAPDMHistory', [APDMController::class, 'history']);

    Route::get('/cV', [CVController::class, 'index']);
    Route::post('/upsertCV', [CVController::class, 'upsert']);
    Route::post('/generateGLCV', [CVController::class, 'generateGL']);
    Route::post('/postCV', [CVController::class, 'post']);
    Route::get('/getCV', [CVController::class, 'get']);
    Route::get('/postingCV', [CVController::class, 'posting']);
    Route::post('/load-CVhistory', [CVController::class, 'load']);
    Route::post('/getCVHistory', [CVController::class, 'history']);

    Route::get('/pCV', [PCVController::class, 'index']);
    Route::post('/upsertPCV', [PCVController::class, 'upsert']);
    Route::post('/generateGLPCV', [PCVController::class, 'generateGL']);
    Route::get('/getPCV', [PCVController::class, 'get']);
    Route::get('/postingPCV', [PCVController::class, 'posting']);
    Route::post('/getPCVHistory', [PCVController::class, 'history']);

    Route::get('/sVI', [SVIController::class, 'index']);
    Route::post('/upsertSVI', [SVIController::class, 'upsert']);
    Route::post('/generateGLSVI', [SVIController::class, 'generateGL']);
    Route::get('/getSVI', [SVIController::class, 'get']);
    Route::get('/postingSVI', [SVIController::class, 'posting']);
    Route::post('/getSVIHistory', [SVIController::class, 'history']);
    Route::get('/findSVI', [SVIController::class, 'find']);

    Route::get('/sOA', [SOAController::class, 'index']);
    Route::post('/upsertSOA', [SOAController::class, 'upsert']);
    Route::post('/generateGLSOA', [SOAController::class, 'generateGL']);
    Route::get('/getSOA', [SOAController::class, 'get']);
    Route::get('/postingSOA', [SOAController::class, 'posting']);
    Route::post('/getSOAHistory', [SOAController::class, 'history']);
    Route::get('/findSOA', [SOAController::class, 'find']);

    Route::get('/aRCM', [ARCMController::class, 'index']);
    Route::post('/upsertARCM', [ARCMController::class, 'upsert']);
    Route::post('/generateGLARCM', [ARCMController::class, 'generateGL']);
    Route::get('/getARCM', [ARCMController::class, 'get']);
    Route::get('/postingARCM', [ARCMController::class, 'posting']);
    Route::post('/getARCMHistory', [ARCMController::class, 'history']);
    Route::get('/findARCM', [ARCMController::class, 'find']);


    Route::get('/aRDM', [ARDMController::class, 'index']);
    Route::post('/upsertARDM', [ARDMController::class, 'upsert']);
    Route::post('/generateGLARDM', [ARDMController::class, 'generateGL']);
    Route::get('/getARDM', [ARDMController::class, 'get']);
    Route::get('/postingARDM', [ARDMController::class, 'posting']);
    Route::post('/getARDMHistory', [ARDMController::class, 'history']);
    Route::get('/findARDM', [ARDMController::class, 'find']);

    Route::post('/cR', [CRController::class, 'index']);
    Route::post('/upsertCR', [CRController::class, 'upsert']);
    Route::post('/getCR', [CRController::class, 'get']);
    Route::post('/generateGLCR', [CRController::class, 'generateGL']);
    Route::get('/getCR', [CRController::class, 'get']);
    Route::get('/postingCR', [CRController::class, 'posting']);
    Route::post('/getCRHistory', [CRController::class, 'history']);
    Route::get('/findCR', [CRController::class, 'find']);

    Route::post('/aR', [ARController::class, 'index']);
    Route::post('/upsertAR', [ARController::class, 'upsert']);
    Route::post('/getAR', [ARController::class, 'get']);
    Route::post('/generateGLAR', [ARController::class, 'generateGL']);
    Route::get('/getAR', [ARController::class, 'get']);
    Route::get('/postingAR', [ARController::class, 'posting']);
    Route::post('/getARHistory', [ARController::class, 'history']);
    Route::get('/findAR', [ARController::class, 'find']);


    Route::post('/aRDS', [ARDSController::class, 'index']);
    Route::post('/upsertARDS', [ARDSController::class, 'upsert']);
    Route::post('/getARDS', [ARDSController::class, 'get']);
    Route::get('/getARDS', [ARDSController::class, 'get']);
    Route::get('/postingARDS', [ARDSController::class, 'posting']);
    Route::post('/getARDSHistory', [ARDSController::class, 'history']);
    Route::get('/findARDS', [ARDSController::class, 'find']);
    Route::get('/getCRDS_OpenDetail', [ARDSController::class, 'getCRDS_OpenDetail']);



    Route::get('/sO', [SOController::class, 'index']);
    Route::post('/upsertSO', [SOController::class, 'upsert']);
    Route::get('/getSO', [SOController::class, 'get']);
    Route::post('/getSOHistory', [SOController::class, 'history']);
    Route::get('/findSO', [SOController::class, 'find']);
    Route::get('/checkSODuplicatePO', [SOController::class, 'checkDuplicatePO']);
    Route::get('/getSODR_OpenSummary', [SOController::class, 'getSODR_OpenSummary']);
    Route::post('/getSODR_OpenDetail', [SOController::class, 'getSODR_OpenDetail']);


    
    Route::get('/dR', [DRController::class, 'index']);
    Route::post('/upsertDR', [DRController::class, 'upsert']);
    Route::get('/getDR', [DRController::class, 'get']);
    Route::post('/getDRHistory', [DRController::class, 'history']);
    Route::get('/findDR', [DRController::class, 'find']);
    Route::get('/getDRSI_OpenSummary', [DRController::class, 'getDRSI_OpenSummary']);
    Route::post('/getDRSI_OpenDetail', [DRController::class, 'getDRSI_OpenDetail']);
    Route::post('/generateGLDR', [DRController::class, 'generateGL']);
    Route::get('/postingDR', [DRController::class, 'posting']);
    Route::post('/getDRSI_Selected', [DRController::class, 'getDRSI_Selected']);



    Route::get('/sI', [SIController::class, 'index']);
    Route::post('/upsertSI', [SIController::class, 'upsert']);
    Route::post('/generateGLSI', [SIController::class, 'generateGL']);
    Route::get('/getSI', [SIController::class, 'get']);
    Route::get('/postingSI', [SIController::class, 'posting']);
    Route::post('/getSIHistory', [SIController::class, 'history']);
    Route::post('/finalizeSI', [SIController::class, 'finalize']);
    Route::get('/findSI', [SIController::class, 'find']);


    Route::get('/csI', [CSIController::class, 'index']);
    Route::post('/upsertCSI', [CSIController::class, 'upsert']);
    Route::post('/generateGLCSI', [CSIController::class, 'generateGL']);
    Route::get('/getCSI', [CSIController::class, 'get']);
    Route::get('/postingCSI', [CSIController::class, 'posting']);
    Route::post('/getCSIHistory', [CSIController::class, 'history']);
    Route::get('/findCSI', [CSIController::class, 'find']);

 



    Route::get('/fARR', [FARRController::class, 'index']);
    Route::post('/upsertFARR', [FARRController::class, 'upsert']);
    Route::get('/getFARR', [FARRController::class, 'get']);
    Route::post('/getFARRHistory', [FARRController::class, 'history']);
    Route::get('/findFARR', [FARRController::class, 'find']);
    Route::get('/postingFARR', [FARRController::class, 'posting']);
    Route::post('/generateGLFARR', [FARRController::class, 'generateGL']);




    /* FA Category */
    Route::get('/faCateg', [FACategController::class, 'index']);
    Route::post('/upsertFACateg', [FACategController::class, 'upsert']);
    Route::get('/lookupFACateg', [FACategController::class, 'lookup']);
    Route::get('/getFACateg', [FACategController::class, 'get']);
    Route::post('/deleteFACateg', [FACategController::class, 'delete']);
    Route::post('/checkInUsedFACateg', [FACategController::class, 'checkInUsed']);
    Route::post('/checkDuplicateFACateg', [FACategController::class, 'checkDuplicate']);
    Route::get('/loadFACateg', [FACategController::class, 'index']);

    /* FA Class */
    Route::get('/faClass', [FAClassController::class, 'index']);
    Route::post('/upsertFAClass', [FAClassController::class, 'upsert']);
    Route::get('/lookupFAClass', [FAClassController::class, 'lookup']);
    Route::get('/getFAClass', [FAClassController::class, 'get']);
    Route::post('/deleteFAClass', [FAClassController::class, 'delete']);
    Route::post('/checkInUsedFAClass', [FAClassController::class, 'checkInUsed']);
    Route::post('/checkDuplicateFAClass', [FAClassController::class, 'checkDuplicate']);
    Route::get('/loadFAClass', [FAClassController::class, 'index']);

    /* FA Location */
    Route::get('/faLoc', [FALocController::class, 'index']);
    Route::post('/upsertFALoc', [FALocController::class, 'upsert']);
    Route::get('/lookupFALoc', [FALocController::class, 'lookup']);
    Route::get('/getFALoc', [FALocController::class, 'get']);
    Route::post('/deleteFALoc', [FALocController::class, 'delete']);
    Route::post('/checkInUsedFALoc', [FALocController::class, 'checkInUsed']);
    Route::post('/checkDuplicateFALoc', [FALocController::class, 'checkDuplicate']);
    Route::get('/loadFALoc', [FALocController::class, 'index']);

    Route::get('/faMast', [FAMastController::class, 'index']);
    Route::post('/lookupFAMast', [FAMastController::class, 'lookup']);
    Route::get('/lookupFAMast', [FAMastController::class, 'lookup']);
    Route::post('/getFAMast', [FAMastController::class, 'get']);
    Route::post('/upsertFAMast', [FAMastController::class, 'upsert']);
    Route::post('/checkFAMastDuplicate', [FAMastController::class, 'checkDuplicate']);
    Route::post('/checkFAMastInUsed', [FAMastController::class, 'checkInUsed']);
    Route::post('/deleteFAMast', [FAMastController::class, 'delete']);
    Route::get('/faMastFinancialInfo', [FAMastController::class, 'financialInfo']);

    Route::get('/fATR', [FATRController::class, 'index']);
    Route::post('/upsertFATR', [FATRController::class, 'upsert']);
    Route::get('/getFATR', [FATRController::class, 'get']);
    Route::post('/getFATRHistory', [FATRController::class, 'history']);
    Route::get('/findFATR', [FATRController::class, 'find']);
    Route::get('/postingFATR', [FATRController::class, 'posting']);
    Route::post('/generateGLFATR', [FATRController::class, 'generateGL']);


    Route::get('/fADP', [FADPController::class, 'index']);
    Route::post('/upsertFADP', [FADPController::class, 'upsert']);
    Route::get('/getFADP', [FADPController::class, 'get']);
    Route::post('/getFADP', [FADPController::class, 'get']);
    Route::post('/getFADPHistory', [FADPController::class, 'history']);
    Route::get('/findFADP', [FADPController::class, 'find']);
    Route::get('/postingFADP', [FADPController::class, 'posting']);
    Route::post('/generateGLFADP', [FADPController::class, 'generateGL']);



	Route::get('/fADS', [FADSController::class, 'index']);
	Route::post('/upsertFADS', [FADSController::class, 'upsert']);
	Route::get('/getFADS', [FADSController::class, 'get']);
	Route::post('/getFADSHistory', [FADSController::class, 'history']);
	Route::get('/findFADS', [FADSController::class, 'find']);
	Route::get('/postingFADS', [FADSController::class, 'posting']);
	Route::post('/generateGLFADS', [FADSController::class, 'generateGL']);




    Route::get('/lookupFAAsset', [FATRController::class, 'assetLookup']);
    Route::get('/getFAAssetInquiry', [FATRController::class, 'assetInquiry']);


    Route::get('/allTranApproval', [AllTranApprovalController::class, 'get']);
    Route::post('/upsertAllTranApproval', [AllTranApprovalController::class, 'upsert']);



  
    Route::get('/getCheckTemplates', [CheckTemplateController::class, 'index']);
    Route::get('/lookupCheckTemplates', [CheckTemplateController::class, 'lookup']);
    Route::get('/getCheckTemplate', [CheckTemplateController::class, 'get']);
    Route::get('/getCheckTemplateByCode', [CheckTemplateController::class, 'getByCode']);

    Route::post('/upsertCheckTemplate', [CheckTemplateController::class, 'upsert']);
    Route::post('/deleteCheckTemplate', [CheckTemplateController::class, 'delete']);
    Route::post('/setInactiveCheckTemplate', [CheckTemplateController::class, 'setInactive']);

    Route::get('/loadBankCheckTemplateMapping', [CheckTemplateController::class, 'loadBankMapping']);
    Route::post('/upsertBankCheckTemplateMapping', [CheckTemplateController::class, 'upsertBankMapping']);
    Route::post('/removeBankCheckTemplateMapping', [CheckTemplateController::class, 'removeBankMapping']);
    Route::get('/getBankCheckTemplate', [CheckTemplateController::class, 'getBankTemplate']);

    Route::post('/checkCheckTemplateInUsed', [CheckTemplateController::class, 'checkInUsed']);
    Route::post('/checkCheckTemplateDuplicate', [CheckTemplateController::class, 'checkDuplicate']);

    

    Route::post('/getSalesTrackerSummary', [SalesInqController::class, 'getSalesTrackerSummary']);
    Route::post('/getSalesTrackerDelivery', [SalesInqController::class, 'getSalesTrackerDelivery']);
    Route::post('/getSalesTrackerInvoices', [SalesInqController::class, 'getSalesTrackerInvoices']);
    Route::post('/getSalesTrackerSettlements', [SalesInqController::class, 'getSalesTrackerSettlements']);
    Route::post('/getSalesTrackerTimeline', [SalesInqController::class, 'getSalesTrackerTimeline']);
    Route::post('/getSalesTrackerDetails', [SalesInqController::class, 'getSalesTrackerDetails']);

    // Landed Cost Reference
    Route::get('/lcRef', [LCRefController::class, 'index']);
    Route::post('/upsertLCRef', [LCRefController::class, 'upsert']);
    Route::get('/lookupLCRef', [LCRefController::class, 'lookup']);
    Route::get('/getLCRef', [LCRefController::class, 'get']);
    Route::post('/deleteLCRef', [LCRefController::class, 'delete']);
    Route::post('/checkInUsedLCRef', [LCRefController::class, 'checkInUsed']);
    Route::post('/checkDuplicateLCRef', [LCRefController::class, 'checkDuplicate']);
    Route::get('/loadLCRef', [LCRefController::class, 'index']);


    
    // Landed Cost Transaction
    Route::get('/lC', [LCController::class, 'index']);
    Route::post('/upsertLC', [LCController::class, 'upsert']);
    Route::get('/getLC', [LCController::class, 'get']);
    Route::post('/getLCOpen', [LCController::class, 'getLCOpen']);
    Route::post('/getLCHistory', [LCController::class, 'history']);
    Route::get('/getRRLC_OpenSummary', [LCController::class, 'getRRLC_OpenSummary']);
    Route::post('/getRRLC_Selected', [LCController::class, 'getRRLC_Selected']);
    Route::get('/postingLC', [LCController::class, 'posting']);



    // Budget Transaction
    Route::get('/budItemRef', [BudItemRefController::class, 'index']);
    Route::post('/lookupBudItemRef', [BudItemRefController::class, 'lookup']);
    Route::get('/lookupBudItemRef', [BudItemRefController::class, 'lookup']);
    Route::post('/getBudItemRef', [BudItemRefController::class, 'get']);
    Route::post('/upsertBudItemRef', [BudItemRefController::class, 'upsert']);
    Route::post('/checkBudItemRefDuplicate', [BudItemRefController::class, 'checkDuplicate']);
    Route::post('/checkBudItemRefInUsed', [BudItemRefController::class, 'checkInUsed']);
    Route::post('/deleteBudItemRef', [BudItemRefController::class, 'delete']);


    Route::get('/budbb', [BUDBBController::class, 'index']);
    Route::post('/getBUDBB', [BUDBBController::class, 'get']);
    Route::get('/getBUDBB', [BUDBBController::class, 'get']);
    Route::post('/upsertBUDBB', [BUDBBController::class, 'upsert']);
    Route::post('/getBUDBBHistory', [BUDBBController::class, 'history']);
    Route::post('/findBUDBB', [BUDBBController::class, 'find']);
    Route::post('/postingBUDBB', [BUDBBController::class, 'posting']);
    Route::post('/uploadBUDBBExcel', [BUDBBController::class, 'uploadExcel']);

    Route::get('/getBUDRA', [BUDRAController::class, 'get']);
    Route::post('/upsertBUDRA', [BUDRAController::class, 'upsert']);
    Route::post('/getBUDRAHistory', [BUDRAController::class, 'history']);
    Route::post('/findBUDRA', [BUDRAController::class, 'find']);
    Route::get('/postingBUDRA', [BUDRAController::class, 'posting']);
  

    Route::get('/getBUDAU', [BUDAUController::class, 'get']);
    Route::post('/upsertBUDAU', [BUDAUController::class, 'upsert']);
    Route::post('/getBUDAUHistory', [BUDAUController::class, 'history']);
    Route::post('/findBUDAU', [BUDAUController::class, 'find']);
    Route::get('/postingBUDAU', [BUDAUController::class, 'posting']);

    Route::post('/getBUDCL', [BUDCLController::class, 'get']);
    Route::get('/getBUDCL', [BUDCLController::class, 'get']);
    Route::post('/loadBUDCL', [BUDCLController::class, 'index']);
    Route::post('/upsertBUDCL', [BUDCLController::class, 'upsert']);
    Route::post('/getBUDCLHistory', [BUDCLController::class, 'history']);
    Route::post('/findBUDCL', [BUDCLController::class, 'find']);
    Route::get('/postingBUDCL', [BUDCLController::class, 'posting']);
    Route::post('/postingBUDCL', [BUDCLController::class, 'posting']);
    Route::post('/getBUDCLBudgetBalance', [BUDCLController::class, 'budgetBalance']);

     
    Route::post('/lookupBUDOpenBalanceYTD', [BUDMoveController::class, 'budOpenBalanceYTD']);
    Route::post('/BUDOpenBalanceYTD', [BUDMoveController::class, 'budOpenBalanceYTD']);
    Route::post('/BUDTop1OpenTempBalance', [BUDMoveController::class, 'budTop1OpenTempBalance']);
    Route::post('/getBUDTop1OpenTempBalance', [BUDMoveController::class, 'budTop1OpenTempBalance']);
    Route::post('/getBUDBudgetQuery', [BUDMoveController::class, 'budgetQuery']);
    Route::post('/getBUDBudgetMonthlyComparative', [BUDMoveController::class, 'budgetMonthlyComparative']);


    Route::get('/fARS', [FARSController::class, 'index']);
    Route::post('/upsertFARS', [FARSController::class, 'upsert']);
    Route::get('/getFARS', [FARSController::class, 'get']);
    Route::post('/getFARSHistory', [FARSController::class, 'history']);
    Route::get('/findFARS', [FARSController::class, 'find']);
    Route::get('/postingFARS', [FARSController::class, 'posting']);
    Route::post('/generateGLFARS', [FARSController::class, 'generateGL']);


    Route::post('/getFAAssetQuery', [FAMoveController::class, 'getFAAssetQuery']);
    Route::post('/getFAAssetHistory', [FAMoveController::class, 'getFAAssetHistory']);
    Route::post('/getFADeprHistory', [FAMoveController::class, 'getFADeprHistory']);
    Route::post('/getFALapsingSchedule', [FAMoveController::class, 'getFALapsingSchedule']);
	
    
    Route::post('/getCANHistory', [CanController::class, 'getHistory']);
    Route::post('/getCANOpenPR', [CanController::class, 'getOpenPR']);
    Route::post('/getCANOpenPRDetail', [CanController::class, 'getOpenPRDetail']);
    Route::post('/getCAN', [CanController::class, 'getCAN']);
    Route::post('/upsertCAN', [CanController::class, 'upsert']);
    Route::post('/submitCAN', [CanController::class, 'submit']);
    Route::post('/approveCAN', [CanController::class, 'approve']);
    Route::post('/awardCAN', [CanController::class, 'award']);
    Route::post('/findCAN', [CanController::class, 'find']);
    Route::post('/markCANPOGenerated', [CanController::class, 'markPOGenerated']);
    Route::post('/markCANPOLinesGenerated', [CanController::class, 'markPOLinesGenerated']);
    Route::post('/can/mark-po-lines-generated', [CanController::class, 'markPOLinesGenerated']);


  
    Route::post('/bankRecon', [BankReconController::class, 'process']);
    Route::post('/bankRecon/load', [BankReconController::class, 'load']);
    Route::post('/bankRecon/get', [BankReconController::class, 'get']);
    Route::post('/bankRecon/saveCheck', [BankReconController::class, 'saveCheck']);
    Route::post('/bankRecon/generateBankRecon', [BankReconController::class, 'generateBankRecon']);
    Route::post('/bankRecon/saveBankRecon', [BankReconController::class, 'saveBankRecon']);
    Route::post('/bankRecon/clear', [BankReconController::class, 'clear']);
    Route::post('/bankRecon/history', [BankReconController::class, 'history']);
    Route::post('/bankRecon/find', [BankReconController::class, 'find']);
    Route::post('/bankRecon/emailReport', [BankReconController::class, 'emailReport']);



    Route::get('/template-layouts/{layoutType}', [TemplateLayoutController::class, 'index']);
    Route::get('/template-layouts/{layoutType}/{layoutName}', [TemplateLayoutController::class, 'show']);
    Route::post('/template-layouts/{layoutType}', [TemplateLayoutController::class, 'store']);
    Route::delete('/template-layouts/{layoutType}/{layoutName}', [TemplateLayoutController::class, 'destroy']);


    // Work Order
    Route::get('/wo', [WOController::class, 'index']);
    Route::post('/getWO', [WOController::class, 'get']);
    Route::post('/loadWO', [WOController::class, 'load']);
    Route::post('/getWOHistory', [WOController::class, 'history']);
    Route::post('/findWO', [WOController::class, 'find']);
    Route::post('/findWOBOM', [WOController::class, 'findBOM']);
    Route::post('/loadWOBOM', [WOController::class, 'loadBOM']);
    Route::post('/upsertWO', [WOController::class, 'upsert']);
    Route::post('/postingWO', [WOController::class, 'posting']);
    Route::post('/cancelWO', [WOController::class, 'cancel']);

    Route::get('/prodBOM',                [ProdBOMController::class, 'index']);
    Route::post('/getProdBOM',            [ProdBOMController::class, 'get']);
    Route::get('/lookupProdBOMItem',      [ProdBOMController::class, 'lookupItem']);
    Route::post('/upsertProdBOM',         [ProdBOMController::class, 'upsert']);
    Route::post('/deleteProdBOM',         [ProdBOMController::class, 'delete']);
    Route::post('/checkDuplicateProdBOM', [ProdBOMController::class, 'checkDuplicate']);
    Route::post('/checkInUsedProdBOM',    [ProdBOMController::class, 'checkInUsed']);

    Route::get('/lookupBOM',              [ProdBOMController::class, 'lookupBOM']);
    Route::get('/loadBOM',                [ProdBOMController::class, 'loadBOM']);



    Route::prefix('store-portal')->group(function () {
    Route::get('/store-context', [StorePortalOrderController::class, 'storeContext']);
    Route::get('/items', [StorePortalOrderController::class, 'items']);
    Route::get('/weekly-forecast', [StorePortalOrderController::class, 'loadWeeklyForecast']);
    Route::get('/weekly-forecast-history', [StorePortalOrderController::class, 'loadWeeklyForecastHistory']);
    Route::post('/weekly-forecast', [StorePortalOrderController::class, 'saveWeeklyForecast']);
    Route::get('/confirmation', [StorePortalOrderController::class, 'loadConfirmation']);
    Route::post('/confirm-order', [StorePortalOrderController::class, 'confirmOrder']);
    Route::get('/query-summary', [StorePortalOrderController::class, 'querySummary']);
    Route::get('/query-detail', [StorePortalOrderController::class, 'queryDetail']);
});

Route::prefix('commissary')->group(function () {
    Route::get('/categories', [CommissaryController::class, 'getCategories']);
    Route::get('/summary', [CommissaryController::class, 'getSummary']);
    Route::get('/detailed', [CommissaryController::class, 'getDetailed']);
});




});

Route::group(['middleware' => ['tenant', 'posting.credential']], function () {
    Route::post('/finalizeAR',   [ARController::class,   'finalize']);
    Route::post('/finalizeCR',   [CRController::class,   'finalize']);
    Route::post('/finalizeARDM', [ARDMController::class, 'finalize']);
    Route::post('/finalizeARCM', [ARCMController::class, 'finalize']);
    Route::post('/finalizeSOA',  [SOAController::class,  'finalize']);
    Route::post('/finalizeSVI',  [SVIController::class,  'finalize']);
    Route::post('/finalizeJV',   [JournalVoucherController::class,  'finalize']);
    Route::post('/finalizePCV',  [PCVController::class, 'finalize']);
    Route::post('/finalizeCV',   [CVController::class, 'finalize']);
    Route::post('/finalizeAPDM', [APDMController::class, 'finalize']);
    Route::post('/finalizeAPCM', [APCMController::class, 'finalize']);
    Route::post('/finalizeMSRR', [MSRRController::class, 'finalize']);
    Route::post('/finalizeFGRR', [FGRRController::class, 'finalize']);
    Route::post('/finalizeRMRR', [RMRRController::class, 'finalize']);
    Route::post('/finalizeMSIS', [MSISController::class, 'finalize']);
    Route::post('/finalizeMSST', [MSSTController::class, 'finalize']);
    Route::post('/finalizeMSAJ', [MSAJController::class, 'finalize']);
    Route::post('/finalizeAPV', [APVoucherController::class, 'finalize']);
    Route::post('/finalizeARDS', [ARDSController::class, 'finalize']);
    Route::post('/cancelARDS', [ARDSController::class, 'cancel']);
    Route::post('/finalizeDR', [DRController::class, 'finalize']);
    Route::post('/finalizeSI', [SIController::class, 'finalize']);
    Route::post('/finalizeFGAJ', [FGAJController::class, 'finalize']);
    Route::post('/finalizeFARR', [FARRController::class, 'finalize']);
    Route::post('/finalizeFATR', [FATRController::class, 'finalize']);
    Route::post('/finalizeFARC', [FARCController::class, 'finalize']);
    Route::post('/finalizeFAAD', [FAADController::class, 'finalize']);
    Route::post('/finalizeFASP', [FASPController::class, 'finalize']);
    Route::post('/finalizeFAMG', [FAMGController::class, 'finalize']);
    Route::post('/finalizeFADP', [FADPController::class, 'finalize']);
    Route::post('/finalizeFADS', [FADSController::class, 'finalize']);
    Route::post('/finalizeFARS', [FARSController::class, 'finalize']);
    Route::post('/finalizeLC', [LCController::class, 'finalize']);
    Route::post('/finalizeFGIS', [FGISController::class, 'finalize']);
    Route::post('/finalizeRMIS', [RMISController::class, 'finalize']);
    Route::post('/finalizeRMST', [RMSTController::class, 'finalize']);
    Route::post('/finalizeCSI', [CSIController::class, 'finalize']);
    Route::post('/finalizeBUDBB', [BUDBBController::class, 'finalize']);
    Route::post('/finalizeBUDRA', [BUDRAController::class, 'finalize']);	
    Route::post('/finalizeBUDAU', [BUDAUController::class, 'finalize']);
    Route::post('/finalizeBUDCL', [BUDCLController::class, 'finalize']);


    Route::post('/cancelARDM', [ARDMController::class, 'cancel']);
    Route::post('/cancelSOA', [SOAController::class, 'cancel']);
    Route::post('/cancelSVI', [SVIController::class, 'cancel']);
    Route::post('/cancelPCV', [PCVController::class, 'cancel']);
    Route::post('/cancelCV',  [CVController::class, 'cancel']);
    Route::post('/cancelAPV', [APVoucherController::class, 'cancel']);
    Route::post('/cancelJV',  [JournalVoucherController::class, 'cancel']);
    Route::post('/cancelARCM', [ARCMController::class, 'cancel']);
    Route::post('/cancelCR',  [CRController::class, 'cancel']);
    Route::post('/cancelAR',  [ARController::class, 'cancel']);
    Route::post('/cancelAPDM', [APDMController::class, 'cancel']);
    Route::post('/cancelAPCM', [APCMController::class, 'cancel']);
    Route::post('/cancelMSRR', [MSRRController::class, 'cancel']);
    Route::post('/cancelMSIS', [MSISController::class, 'cancel']);
    Route::post('/cancelFGRR', [FGRRController::class, 'cancel']);
    Route::post('/cancelRMRR', [RMRRController::class, 'cancel']);
    Route::post('/cancelMSRTV', [MSRTVController::class, 'cancel']);
    Route::post('/cancelMSAJ', [MSAJController::class, 'cancel']);
    Route::post('/cancelFGRTV', [FGRTVController::class, 'cancel']);
    Route::post('/cancelFGAJ', [FGAJController::class, 'cancel']);
    Route::post('/cancelMSST', [MSSTController::class, 'cancel']);
    Route::post('/cancelPR',  [PRController::class, 'cancel']);
    Route::post('/cancelPO',  [POController::class, 'cancel']);
    Route::post('/cancelJO',  [JOController::class, 'cancel']);
    Route::post('/cancelSO',  [SOController::class, 'cancel']);
    Route::post('/cancelDR',  [DRController::class, 'cancel']);
    Route::post('/cancelSI', [SIController::class, 'cancel']);
    Route::post('/cancelFGAJ', [FGAJController::class, 'cancel']);
    Route::post('/cancelFARR', [FARRController::class, 'cancel']);
    Route::post('/cancelFATR', [FATRController::class, 'cancel']);
    Route::post('/cancelFARC', [FARCController::class, 'cancel']);
    Route::post('/cancelFAAD', [FAADController::class, 'cancel']);
    Route::post('/cancelFASP', [FASPController::class, 'cancel']);
    Route::post('/cancelFAMG', [FAMGController::class, 'cancel']);
    Route::post('/cancelFADP', [FADPController::class, 'cancel']);
    Route::post('/cancelFADS', [FADSController::class, 'cancel']);
    Route::post('/cancelFARS', [FARSController::class, 'cancel']);
    Route::post('/cancelLC', [LCController::class, 'cancel']);
    Route::post('/cancelCSI', [CSIController::class, 'cancel']);
    Route::post('/cancelBUDBB', [BUDBBController::class, 'cancel']);
    Route::post('/cancelCAN', [CanController::class, 'cancel']);
    Route::post('/cancelBUDRA', [BUDRAController::class, 'cancel']);
    Route::post('/cancelBUDAU', [BUDAUController::class, 'cancel']);
    Route::post('/cancelBUDCL', [BUDCLController::class, 'cancel']);


    Route::post('/generateJVARCWLCL', [ARBalanceController::class, 'generateJVARCWLCL']);
    Route::post('/processGLMonthEnd', [GLBalanceController::class, 'processGLMonthEnd']);

    Route::post('/bankRecon/post', [BankReconController::class, 'post']);
    Route::post('/bankRecon/unpost', [BankReconController::class, 'unpost']);
});
