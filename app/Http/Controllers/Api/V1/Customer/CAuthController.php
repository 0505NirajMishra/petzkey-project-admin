<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiConsultantLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Http\Requests\Admin\PetDetailRequest;

use App\Http\Requests\Admin\DoctorSpeRequest;

use App\Http\Requests\Admin\TrainerImageRequest;

use App\Http\Requests\Admin\TrainerCapacityRequest;

use App\Http\Requests\Admin\TrainerApptslotRequest;

use App\Http\Requests\Admin\DoctorAvaRequest;

use App\Http\Requests\Admin\DoctorAppslotRequest;

use App\Http\Requests\Admin\DoctorAppoinmentRequest;

use App\Http\Requests\Admin\DoctorImageRequest;

use App\Http\Requests\Admin\DoctorCapacityRequest;

use App\Http\Requests\Admin\DoctorRequest;

use App\Http\Requests\Admin\ClinicServiceRequest;

use App\Http\Requests\Admin\HostelProfileRequest;

use App\Http\Requests\Admin\HostelAvaRequest; 

use App\Http\Requests\Admin\HostelAppoinmentRequest; 

use App\Http\Requests\Admin\HostelSerRequest;

use App\Http\Requests\Admin\DoctorServiceRequest;
use App\Http\Requests\Admin\ManagehostelserviceRequest;
use App\Http\Requests\Admin\HostelServiceRequest;
use App\Http\Requests\ApiChangePasswordRequest;
use App\Http\Requests\ApiConsultantRequest;
use App\Http\Requests\Admin\ContactUsRequest;
use App\Services\Api\AuthService;
use App\Models\User;
use App\Services\HelperService;
use App\Services\UserService;
use App\Services\ConsultantService;
use App\Services\WalletService;
use Illuminate\Http\Request;

class CAuthController extends Controller
{

    protected $helperService, $userService, $apiAuthService,$walletService;

    public function __construct()
    {
        $this->helperService = new HelperService();
        $this->userService = new UserService(); 
        $this->apiAuthService = new AuthService();
    }

