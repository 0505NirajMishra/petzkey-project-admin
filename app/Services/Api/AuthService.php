<?php

namespace App\Services\Api;

use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Http\Requests\Admin\ContactUsRequest;
use App\Models\MasterOtp;
use App\Models\User;

use App\Models\HostelSer;

use App\Models\TrainerImage;

use App\Models\TrainerAppslot;

use App\Models\TrainerCapacity;

use App\Models\HostelAppoinment;

use App\Models\Doctors;

use App\Models\Docimages;

use App\Models\DocAppslot; 

use App\Models\doctorappoinments;

use App\Models\Doccapacitys;

use App\Models\Appslot;

use App\Models\doctoravailbilty;

use App\Models\hostelavailbilty;

use App\Models\DoctorServiceAdd;

use App\Models\Petdetails;

use App\Models\Package;

use App\Models\Category;

use App\Models\doctorspeciality;

use App\Models\HostelProfile;

use App\Models\Managehostels;
use App\Models\Subcatgeorys;

use App\Models\HostelAddService;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Advisorie;
use App\Models\SetAvailability;
use App\Notifications\NewUserNotify;
use App\Services\HelperService;
use App\Services\UserService;

use App\Services\PetDetailsService;
use App\Services\ClinicService;

use App\Services\RatingService;
use App\Services\ReviewService;
use App\Services\ContactUsService;
use App\Services\SetAvailabilityService;
use App\Services\BookAnAppointmentService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URl;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class AuthService
{
    /**
     * Authenticate user Check and login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(
                [
                    'status' => false,
                    'message' => "You don't have an account with us, Please create your account with us and then login.",
                    'type' => 'unauthorized',
                ],
                200
            );
        }

        $credentials = $request->only(['email', 'password']);
        $credentials['status'] = 0;
        $token = auth('api')->attempt($credentials, ['exp' => Carbon::now()->addDays(60)->timestamp]);

        if (!$token) {
            if ($user ->status == 1) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Your account has been deactivated by admin. Please contact to Support Team.',
                        'type' => 'unauthorized',
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Oops!, You have provide incorrect credentials.',
                        'type' => 'unauthorized',
                    ],
                    200
                );
            }
        }
        $user = JWTAuth::setToken($token)->toUser();

        if ($user->status == 0) {
            // UserService::updateLastLogin($user->id, $request);
            return response()->json(
                [
                    'status' => true,
                    'message' => 'login successfully',
                    'token' => $token,
                    'data' => $user
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Deactive user',
                    'type' => 'unauthorized',
                ],
                200
            );
        }
    }

     /**
     * Register user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public static function register(Request $request)
    {
        
        $is_register = false;
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'You have an account, Please login with same credentials.',
                    'type' => 'unauthorized',
                ],
                200
            );
        } else {
            $is_register = true;
            $input = array_merge(
                $request->except(['_token']),
                [
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'c_password' => Hash::make($request->c_password),
                    'about' => $request->about,
                    'user_type' => $request->user_type,
                    'fcm_token' => $request->fcm_token,
                    'status' => 0,
                ]
            );

          
            $user = UserService::create($input); 
            
            $user->assignRole($request->role);

            $token = auth('api')->login($user, ['exp' => Carbon::now()->addDays(120)->timestamp]);

            if (!$token) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'unauthorized',
                        'type' => 'unauthorized',
                    ],
                    200
                );
            }

            $user = JWTAuth::setToken($token)->toUser();
         
            if ($user->status == 0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Register is successfully',
                        'is_register' => $is_register,
                        'token' => $token,
                        'data' => $user
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Deactive user',
                        'type' => 'unauthorized',
                    ],
                    200
                );
            }
        }
    }


    // Api Hostel Service 

    public static function hostelservice(Request $request){

        $input = 
        [
        'service_type' => $request->service_type,
        'service_company_name' => $request->service_company_name,
        'service_company_number' => $request->service_company_number,
        'service_location' => $request->service_location,
        'service_aboutus' => $request->service_aboutus,
       
        ];


        if(!empty($request->service_licence_photo)){
        $image=$request->file('service_licence_photo'); 
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/hostel/image/');
        $image->move($destinationPath, $filename); 
        $input['service_licence_photo']=$filename;
        }


        if(!empty($request->service_work_photo)){
        $image2=$request->file('service_work_photo'); 
        $filename2 = time().$image2->getClientOriginalName();
        $destinationPath2 = public_path('/hostel/image/');
        $image2->move($destinationPath2, $filename2);
        $input['service_work_photo']=$filename2;
        }

        if(!empty($request->service_image_logo)){
        $image3=$request->file('service_image_logo');    
        $filename3 = time().$image3->getClientOriginalName();
        $destinationPath3 = public_path('/hostel/image/');
        $image3->move($destinationPath3, $filename3);
        $input['service_image_logo']=$filename3;
        }


        $hostelservice = Hostelservice::create($input);

        if ($hostelservice) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $hostelservice
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
                }
    }  

    // api clinic add 

    public static function addclinic(Request $request){

        $input = 
        [
          'clinic_category_name' => $request->clinic_category_name,
           'clinic_consult_fees' => $request->clinic_consult_fees,
        ];


        $service = ClinicService::create($input);

        if ($service) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $service
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
                }
    }

    // add doctor 

    public static function adddoctor(Request $request){

        $input = 
        [
        'doctor_image' => $request->doctor_image,
        ];


        if(!empty($request->doctor_image)){
        $image=$request->file('doctor_image'); 
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/doctor/image/');
        $image->move($destinationPath, $filename); 
        $input['doctor_image']=$filename;
        }

        $doctor = Doctors::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
                }
    }  

    // add hostel availbilty

    public static function hostelavailbilty(Request $request){

        $input = 
        [
         'opening_time' => $request->opening_time,
         'closing_time' => $request->closing_time,
        ];

        $doctor = hostelavailbilty::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
                }


    } 

    // add hostel service add

    public static function addhostelservice(Request $request){
            
        $input = 
        [
         'pettype' => $request->pettype,
         'hrs_fee' => $request->hrs_fee,
         'day_fee' => $request->day_fee,
         'desc' => $request->desc,
         'hos_seat' => $request->hos_seat,
        ];

        $doctor = HostelSer::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }


    } 

    // add hostel appoinment

    public static function addhostelappoinment(Request $request){
            
        $input = 
        [
         'appt_date_time' => $request->appt_date_time,
         'book_date_time' => $request->book_date_time,
         'progress_status' => $request->progress_status,
         'payment' => $request->payment,
        ];

        $doctor = HostelAppoinment::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }

    }

    // add hostel profile 

    public static function addhostelprofile(Request $request){
        $input = 
        [
         'hostel_image' => $request->hostel_image,
        ];

        $image=$request->file('hostel_image');
        
        $filename = time().$image->getClientOriginalName();
        
        $destinationPath = public_path('/hostelprofile/image/');
        
        $image->move($destinationPath, $filename);
        
        $input['hostel_image']=$filename;

        $doctor = HostelProfile::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }
    }

    // get hostel availbilty 

    public static function gethostelavailbilty(){
           
        $status = DB::table('hostelavailbiltys')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    // update hostel availbilty

    public static function updatehostelavailbilty(Request $request,$id){
           
        $input = 
        [
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
        ]; 

    
        $updatedata = DB::table('hostelavailbiltys')->where('hostel_avail_id',$id)->update($input);
        
        if ($updatedata) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
                }
    }


    // get hostel appoinment 

    public static function gethostelappoinment(){

        $status = DB::table('hostelappoinments')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }       
    } 

    // delete hostel appoinment

    public static function deletehostelappoinment($id){
           
        $result=DB::table('hostelappoinments')->where('appt_id', $id)->delete();
       
        if($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }

    }

    // get hostel service 

    public static function gethostelser(){
           
        $status = DB::table('hostelsers')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }


    // delete hostel add service 

    public static function deletehostelservice($id){
           
        $result=DB::table('hostelsers')->where('hostel_servc_id', $id)->delete();
       
        if ($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }

    }

    // delete hostel availbilty 

    public static function deletehostelavailbilty($id){
            
        $result=DB::table('hostelavailbiltys')->where('hostel_avail_id', $id)->delete();
       
        if ($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }

    }

    // get hostel profile 

    public static function gethostelprofile(){

        $status = DB::table('hostelprofiles')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    // delete hostel profile 

    public static function deletehostelprofile($id)
    {

        $result=DB::table('hostelprofiles')->where('hostle_img_id', $id)->delete();
       
        if($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }


    // add doctor image 

    public static function adddoctorimage(Request $request){

        $input = 
        [
           'clinic_img' => $request->clinic_img,
        ];

        $image=$request->file('clinic_img');
        
        $filename = time().$image->getClientOriginalName();
        
        $destinationPath = public_path('/doctor/image/');
        
        $image->move($destinationPath, $filename);
        
        $input['clinic_img']=$filename;

        $doctor = Docimages::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }
    }

    // get doctor image detail 

    public static function getdoctorimage(){

        $status = DB::table('doctorclinicimages')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    } 

    // delete doctor image record

    public static function deletedoctorimage($id)
    {
            
        $result=DB::table('doctorclinicimages')->where('clinic_img_id',$id)->delete();
       
        if($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }

     }

     // update doctor image record

     public static function updatedoctorimage(Request $request,$id){ 

        $input = 
        [
            'clinic_img' => $request->clinic_img,
        ]; 

        $image=$request->file('clinic_img');
        
        $filename = time().$image->getClientOriginalName();
        
        $destinationPath = public_path('/doctor/image/');
        
        $image->move($destinationPath, $filename);
        
        $input['clinic_img']=$filename;

        $updatedata = DB::table('doctorclinicimages')->where('clinic_img_id',$id)->update($input);
        
        if ($updatedata) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
                }
     } 


   
     // add doctor availbilty 

    public static function docavailbilty(Request $request){

        $input = 
        [
           'avail_days' => $request->avail_days,
           'opening_time' => $request->opening_time,
           'closing_time' => $request->closing_time,
        ];

        $doctor = doctoravailbilty::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }
    }



    // add doctor capacity

    public static function adddoctorcapacitor(Request $request){

        $input = 
        [
           'dr_apt_cap' => $request->dr_apt_cap,
        ];

        $doctor = Doccapacitys::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }

    } 

    // get doctor capacity

    public static function getdoctorcapacitor(){

        $status = DB::table('doctorcapacitys')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }

    }

    // delete doctor capacitor 

    public static function deletedoctorcapacitor($id){

        $result=DB::table('doctorcapacitys')->where('dr_apt_cap_id',$id)->delete();
       
        if($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }

    }

    // update doctor capacitor 

    public static function updatedoctorcapacitor(Request $request,$id){
           
        $input = 
        [
            'dr_apt_cap' => $request->dr_apt_cap,
        ]; 

    
        $updatedata = DB::table('doctorcapacitys')->where('dr_apt_cap_id',$id)->update($input);
        
        if ($updatedata) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
                }
    } 

    // get doctor availbilty 

    public static function getdocavailbilty(){

        $status = DB::table('doctoravailbiltys')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    } 

     // delete doctor availabilty 

     public static function deletedocavailbilty($id){
            
        $result=DB::table('doctoravailbiltys')->where('doctor_avail_id',$id)->delete();
       
        if($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }

     }

    // update doctor availabilty 

    public static function updatedocavailbilty(Request $request,$id){ 

        $input = 
        [
        'avail_days' => $request->avail_days,
        'opening_time' => $request->opening_time,
        'closing_time' => $request->closing_time,
        ];

        $updatedata = DB::table('doctoravailbiltys')->where('doctor_avail_id',$id)->update($input);
        
        if ($updatedata) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
                }
    }

     // get doctor spe 

     public static function getdoctorspe(){
           
        $status = DB::table('doctorspecialitys')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    } 

     // add doctor spe 

     public static function doctorspe(Request $request){
            
        $input = 
        [
           'dr_spclty_name' => $request->dr_spclty_name,
        ];

        $doctor = doctorspeciality::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }

     }

     // delete doctor spe 

     public static function deletedoctorspe($id){ 

        $result=DB::table('doctorspecialitys')->where('dr_spclty_id',$id)->delete();
       
        if ($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    
     } 
     
     // update doctor spe 

     public static function updatedoctorspecialist(Request $request,$id){
            
        $input = 
        [
        'dr_spclty_name' => $request->dr_spclty_name,
        ];

        $updatedata = DB::table('doctorspecialitys')->where('dr_spclty_id',$id)->update($input);
        
        if ($updatedata) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
        }
     }

     // add doctor service

     public static function adddoctorservice(Request $request){

        $input = 
        [
           'doctor_service_name' => $request->doctor_service_name,
        ];

        $doctor = DoctorServiceAdd::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }

     }  

    // get trainer profile 

    public static function gettrainerprofile(){

        $status = DB::table('trainerimages')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    // add trainer profile 

    public static function addtrainerprofile(Request $request){

        $input = 
        [
            'trainer_image' => $request->trainer_image,
        ]; 

        $image=$request->file('trainer_image');
        
        $filename = time().$image->getClientOriginalName();
        
        $destinationPath = public_path('/trainer/image/');
        
        $image->move($destinationPath, $filename);
        
        $input['trainer_image']=$filename;

        $doctor = TrainerImage::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }

    } 

    // delete trainer profile 
    
    public static function deletetrainerprofile($id){ 

        $result=DB::table('trainerimages')->where('trainer_img_id',$id)->delete();
       
        if($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    
    } 
     
     // update trainer profile 

     public static function updatetrainerprofile(Request $request,$id){
            
        $input = 
        [
            'trainer_image' => $request->trainer_image,
        ]; 

        $image=$request->file('trainer_image');
        
        $filename = time().$image->getClientOriginalName();
        
        $destinationPath = public_path('/trainer/image/');
        
        $image->move($destinationPath, $filename);
        
        $input['trainer_image']=$filename;

        $updatedata = DB::table('trainerimages')->where('trainer_img_id',$id)->update($input);
        
        if ($updatedata) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
        }
     }


    // get trainer capacity

    public static function gettrainercapacity(){

        $status = DB::table('trainerapptcapacitys')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    // add trainer capacity

    public static function addtrainercapacity(Request $request){
           
        $input = 
        [
            'trainer_apt_cap' => $request->trainer_apt_cap,
        ]; 

      
        $doctor = TrainerCapacity::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }
    } 

    // delete trainer capacity
    
    public static function deletetrainercapacity($id){ 

        $result=DB::table('trainerapptcapacitys')->where('trainer_apt_cap_id',$id)->delete();
       
        if($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    
    }

    // update trainer capacity

    public static function updatetrainercapacity(Request $request,$id){
            
        $input = 
        [
            'trainer_apt_cap' => $request->trainer_apt_cap,
        ]; 

        $updatedata = DB::table('trainerapptcapacitys')->where('trainer_apt_cap_id',$id)->update($input);
        
        if ($updatedata) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
        }
    }


    // get trainer appt slot

    public static function gettrainerapptslot(){

        $status = DB::table('trainerappslots')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    // add trainer appt slot

    public static function addtrainerapptslot(Request $request){
           
        $input = 
        [
            'trainer_mrg_slot' => $request->trainer_mrg_slot,
            'trainer_evg_slot' => $request->trainer_evg_slot,
        ]; 
      
        $doctor = TrainerAppslot::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
            );
            } 
            else {
                return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
            );
        }
    } 

    // delete trainer appt slot

    public static function deletetrainerapptslot($id){ 

        $result=DB::table('trainerappslots')->where('trainer_apt_slot_id',$id)->delete();
       
        if($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    
    }

    // update trainer aapt slot

    public static function updatetrainerapptslot(Request $request,$id){
            
        $input = 
        [
            'trainer_mrg_slot' => $request->trainer_mrg_slot,
            'trainer_evg_slot' => $request->trainer_evg_slot,
        ]; 

        $updatedata = DB::table('trainerappslots')->where('trainer_apt_slot_id',$id)->update($input);
        
        if ($updatedata) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
        }
    }


    // get doctor service list 

    public static function getdoctorservice(){
           
        $status = DB::table('doctorservices')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    // get clinic service record 

    public static function getclinicrecord(){
           
        $status = DB::table('doctclinicservices')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    // delete clinic record 

    public static function clinicdelete($id){ 

        $result=DB::table('doctclinicservices')->where('clinic_id', $id)->delete();
       
        if ($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    
    } 

    // get doctor api 
    
    public static function getdoctorprofile()
    {

        $data = DB::table('doctors')->get();
    
        if (count($data)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $data
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    // delete doctor record 

    public static function deletedoctor($id){ 

        $result=DB::table('doctors')->where('doctor_id', $id)->delete();
       
        if ($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    
    } 

    // delete doctor record 
    
    public static function deletedoctorservice($id){

        $result=DB::table('doctorservices')->where('doctor_service_id', $id)->delete();
       
        if($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    // update pet detail api 

    public static function updatepetdetails(Request $request,$id){

        $input = 
        [
        'pet_type' => $request->pet_type,
        'pet_breed' => $request->pet_breed,
        'pet_gender' => $request->pet_gender,
        'pet_height' => $request->pet_height,
        'pet_weight' => $request->pet_weight,
        ];

        if (!empty($input['pet_image'])) { 

            $image=$request->file('pet_image');
            $filename = time().$image->getClientOriginalName();
            $destinationPath = public_path('/petdetail/image/');
            $image->move($destinationPath, $filename);
            $input['pet_image']=$filename;
        } 

        $updatedata = DB::table('petdetails')->where('pet_id',$id)->update($input);
        
        // PetDetailsService::updateById($input,$id);

        if ($updatedata) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
                }
    }

    // update hostel appoinment api 

    public static function updatehostelappoinment(Request $request,$id){
           
        $input = 
        [
        'appt_date_time' => $request->appt_date_time,
        'book_date_time' => $request->book_date_time,
        'progress_status' => $request->progress_status,
        'payment' => $request->payment,
        ];

        $updatedata = DB::table('hostelappoinments')->where('appt_id',$id)->update($input);
        
        if ($updatedata) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
                }
           
    }

    // update hostel service company api 

    public static function updatehostelservice(Request $request,$id){

        $input = array();

        if (        
            !empty($request->service_licence_photo) || 
            !empty($request->service_work_photo) || 
            !empty($request->service_image_logo) || 
            !empty($request->service_company_number)|| 
            !empty($request->service_type ) || 
            !empty($request->service_company_name ) || 
            !empty($request->service_location) ||
            !empty($request->service_aboutus)
        )


         { 

            $input['service_company_number'] = $request->service_company_number;

            $input['service_company_name'] = $request->service_company_name;

            $input['service_type'] = $request->service_type;

            $input['service_location'] = $request->service_location;

            $input['service_aboutus'] = $request->service_location;

            $image=$request->file('service_licence_photo'); 
            $filename = time().$image->getClientOriginalName();
            $destinationPath = public_path('/hostel/image/');
            $image->move($destinationPath, $filename); 
            $input['service_licence_photo']=$filename; 
    
            $image2=$request->file('service_work_photo'); 
            $filename2 = time().$image2->getClientOriginalName();
            $destinationPath2 = public_path('/hostel/image/');
            $image2->move($destinationPath2, $filename2);
            $input['service_work_photo']=$filename2; 
    
            $image3=$request->file('service_image_logo');    
            $filename3 = time().$image3->getClientOriginalName();
            $destinationPath3 = public_path('/hostel/image/');
            $image3->move($destinationPath3, $filename3);
            $input['service_image_logo']=$filename3;

        } 

        $updatedata = DB::table('services')->where('service_id',$id)->update($input);
        
        if ($updatedata) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
                }
    }


    // update hostel add service 

    public static function updatehostelser(Request $request,$id){

        $input = array();

        if (        
            !empty($request->pettype) || 
            !empty($request->hrs_fee) || 
            !empty($request->day_fee) || 
            !empty($request->hos_seat)||  
            !empty($request->desc )
        )


         { 

            $input['pettype'] = $request->pettype;

            $input['hrs_fee'] = $request->hrs_fee;

            $input['day_fee'] = $request->day_fee;

            $input['hos_seat'] = $request->hos_seat;

            $input['desc'] = $request->desc;

        } 

        $updatedata = DB::table('hostelsers')->where('hostel_servc_id',$id)->update($input);
        
        if ($updatedata) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
                }
    }



    // delete api for hostel service 

    public static function deleteservice($id){ 

        $result=DB::table('services')->where('service_id', $id)->delete();
       
        if ($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    
    } 

    // delete api for pet detail 

    public static function petdetaildelete($id){ 

        $result=DB::table('petdetails')->where('pet_id', $id)->delete();
       
        if($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } 
        else 
        {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    } 

    // delete api for manage hostel service

    public static function managehostelservicedelete($id){ 

        $result=DB::table('managehostelservice')->where('pet_id', $id)->delete();
       
        if($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } 
        else 
        {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    } 

    // add petdetail api 

    public static function addpetdetail(Request $request){
        $input = 
        [
        'pet_type' => $request->pet_type,
        'pet_breed' => $request->pet_breed,
        'pet_gender' => $request->pet_gender,
        'pet_height' => $request->pet_height,
        'pet_weight' => $request->pet_weight,
        ];

        if(!empty($request->pet_image))
        {
            $image=$request->file('pet_image'); 
            $filename = time().$image->getClientOriginalName();
            $destinationPath = public_path('/petdetail/image/');
            $image->move($destinationPath, $filename); 
            $input['pet_image']=$filename;
        }

        $addpetdetail = Petdetails::create($input);

        if ($addpetdetail) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $addpetdetail
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
                }
    } 
    
    // add managehostelservice

    public static function managehostelservice(Request $request){
        $input = 
        [
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
            'pet_type' => $request->pet_type,
            'pet_per_hour' => $request->pet_per_hour,
            'pet_per_day' => $request->pet_per_day,
            'pet_seat' => $request->pet_seat,
            'pet_desc' => $request->pet_desc,
        ];

        if(!empty($request->pet_image))
        {
            $image=$request->file('pet_image'); 
            $filename = time().$image->getClientOriginalName();
            $destinationPath = public_path('/managehostelservice/image/');
            $image->move($destinationPath, $filename); 
            $input['pet_image']=$filename;
        }

        $addpetdetail = Managehostels::create($input);

        if ($addpetdetail) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $addpetdetail
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
                }
    }

    // get petdetail list 

    public static function get_petdetail()
    {
        $status = Petdetails::get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }
    
    // get managehostelservice

    public static function get_manageservice()
    {
        $status = Mhostelservice::get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }


    // get doctor apt slot

    public static function getdoctorslot(){
           
        $status = DB::table('doctoraptslots')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    // add doctor apt slot 

    public static function adddoctorslot(Request $request){
            
        $input = 
        [
           'dr_mrg_slot' => $request->dr_mrg_slot,
           'dr_evg_slot' => $request->dr_evg_slot,
        ];

        $doctor = DocAppslot::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }

     }

     // delete doctor spe 

     public static function deletedoctorslot($id){ 

        $result=DB::table('doctoraptslots')->where('dr_apt_slot_td',$id)->delete();
       
        if ($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    
     } 
     
     // update doctor spe 

     public static function updatedoctorslot(Request $request,$id){
            
        $input = 
        [
        'dr_mrg_slot' => $request->dr_mrg_slot,
        'dr_evg_slot' => $request->dr_evg_slot,
        ];

        $updatedata = DB::table('doctoraptslots')->where('dr_apt_slot_td',$id)->update($input);
        
        if ($updatedata) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
        }
     }


    
    // get doctor appoinment

    public static function getdoctorappoinment(){
           
        $status = DB::table('doctorappoinments')->get();
    
        if (count($status)>0) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    // add doctor apt slot 

    public static function adddoctorappoinment(Request $request){
            
        $input = 
        [
           'appt_date_time' => $request->appt_date_time,
           'book_date_time' => $request->book_date_time,
           'progress_status' => $request->progress_status,
           'payment' => $request->payment,
        ];

        $doctor = doctorappoinments::create($input);

        if ($doctor) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Insert successfully',
                    'data' => $doctor
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Inserted',
                    'data' =>[],
                ],
                200
                );
        }

     }

     // delete doctor spe 

     public static function deletedoctorappoinment($id){ 

        $result=DB::table('doctorappoinments')->where('appt_id',$id)->delete();
       
        if ($result) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Delete successfully',
                    'data' => $result
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    
     } 
     
     // update doctor spe 

     public static function updatedoctorappoinment(Request $request,$id){
            
        $input = 
        [
            'appt_date_time' => $request->appt_date_time,
            'book_date_time' => $request->book_date_time,
            'progress_status' => $request->progress_status,
            'payment' => $request->payment,
        ];

        $updatedata = DB::table('doctorappoinments')->where('appt_id',$id)->update($input);
        
        if ($updatedata) 
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Update successfully',
                    'data' => $updatedata
                ],
                200
                    );
                 } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Updated',
                    'data' =>[],
                ],
                200
                );
        }
     }





    
    
    
    //Api For Update User Notification Status 

   public static function update_notification(Request $request)
   {  

    $validator=Validator::make($request->all(),[
        'push_notification'=>'required',
        ]);
        if($validator->fails()){
        return response()->json([
            'message'=>'Validation fails',
            'error'=>$validator->errors()
        ],400);
        }

        $user=$request->user();
    
        $user->update([
        'push_notification'=>$request->push_notification,
        
             ]);
        return response()->json([
            'message'=>'Data Update Successfully',
        ],200);

    }


    //Api For Change User Password
 
    public static function user_change_password(Request $request){
        $validator=Validator::make($request->all(),[
            'old_password'=>'required',
            'password'=>'required|min:2|max:100',
            'confirm_password'=>'required|same:password',
            
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'Validation fails',
                'error'=>$validator->errors()
            ],400);
        }

        $user=$request->user();
        if(Hash::check($request->old_password,$user->password)){
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
            return response()->json([
                'message'=>'Password Update Successfully',
            ],200);
        }else{
            return response()->json([
                'message'=>'Old Password does not matched',
            ],400);
        }
    }

    //Api For User Edit User Profile 
    public static function user_edit_profile(Request $request){  
       
            $validator=Validator::make($request->all(),[
                'name'=>'required|min:2|max:100',
                'l_name'=>'required|min:2|max:100',
                'email'=>'required|min:2|max:100',
                'phone'=>'required',
                'gender'=>'required|min:2|max:100',
            ]);
            if($validator->fails()){
                return response()->json([
                    'message'=>'Validation fails',
                    'error'=>$validator->errors()
                ],400);
            }

            $user=$request->user();
            
            $user->update([
                'name'=>$request->name,
                'l_name'=>$request->l_name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
            ]);
                return response()->json([
                    'message'=>'Profile Update Successfully',
                ],200);
        
    }



    //Api For Get catgeory

    public static function get_category(){
            $status = Category::get();
            if (count($status)>0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Data Find successfully',
                        'data' => $status
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Data not Found',
                        'data' =>[],
                    ],
                    200
                );
            }
    } 




    // Api For Get Subcatgeory

    public static function get_subcategory(){
            $status = Subcatgeorys::get();
            if (count($status)>0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Data Find successfully',
                        'data' => $status
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Data not Found',
                        'data' =>[],
                    ],
                    200
                );
            }
        }


    //Api For Get Advisor By Counsilar Id
    public static function  shor_by_advisory(Request $request){
        $status = User::where('user_type','1')->where('advisory',$request->advisory)->get();
        if (count($status)>0) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $status
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    //Api For Update Password By User ID
        public static function update_password(Request $request)
        {
            $updateUser = DB::table('users')->where('id',$request->user_id)->update(array('password' =>  Hash::make($request->password)));
        
            if ($updateUser) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Data Update successfully',
                        'data' => $updateUser 
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Data not Updated',
                        'data' =>[],
                    ],
                    200
                );
            }
        }


    //Api For Set Availablity
        
    public static function set_availablity(Request $request){
        
            if($request->isMethod('post')){
                $data = $request->all();
    
                foreach($data['set_availablitys'] as $key => $value){
                    $availability = new SetAvailability();
                    $availability->date = $value['date'];
                    $availability->start_time = $value['start_time'];
                    $availability->end_time = $value['end_time'];
                    $availability->consultant = $value['consultant'];
                    $availability->save();
                }
                // return response()->json(['message'=>'Data added Successfully']);
                if ($data) {
                        return response()->json(
                            [
                                'status' => true,
                                'message' => 'Data Insert successfully',
                                'data' => $data 
                            ],
                            200
                        );
                    } else {
                        return response()->json(
                            [
                                'status' => false,
                                'message' => 'Data not Found',
                                'data' =>[],
                            ],
                            200
                        );
             }
            }
        }

    //Api For Insert Book_An_Appointment
    public static function book_appointment(Request $request)
    {     
        $input = 
        [
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'package_id' => $request->package_id,
        'consultant_id' => $request->consultant_id,
        'vat_no' => $request->vat_no,
        'promocode' => $request->promocode,
        'promo_id' => $request->promo_id,
        'status' => $request->status,
         ];
        $availability = BookAnAppointmentService::create($input);
  
         if ($availability) {
            return response()->json(
            [
                'status' => true,
                'message' => 'Data Insert successfully',
                'data' => $availability 
            ],
            200
             );
             } else {
        return response()->json(
            [
                'status' => false,
                'message' => 'Data not Inserted',
                'data' =>[],
            ],
            200
             );
            }
    }

    //Api For Insert Rating
    public static function rating(Request $request)
    {  
        $input = 
        [
        'rating' => $request->rating,
        // 'user_id' => $request->user_id,
        'counsler_id' => $request->counsler_id,
        ];
        $rating = RatingService::create($input);
  
        if ($rating) {
        return response()->json(
            [
                'status' => true,
                'message' => 'Data Insert successfully',
                'data' => $rating 
            ],
            200
                );
             } else {
        return response()->json(
            [
                'status' => false,
                'message' => 'Data not Inserted',
                'data' =>[],
            ],
            200
            );
            }
    }


     //Api For Insert Rating
     public static function review(Request $request)
     {
         
        $input = 
        [
         'review' => $request->review,  
         'counsler_id' => $request->counsler_id,
 
        ];
         
        $review = ReviewService::create($input);
   
        if ($review) {
         return response()->json(
             [
                 'status' => true,
                 'message' => 'Data Insert successfully',
                 'data' => $review 
             ],
             200
             );
          } else {
         return response()->json(
             [
                 'status' => false,
                 'message' => 'Data not Inserted',
                 'data' =>[],
             ],
             200
         );
         }
     }

     //Api For Insert Book_An_Appointment
    public static function contact_us(ContactUsRequest $request)
    {       
         $input = 
        [
        'user_name' => $request->user_name,
        'phone' => $request->phone,
        'gender' => $request->gender,
        'messages' => $request->messages,
        
        ];    
         $contact = ContactUsService::create($input);
  
            if ($contact) {
        return response()->json(
            [
                'status' => true,
                'message' => 'Data Insert successfully',
                'data' => $contact 
            ],
            200
              );
            }  else {
        return response()->json(
            [
                'status' => false,
                'message' => 'Data not Inserted',
                'data' =>[],
            ],
            200
         );
            }
    }

    //Api For Consultant Review
    public static function consultant_review(Request $request){
        
        $users = DB::table('reviews')
        ->join("users", "users.id", "=", "reviews.counsler_id")
        ->where('reviews.counsler_id',$request->counsler_id)->get();
        if (count($users)>0) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $users
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
        }
    }

    

    //Api For Get Advisor By Counsilar Id
    public static function  availablity_by_consultant(Request $request){
        $result = Rating::where('consultant_id',$request->consultant_id)->get();
         if (count($result)>0) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find successfully',
                    'data' => $result
                ],
                200
            );
             } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' =>[],
                ],
                200
            );
            }
    }

    

    //Api For Get User By advisory Id where user_type =0
     public static function  user_by_advisory(Request $request)
     {
        $result = User::where('user_type','0')->where('advisory',$request->advisory)->get();  
            if (count($result)>0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Data Find successfully',
                        'data' => $result
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Data not Found',
                        'data' =>[],
                    ],
                    200
                );
            }
        }


          //Api For Get Advisory

          public static function  get_package(){
            $package = Package::get();
            if (count($package)>0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Data Find successfully',
                        'data' => $package
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Data not Found',
                        'data' =>[],
                    ],
                    200
                );
            }
        }


    
    public static function logout(Request $request)
    {
        self::getAuthUser();
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    public static function getAuthUser()
    {
        return JWTAuth::parseToken()->authenticate();
    }


}