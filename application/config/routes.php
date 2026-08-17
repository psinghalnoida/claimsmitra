<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

/* ------------------------------------------------------------------------- *
 * WEB CONTROLLER
* ------------------------------------------------------------------------- */
$route['default_controller'] = 'web';
$route['user_profile'] = 'web/user_profile';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/* ------------------------------------------------------------------------- *
 * COMPANY CONTROLLER
* ------------------------------------------------------------------------- */
$route['companynames'] = 'company/getCompanyNameByUserID';
$route['departmentnames'] =  'company/getDepartmentNameByCorporateId';
$route['validatePanCard'] = 'company/validatepancard';
$route['createcompany'] = 'company/createCompany';
$route['createcompanybyuser'] = 'company/createcompanybyUser';
$route['companybyid'] = 'company/getcompanybyId';
$route['branches'] = 'company/getbranches';
$route['addbranch'] = 'company/addnewbranch';


/* ------------------------------------------------------------------------- *
 * ASSIGNMENT CONTROLLER
* ------------------------------------------------------------------------- */
$route['dispatch'] ='assignment/dispatchFile';
$route['preparelor'] ='assignment/preparelor';
$route['surveyorfee'] ='assignment/surveyorfee';
$route['prepareemail'] ='assignment/prepareemail';
$route['viewlor'] ='assignment/viewlor';
$route['viewcasedetail'] ='assignment/viewlivelocationcasedetail';
$route['createtemplatedetail'] ='assignment/createlivelocationcasedetail';
$route['createtemplate'] = 'assignment/createtemplate';
$route['viewoutgoincasedetail'] ='assignment/viewoutgoingcasedetail';
$route['incomingassignment'] = 'assignment/getIncomingAssignment';
$route['outgoingcasetable'] = 'assignment/getoutcaseAssignment';
$route['calculateamount'] = 'assignment/calculated_amount';
$route['documents_translation'] = 'assignment/documentsTranslation';
$route['ebdeath_indivi'] = 'assignment/ebdeathIndivi';
$route['motorspotsurvey_indivi'] = 'assignment/motorspotsurveyIndi';
$route['assetvaluation_indivi'] = 'assignment/assetvaluationIndivi';
$route['marinepredis_indivi'] = 'assignment/marinepredisIndivi';
$route['outgoingassignment'] = 'assignment/getOutgoingAssignment';
$route['compaletedassignment'] = 'assignment/getCompletedAssignment';
$route['checkreferenceexist'] = 'assignment/check_case_reference';
$route['checkoutgoingreferenceexist'] = 'assignment/outgoing_check_case_reference';
$route['userdepartment'] = 'assignment/getUsersByDepartment';
$route['jobdata'] = 'assignment/submitJobData';
$route['generateform'] = 'assignment/generateForm';
$route['generateoutgoingForm'] = 'assignment/generateoutgoingForm';


//REPORT DATA.............Kajal
$route['updatecattlecaseData'] ='assignment/updatecattlecaseData';
$route['updatemotorspotcaseData_outgoing'] ='assignment/updatemotorspotcaseData_outgoing';
$route['updatemotorspotcaseData'] ='assignment/updatemotorspotcaseData';
$route['updatemotortheftcasedata'] ='assignment/updateMotorTheftCaseData';
$route['templatecasedata'] ='assignment/templatecasedata';
$route['riskinspection'] ='assignment/riskinspection';
$route['sabpaisaresponse'] ='assignment/sabpaisaresponse';


//ESSENTIAL DATA ............KAJAL
$route['cattleessentialdata'] ='assignment/cattleessentialdata';
$route['riskeessentialdata'] ='assignment/riskeessentialdata';
$route['engipreinsessentialdata'] ='assignment/engipreinsessentialdata';
$route['lopfinalessential'] ='assignment/lopfinalessential';
$route['fireprinsessentialdata'] ='assignment/fireprinsessentialdata';
$route['firefinalessentialdata'] ='assignment/firefinalessentialdata';
$route['miscellaneousessentialdata'] ='assignment/miscellaneousessentialdata';
$route['paclaimessential'] ='assignment/paclaimessential';
$route['motorspotessential'] ='assignment/motorspotessentialdata';

