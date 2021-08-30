<?php


use JasperPHP\JasperPHP as JasperPHP;
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




Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

//Route::post('uservalidate','UserLoginController@login');

Route::get('/home', 'HomeController@index')->name('home');


Route::get('locale', 'UserController@languageSetup');


Route::get('termsearch','HomeController@termSearch');


Route::get('termattachment','InspectionController@termAttachment');

Route::get('termbasket','HomeController@termBasket')->name('termbasket');

Route::get('testbasket','UserController@testBasket');

/*Route::get('dashboard', function () {
    return view('dashboard'); 
});*/
Route::get('dashboard','UserController@dashboard');

Route::get('user','UserController@user');


Route::get('getLastCode','UserController@getLastCode');

Route::get('getuserdetail','ReportController@getUserdetail');

Route::post('usertrn','UserController@usertrn');

Route::get('role','UserController@role');

Route::post('roletrn','UserController@roletrn');

Route::get('module','UserController@module');

Route::post('moduletrn','UserController@moduletrn');

Route::get('access','UserController@access');

Route::post('accesstrn','UserController@accesstrn');

Route::get('getaccessajax','UserController@getaccessajax');

Route::get('getaccess','UserController@getaccess');

Route::get('valuationdata','UserController@valuationdata');

Route::get('resetpassword','UserController@resetpassword');

Route::get('getValidUser','UserController@getValidUser');

Route::get('search','UserController@search');

Route::post('searchtrn','UserController@searchtrn');

Route::get('searchdetail','UserController@searchdetail');

Route::post('searchdetail','UserController@searchdetail');

Route::post('searchdetailtrn','UserController@searchdetailtrn');

Route::get('searchsample','UserController@sa');

Route::get('profile','UserController@profile');

Route::post('changePassword','UserController@changePassword')->name('changePassword');

Route::get('codemaintenance','UserController@codeMaintenance');

Route::post('codeMaintenancetrn','UserController@codeMaintenancetrn');

Route::get('codemaintenancedetail','UserController@codemaintenancedetail');

Route::post('codemaintenancedetail','UserController@codemaintenancedetail');
Route::post('codemaintenancedetailtrn','UserController@codemaintenancedetailtrn');



Route::get('getFilterData','UserController@getFilterData');


Route::get('accessdenied','HomeController@accessDenied');


Route::get('getcustomfilterdata','UserController@getCustomFilterData');

Route::post('applyfilter','UserController@applyfilter');


Route::get('getParameter','UserController@getParameter');

Route::get('getChildParameter','UserController@getChildParameter');

//property registeration.

Route::get('propertyregister','PropertyRegisterationController@propertyRegister');

Route::get('existspropertyregister','PropertyRegisterationController@existspropertyRegister');


Route::get('existspropertymaintanance', 'InspectionController@exsitsPropertyMaintanace');

Route::get('existspropertymaintanancedata', 'InspectionController@existPropertyMaintenanceTables')->name('existspropertymaintanance');

Route::get('propertytables', 'PropertyRegisterationController@propertyTables')->name('propertytables');

Route::get('tableview','PropertyRegisterationController@table');

Route::get('maintenancepropertydetail','PropertyRegisterationController@maintenancepropertydetail');

Route::get('childparam','PropertyRegisterationController@childparam');

Route::get('subCategory','PropertyRegisterationController@subCategory');

Route::post('registerproperty','PropertyRegisterationController@registerproperty');

Route::get('teste','PropertyRegisterationController@testExceptopm');

Route::get('propertybasket','PropertyRegisterationController@propertybasket');

Route::post('propertybaskettrn','PropertyRegisterationController@propertybaskettrn');

Route::get('bldgareadetail','PropertyRegisterationController@bldgareadetail');

Route::get('existspropertybasket','PropertyRegisterationController@existspropertybasket');

Route::post('exsitspropertybaskettrn','PropertyRegisterationController@exsitspropertybaskettrn');

Route::get('fmterm', function () {
    return view('filemanager.term');
});

Route::get('filemanager','FileManagerController@filemanager');

Route::post('filemanagertrn','FileManagerController@filemanagertrn');

//
Route::get('tenant','CodeMaintenanceController@tenantRegistration');

Route::get('tenanttable', 'CodeMaintenanceController@tenantTable');

