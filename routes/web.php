<?php

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

/* --------------------------------------------------- Guest --------------------------------------------------- */
// Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Static Pages Routes
Route::get('/', 'guest\PagesController@index')->name('guest.welcome');
Route::get('about_us', 'guest\PagesController@about')->name('guest.about');
Route::get('service_ss', 'guest\PagesController@serviceSS')->name('guest.sss');
Route::get('service_uc', 'guest\PagesController@serviceUC')->name('guest.suc');
Route::get('term', 'guest\PagesController@term')->name('guest.term');
Route::get('privacy', 'guest\PagesController@privacy')->name('guest.privacy');


/* --------------------------------------------------- Counselor --------------------------------------------------- */
// Counselor Home Page Route
Route::get('/counselor/home', 'counselor\PagesController@index')->name('counselor.home');

// Counselor Account Routes
Route::resource('counselor/counselor_account','counselor\CounselorAccountController', ['except' => ['index','destroy','show']]);


/* --------------------------------------------------- School Admin --------------------------------------------------- */
// School Admin Home Page Route
Route::get('/school_admin/home', 'school_admin\PagesController@index')->name('school_admin.home');

// Statistic Route
Route::get('/school_admin/statistic', 'school_admin\PagesController@statistic')->name('school_admin.statistic');

// School Admin Account Routes
Route::resource('school_admin/school_admin_account','school_admin\SchoolAdminAccountController', ['except' => ['index','destroy','show']]);

// School Admin Announcement Routes
Route::resource('school_admin/school_admin_announcement','school_admin\AnnouncementController');


/* --------------------------------------------------- Student --------------------------------------------------- */
// Student Home Page Route
Route::get('/student/home', 'student\PagesController@index')->name('student.home');

// Self Assessment Routes
Route::get('/student/assessment', 'student\AssessmentController@index')->name('assessment.index');
Route::get('/student/assessment/result', 'student\AssessmentController@result')->name('assessment.result');

// Interest Assessment Routes
Route::get('/student/assessment/interest/test', 'student\AssessmentController@interest_test')->name('assessment.interest.test');
Route::post('/student/assessment/interest', 'student\AssessmentController@interest_store')->name('assessment.interest.store');
Route::get('/student/assessment/interest/result', 'student\AssessmentController@interest_result')->name('assessment.interest.result');

// Ability Assessment Routes
Route::get('/student/assessment/ability/test', 'student\AssessmentController@ability_test')->name('assessment.ability.test');
Route::post('/student/assessment/ability', 'student\AssessmentController@ability_store')->name('assessment.ability.store');
Route::get('/student/assessment/ability/result', 'student\AssessmentController@ability_result')->name('assessment.ability.result');

// Value Assessment Routes
Route::get('/student/assessment/value/test', 'student\AssessmentController@value_test')->name('assessment.value.test');
Route::post('/student/assessment/value', 'student\AssessmentController@value_store')->name('assessment.value.store');
Route::get('/student/assessment/value/result', 'student\AssessmentController@value_result')->name('assessment.value.result');

// Message Route
Route::get('/student/message', 'student\PagesController@message')->name('student.message');

// My Decision Route
Route::get('/student/decision', 'student\PagesController@decision')->name('student.decision');
Route::put('/student/decision/{decision}', 'student\PagesController@decision_store')->name('student.decision.update');

// Student Account Routes
Route::resource('student/student_account','student\StudentAccountController', ['except' => ['index','destroy','show']]);


/* --------------------------------------------------- System Admin --------------------------------------------------- */
// System Admin Home Page Route
Route::get('/system_admin/home', 'system_admin\PagesController@index')->name('system_admin.home');

// System Admin Account Routes
Route::resource('system_admin/system_admin_account','system_admin\SystemAdminAccountController', ['except' => ['index','destroy','show']]);

// Major Routes
Route::resource('system_admin/major','system_admin\MajorController', ['except' => ['create','show','edit']]);

// Account Manager Routes
Route::put('/system_admin/counselor_acc/{counselor}', 'system_admin\AccountManagerController@counselor_acc_update')->name('account_manager.counselor.update');
Route::get('/system_admin/admin_acc', 'system_admin\AccountManagerController@admin_acc_index')->name('account_manager.admin.index');
Route::put('/system_admin/admin_acc/{admin}', 'system_admin\AccountManagerController@admin_acc_update')->name('account_manager.admin.update');

/* --------------------------------------------------- Shared --------------------------------------------------- */
// Announcement Routes
Route::get('/announcements/single/{id}', 'shared\AnnouncementController@single')->name('announcement.single');

// Scholarship Routes
Route::resource('scholarships','shared\ScholarshipController');

// Feedback Routes
Route::resource('feedback','shared\FeedbackController', ['except' => ['show','edit','destroy']]);

// Article Routes
Route::delete('article_files/{file}', 'shared\ArticleController@delete_file')->name('article_files.delete');
Route::resource('articles','shared\ArticleController');

// Career Routes
Route::resource('career','shared\CareerController');

// School Routes
Route::resource('school','shared\SchoolController', ['except' => ['show']]);