$route['motorfinalspotessential'] ='assignment/motorfinalessentialdata';
$route['motorpreinsessential'] ='assignment/motorpreinsessential';
$route['motortheftsessentialtemplate'] ='assignment/motortheftsessentialtemplate';
$route['motortpessential'] ='assignment/motortpessential';
$route['marinespotspotessential'] ='assignment/marinespotessentialdata';
$route['marinefinalspotessential'] ='assignment/marinefinalessentialdata';
$route['marinecargospotessential'] ='assignment/marinecargoessentialdata';
$route['marinepredispatchessential'] ='assignment/marinepredispatchessentialdata';
$route['marinepredispatchessential_outgoing'] ='assignment/marinepredispatchessential_outgoing';
$route['ebdeathessential'] ='assignment/ebdeathessential';
$route['updateebdeathcasedata'] ='assignment/updateebdeathcasedata';
$route['updatepredispatchcasedata'] ='assignment/updatepredispatchcasedata';
$route['assetsessential'] ='assignment/assetsessential';
$route['assetsessential_outgoing'] ='assignment/assetsessential_outgoing';
$route['assetsindivessential'] ='assignment/assetsindivessential';
$route['mediclaimessential'] ='assignment/mediclaimessential';
$route['createoutgoingassignment'] = 'assignment/createOutgoingAssignment';
$route['doc_trans_assignment'] = 'assignment/documentsTranslation';
$route['assessment'] ='assignment/assessmentdata';
$route['getassessmentdata'] ='assignment/get_assessment_data';
$route['finalizeAssessment'] ='assignment/finalizeAssessment';
$route['submitfinalassessment'] ='assignment/submitfinalassessment';
$route['loadassessmantform'] ='assignment/loadassessmantform';

//INDIVIDUAL DATA ............KAJAL

$route['motorspotessential_outgoing'] ='assignment/motorspotessential_outgoing';
$route['marinepredispatchessential_outgoing'] ='assignment/marinepredispatchessential_outgoing';
$route['updateebdeathcasedata_outgoing'] ='assignment/updateebdeathcasedata_outgoing';
$route['assetsessential_outgoing'] ='assignment/assetsessential_outgoing';
$route['ebdeathessential_outgoing'] = 'assignment/ebdeathessential_outgoing';


/* ------------------------------------------------------------------------- *
 * DASHBOARD CONTROLLER
* ------------------------------------------------------------------------- */
$route['live_location_based'] = 'dashboard/live_location_job';
$route['job/tanslation_live_insert'] = 'dashboard/create_live_newcase';
$route['view_live_case_details/(:any)'] = 'dashboard/view_case_details/$1';
$route['edit_live_case_details/(:any)'] = 'dashboard/edit_case_details/$1';
$route['update_live_case/(:any)'] = 'dashboard/edit_live_case_report/$1';
$route['delete_case/(:any)'] = 'dashboard/delete_case/$1';
$route['comment/(:any)'] = 'dashboard/comment_case/$1';
$route['add_coooemnt/(:any)'] = 'dashboard/add_comment/$1';
// $route['dashboard'] = 'dashboard';
$route['assign_inspector_list/(:any)'] = 'dashboard/assign_inspector_list/$1';
$route['asign_to_inspector/(:any)'] = 'dashboard/asign_to_inspector/$1';
//$route['job/viewcase/(:any)'] = 'dashboard/viewIncomingCase/$1';
// $route['job/getnonlocationjob'] = 'dashboard/getNonLocationJob';
//$route['job/findtranslator'] = 'dashboard/get_translator';
//Add on change by sharma
$route['non_location_based'] = 'dashboard/location_based_job';
$route['completed_case'] = 'dashboard/completed_case';
$route['deleted_case'] = 'dashboard/deleted_case';


/* ------------------------------------------------------------------------- *
 * API CONTROLLER
* ------------------------------------------------------------------------- */
$route['Api'] = 'Api';
$route['Api/(:any)'] = 'Api/$1';