Route::get('tenanttrn','CodeMaintenanceController@tenantRegistrationTransaction');

Route::get('ratepayer','CodeMaintenanceController@ratepayerRegistration');

Route::get('ratepayertrn','CodeMaintenanceController@ratepayerRegistrationTransaction');

Route::get('getValidRatepayer','CodeMaintenanceController@getValidRatepayer');

Route::get('validateAccount','PropertyRegisterationController@validateAccount');

Route::get('checkdigit','PropertyRegisterationController@checkDigit');

//inspection 
Route::get('term','HomeController@term');

Route::get('termtrn','HomeController@termTransaction');

Route::get('group','HomeController@group')->name('group');
Route::get('grouptrn','HomeController@groupTransaction');

//valterm
Route::get('valterm','HomeController@valterm');
Route::get('valbasket','HomeController@valbasket')->name('valbasket');

Route::get('property',  'InspectionController@property');

Route::get('insproperty', 'InspectionController@propertyTablesIns');

Route::get('inspectionproperty', 'InspectionController@propertyTables')->name('inspectionproperty');

Route::get('newproperty', 'InspectionController@newProperty');

Route::get('newpropertydata', 'InspectionController@newPropertyData');

Route::get('grabbasket', 'InspectionController@grabBasket');

Route::get('grabexists', 'InspectionController@grabExistsBasket');

Route::get('existsproperty', 'InspectionController@exsitsProperty');

Route::get('existspropertydata', 'InspectionController@existPropertyTables')->name('existsproperty');

Route::get('grappdata', 'InspectionController@grappdata');

Route::get('grapnewdata', 'InspectionController@grapnewdata');

Route::get('existspropertymaintenancetrn', 'InspectionController@existspropertymaintenancetrn');

Route::get('inspection', 'InspectionController@inspectionTab');

Route::get('inspectiondetail', 'InspectionController@inspectionDetailTab');

Route::get('tenantSearch', 'InspectionController@tenantSearch');

Route::get('ratepayersearch', 'InspectionController@ratepayerSearch');

Route::get('approve', 'PropertyRegisterationController@approve');

Route::get('datatransfer', 'UserController@dataTransfer');

Route::get('evidentmgmt', 'CodeMaintenanceController@evidentManagement');

Route::get('evidentmgmttrn', 'CodeMaintenanceController@evidentTransaction');

/**Tone of List**/

Route::get('tonebasket', 'CodeMaintenanceController@toneBasket');

Route::get('tonebaskettrn', 'CodeMaintenanceController@toneBasketTransaction');

Route::get('ratebasket', 'CodeMaintenanceController@taxBasket');

Route::get('ratebaskettrn', 'CodeMaintenanceController@rateBasketTransaction');

Route::get('tonebldg', 'CodeMaintenanceController@toneBLDG');

Route::get('tonebldgtrn', 'CodeMaintenanceController@toneBLDGTransaction');

Route::get('tonebldgtable', 'CodeMaintenanceController@tonebldgTable');

Route::get('toneland', 'CodeMaintenanceController@toneLand');

Route::get('tonelandtrn', 'CodeMaintenanceController@toneLandTransaction');

Route::get('tonelandtable', 'CodeMaintenanceController@tonelandTable');

Route::get('toneallowance', 'CodeMaintenanceController@toneAllowance');

Route::get('toneallowancetrn', 'CodeMaintenanceController@toneAllowanceTransaction');

Route::get('tonedepreciation', 'CodeMaintenanceController@toneDepreciation');

Route::get('tonedepreciationtrn', 'CodeMaintenanceController@toneDepreciationTransaction');

Route::get('tonelandstandart', 'CodeMaintenanceController@toneLandstandart');

Route::get('tonelandstandarttrn', 'CodeMaintenanceController@tonelandstandartTransaction');

Route::get('tonelandsdtable', 'CodeMaintenanceController@tonelandsdTable');

Route::get('taxrate', 'CodeMaintenanceController@taxRate');

Route::get('taxratetrn', 'CodeMaintenanceController@taxrateTransaction');

Route::get('tonetaxtable', 'CodeMaintenanceController@tonetaxTable');

Route::post('updateinspection','InspectionController@updateInspection');

