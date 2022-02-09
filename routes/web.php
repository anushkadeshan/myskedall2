<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

//dd(Auth::routes());
// Authentication Routes...
Route::get('login', 'LoginController@Index')->name('login')->middleware('guest');
Route::get('auth-group', 'LoginController@authGroup')->name('authGroup');
Route::post('auth-group', 'LoginController@authGroupLogin')->name('authGroupLogin');
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', 'HomeController@Index');
// Registration Routes...
//Route::get('registers', 'Auth\RegisterController@showRegistrationForm');
Route::post('registers', 'Auth\RegisterController@register')->name('register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('lang/{locale}', 'LocalizationController@index')->name('locale');
Route::group(['middleware' => ['auth']], function () {
Route::get('store', 'LocalizationController@store');
Route::get('registraion', function ($name = 'This Page should be design in next milestones') {
	return $name;
});
Route::post('alert/delete/{id}', 'AlertController@destroy');
Route::post('approvals/delete/{id}', 'ApprovalController@destroy');
Route::group(['middleware'=>'auth'],function(){

    Route::get('/clear-cache', function() {
		$exitCode = Artisan::call('cache:clear');
		// return what you want
	});
	Route::get('/home','HomeController@Home')->name('home');

	Route::get('/delete-profile-photo', 'ApiController@DeleteProfilePhoto');
	Route::get('/change-active-group/{group_id}','HomeController@ChangeActiveGroup');
	Route::get('/app-permission/{key}/{value}','HomeController@AppPermission');
	Route::group(['prefix'=>'admin'],function(){
		Route::get('/space-requests','HomeController@AdminSpaceRequest');
		Route::get('/organization-management','HomeController@AdminOrganizationManagement');
		Route::get('edit-organization/{id?}','HomeController@AdminEditOrganization');
		Route::post('edit-organization/{id?}','HomeController@AdminEditOrganizationPost');
		Route::get('/delete-organization/{id}','HomeController@AdminDeleteOrganization');
		Route::get('/edit-space-request/{id}','HomeController@AdminEditSpaceRequest');
		Route::post('update-space-request/{id}','HomeController@AdminPostSpaceRequest')->name('space.update');
		Route::get('reason-management','HomeController@ReasonManagement');
		Route::get('/edit-reason/{id?}','HomeController@AdminEditReason');
		Route::post('/edit-reason/{id?}','HomeController@AdminPostEditReason');
		Route::get('/delete-reason/{id}','HomeController@AdminDeleteReason');
		Route::get('/location-management','HomeController@AdminLocationManagement')->name('location-managament');
		Route::get('/new-location','HomeController@AdminNewLocation');
		Route::get('/edit-location/{id?}', 'HomeController@AdminEditLocation');
		Route::get('/view-location/{id?}', 'HomeController@AdminViewLocation');
		Route::post('/mark-as-block', 'HomeController@LocationMarkAsBlock');
		Route::post('/mark-as-unblock', 'HomeController@LocationMarkAsUnBlock');
		Route::post('/add-location/', 'HomeController@AdminPostLocation');
		Route::post('edit-location/{id?}','HomeController@AdminPostEditLocation');
		Route::get('/delete-location/{id}','HomeController@AdminDeleteLocation');
		Route::get('/external-location','HomeController@AdminExternalLocation');
		Route::get('/edit-external-location/{id?}','HomeController@AdminEditExternalLocation');
		Route::post('/edit-external-location/{id?}','HomeController@AdminPostEditExternalLocation');
		Route::get('/delete-external-location/{id}','HomeController@AdminDeleteExternalLocation');
		Route::get('/alerts','HomeController@AdminAlerts');

        Route::get('/supports', 'HomeController@AdminSupports')->name('supports.index');
		Route::get('/edit-support/{id?}', 'HomeController@AdminEditSupport');
        Route::post('/edit-support/{id?}', 'HomeController@AdminPostEditSupport');
        Route::get('/delete-support/{id}', 'HomeController@AdminDeleteSupport');
        //group requests
       // Route::get('/group-requests', 'HomeController@requests');
        Route::get('/search-group-requests', 'ApiController@getGroupRequests')->name('group-requests');
        Route::get('/accept-group-request/{id}', 'ApiController@acceptGroupRequest')->name('accept-group-request');
        Route::get('/reject-group-request/{id}', 'ApiController@rejectGroupRequest')->name('reject-group-request');

		//organizations/groups
		Route::get('/organizations', 'HomeController@organizations')->middleware('SuperAdmin');
		Route::get('/edit-group/{id?}', 'HomeController@EditOrganization')->middleware('SuperAdmin');
        Route::post('/edit-group/{id?}', 'HomeController@AdminPostEditGroup')->middleware('SuperAdmin');
		Route::post('/delete-group/{id?}', 'HomeController@AdminPostDeleteGroup')->middleware('SuperAdmin');
		Route::get('/change-view/{view}', 'HomeController@ChangeView');

		Route::post('/new-location-sketchs', 'ApiController@NewLocationSketchs');
		Route::post('/new-location-blue-prints', 'ApiController@NewLocationBluePrints');
		Route::post('/new-location-rules', 'ApiController@NewLocationRules');
		Route::get('/users', 'HomeController@users');
		Route::get('/new-user', 'HomeController@NewUser');
		Route::post('/add-new-user', 'HomeController@CreateUser')->name('add.user');
		Route::get('/edit-user/{id}', 'HomeController@user_edit')->name('edit.user');
		Route::post('/update-user/', 'HomeController@user_update')->name('update.user');

		Route::get('/alertData', 'AlertController@alertData');
		Route::get('/approvalData', 'ApprovalController@approvals');
		Route::post('/change/action/', 'AlertController@changeAction');
		Route::post('/update-request-reject-reason/', 'ApprovalController@rejectReason');
		Route::get('reports', 'ReportController@index')->name('reports.index');
		Route::get('reports/locations', 'ReportController@locations');
		Route::post('reports/locations', 'ReportController@postLocations');
		Route::get('reports/items', 'ReportController@items');
		Route::post('reports/items', 'ReportController@postItems');
		Route::get('reports/functions', 'ReportController@functions');
		Route::post('reports/functions', 'ReportController@postFunctions');
		Route::get('reports/values', 'ReportController@values');
		Route::post('reports/values', 'ReportController@postValues');
		Route::get('reports/requests', 'ReportController@requests');
		Route::post('reports/requests', 'ReportController@postRequests');
		Route::get('reports/checklist', 'ReportController@checklist');
		Route::get('get/checklist-data', 'ReportController@checklistData');
		Route::post('get/checklist-data', 'ReportController@checklistData');
		Route::post('get/update-location-checklist', 'ReportController@updateLocationchecklistData');
		Route::post('reports/update-reason', 'ReportController@updateLocationchecklistReason');
		Route::post('get/update-material-checklist', 'ReportController@updateMaterialChecklistData');
		Route::post('reports/update-reason-material', 'ReportController@updateMaterialchecklistReason');

		Route::get('reports/audit', 'ReportController@audit');
		Route::get('get/audit-data', 'ReportController@auditData');
		Route::post('get/audit-data', 'ReportController@auditData');
		Route::post('get/audit-location-checklist', 'ReportController@updateLocationAuditData');
		Route::post('get/audit-material-checklist', 'ReportController@updateMaterialAuditData');

		Route::get('reports/back-log', 'ReportController@backLog');
		Route::post('reports/back-log', 'ReportController@backLogPost');

		Route::get('reports/back-log/item/{id}', 'ReportController@backLogItem');
		Route::get('space-reasons', 'ReasonController@index')->name('reasons.index');
		Route::get('space-reasons-create', 'ReasonController@create')->name('reasons.create');
		Route::post('space-reasons-store', 'ReasonController@store')->name('reasons.store');
		Route::get('space-reasons-edit/{id}', 'ReasonController@edit')->name('reasons.edit');
		Route::post('space-reasons-update/{id}', 'ReasonController@update')->name('reasons.update');
		Route::post('space-reasons', 'ReasonController@dataTable');
		Route::get('location-types', 'LocationTypeController@index')->name('types.index');
		Route::post('location-types', 'LocationTypeController@dataTable');
		Route::get('location-types-create', 'LocationTypeController@create')->name('types.create');
		Route::post('location-types-store', 'LocationTypeController@store')->name('types.store');
		Route::get('location-types-edit/{id}', 'LocationTypeController@edit')->name('types.edit');
		Route::post('location-types-update/{id}', 'LocationTypeController@update')->name('types.update');

	});
	Route::group(['prefix'=>'api'],function(){
		Route::get('/send-group-request/{groupId}','ApiController@SendGroupRequest');
		Route::get('/user-data/{id}', 'ApiController@AlertsUserData');
		Route::post('/show-space-requests','ApiController@ShowSpaceRequest');
		Route::post('/change-profile-photo','ApiController@ChangeProfilePhoto');
		Route::post('/change-password','ApiController@ChangePassword');
		Route::post('/to-share-email','ApiController@ToShareEmail');
		Route::post('/help-contact-report','ApiController@HelpContactReport');
		Route::post('get-request-location','ApiController@GetRequestLocation');
		Route::post('get-price-by-location','ApiController@GetPriceByLocation');
		Route::get('get-location','ApiController@GetLocation');
        Route::post('SaveRequestPriority','ApiController@SaveRequestPriority');
        Route::post('SaveRequestAsDraft', 'ApiController@SaveRequestAsDraft');

		Route::group(['prefix'=>'admin'],function(){
			Route::post('space-requests','ApiController@AdminSpaceRequest');
			Route::post('organization-list','ApiController@AdminOrganizationList');
			Route::post('is-approve-space-request','ApiController@IsApproveAdminRequest');
			Route::post('change-organization-status','ApiController@ChangeOrganizationStatus');
			Route::post('reason-management','ApiController@ReasonManagement');
			Route::post('change-reason-status','ApiController@ChangeReasonStatus');
			Route::post('location-management','ApiController@LocationManagement');
			Route::post('external-location','ApiController@ExternalLocation');
			Route::post('share-space-request','ApiController@ShareSpaceRequest');
			Route::post('alert-management', 'ApiController@GetSpaceAlerts');
            Route::post('supports', 'ApiController@Supports');
            Route::post('group-list', 'ApiController@groups');
			Route::post('mark-alert-success', 'ApiController@markAlertAsSuccess');
			Route::get('filter-space-requests/{address}', 'HomeController@SpaceRequestsInLocation');
			Route::get('delete-location-sketch-file', 'ApiController@DeleteLocationSketchFile');
			Route::get('delete-location-photo', 'ApiController@DeleteLocationPhoto');
			Route::get('delete-location-blue-print-file', 'ApiController@DeleteLocationBluePrintFile');
			Route::get('delete-location-rule', 'ApiController@DeleteLocationRule');
			Route::post('change-user-level', 'ApiController@ChangeUserLevel');
			Route::post('change-user-admin', 'ApiController@ChangeUserAdmin');
			Route::post('change-location-status', 'ApiController@ChangeLocationStatus');
			Route::post('change-user-group', 'ApiController@ChangeUserGroup');

		});
	});
	Route::get('app/space/{id}','SpaceController@Home')->middleware(['Space','CheckAppPermission']);
	Route::group(['prefix'=>'space','middleware'=>'Space'],function(){

		Route::get('/search-space-requests', 'SpaceController@searchSpaceRequests');
		Route::get('/new-request','SpaceController@NewRequest');
		Route::post('/new-request','SpaceController@NewRequestMethod');
		Route::get('/edit-request/{request_id}','SpaceController@ReuseRequest')->where('request_id','[0-9]+')->name('space.edit');
		Route::post('/edit-request/{request_id}','SpaceController@ReuseRequestPost')->where('request_id','[0-9]+');
		Route::get('/approved-request','SpaceController@ApprovedRequest');
		Route::get('/rejected-request','SpaceController@RejectedRequest');
		Route::get('/repproved-request','SpaceController@RepprovedRequest');
		Route::get('/search-request','SpaceController@SearchRequest');
		Route::get('/view-request/{request_id}', 'SpaceController@ViewRequest')->where('request_id', '[0-9]+');
	});
});
	Route::group(['middleware' => ['role:Super Admin']], function () {
		Route::resource('roles', 'RoleController');
		Route::post('change/role', 'RoleController@changeRole');
		Route::post('give-permission-to-role', 'PermissionController@givePermissionToRole');
		Route::resource('permissions', 'PermissionController');
		Route::post('assign-apps-to-group', 'AppController@assignAppstoGroup');
		Route::resource('groups', 'GroupController');
		Route::get('/apps', 'HomeController@Apps');
	});
	Route::group(['middleware' => ['permission:Create User|Edit User|View User|Delete User']], function () {
		Route::resource('users', 'UserController');
		Route::get('profile', 'UserController@profile')->name('profile');
	});
	Route::group(['middleware' => ['permission:Assign Apps to User']], function () {
		Route::post('assign-apps-to-user', 'AppController@assignAppstoUser');
		
	});

	Route::get('/group-requests', 'GroupController@groupRequests')->name('groups.requests')->middleware('permission:Accept Group Requests');

	Route::get('app/mensagens/{id}', 'MessageController@index')->middleware('CheckAppPermission');
	Route::get('user-search-chat', 'MessageController@searchUser')->name('user-search-chat');
	Route::get('get-chat-heads', 'MessageController@GetUsersChat')->name('get-chat-heads');
	Route::get('add-user-to-chat', 'MessageController@AddUserToChat')->name('add.user.to.chat');
	Route::get('add-message-to-chat', 'MessageController@AddMessageToChat')->name('add-message-to-chat');
	Route::post('assign-managers-to-group', 'GroupController@assignManagerstoGroup');

	Route::resource('alerts', 'AlertController');
	Route::resource('materials', 'MaterialController');

	Route::resource('functions', 'FunctionController');

	Route::resource('approvals', 'ApprovalController');
    Route::get('app/approvals/{id}','AppApprovalsController@index')->middleware(['CheckAppPermission']);
    Route::group(['prefix'=>'apps/approvals'],function(){
        Route::get('home', 'AppApprovalsController@index')->name('approvals.home');
        Route::get('requests/{status}', 'AppApprovalsController@requests')->name('approvals.requests');
        Route::get('create-request', 'AppApprovalsController@create')->name('approvals.create');
        Route::get('edit-request/{id}', 'AppApprovalsController@edit')->name('approvals.edit');
        Route::get('view-request/{id}', 'AppApprovalsController@show')->name('approvals.view');
        Route::get('types', 'AppApprovalsController@types')->name('approvals.types');
        Route::get('sub-types', 'AppApprovalsController@subtypes')->name('approvals.subtypes');
        Route::get('create-levels', 'LevelController@create')->name('create.levels');
        Route::get('levels', 'LevelController@index')->name('approvals.levels');
        Route::get('supports', 'AppApprovalsController@support')->name('create.support');
        Route::get('calendar','FullCalenderController@index')->name('approvals.calender');
    });

    Route::post('fullcalendar/delete','FullCalenderController@destroy');
});