/* ------------------------------------------------------------------------- *
 * CASES CONTROLLER
* ------------------------------------------------------------------------- */
$route['locationcase'] = 'cases/createlocationcase';
$route['quicksurveycase'] = 'assignment/quicksurveycase';
$route['locationincoming'] = 'cases/getlocationincoming';
$route['locationoutgoing'] = 'cases/getlocationoutgoing';
$route['locationoutgoingjobs'] = 'cases/getlocationoutgoingjobs';
$route['locationoutgoingimages/(:any)'] = 'cases/viewlocationimages/$1';
$route['locationoutgoingvideos/(:any)'] = 'cases/viewlocationvideos/$1';
$route['locationoutgoingdocuments/(:any)'] = 'cases/viewlocationdocuments/$1';
$route['quicksurveylist'] = 'assignment/getQuicksurvey';
$route['movemediafiles'] = 'cases/movemediafiles';
$route['quicksurveyimages/(:any)'] = 'cases/viewquicksurveyimages/$1';
$route['quicksurveyvideos/(:any)'] = 'cases/viewquicksurveyvideos/$1';
$route['quicksurveydocs/(:any)'] = 'cases/viewquicksurveydocs/$1';
$route['cases/delete_documents'] = 'cases/delete_documents';
$route['cases/delete_image'] = 'cases/delete_image';
$route['cases/delete_videos'] = 'cases/delete_videos';
// Translation Job 
$route['nonlocationincoming'] = 'cases/getnonlocationincoming';
$route['nonlocationincomingjobs'] = 'cases/getnonlocationincomingjobs';
$route['viewnonlocationincomingjobs/(:any)'] = 'cases/viewnonlocationIncomingJobs/$1';
$route['viewnonlocationoutgoingjobs/(:any)'] = 'cases/viewnonlocationOutgoingJobs/$1';
$route['nonlocationoutgoing'] = 'cases/getnonlocationoutgoing';
$route['nonlocationoutgoingjobs'] = 'cases/getnonlocationoutgoingjobs';
$route['nonlocationcase'] = 'assignment/createnonlocationcase';
$route['nonlocationothercase'] = 'cases/createothercase';
$route['checkout'] = 'assignment/checkout';
$route['agreeforterms'] = 'cases/paychekout';
$route['acceptincomingcase'] = 'cases/acceptincomingjob';
$route['approved'] = 'cases/caseapproved';
$route['pricing'] = 'pricing/getPricingList';
$route['nonlocationcompleted'] = 'cases/getnonlocationcompleted';
$route['locationcompleted'] = 'cases/getlocationcompleted';
$route['nonlocationpending'] = 'cases/getnonlocationpending';
$route['nonlocationpendingcase'] = 'cases/getnonlocationpendingcase';
//$route['assigntask'] = 'cases/assignTask';
$route['vendordetail'] = 'cases/getvendorlist';
$route['pincodeincoming'] = 'cases/getpincodeincoming';
$route['pincodeoutgoing'] = 'cases/getpincodeoutgoing';
$route['pincodecompleted'] = 'cases/getpincodecompleted';
$route['pincodecase'] = 'cases/createpincodecase';
$route['pincodeoutgoingjobs'] = 'cases/getpincodeoutgoingjobs';
$route['sharelivelocation/(:any)/(:any)'] = 'cases/sharelocation/$1/$2';
$route['cases/submitForm'] = 'Cases/submitForm';
$route['thankyou'] ='cases/thank_you';
$route['createnewcase'] = 'cases/showcreatecase';

$route['encryptdataid'] = 'home/encrypturlvalueid';
$route['generateqrdata/(:any)'] = 'cases/getQrData/$1'; 
$route['generatecattleila'] = 'cases/generate_ila';
$route['generatechecklist/(:any)/(:any)'] = 'cases/generate_checklist/$1/$2';
$route['generatepdf/(:any)/(:any)'] = 'cases/generate_pdf/$1/$2';