Route::get('evidentDetail', 'CodeMaintenanceController@evidentDetail');

Route::get('valuationdetail', 'ValutionController@valuationDetail');

Route::get('landval', 'ValutionController@landDetail'); 

Route::get('bldgval', 'ValutionController@bldgDetail');

Route::post('validateValuation', 'ValutionController@validateProperty');

Route::post('massvaluation', 'ValutionController@massValuation');

Route::post('manualValuation', 'ValutionController@manualValuation');


Route::post('manualValuationv2', 'ValutionController@manualValuationV2');

Route::post('manualValuation2', 'ValutionController@manualValuation2');
Route::get('clearValuation', 'ValutionController@resetValuation');

Route::get('export', 'HomeController@generateReport');

Route::get('inspectionform', 'ReportController@inspectionForm');

Route::get('inspectionformtable', 'ReportController@propertyTables');

Route::get('valuationformtable', 'ReportController@valuationTables');

Route::get('generateinspectionreport','ReportController@generateInspectionForm');

Route::get('valuationform', 'ReportController@valuationForm');

Route::get('valuationdata', 'ReportController@group');

Route::get('valuationdatatable', 'ReportController@valuationDataTable');

Route::get('valuationdatatablebasket', 'ReportController@basketTables');

Route::get('generateValuationData','ReportController@generateValuationData');

Route::get('generateValuationForm','ReportController@generateValuationForm');

Route::get('/e', function () {

    $jasper = new JasperPHP;

	// Compile a JRXML to Jasper
    $jasper->compile(__DIR__ . '/../../vendor/cossou/jasperphp/examples/hello_world.jrxml')->execute();

	// Process a Jasper file to PDF and RTF (you can use directly the .jrxml)
    $jasper->process(
        __DIR__ . '/../../vendor/cossou/jasperphp/examples/hello_world.jasper',
        false,
        array("pdf", "rtf"),
        array("php_version" => "xxx")
    )->execute();

	// List the parameters from a Jasper file.
    $array = $jasper->list_parameters(
        __DIR__ . '/../../vendor/cossou/jasperphp/examples/hello_world.jasper'
    )->execute();

    return view('welcome');
});


// objection Route
Route::get('objection','ObjectionController@basket');

Route::get('objectionapprove','ObjectionController@objectionapprove');

Route::get('meeting','ObjectionController@agenda');

Route::get('meetingtrn','ObjectionController@agendaTransaction');

Route::get('agenda','ObjectionController@objectionAgenda');

Route::get('objectionbasket','ObjectionController@objectionBasket');

Route::get('objectionbaskettable','ObjectionController@objectionBasketTable');

Route::get('newnotice','ObjectionController@newNotice');

Route::get('notice','ObjectionController@notice');

Route::get('agendatrn','ObjectionController@agendatrn');

Route::get('agendadetailtrn','ObjectionController@agendadetailtrn');

Route::get('objectionreport','ObjectionController@objectionReport');

Route::get('objectionreporttable','ObjectionController@objectionReportTable');

Route::get('objectionreportsearch','ObjectionController@objectionReportSearch');

Route::get('objectionreportsearchtable','ObjectionController@objectionReportSearchTable');

Route::get('objectionreportrn','ObjectionController@objectionReporTrn');

Route::get('objectionreporttrn','ObjectionController@objectionReportTrn');

Route::get('decision','ObjectionController@decision');

Route::get('decisiontable','ObjectionController@decisionTable');

Route::get('decisioncal','ObjectionController@decisionCalculation');

Route::get('generateAgenda','ReportController@generateAgenda');

Route::get('generateNotis','ReportController@generateNotis');

Route::get('generateNotis2','ReportController@generateNotis2');

Route::get('result','ObjectionController@result');

Route::get('objectiondetail','ObjectionController@objectionDetail');

Route::get('objectiondetailtable','ObjectionController@objectionDetailTable');

Route::get('getnotice','ObjectionController@grabNotice');

Route::get('noticedetailtrn','ObjectionController@noticedetailtrn');

Route::get('noticeTables','ObjectionController@noticeTables');

Route::get('decisiontrn','ObjectionController@decisionTrn');

Route::get('generateobjection1','ReportController@generateObjection1');

