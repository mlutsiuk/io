<?php

use Illuminate\Support\Facades\Route;

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
//TODO: Додати групу з middleware auth на всі маршрути окрім тих що треба для входу. Підчистити конструктори контроллерів
//TODO: Delete?
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/user/home', 'HomeController@user')->name('user.home');
Route::get('/admin/home', 'HomeController@admin')->middleware('can:isAdmin')->name('admin.home');


$inventoryGroupData = [
    'namespace' => 'Inventory',
];
Route::group($inventoryGroupData, function() {

    //TODO: user/home???
    Route::get('profile', 'UserController@profile');


    //Адмінка
    $inventoryAdminGroupData = [
        'namespace' => 'Admin',
        'prefix' => 'admin',
    ];
    Route::group($inventoryAdminGroupData, function () {
        //
        /* $methods = ['index','edit','store','update','create',];
         Route::resource('categories', 'CategoryController')
         ->only($methods)
         ->names('admin.categories');*/

        //Departments
        Route::resource('departments', 'DepartmentController')
            ->middleware('can:isAdmin')
            ->except(['create', 'show'])                              //не робити маршрут для метода show
            ->names('admin.departments');
        Route::post('/departments/update_ajax', 'DepartmentController@updateAjax')->name('admin.departments.updateAjax');

        //Users
        Route::resource('users', 'UserController')
            ->only(['index', 'show'])
            ->names('admin.users');

    });
});


$authGroupData = [
    'namespace' => 'Auth',
];
Route::group($authGroupData, function() {
    //login with Google
    Route::get('/login/google', 'LoginController@redirectToProvider');
    Route::get('/login/google/callback', 'LoginController@handleProviderCallback');
    Route::post('logout', 'LoginController@logout')->name('logout');

    //Route::post('login', 'LoginController@login');  //Native Login User Form
});
Route::get('/test/users', 'Api\UserController@index');