$route['generatereportpdf/(:any)'] = 'cases/generatereport_pdf/$1';
$route['updatecasedata'] = 'cases/updateCaseData';
$route['getalljobs'] ='cases/getallcases';
$route['downloadmedia/(:any)'] = 'cases/download_zip/$1';
$route['viewmedia/(:any)'] = 'cases/getQrData/$1';
// $route['viewcasedetail/(:any)'] ='cases/viewlivelocationcasedetail/$1';
$route['caseila'] ='cases/prepareila';
$route['preview'] ='cases/preview';
$route['cases/fetchquestions'] = 'Cases/fetchQuestions';
$route['cases/sendmail'] = 'cases/sendmail';
$route['getalljobs'] ='cases/getallcases';
$route['casesurveyfee'] ='cases/livelocationsurveyfee';
// $route['sendlor']='cases/sendlor';
// $route['saveDispatchData'] = 'cases/saveDispatchData'; // route for dispatching data to db
$route['cases/getRecordsByAid/(:any)'] = 'cases/getRecordsByAid/$1';
$route['saveSurveyFeeData'] = 'cases/livelocationsurveyfee';   // route for surveyfee to db
$route['cases/getSurveyFeeRecordByAid/(:any)'] = 'cases/getSurveyFeeRecordByAid/$1';
$route['deleteSurveyFee'] = 'cases/deleteSurveyFee';
$route['generatebill'] = 'cases/generate_bill'; // for generate bill(TI) in pdf form
$route['generatereceivable'] = 'cases/generate_RI'; // for generate bill(RI) in pdf form
$route['generatemail']='cases/generate_new_pdf';
$route['getassignment'] = 'cases/getTypeofCase';

/* ------------------------------------------------------------------------- *
 * HOME CONTROLLER
* ------------------------------------------------------------------------- */
$route['user_login'] = 'home/userLogin';
$route['saveDepartments'] = 'home/saveDepartments';
$route['user_registration'] = 'home/userRegistration';
$route['profilemanagement'] = 'home/profileManagement';
$route['user_profile_update'] = 'home/userProfileUpdate';
$route['companydetail'] = 'home/getCompanydetail';
$route['encryptdata'] = 'home/encrypturlvalue';
$route['user_logout'] = 'home/userLogout';
$route['dashboardlock'] = 'home/screenLock';
$route['emailvarification'] = 'home/emailVarification';
$route['mobilevarification'] = 'home/mobileVarification';
$route['mobile_exist'] = 'home/mobileexist';
$route['otpverification'] = 'home/otpverification';
$route['searchpincode'] = 'home/searchpincode';
$route['fetchsla'] = 'home/get_sla_data';
$route['save_new_bank'] = 'home/insert_new_bank';
$route['save_new_document'] = 'home/insert_new_document';
$route['getkycdetailbyid'] = 'home/getkycbyid';
$route['deletebankaccount'] = 'home/deleteBankAccount';
$route['deletekycdocument'] = 'home/deleteKycAccount';
$route['update_bank'] = 'home/updateBank';
$route['update_document'] = 'home/updateKycDocument';
$route['save_new_agent'] = 'home/insert_new_agent';
$route['save_new_salvage_buyer'] = 'home/insert_new_salvage_buyer';
$route['save_new_investigator'] = 'home/insert_new_investigator';
$route['deleteprofession'] = 'home/deleteProfession';
//$route['getInsurance_company'] = 'home/getinsurancecompany';
$route['getbanklist'] = 'home/getbanklist';
$route['getbankdetailbyid'] = 'home/getbankbyid';
$route['getagentbyId'] = 'home/getagentbyid';
$route['getdocumentbyid'] = 'home/getdocumentByid';
$route['companybyprofessionid'] = 'home/getcompanybyprofessionId';
$route['geteditsalvage'] = 'home/geteditsalvage';
$route['deletetrader'] = 'home/deletetrader';
$route['deleteagent'] = 'home/deleteagent';
$route['investigatorlist'] = 'home/investigatorList';
$route['salvagebuyercategorylist'] = 'home/salvagebuyercategoryList';
$route['salvagesubcategory'] = 'home/salvagesubcategoryList';
$route['state'] = 'home/stateList';
$route['city'] = 'home/cityList';
$route['profession'] = 'home/get_profession';
$route['companies'] = 'home/get_company';
$route['getkyclist'] = 'home/getkycList';
$route['getdocumentsbyid'] = 'home/getdocumentsbyid';
$route['save_gst'] = 'home/add_gst';
$route['save_pan'] = 'home/add_pan';
$route['save_aadhar_card'] = 'home/add_aadhar_Card';
$route['userforgotpassword'] = 'home/userForgotpassword';
$route['uploadProfilePhoto'] = 'home/uploadProfilePicture';
$route['resetPasscode'] = 'home/resetPasscode';