Route::get('generateobjection2','ReportController@generateObjection2');

Route::get('generateResult','ReportController@generateResult');

Route::get('decisiongrab','ObjectionController@decisionGrab');
 
Route::get('decisiongrabtable','ObjectionController@decisionGrabTables');

Route::get('decisiongrabtrn','ObjectionController@decisiongrabtrn');

Route::get('decisionapprove','ObjectionController@decisionapprove');

Route::get('objectionproperty','ObjectionController@objectionproperty');

Route::get('propertyaddress','HomeController@propertyAddress');

Route::get('propertylot','HomeController@propertyLot');
    
Route::get('propertyaddressdata', 'HomeController@propertyTables');

Route::get('ownerdetail', 'HomeController@ownerDetail');

Route::post('propertylotdetail', 'HomeController@propertyLotDetail');

Route::get('lotdetail', 'HomeController@lotDetail');

Route::get('lotdetailtrn', 'HomeController@lotdetailtrn');

Route::get('propertyinfotrn', 'HomeController@propertyinfotrn');

Route::get('plan', 'HomeController@plan');

Route::get('plantrn', 'HomeController@plantrn');

// Ownership Transfer

Route::get('ownerregister','HomeController@ownerRegister');

Route::get('ownerregistertrn','HomeController@ownerRegisterTRN');

Route::get('ownertransfer','HomeController@ownerTransfer');

Route::get('ownertransferapproval','HomeController@ownerTransferApproval');

Route::get('ownertransferprocess','HomeController@ownerTransferProcess');

Route::get('ownertransfertrn','HomeController@ownerTransferTRN');

Route::get('ownertransferretrytrn','HomeController@ownerTransferretryTRN');

Route::get('ownertransferdetail','HomeController@transferLogTables');

Route::get('ownerlog','HomeController@ownerLog');

Route::get('addresslogtables','HomeController@addressLogTables');

Route::get('addresslog','HomeController@addressLog');


Route::get('propaddresslogtables','HomeController@propAddressLogTables');

Route::get('generateOwnershipreport','HomeController@generateOwnershipreport');

Route::get('generateRemisireport','HomeController@generateRemisireport');

Route::get('ownerlogdata','HomeController@ownerLogTables');

Route::get('owneradddresTables','HomeController@owneradddresTables');

Route::get('deactive','HomeController@deactivateBakset')->name('deactive');

Route::get('deactiveproperty','HomeController@deactive');

Route::get('deletepropertytables', 'HomeController@deletepropertyTables')->name('deactiveproperty');

Route::get('adddeactiveproperty', 'HomeController@deleteProperty');

//Route::get('datasearch', 'HomeController@datasearch');

Route::get('datasearch', 'HomeController@dataSearch');

Route::get('datasearchtables', 'HomeController@dataSearchTables')->name('datasearchtables');

Route::get('dmsSearchTables', 'FileManagerController@dmsSearchTables')->name('dmsSearchTables');

Route::get('datasearchdetail', 'HomeController@datasearchTab')->name('datasearchdetail');

Route::get('groupdeactivetrn', 'HomeController@groupDeactiveTransaction');

Route::get('zonebldgsummary', 'ReportController@zoneSummary');

Route::get('zonesummarytable', 'ReportController@zonesummaryTables');

Route::get('subzonesummary', 'ReportController@subzoneSummary');

Route::get('subzonesummarytable', 'ReportController@subzonesummaryTables');

Route::get('racesummary', 'ReportController@racSummary');

Route::get('racesummarytable', 'ReportController@racesummaryTables');

Route::get('generatesummaryzone', 'ReportController@generateSummaryZone');

Route::get('generatesummarybldg', 'ReportController@generateSummaryBLDG');

Route::get('generatesummaryrace', 'ReportController@generateSummaryRace');

Route::get('subzonecollection', 'ReportController@subzoneCollection');

Route::get('subzonecollectiontable', 'ReportController@subzoneCollectionTables');

Route::get('bldgcollection', 'ReportController@bldgCollection');

Route::get('bldgcollectiontable', 'ReportController@bldgCollectionTables');

Route::get('generatecollectionzone', 'ReportController@generateCollectionZone');

Route::get('generatecollectionbldg', 'ReportController@generateCollectionBLDG');

