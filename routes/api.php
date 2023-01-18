<?php

use App\Http\Controllers\Api\V1\Customer\CTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/v1/test', 'Api\V1\TestController@test');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/service',[PetController::class,'store']);

Route::group(['middleware' => ['optimizeImages'], 'prefix' => '/v1/customer', 'namespace' => 'Api\V1\Customer'], function () {
    
    Route::get('/test', [CTestController::class, 'test']);
    
    // -------- Register And Login API ----------
    Route::controller(CAuthController::class)->group(function () 
    {
        
        Route::post('login', 'login');
        Route::post('register', 'register'); 
        
        Route::post('get_category', 'get_category');
        Route::post('get_petdetail', 'get_petdetail');
        Route::post('get_subcategory', 'get_subcategory');
        Route::post('get_manageservice', 'get_manageservice');
        Route::post('hostelservice', 'hostelservice');
        Route::post('addpetdetail', 'addpetdetail');
        Route::post('adddoctor', 'adddoctor');

        // clinic inside doctor

        Route::post('addclinic', 'addclinic');
        Route::post('getclinicrecord', 'getclinicrecord');
        Route::post('clinicdelete/{id}', 'clinicdelete');

        // end clinic inside doctor 

        // start hostel availbilty

        Route::post('hostelavailbilty', 'hostelavailbilty');
        Route::post('gethostelavailbilty', 'gethostelavailbilty');
        Route::post('deletehostelavailbilty/{id}', 'deletehostelavailbilty');
        Route::post('updatehostelavailbilty/{id}', 'updatehostelavailbilty');

        // end hostel availbilty 

    
        // start hostel service not hostel company
    
        Route::post('addhostelservice', 'addhostelservice');
        Route::post('gethostelser', 'gethostelser');
        Route::post('deletehostelservice/{id}', 'deletehostelservice');
        Route::post('updatehostelser/{id}', 'updatehostelser');

        // end hostel service



        // start hostel profile 
        Route::post('addhostelprofile', 'addhostelprofile');
        Route::post('gethostelprofile', 'gethostelprofile');
        Route::post('deletehostelprofile/{id}', 'deletehostelprofile');
        // end hostel profile

        // start hostel appoinment

        Route::post('addhostelappoinment', 'addhostelappoinment');
        Route::post('gethostelappoinment', 'gethostelappoinment');
        Route::post('deletehostelappoinment/{id}', 'deletehostelappoinment');
        Route::post('updatehostelappoinment/{id}', 'updatehostelappoinment');

        // end hostel appoinment 

        // start doctor speciality

           Route::post('doctorspe', 'doctorspe');
           Route::post('getdoctorspe', 'getdoctorspe');
           Route::post('deletedoctorspe/{id}', 'deletedoctorspe');
           Route::post('updatedoctorspecialist/{id}', 'updatedoctorspecialist');

        // end doctor speciality

        // start doctor availbilty 

            Route::post('docavailbilty', 'docavailbilty');
            Route::post('getdocavailbilty', 'getdocavailbilty');
            Route::post('deletedocavailbilty/{id}', 'deletedocavailbilty');
            Route::post('updatedocavailbilty/{id}', 'updatedocavailbilty');
            
        // end doctor availbilty 


        // start doctor image 
           Route::post('adddoctorimage', 'adddoctorimage');
           Route::post('getdoctorimage', 'getdoctorimage');
           Route::post('deletedoctorimage/{id}', 'deletedoctorimage');
           Route::post('updatedoctorimage/{id}', 'updatedoctorimage');
        // end doctor image

        // start doctor capacits
            Route::post('adddoctorcapacitor', 'adddoctorcapacitor');
            Route::post('getdoctorcapacitor','getdoctorcapacitor');
            Route::post('deletedoctorcapacitor/{id}','deletedoctorcapacitor');
            Route::post('updatedoctorcapacitor/{id}','updatedoctorcapacitor');
        // end doctor capacits

        // start doctor aap slot 
            Route::post('getdoctorslot', 'getdoctorslot');
            Route::post('adddoctorslot','adddoctorslot');
            Route::post('deletedoctorslot/{id}','deletedoctorslot');
            Route::post('updatedoctorslot/{id}','updatedoctorslot');
        // end doctor app slot

        // start doctor appoinment 
        Route::post('getdoctorappoinment', 'getdoctorappoinment');
        Route::post('adddoctorappoinment','adddoctorappoinment');
        Route::post('deletedoctorappoinment/{id}','deletedoctorappoinment');
        Route::post('updatedoctorappoinment/{id}','updatedoctorappoinment');

        // end doctor appoinment

        // start trainer profile 
           Route::post('gettrainerprofile', 'gettrainerprofile');
           Route::post('addtrainerprofile', 'addtrainerprofile');
           Route::post('deletetrainerprofile/{id}', 'deletetrainerprofile');
           Route::post('updatetrainerprofile/{id}', 'updatetrainerprofile');
        // end trainer profile

        // start trainer capacity
            Route::post('gettrainercapacity', 'gettrainercapacity');
            Route::post('deletetrainercapacity/{id}', 'deletetrainercapacity');
            Route::post('addtrainercapacity', 'addtrainercapacity');
            Route::post('updatetrainercapacity/{id}', 'updatetrainercapacity');
        // end trainer capacity

        // start trainer appt slot 
            Route::post('gettrainerapptslot', 'gettrainerapptslot');
            Route::post('deletetrainerapptslot/{id}', 'deletetrainerapptslot');
            Route::post('addtrainerapptslot', 'addtrainerapptslot');
            Route::post('updatetrainerapptslot/{id}', 'updatetrainerapptslot');
        // end trainer appt slot
        
        Route::post('adddoctorservice', 'adddoctorservice');
        Route::post('deletedoctor/{id}','deletedoctor');
        Route::post('getdoctorprofile', 'getdoctorprofile');
        Route::post('getdoctorservice', 'getdoctorservice');

        Route::post('managehostelservice', 'managehostelservice'); 
        Route::post('deleteservice/{id}', 'deleteservice');
        Route::post('deletedoctorservice/{id}', 'deletedoctorservice');
        Route::post('petdetaildelete/{id}', 'petdetaildelete'); 
        Route::post('managehostelservicedelete/{id}', 'managehostelservicedelete'); 
        Route::post('updatepetdetails/{id}', 'updatepetdetails');
        Route::post('updatedetails/{id}', 'updatepetdetails'); 

        Route::post('updatehostelservice/{id}', 'updatehostelservice');

      
        

    });

    
    Route::get('/category',[CategoryController::class,'index']);

    // -------- Register And Login API ----------
    Route::group(['middleware' => ['jwt.auth']], function () {
        /* logout APi */
        Route::controller(CAuthController::class)->group(function () {
            Route::post('change_password', 'change_password');
            Route::post('user_edit_profile', 'user_edit_profile');
            Route::post('update_notification', 'update_notification');
            Route::post('user_change_password', 'user_change_password');
            Route::post('rating', 'rating');
            Route::post('review', 'review');

            Route::post('consultant_edit_profile', 'consultant_edit_profile');
            Route::post('logout', 'logout');
        });

        /* Profile Controller */
        Route::controller(CProfileController::class)->group(function () {
            /*Profile API */
            Route::get('profile', 'profile');
            Route::put('update-profile', 'updateProfile');
            Route::post('update-profile-image', 'updateProfileImage');
        });
    });
});