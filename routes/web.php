<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\SubserviceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BookserviceController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ArTechnicianController;
use Illuminate\Support\Facades\Auth;

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
//     // return view('welcome');
//     return view('user.form');
// });

Auth::routes();

// Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

    Route::get('/', [HomeController::class, 'index'])->name('user.index');
    // Route::get('user/form', [HomeController::class, 'formPage'])->name('paitentform');
    Route::get('user/member', [HomeController::class, 'memberPage'])->name('memberPage');

    Route::get('logout', [HomeController::class, 'logoutpage'])->name('logout');

    Route::group(['middleware' => 'auth',  'prefix' => ''], function () {
    Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
        Route::get('/index', [HomeController::class, 'adminHome'])->name('admin.index');

        //booking
        Route::get('/bookings', [BookserviceController::class, 'index'])->name('admin.bookingList');
        Route::get('/bookingDetails/{id}', [BookserviceController::class, 'bookingDetails'])->name('admin.bookdetail');
        Route::get('/bookingEdit/{id}', [BookserviceController::class, 'edit'])->name('admin.bookedit');
        Route::post('/bookingUpdate/{id}', [BookserviceController::class, 'update'])->name('admin.bookUpdate');
        Route::get('/form', [BookserviceController::class, 'formPageAdmin'])->name('adminpaitentform');
        Route::post('/form', [BookserviceController::class, 'submitform'])->name('admin.submitform');
        Route::post('/updateStatus', [BookserviceController::class, 'updateStatus'])->name('admin.updateStatus');

        Route::get('/member', [HomeController::class, 'memberPageAdmin'])->name('adminmemberPage');
        Route::get('/branch', [HomeController::class, 'branchPageAdmin'])->name('adminBranchPage');
        Route::get('/serviceAdd', [HomeController::class, 'servicePageAdmin'])->name('servicePage');

        // branch 
        Route::post("/storeBranch",[BranchController::class,"store"])->name("branch.store");
        Route::get("/branchList",[BranchController::class,"list"])->name("branch.list");
        Route::get("/branchEdit/{id}",[BranchController::class,"editBranch"])->name("branch.Edit");
        Route::post("/branchEdit",[BranchController::class,"edit"])->name("branch.update");
        Route::get("/deletebranch/{id}",[BranchController::class,"delete"])->name("branch.delete");

        //service
        Route::get('/services', [ServiceController::class, 'index'])->name('service.index');
        Route::get('/serviceAdd', [ServiceController::class, 'create'])->name('service.create');
        Route::post('/serviceStore', [ServiceController::class, 'store'])->name('service.store');
        Route::get('/serviceEdit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
        Route::post('/serviceUpdate/{id}', [ServiceController::class, 'update'])->name('service.update');
        Route::get('/serviceDelete/{id}', [ServiceController::class, 'delete'])->name('service.delete');

        Route::get('/searchData', [ServiceController::class, 'getsubservice'])->name('service.getsub');

        //subservice
        Route::get('/subservices', [SubserviceController::class, 'index'])->name('subservice.index');
        Route::get('/subserviceAdd', [SubserviceController::class, 'create'])->name('subservice.create');
        Route::post('/subserviceStore', [SubserviceController::class, 'store'])->name('subservice.store');
        Route::get('/subserviceEdit/{id}', [SubserviceController::class, 'edit'])->name('subservice.edit');
        Route::post('/subserviceUpdate/{id}', [SubserviceController::class, 'update'])->name('subservice.update');
        Route::get('/subserviceDelete/{id}', [SubserviceController::class, 'delete'])->name('subservice.delete');

        //provider
        Route::get("/providers",[ProviderController::class,'index'])->name('provider.index');        
        Route::get("/providerAdd",[ProviderController::class,'create'])->name('provider.create');        
        Route::post("/providerStore",[ProviderController::class,'store'])->name('provider.store');        
        Route::get("/providerEdit/{id}",[ProviderController::class,'edit'])->name('provider.edit');        
        Route::post("/providerUpdate/{id}",[ProviderController::class,'update'])->name('provider.update');        
        Route::get("/providerDelete/{id}",[ProviderController::class,'delete'])->name('provider.delete');
        

        //Test
        Route::get("/testList",[TestController::class,'index'])->name('test.index');        
        Route::get("/testAdd",[TestController::class,'create'])->name('test.create');        
        Route::post("/testAdd",[TestController::class,'store'])->name('test.store');        
        Route::get("/testEdit/{id}",[TestController::class,'edit'])->name('test.edit');        
        Route::post("/testUpdate/{id}",[TestController::class,'update'])->name('test.update');        
        Route::get("/testDelete/{id}",[TestController::class,'delete'])->name('test.delete');

        //commissions
        Route::get("/commissions",[CommissionController::class,"index"])->name("provider.commission");
        Route::get("/sendComm",[CommissionController::class,"cutComm"])->name("admin.cutComm");
        Route::post("/sendCommission",[CommissionController::class,"send"])->name("admin.sendComm");
        Route::get("/TechnicianCommissions",[CommissionController::class,"tech_commission"])->name("tech.commission");
        Route::get("/sendTechnicianComm",[CommissionController::class,"cut_techComm"])->name("admin.cutTechComm");
        Route::post("/sendTechCommission",[CommissionController::class,"send_techComm"])->name("admin.sendTechComm");
        Route::get("/tech_slip",[CommissionController::class,"tech_slip"])->name("tech.slip");
        Route::get("/provider_slip",[CommissionController::class,"provider_slip"])->name("provider.slip");

         //technicians
         Route::get("/technicians",[ArTechnicianController::class,'index'])->name('tech.index');        
         Route::get("/techAdd",[ArTechnicianController::class,'create'])->name('tech.create');        
         Route::post("/techStore",[ArTechnicianController::class,'store'])->name('tech.store');        
         Route::get("/techEdit/{id}",[ArTechnicianController::class,'edit'])->name('tech.edit');        
         Route::post("/techUpdate/{id}",[ArTechnicianController::class,'update'])->name('tech.update');        
         Route::get("/techDelete/{id}",[ArTechnicianController::class,'delete'])->name('tech.delete');


         //credits
         Route::get("/credits",[BookserviceController::class,'credits'])->name('admin.credits');
         Route::get("/creditSend",[BookserviceController::class,'creditSend'])->name('admin.creditSend');
         Route::post("/creditUpdate",[BookserviceController::class,'creditUpdate'])->name('admin.creditUpdate');
         Route::get("/creditDetails/{id}",[BookserviceController::class,'creditDetails'])->name('admin.creditDetails');


         //add states if not exist in db
         Route::post("/storeState",[HomeController::class,'state'])->name('admin.state');  
         Route::post("/storeCity",[HomeController::class,'city'])->name('admin.city');  
    });
});