Route::get('exportexcel', 'ReportController@exportExcel');

Route::get('exportexceltable', 'ReportController@exportExcelTables');

Route::get('downloadexcel', 'ReportController@exportCsv');

Route::get('districtcollection', 'ReportController@districtCollection');

Route::get('districtcollectiontable', 'ReportController@districtCollectionTables');

Route::get('generatecollectiondistrict', 'ReportController@generateCollectionDIS');

Route::get('borangc', 'ReportController@borangC');

Route::post('generateborangc', 'ReportController@generateBorangc');

Route::get('borangb', 'ReportController@borangB');

Route::post('generateborangb', 'ReportController@generateBorangB');

Route::get('filelist', 'FileManagerController@getFilelist');

Route::get('statistical', 'ReportController@statistical');

Route::get('statisticaltable', 'ReportController@statisticalTables');

Route::get('generatenewowner', 'ReportController@generateNewOwner');

Route::get('accountsearch', 'HomeController@accountSearch');

Route::get('accountsearchdata', 'HomeController@accountSearchData');

Route::get('download','FileManagerController@download');

Route::get('filedelete','FileManagerController@fileDelete');

Route::post('upload','FileManagerController@upload');

Route::get('updateattachment', 'HomeController@updateAttachment');

Route::get('termattachment', 'HomeController@termAttachment');

Route::post('termupload','FileManagerController@termUpload');

Route::get('officialsearch', 'HomeController@officialSearch');

Route::get('officialsearchdata', 'HomeController@officialSearchData');

Route::get('addapplication', 'HomeController@addApplication');

Route::get('updateapplication', 'HomeController@updateApplication');

Route::get('addapplicationdata', 'HomeController@addApplicationData');

Route::get('searchpropertyaddress', 'HomeController@searchPropertyAddress');

Route::get('searchpropertyaddressdata', 'HomeController@searchPropertyAddressData');

Route::get('propertylotdata', 'HomeController@propertyLotData');

Route::get('manualvaluation', 'ValutionController@manualValuationProcess');

Route::get('manualland', 'ValutionController@manualLand');

Route::get('manualbldg', 'ValutionController@bldgDetailManaual');

Route::get('landstarndard', 'ValutionController@landStarndard');

Route::get('remisi', 'HomeController@remisi');  

Route::get('addremisi', 'HomeController@addRemisi'); 

Route::POST('manaualvaluationprocess', 'ValutionController@manaualValuationProcess'); 

Route::get('remisisearchdata', 'HomeController@remisiSearchData');

Route::get('remisidetail',  'HomeController@remisiDetail'); 

Route::get('remisiregister',  'HomeController@remisiRegister'); 

Route::get('remisitrn','HomeController@remisiTRN');

Route::get('investigation',  function () {
    return view('remisi.investigation'); 
});

Route::get('insresult',  function () {
    return view('remisi.investigationresult'); 
});



Route::get('generateinspectionform', 'ReportController@generateInspectionForm');


Route::get('generatevaluation', 'ReportController@generateValuationR5');


Route::get('r4cover', 'ReportController@r4cover');

Route::get('generater4cover', 'ReportController@generateR4Cover');


Route::get('r4coverdatatable', 'ReportController@r4coverDataTables');

Route::get('defunctreport', 'ReportController@defunctReport');

Route::get('ownernotice', 'ReportController@ownerNotice');

Route::get('ownernoticedata', 'ReportController@ownerNoticeDataTables');

Route::get('generateowntypa', 'ReportController@generateOwnerTypeA');

Route::get('generateowntypb', 'ReportController@generateOwnerTypeB');

Route::get('ownertransferlist', 'ReportController@ownerTransferList');

Route::get('ownertransferlistdata', 'ReportController@ownerTransferListData');

Route::get('generateownertransferlist', 'ReportController@generateOwnerTransferList');

Route::get('pivotreport', 'ReportController@pivotReport');

Route::get('generatePivotReport','ReportController@generatePivotReport');

Route::get('generateoffsReport','ReportController@officialSearchReport');

Route::get('generatedeactive','ReportController@generateDeactive');

//Route::get('exportcsv','HomeController@ExportDataEnqueryCSV');

Route::get('exportcsv','ReportController@ExportDataEnqueryCSV');