<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\tenant\HomeController;
use App\Http\Controllers\admin\ApprovalController;
use App\Http\Controllers\admin\UserListController;
use App\Http\Controllers\admin\AdminReportController;
use App\Http\Controllers\advertiser\ReportController;
use App\Http\Controllers\advertiser\ProfileController;
use App\Http\Controllers\advertiser\PropertyController;
use App\Http\Controllers\admin\ContentCheckersController;
use App\Http\Controllers\admin\Dashboard;
use App\Http\Controllers\tenant\ChatController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('loginRegister/login');
});

Route::get('login', [AuthController::class,'index'])->name('login');

// =====================================================================================================================

// for Tenant Login Form & Login Action
Route::get('loginTenant', [AuthController::class,'loginTenantForm'])->name('loginTenantForm');
Route::post('loginTenant', [AuthController::class,'loginTenantAction'])->name('loginTenantAction');

Route::middleware(['auth:tenant'])->group(function () {

    Route::get('tenant/home', [HomeController::class,'showHome'])->name('showHome');
    Route::get('tenant/property/{property_id}', [HomeController::class, 'showHomeProperty'])->name('showHomeProperty');

    Route::get('reminder', [ReminderController::class, 'showReminder'])->name('showReminder');
    Route::get('reminder/edit/{reminderId}', [ReminderController::class, 'showEditReminder'])->name('showEditReminder');
    Route::put('reminder/edit/{reminderId}', [ReminderController::class, 'editReminder'])->name('editReminder');
    Route::post('reminder/add/{propertyId}', [ReminderController::class, 'addReminder'])->name('reminder.addReminder');

    Route::get('chatList', [ChatController::class, 'tenantViewChatList'])->name('tenantViewChatList');
    Route::post('chatList/chat/add/{advertiserId}', [ChatController::class, 'addChatList'])->name('addChatList');
    Route::get('chatList/chat/{chatListId}', [ChatController::class, 'tenantViewChatHistory'])->name('tenantViewChatHistory');
    Route::post('chatList/chat/{chatListId}/send', [ChatController::class, 'tenantSendMessage'])->name('tenantSendMessage');
});
Route::post('logoutTenant', [AuthController::class, 'logoutTenant'])->name('logoutTenant');
// =====================================================================================================================


Route::get('loginAdvertiser', [AuthController::class,'loginAdvertiserForm'])->name('loginAdvertiserForm');
Route::post('loginAdvertiser', [AuthController::class,'loginAdvertiserAction'])->name('loginAdvertiserAction');

