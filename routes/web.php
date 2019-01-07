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

// 用户登录路由
Route::group([
    'domain' => env('APP_USER_SUBDOMAIN'),
    'namespace' => 'User\Auth',
], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('user.login');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('user.logout');

    Route::get('/register', 'RegisterController@showRegistrationForm')->name('user.register');
    Route::post('/register', 'RegisterController@register')->name('user.register');

    // 这里没有带 user. 前缀
    // 原因参考 /Users/lin/code/laravel-subdomain-multi-auth-starter/vendor/laravel/framework/src/Illuminate/Auth/Notifications/VerifyEmail.php#L59
    // verificationUrl 方法里指定了路由别名
    // 所以管理员端也不方便做邮箱地址验证了
    Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
    Route::get('/email/resend', 'VerificationController@resend')->name('verification.resend');

    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('user.password.update');
    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('user.password.reset');
});

// 管理员登录路由
Route::group([
    'domain' => env('APP_ADMIN_SUBDOMAIN'),
    'namespace' => 'Admin\Auth',
], function () {

    // 管理员端没有首页, 直接去登录页
    Route::get('/', function () {
        return redirect('/login');
    });

    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('admin.logout');

    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
});

// 用户端有首页
Route::get('/', function () {
    return view('welcome');
});