     /**
     * Authenticate user Check.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function login(ApiLoginRequest $request)
    {
        return $this->apiAuthService->login($request);
    }

     /*
     ** Register user.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
     // public function user_register(Request $request)
    
    public function register(ApiRegisterRequest $request)
    {
        $request->merge(['role' => 'Customer']);
        return $this->apiAuthService->register($request);
    }

    // post hostel service

    public function hostelservice(HostelServiceRequest $request)
    {
        return $this->apiAuthService->hostelservice($request);
    } 



    // post doctor 

    public function adddoctor(DoctorRequest $request)
    {
        return $this->apiAuthService->adddoctor($request);
    } 

    // add doctor service

    public function adddoctorservice(DoctorServiceRequest $request)
    {
        return $this->apiAuthService->adddoctorservice($request);
    } 

    // add clinic 

    public function addclinic(ClinicServiceRequest $request)
    {
        return $this->apiAuthService->addclinic($request);
    }

    // add hostel service add 

    public function addhostelservice(HostelSerRequest $request)
    {
        return $this->apiAuthService->addhostelservice($request);
    }

    // add hostel profile 

    public function addhostelprofile(HostelProfileRequest $request)
    {
        return $this->apiAuthService->addhostelprofile($request);
    }


    // add hostel appoinment 

    public function addhostelappoinment(HostelAppoinmentRequest $request)
    {
        return $this->apiAuthService->addhostelappoinment($request);
    }

    // get hostel service

    public function gethostelser()
    {
        return $this->apiAuthService->gethostelser();
    }

    // get hostel profile 

    public function gethostelprofile()
    {
        return $this->apiAuthService->gethostelprofile();
    }

    // get hostel appoinment 

    public function gethostelappoinment()
    {
        return $this->apiAuthService->gethostelappoinment();
    }


    // delete hostel appoinment 
    
    public function deletehostelappoinment($id)
    {
        return $this->apiAuthService->deletehostelappoinment($id);
    }


    // delete hostel profile 

    public function deletehostelprofile($id)
    {
        return $this->apiAuthService->deletehostelprofile($id);
    }

    // hostel availbilty

    public function hostelavailbilty(HostelAvaRequest $request)
    {
        return $this->apiAuthService->hostelavailbilty($request);
    }

    // add doctor availbilty 

    public function docavailbilty(DoctorAvaRequest $request)
    {
        return $this->apiAuthService->docavailbilty($request);
    }

    // get doctor availbilty 

    public function getdocavailbilty()
    {
        return $this->apiAuthService->getdocavailbilty();
    }

    // delete doctor availbilty 

    public function deletedocavailbilty($id)
    {
        return $this->apiAuthService->deletedocavailbilty($id);
    } 

    // update doctor availbilty 

    public function updatedocavailbilty(Request $request,$id)
    {
        return $this->apiAuthService->updatedocavailbilty($request,$id);
    }


    // add doctor image 

    public function adddoctorimage(DoctorImageRequest $request)
    {
        return $this->apiAuthService->adddoctorimage($request);
    }

    // get doctor image detail 

    public function getdoctorimage()
    {
        return $this->apiAuthService->getdoctorimage();
    }

    // delete doctor image record 

    public function deletedoctorimage($id)
    {
        return $this->apiAuthService->deletedoctorimage($id);
    } 

    // update doctor image

    public function updatedoctorimage(Request $request,$id)
    {
        return $this->apiAuthService->updatedoctorimage($request,$id);
    }




    // add doctor capacitor 

    public function adddoctorcapacitor(DoctorCapacityRequest $request)
    {
        return $this->apiAuthService->adddoctorcapacitor($request);
    }

    // get doctor capacitor 

    public function getdoctorcapacitor(){
        return $this->apiAuthService->getdoctorcapacitor();
    }

    // delete doctor capacitor 

    public function deletedoctorcapacitor($id)
    {
        return $this->apiAuthService->deletedoctorcapacitor($id);
    }

    // update doctor capacitor

    public function updatedoctorcapacitor(Request $request,$id){
        return $this->apiAuthService->updatedoctorcapacitor($request,$id);
    }

    // get doctor apt slot 

    public function getdoctorslot()
    {
        return $this->apiAuthService->getdoctorslot();
    }

    // add doctor apt slot 

    public function adddoctorslot(DoctorAppslotRequest $request){
        return $this->apiAuthService->adddoctorslot($request);
    }
    
    // delete doctor apt slot 

    public function deletedoctorslot($id){
        return $this->apiAuthService->deletedoctorslot($id);
    }

    // update doctor apt slot 

    public function updatedoctorslot(Request $request,$id)
    {
        return $this->apiAuthService->updatedoctorslot($request,$id);
    }

    // get doctor appoinment 

    public function getdoctorappoinment()
    {
        return $this->apiAuthService->getdoctorappoinment();
    }


    // add doctor appoinment 

    public function adddoctorappoinment(DoctorAppoinmentRequest $request){
        return $this->apiAuthService->adddoctorappoinment($request);
    }

    // delete doctor appoinment 

    public function deletedoctorappoinment($id){
        return $this->apiAuthService->deletedoctorappoinment($id);
    }
    
    // update doctor appoinment 

    public function updatedoctorappoinment(Request $request,$id)
    {
        return $this->apiAuthService->updatedoctorappoinment($request,$id);
    }

    // doctor spe

    public function doctorspe(DoctorSpeRequest $request)
    {
        return $this->apiAuthService->doctorspe($request);
    }

    // get doctor spe 

    public function getdoctorspe(){

        return $this->apiAuthService->getdoctorspe();
    } 

    // delete doctor spe 

    public function deletedoctorspe($id)
    {
        return $this->apiAuthService->deletedoctorspe($id);
    }

    // update doctor spe 

    public function updatedoctorspecialist(Request $request,$id)
    {
        return $this->apiAuthService->updatedoctorspecialist($request,$id);
    }

    // update hostel availbilty

    public function updatehostelavailbilty(Request $request,$id){
        return $this->apiAuthService->updatehostelavailbilty($request,$id);
    }

  
    // get hostel availbilty 

    public function gethostelavailbilty()
    {
        return $this->apiAuthService->gethostelavailbilty();
    }

    // delete hostel service 

    public function deletehostelservice($id)
    {
        return $this->apiAuthService->deletehostelservice($id);
    }

    // delete hostel availbilty 

    public function deletehostelavailbilty($id){
        return $this->apiAuthService->deletehostelavailbilty($id);
    }


    // get doctor service list 

    public function getdoctorservice()
    {
        return $this->apiAuthService->getdoctorservice();
    } 

    // get clinic record 

    public function getclinicrecord()
    {
        return $this->apiAuthService->getclinicrecord();
    } 

    // delete clinic record

    public function clinicdelete($id)
    {
        return $this->apiAuthService->clinicdelete($id);
    }

    // delete doctor service record

    public function deletedoctorservice($id)
    {
        return $this->apiAuthService->deletedoctorservice($id);
    }

    // get trainer profile 

    public function gettrainerprofile()
    {
        return $this->apiAuthService->gettrainerprofile();
    }

    // add trainer profile

    public function addtrainerprofile(TrainerImageRequest $request)
    {
        return $this->apiAuthService->addtrainerprofile($request);
    }

    // delete trainer profile 

    public function deletetrainerprofile($id)
    {
        return $this->apiAuthService->deletetrainerprofile($id);
    }


    // update trainer profile

    public function updatetrainerprofile(Request $request,$id)
    {
        return $this->apiAuthService->updatetrainerprofile($request,$id);
    }

    // get trainer capacity

    public function gettrainercapacity()
    {
        return $this->apiAuthService->gettrainercapacity();
    }

    // add trainer capacity

    public function addtrainercapacity(TrainerCapacityRequest $request)
    {
        return $this->apiAuthService->addtrainercapacity($request);
    }

    // delete trainer capacity

    public function deletetrainercapacity($id)
    {
        return $this->apiAuthService->deletetrainercapacity($id);
    }

    // update trainer capacity

    public function updatetrainercapacity(Request $request,$id)
    {
        return $this->apiAuthService->updatetrainercapacity($request,$id);
    }


    // get trainer appt slot

    public function gettrainerapptslot()
    {
        return $this->apiAuthService->gettrainerapptslot();
    }

    // add trainer appt slot

    public function addtrainerapptslot(TrainerApptslotRequest $request)
    {
        return $this->apiAuthService->addtrainerapptslot($request);
    }

    // delete trainer appt slot

    public function deletetrainerapptslot($id)
    {
        return $this->apiAuthService->deletetrainerapptslot($id);
    }

    // update trainer appt slot

    public function updatetrainerapptslot(Request $request,$id)
    {
        return $this->apiAuthService->updatetrainerapptslot($request,$id);
    }

    
    // get doctor list

    public function getdoctorprofile()
    {
        return $this->apiAuthService->getdoctorprofile();
    } 

    // update pet details 

    public function updatepetdetails(PetDetailRequest $request,$id)
    {
        return $this->apiAuthService->updatepetdetails($request,$id);
    }
    
    // update hostel service company 

    public function updatehostelservice(Request $request,$id)
    {
        return $this->apiAuthService->updatehostelservice($request,$id);
    } 

    // update hostel add service 

    public function updatehostelser(Request $request,$id)
    {
        return $this->apiAuthService->updatehostelser($request,$id);
    } 

    // update hostel service appoinment

    public function updatehostelappoinment(Request $request,$id)
    {
        return $this->apiAuthService->updatehostelappoinment($request,$id);
    }

    // delete hostel service 

    public function deleteservice($id)
    {
        return $this->apiAuthService->deleteservice($id);
    }

    // delete doctor record

    public function deletedoctor($id)
    {
        return $this->apiAuthService->deletedoctor($id);
    }

    // delete pet detail

    public function petdetaildelete($id)
    {
        return $this->apiAuthService->petdetaildelete($id);
    }

    // delete manage hostel service 

    public function managehostelservicedelete($id)
    {
        return $this->apiAuthService->managehostelservicedelete($id);
    }

    // add pet detail 

    public function addpetdetail(PetDetailRequest $request)
    {
        return $this->apiAuthService->addpetdetail($request);
    } 

    // add managehostelservice 

    public function managehostelservice(ManagehostelserviceRequest $request)
    {
        return $this->apiAuthService->managehostelservice($request);
    } 

    // get manage hostel service list

    public function get_manageservice()
    {
        return $this->apiAuthService->get_manageservice();
    }

    // get pet list 

    public function get_petdetail()
    {
        return $this->apiAuthService->get_petdetail();
    }

   
    //Update User Notification
    
    public function update_notification(Request $request)
    {
        return $this->apiAuthService->update_notification($request);
    }

    //Update User Profile
    
    public function user_edit_profile(Request $request)
    {
        return $this->apiAuthService->user_edit_profile($request);
    }

    //Change User Password
    
    public function user_change_password(Request $request)
    {
        return $this->apiAuthService->user_change_password($request);
    }

    
    //Get All Category 

    public function get_category()
    {
        return $this->apiAuthService->get_category();
    }

    // get All Subcategory

    public function get_subcategory()
    {
        return $this->apiAuthService->get_subcategory();
    }


    //Get Insert Book Appointment
    public function book_appointment(Request $request)
    {
        return $this->apiAuthService->book_appointment($request);
    }

    //Set Availablity
    public function set_availablity(Request $request)
    {  
        return $this->apiAuthService->set_availablity($request);
    }

    //Rating
    public function rating(Request $request)
    {  
        return $this->apiAuthService->rating($request);
    }

     //Review
     public function review(Request $request)
     {   
         return $this->apiAuthService->review($request);
     }

     //Contact US
     public function contact_us(ContactUsRequest $request)
     {  
          return $this->apiAuthService->contact_us($request);
     }
     


    // Update Consultant Password  By user_id 

    public function update_password(Request $request)
    {
        return $this->apiAuthService->update_password($request);
        
    }

    //Advisory By Counsiler 

    public function shor_by_advisory(Request $request)
    {
        
        return $this->apiAuthService->shor_by_advisory($request);
        
    }

    //Advisory By Counsiler
    public function consultant_review(Request $request)
    {
        return $this->apiAuthService->consultant_review($request);
    }


      //Availablity By Counsiler
      public function availablity_by_consultant(Request $request)
      {
          
          return $this->apiAuthService->availablity_by_consultant($request);
          
      }

         //User By Advisory
         public function user_by_advisory(Request $request)
         {
             
             return $this->apiAuthService->user_by_advisory($request);
             
         }

         // public function verify_mail(Request $request)
         // {       
         //        return $this->apiAuthService->verify_mail($request);
         // }

    public function get_package(Request $request)
    {
        return $this->apiAuthService->get_package($request);   
    }
 
     /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function logout(Request $request)
    {
        return $this->apiAuthService->logout($request);
    }
   
}