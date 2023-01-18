<?php

use App\Http\Controllers\Admin\AdminErrorPageController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\categorycontroller;
use App\Http\Controllers\Admin\SubController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('admin.dashboard');
});
// Route::get('/admin', function () {
//     return redirect('/admin/dashboard');
// });
Auth::routes(['register' => false]);
// Route::get('/test', 'TestController@test');
// Route::controller(TestController::class)->group(function () {
//     //
// });
Route::get('/admin/test', 'TestController@test');



Route::group(['middleware' => ['optimizeImages'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
    });
    Route::controller(AdminErrorPageController::class)->group(function () {
        Route::get('/404', 'pageNotFound')->name('notfound');
        Route::get('/500', 'serverError')->name('server_error');
    });
    Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function () {

        Route::controller(DashboardController::class)->group(function () {
            Route::get('/test', 'test')->name('test');
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('dashboard-counts', 'dashboardCountsData')->name('dashboard-counts');
        });

        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::get('change-password', 'changePassword')->name('change_password');
            Route::put('change-password/{user}', 'updatePassword')->name('update.password');
        });

        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        

        Route::controller(UserController::class)->group(function () {
            Route::get('/update_language/{user}/{language}', 'updateLanguage')->name('users.update_language');
            Route::get('/users/status/{id}/{status}', 'status')->name('users.status');
            Route::get('/users/rating/{id}', 'rating')->name('users.rating');
            Route::get('/users/{id}/{approve}', 'approve')->name('users.approve');
            Route::get('/users/phoneapprove/{id}/{phoneapprove}', 'phoneapprove')->name('users.phoneapprove');
            Route::get('/users/emailapprove/{id}/{emailapprove}', 'emailapprove')->name('users.emailapprove');
            // Route::get('/users/consultant/', 'consultant')->name('users.consultant');
            Route::post('/users/download', 'export')->name('users.download');
        });
        Route::resource('/users', UserController::class);
        
        Route::controller(ConsultantController::class)->group(function () {
            Route::get('/consultants/{id}/{status}', 'status')->name('consultants.status');

            
        });
        Route::resource('/consultants', ConsultantController::class);

        
        Route::controller(AdvisorieController::class)->group(function () {
            Route::get('/advisorys/status/{id}/{status}', 'status')->name('advisorys.status');
        });


        Route::resource('/advisorys', AdvisorieController::class); 


        Route::controller(SetAvailablityController::class)->group(function () {
            Route::get('/battles/status/{id}/{status}', 'status')->name('battles.status');
            Route::get('/battles/{id}/', 'index')->name('battles.index');
        });
        Route::resource('/battles', SetAvailablityController::class);

        Route::controller(BookAnAppointmentController::class)->group(function () {
            Route::get('/bookanappointments/status/{id}/{status}', 'status')->name('bookanappointments.status');
            // Route::get('/bookanappointments/{id}/', 'index')->name('battles.index');
        });
        Route::resource('/bookanappointments', BookAnAppointmentController::class);


        //Promocode 
        Route::controller(PromocodeController::class)->group(function () {
            Route::get('/promocodes/status/{id}/{status}', 'status')->name('promocodes.status');
        });
        Route::resource('/promocodes', PromocodeController::class);

        Route::controller(CategoryController::class)->group(function () 
        {
            Route::get('/categorys/status/{id}/{status}', 'status')->name('categorys.status');
            Route::get('/categorys/destroy/{cat_id}/', 'destroy')->name('categorys.destroy');
        });
        Route::resource('/categorys', CategoryController::class); 

        //subcategorys
        Route::controller(SubController::class)->group(function () {
            Route::get('/subcategorys/status/{id}/{status}', 'status')->name('subcategorys.status');
            Route::get('/subcategorys/destroy/{sub_id}/', 'destroy')->name('subcategorys.destroy');
        });
        Route::resource('/subcategorys', SubController::class);

        //hostel company register

        Route::controller(HostelserviceController::class)->group(function () {
            Route::get('/hostelservices/status/{id}/{status}', 'status')->name('hostelservices.status');
            Route::get('/hostelservices/destroy/{service_id}/', 'destroy')->name('hostelservices.destroy');
        });
        Route::resource('/hostelservices', HostelserviceController::class);
        
        // trainer services 

        Route::controller(TrainerServiceController::class)->group(function () {
            Route::get('/trainerservices/status/{id}/{status}', 'status')->name('trainerservices.status');
            Route::get('/trainerservices/destroy/{service_id}/', 'destroy')->name('trainerservices.destroy');
        });
        Route::resource('/trainerservices',TrainerServiceController::class);


        // trainer availbilty

        Route::controller(TrainerAvaController::class)->group(function () {
            Route::get('/traineravas/status/{id}/{status}', 'status')->name('traineravas.status');
            Route::get('/traineravas/destroy/{service_id}/', 'destroy')->name('traineravas.destroy');
        });
        Route::resource('/traineravas',TrainerAvaController::class);
        
        // sallon services 

        Route::controller(SallonServiceController::class)->group(function () {
            Route::get('/sallonservices/status/{id}/{status}', 'status')->name('sallonservices.status');
            Route::get('/sallonservices/destroy/{service_id}/', 'destroy')->name('sallonservices.destroy');
        });
        Route::resource('/sallonservices',SallonServiceController::class);

        // sallon availbilty

        Route::controller(SallonAvaController::class)->group(function () {
            Route::get('/sallonavas/status/{id}/{status}', 'status')->name('sallonavas.status');
            Route::get('/sallonavas/destroy/{service_id}/', 'destroy')->name('sallonavas.destroy');
        });
        Route::resource('/sallonavas',SallonAvaController::class);

        // user address  

        Route::controller(UseraddressController::class)->group(function () {
            Route::get('/useradds/status/{id}/{status}', 'status')->name('useradds.status');
            Route::get('/useradds/destroy/{service_id}/', 'destroy')->name('useradds.destroy');
        });
        Route::resource('/useradds',UseraddressController::class);
        
        // user customer

        Route::controller(CustomerAppoinmentController::class)->group(function () {
            Route::get('/customers/status/{id}/{status}', 'status')->name('customers.status');
            Route::get('/customers/destroy/{service_id}/', 'destroy')->name('customers.destroy');
        });
        Route::resource('/customers',CustomerAppoinmentController::class);

        // trainer image

        Route::controller(TrainerImageController::class)->group(function () {
            Route::get('/trainerimages/status/{id}/{status}', 'status')->name('trainerimages.status');
            Route::get('/trainerimages/destroy/{service_id}/', 'destroy')->name('trainerimages.destroy');
        });
        Route::resource('/trainerimages',TrainerImageController::class);

        // trainer capacity
        
        Route::controller(TrainerCapacityController::class)->group(function () {
            Route::get('/trainercapacitys/status/{id}/{status}', 'status')->name('trainercapacitys.status');
            Route::get('/trainercapacitys/destroy/{service_id}/', 'destroy')->name('trainercapacitys.destroy');
        });
        Route::resource('/trainercapacitys',TrainerCapacityController::class);

        // trainer appt slot

        Route::controller(TrainerApptslotController::class)->group(function () {
            Route::get('/trainerappslots/status/{id}/{status}', 'status')->name('trainerappslots.status');
            Route::get('/trainerappslots/destroy/{service_id}/', 'destroy')->name('trainerappslots.destroy');
        });
        Route::resource('/trainerappslots',TrainerApptslotController::class);

        // sallon appt slot

        Route::controller(SallonApptslotController::class)->group(function () {
            Route::get('/sallonappslots/status/{id}/{status}', 'status')->name('sallonappslots.status');
            Route::get('/sallonappslots/destroy/{service_id}/', 'destroy')->name('sallonappslots.destroy');
        });
        Route::resource('/sallonappslots',SallonApptslotController::class);

        // trainer appoinment

        Route::controller(TrainerAppoinmentController::class)->group(function () {
            Route::get('/trainerappoinments/status/{id}/{status}', 'status')->name('trainerappoinments.status');
            Route::get('/trainerappoinments/destroy/{service_id}/', 'destroy')->name('trainerappoinments.destroy');
        });
        Route::resource('/trainerappoinments',TrainerAppoinmentController::class);

        // sallon appoinment 

        Route::controller(SallonAppoinmentController::class)->group(function () {
            Route::get('/sallonappionments/status/{id}/{status}', 'status')->name('sallonappionments.status');
            Route::get('/sallonappionments/destroy/{service_id}/', 'destroy')->name('sallonappionments.destroy');
        });
        Route::resource('/sallonappionments',SallonAppoinmentController::class);

        // sallon

        Route::controller(SallonImageController::class)->group(function () {
            Route::get('/sallons/status/{id}/{status}', 'status')->name('sallons.status');
            Route::get('/sallons/destroy/{service_id}/', 'destroy')->name('sallons.destroy');
        });
        Route::resource('/sallons',SallonImageController::class);
        
        // sallon appt capacitys

        Route::controller(SallonCapacityController::class)->group(function () {
            Route::get('/sallonapptcapacitys/status/{id}/{status}', 'status')->name('sallonapptcapacitys.status');
            Route::get('/sallonapptcapacitys/destroy/{service_id}/', 'destroy')->name('sallonapptcapacitys.destroy');
        });
        Route::resource('/sallonapptcapacitys',SallonCapacityController::class);



        // hostel profile

        Route::controller(HostelProfileController::class)->group(function () {
            Route::get('/hostelprofiles/status/{id}/{status}', 'status')->name('hostelprofiles.status');
            Route::get('/hostelprofiles/destroy/{id}/', 'destroy')->name('hostelprofiles.destroy');
        });
        Route::resource('/hostelprofiles', HostelProfileController::class);

        // hostel add service 

        Route::controller(HostelSerController::class)->group(function () {
            Route::get('/hosteladdsers/status/{id}/{status}', 'status')->name('hosteladdsers.status');
            Route::get('/hosteladdsers/destroy/{id}/', 'destroy')->name('hosteladdsers.destroy');
        });
        Route::resource('/hosteladdsers', HostelSerController::class);


        // hostel appoinment 

        Route::controller(AppoinmentController::class)->group(function () {
            Route::get('/appoinments/status/{id}/{status}', 'status')->name('appoinments.status');
            Route::get('/appoinments/destroy/{id}/', 'destroy')->name('appoinments.destroy');
        });
        Route::resource('/appoinments', AppoinmentController::class); 

        // doctor availbilty

        Route::controller(DoctorAvaController::class)->group(function () {
            Route::get('/doctoravas/status/{id}/{status}', 'status')->name('doctoravas.status');
            Route::get('/doctoravas/destroy/{id}/', 'destroy')->name('doctoravas.destroy');
        });
        Route::resource('/doctoravas', DoctorAvaController::class); 

        // doctor Speciality 

        Route::controller(DoctorSpeController::class)->group(function () {
            Route::get('/docspecialitys/status/{id}/{status}', 'status')->name('docspecialitys.status');
            Route::get('/docspecialitys/destroy/{id}/', 'destroy')->name('docspecialitys.destroy');
        });
        Route::resource('/docspecialitys', DoctorSpeController::class); 

        // doctor images 
        
        Route::controller(DoctorImageController::class)->group(function () {
            Route::get('/doctorimages/status/{id}/{status}', 'status')->name('doctorimages.status');
            Route::get('/doctorimages/destroy/{id}/', 'destroy')->name('doctorimages.destroy');
        });
        Route::resource('/doctorimages', DoctorImageController::class); 

        // doctor capaciter 

        Route::controller(DoctorCapacityController::class)->group(function () {
            Route::get('/doctorcapacitys/status/{id}/{status}', 'status')->name('doctorcapacitys.status');
            Route::get('/doctorcapacitys/destroy/{id}/', 'destroy')->name('doctorcapacitys.destroy');
        });
        Route::resource('/doctorcapacitys', DoctorCapacityController::class); 

        // doctor appslot 

        Route::controller(DoctorAppslotController::class)->group(function () {
            Route::get('/doctoraptsolts/status/{id}/{status}', 'status')->name('doctoraptsolts.status');
            Route::get('/doctoraptsolts/destroy/{id}/', 'destroy')->name('doctoraptsolts.destroy');
        });
        Route::resource('/doctoraptsolts', DoctorAppslotController::class); 

        // doctor appoinment 

        Route::controller(DoctorAppoinmentController::class)->group(function () {
            Route::get('/doctorappoinments/status/{id}/{status}', 'status')->name('doctorappoinments.status');
            Route::get('/doctorappoinments/destroy/{id}/', 'destroy')->name('doctorappoinments.destroy');
        });
        Route::resource('/doctorappoinments', DoctorAppoinmentController::class); 

        // hostel availbilty 

        Route::controller(HostelAvaController::class)->group(function () {
            Route::get('/hostelavailbiltys/status/{id}/{status}', 'status')->name('hostelavailbiltys.status');
            Route::get('/hostelavailbiltys/destroy/{id}/', 'destroy')->name('hostelavailbiltys.destroy');
        });
        Route::resource('/hostelavailbiltys',HostelAvaController::class); 

        // doctor service

        Route::controller(DoctorSerController::class)->group(function () {
            Route::get('/doctorsers/status/{id}/{status}', 'status')->name('doctorsers.status');
            Route::get('/doctorsers/destroy/{id}/', 'destroy')->name('doctorsers.destroy');
        });
        Route::resource('/doctorsers',DoctorSerController::class); 

        // user service type

        Route::controller(UserServiceController::class)->group(function () {
            Route::get('/userservices/status/{id}/{status}', 'status')->name('userservices.status');
            Route::get('/userservices/destroy/{id}/', 'destroy')->name('userservices.destroy');
        });
        Route::resource('/userservices',UserServiceController::class);

        // end service type

        // doctor 

        Route::controller(DoctorController::class)->group(function () {
            Route::get('/doctors/status/{id}/{status}', 'status')->name('doctors.status');
            Route::get('/doctors/destroy/{id}/', 'destroy')->name('doctors.destroy');
        });
        Route::resource('/doctors', DoctorController::class); 

        //petdetail 

           Route::controller(PetdetailController::class)->group(function () {
            Route::get('/petdetails/status/{id}/{status}', 'status')->name('petdetails.status');
            Route::get('/petdetails/destroy/{sub_id}/', 'destroy')->name('petdetails.destroy');
           });
           Route::resource('/petdetails', PetdetailController::class);


      

        //add managehostelservice
        
        Route::controller(ManageHostelController::class)->group(function () 
        {
            Route::get('/managehostels/status/{id}/{status}', 'status')->name('managehostels.status');
            Route::get('/managehostels/destroy/{pet_id}/', 'destroy')->name('managehostels.destroy');
        });
        Route::resource('/managehostels', ManageHostelController::class);


        //Setting manager
        Route::controller(SettingController::class)->group(function () {
            Route::get('/settings/general', 'edit_general')->name('settings.edit_general');
            Route::post('/settings/general', 'update_general')->name('settings.update_general');
        });
    });
});