Route::middleware(['auth:advertiser'])->group(function () {

    Route::get('advertiser/advertiserTest', function () {
        return view('advertiser.advertiserTest');
    })->name('advertiser.advertiserTest');

    Route::resource('property', PropertyController::class);

    Route::get('advertiser/profile',[ProfileController::class,'viewProfileForm'])->name('viewProfileForm');
    Route::put('advertiser/profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

    Route::get('advertiser/summaryReport', [ReportController::class, 'viewSummaryReport'])->name('viewSummaryReport');
    Route::post('advertiser/summaryReport', [ReportController::class, 'generateSummaryReport'])->name('generateSummaryReport');

    Route::get('advertiser/vacancyReport', [ReportController::class, 'viewVacancyReport'])->name('viewVacancyReport');
    Route::post('advertiser/vacancyReport', [ReportController::class, 'generateVacancyReport'])->name('generateVacancyReport');

    Route::get('advertiser/categoryReport', [ReportController::class, 'viewCategoryReport'])->name('viewCategoryReport');
    Route::post('advertiser/categoryReport', [ReportController::class, 'generateCategoryReport'])->name('generateCategoryReport');

    Route::get('advertiser/chatList', [ChatController::class, 'advertiserViewChatList'])->name('advertiserViewChatList');
    Route::get('advertiser/chatList/chat/{chatListId}', [ChatController::class, 'advertiserViewChatHistory'])->name('advertiserViewChatHistory');
    Route::post('advertiser/chatList/chat/{chatListId}/send', [ChatController::class, 'advertiserSendMessage'])->name('advertiserSendMessage');
});

// For Advertiser logout!
Route::post('logoutAdvertiser', [AuthController::class, 'logoutAdvertiser'])->name('logoutAdvertiser');


// =====================================================================================================================

// for Administrator Login Form & Login Action
Route::get('loginAdministrator', [AuthController::class,'loginAdministratorForm'])->name('loginAdministratorForm');
Route::post('loginAdministrator', [AuthController::class,'loginAdministratorAction'])->name('loginAdministratorAction');

Route::middleware(['auth:administrator'])->group(function () {
    // Route to the advertiserTest blade file
    Route::get('administrator/administratorTest', function () {
        return view('administrator.AdministratorTest');
    })->name('administrator.administratorTest');

    // Add more routes specific to tenants
});
// For Tenant logout!


Route::post('logoutAdministrator', [AuthController::class, 'logoutAdministrator'])->name('logoutAdministrator');

Route::get('administrator/contentChecker', [ContentCheckersController::class, 'viewCheckerForm'])->name('viewCheckerForm');
Route::get('administrator/contentCreate', [ContentCheckersController::class, 'create'])->name('createContent');
Route::post('administrator/contentCreate', [ContentCheckersController::class,'store'])->name('contentStore');

Route::get('administrator/profileAdmin', [UserListController::class, 'adminProfileView'])->name('adminProfileView');
Route::put('administrator/profileAdmin', [UserListController::class, 'updateAdminProfile'])->name('updateAdminProfile');

//Admin dashboard route
Route::get('administrator/administratorDashboard', [Dashboard::class, 'homepage'])->name('homepage');

//For user acc report
Route::get('administrator/userAccReport', [AdminReportController::class, 'viewUserAccManagementReport'])->name('viewUserAccManagementReport');
Route::post('administrator/userAccReport', [AdminReportController::class, 'generateUserAccManagementReport'])->name('generateUserAccManagementReport');


//For property registration report
Route::get('administrator/propRegManagementReport', [AdminReportController::class, 'viewPropRegManagementReport'])->name('viewPropRegManagementReport');
Route::post('administrator/propRegManagementReport', [AdminReportController::class, 'generatePropRegManagementReport'])->name('generatePropRegManagementReport');


//For content checker report
Route::get('administrator/contentCheckerReport', [AdminReportController::class, 'viewContentCheckerReport'])->name('viewContentCheckerReport');
Route::post('administrator/contentCheckerReport', [AdminReportController::class, 'generateContentCheckerReport'])->name('generateContentCheckerReport');



Route::get('administrator/adminView', [UserListController::class, 'viewAdmin'])->name('viewAdmin');
Route::get('administrator/landlordList', [UserListController::class, 'viewLandlord'])->name('viewLandlord');
Route::get('administrator/tenantList', [UserListController::class, 'viewTenant'])->name('viewTenant');

//For tenant list
Route::get('administrator/tenant/{id}', [UserListController::class, 'showTenant'])->name('showTenant');
Route::put('administrator/tenant/{id}/deactivate', [UserListController::class, 'deactivateTenant'])->name('deactivateTenant');
Route::put('administrator/tenant/{id}/activate', [UserListController::class, 'activateTenant'])->name('activateTenant');

//For advertiser list
Route::get('administrator/advertiser/{id}', [UserListController::class, 'showAdvertiser'])->name('showAdvertiser');
Route::put('administrator/advertiser/{id}/deactivate', [UserListController::class, 'deactivateAdvertiser'])->name('deactivateAdvertiser');
Route::put('administrator/advertiser/{id}/activate', [UserListController::class, 'activateAdvertiser'])->name('activateAdvertiser');

//For advertiser registration
Route::get('administrator/advertiserApp/{id}', [ApprovalController::class, 'showAdvertiser'])->name('showAdvertiserApp');
Route::put('administrator/advertiser/{id}/reject', [ApprovalController::class, 'rejectedAdvertiser'])->name('rejectedAdvertiser');
Route::put('administrator/advertiser/{id}/approve', [ApprovalController::class, 'approveAdvertiser'])->name('approveAdvertiser');

//For tenant registration
Route::get('administrator/tenantApp/{id}', [ApprovalController::class, 'showTenant'])->name('showTenantApp');
Route::put('administrator/tenant/{id}/reject', [ApprovalController::class, 'rejectedTenant'])->name('rejectedTenant');
Route::put('administrator/tenant/{id}/approve', [ApprovalController::class, 'approveTenant'])->name('approveTenant');



Route::get('administrator/adminCreate', [UserListController::class, 'adminCreate'])->name('adminCreate');
Route::post('administrator/adminCreate', [UserListController::class,'adminStore'])->name('adminStore');

Route::get('administrator/propertyApproval', [ApprovalController::class, 'propertyApproval'])->name('propertyApproval');
Route::get('administrator/landlordApproval', [ApprovalController::class, 'landlordApproval'])->name('landlordApproval');
Route::get('administrator/tenantApproval', [ApprovalController::class, 'tenantApproval'])->name('tenantApproval');


Route::delete('/administrator/{id}', [UserListController::class, 'destroyAdmin'])->name('deleteAdmin');
Route::delete('/administrator-word/{id}', [ContentCheckersController::class, 'destroy'])->name('deleteWord');
Route::resource('administrator', ContentCheckersController::class);

//property
Route::middleware(['auth:administrator'])->group(function () {
    // Route to the advertiserTest blade file
    Route::get('administrator/administratorTest', function () {
        return view('administrator.AdministratorTest');
    })->name('administrator.administratorTest');

    Route::get('administrator/propertyApproval', [ApprovalController::class, 'showAllPropertyApproval'])->name('showAllPropertyApproval');
    Route::get('administrator/propertyApproval/{propertyId}', [ApprovalController::class, 'showProperty'])->name('showProperty');
    Route::put('administrator/propertyApproval/{propertyId}', [ApprovalController::class, 'handleApproveRejectRequest'])->name('handleApproveRejectRequest');

});


// =====================================================================================================================


// For registration type
Route::get('registerType', [AuthController::class,'registerType'])->name('registerType');

// for Tenant Registration Form & Registration Action
Route::get('registerTenant', [AuthController::class,'registerTenant'])->name('registerTenant');
Route::post('registerTenant', [AuthController::class,'registerTenantStore'])->name('registerTenantStore');

// for Advertiser Registration Form & Registration Action
Route::get('registerAdvertiser', [AuthController::class,'registerAdvertiser'])->name('registerAdvertiser');
Route::post('registerAdvertiser', [AuthController::class,'registerAdvertiserStore'])->name('registerAdvertiserStore');