/* ------------------------------------------------------------------------- *
 * POLICY CONTROLLER
* ------------------------------------------------------------------------- */
$route['policylist'] = 'policy/getpolicylist';
$route['getpolicydata'] = 'policy/getpolicybyid';


/* ------------------------------------------------------------------------- *
 * BILLING CONTROLLER
* ------------------------------------------------------------------------- */
$route['billing'] ='billing';
$route['taxinvoicerequest'] = 'billing/getTaxinvoiceRequest';
$route['taxinvoice'] = 'billing/getTaxinvoice';
$route['savetinumber'] = 'billing/savetiNumber';
$route['receivable_invoice'] = 'billing/getBillingData';
$route['addpayment'] = 'billing/addPayment';

/* ------------------------------------------------------------------------- *
 * PAYMENT CONTROLLER
* ------------------------------------------------------------------------- */
$route['finalcheckout'] = 'payment';
$route['getallpaymentrecord'] = 'payment/incomingpayment';
$route['makepayment'] = 'payment/getbalanceamount';
$route['wallet']='payment/getWallet';
$route['addmoney']='payment/addMoney';



/* ------------------------------------------------------------------------- *
 * SETTING CONTROLLER
* ------------------------------------------------------------------------- */
$route['allinsurer'] ='setting/getInsurer'; // will be delete in future
$route['connectedvendor'] = 'setting/getConnectedVendor';
$route['deletevendor'] = 'setting/deletevendor';
$route['connectNewVendor'] = 'setting/connectNewVendor';
$route['vendorid'] = 'setting/checkRecordExists';
$route['checkvendorexists'] = 'setting/checkVendorExists';
$route['vendors'] = 'setting/getVendors';
$route['vendortype'] = 'setting/getVendortype';
$route['branch'] = 'setting/getBranch';
$route['users'] = 'setting/getUsers';
$route['allusers'] = 'setting/checkMobileExists';
$route['essentialform'] ='setting/submitEssentialForm';
$route['move-files'] = 'setting/move_files';
$route['adduser'] = 'setting/addUser';
$route['adddepartments'] = 'setting/fetchDepartments';
$route['addNewBranch'] = 'setting/addNewBranch';
$route['createnewfield'] ='setting/createnewfield';

/* ------------------------------------------------------------------------- *
 * MIS CONTROLLER
* ------------------------------------------------------------------------- */
$route['generatemis'] = 'mis/getMisFilter';


/* ------------------------------------------------------------------------- *
 * EMAIL CONTROLLER
* ------------------------------------------------------------------------- */
$route['emailsetting']='email/emailSetting';


/* ------------------------------------------------------------------------- *
 * USERS CONTROLLER
* ------------------------------------------------------------------------- */
$route['userlocation/(:any)'] = 'users/userLocation/$1';
//$route['userlist'] = 'users/userlisting';
$route['allowformobileapp'] = 'users/allowformobile';

/* ------------------------------------------------------------------------- *
 * SUPER ADMIN CONTROLLER
* ------------------------------------------------------------------------- */
$route['admin'] = 'admin';

/* ------------------------------------------------------------------------- *
 * OTHER 
* ------------------------------------------------------------------------- */
$route['job/tranlator/list'] = 'translation/translatorlist';
// // Quick Surevey
// $route['quicksurvey'] = 'cases/quicksurvey';
// $route['downloadmedia/(:any)'] = 'cases/download_zip/$1';
// $route['viewcasedetail'] ='cases/viewlivelocationcasedetail';
// $route['getCaseForm'] = 'cases/getCaseForm';
// $route['getcaseformdata'] = 'cases/getCaseFormData';
