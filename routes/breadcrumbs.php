<?php

use App\Services\ManagerLanguageService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

$mls = new ManagerLanguageService('lang_breadcrumbs');
// Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
//     $trail->push('Dashboard', route('home.index'));
// });

// Breadcrumbs::for('subcategories', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('SubCategories', route('sub_categories.index'));
// });

/*------------- Admin Dashboard (Admin Home) -------------*/
// Home
Breadcrumbs::for('admin.dashboard', function ($trail) use ($mls) {
    $trail->push($mls->messageLanguage('only_name', 'dashboard', 2), route('admin.dashboard'));
});

Breadcrumbs::for("admin.profile", function ($trail) use ($mls) {
    $trail->parent("admin.dashboard");
    $trail->push($mls->messageLanguage('only_name', 'profile', 2), route("admin.profile"));
});
Breadcrumbs::for("admin.change-password", function ($trail) use ($mls) {
    $trail->parent("admin.dashboard");
    $trail->push($mls->messageLanguage('only_name', 'change_password', 2), route("admin.change_password"));
});

// general Settings
Breadcrumbs::for('admin.settings.edit_general', function ($trail) {
    $trail->parent("admin.dashboard");
    $trail->push('Settings - General', route("admin.settings.edit_general"));
});

Breadcrumbs::macro('resource', function ($name, $title, $list = false) {
    // Home > $title
    Breadcrumbs::for("admin.$name.index", function ($trail) use ($name, $title) {
        $trail->parent("admin.dashboard");
        $trail->push($title, route("admin.$name.index"));
    });
   
    // Home > $title > Add New
    Breadcrumbs::for("admin.$name.create", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push("Add New $title", route("admin.$name.create"));
    });
// My Changes
      Breadcrumbs::for("admin.$name.excel", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push("Add New $title", route("admin.$name.excel"));
    });
//      
    // Home > $title > Edit
    Breadcrumbs::for("admin.$name.edit", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push("Edit $title", url("admin/$name/{id}/edit"));
    });
    // Home > $title > Details
    Breadcrumbs::for("admin.$name.show", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push(" Details", url("admin/$name/{id}"));
    });
    Breadcrumbs::for("admin.$name.rating", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push(" Details", url("admin/$name/{id}"));
    });
     Breadcrumbs::for("admin.$name.win", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push(" Details", url("admin/$name/{id}"));
    });
    if ($list == true) {
        Breadcrumbs::for("admin.$name.list", function ($trail) use ($name, $title) {
            $trail->parent("admin.dashboard");
            $trail->push($title, route("admin.$name.list"));
        });
    }
});

/*------------- Admin Users ------------------------*/
Breadcrumbs::resource('users', $mls->messageLanguage('only_name', 'user', 2));
/*------------- Admin Roles ------------------------*/
Breadcrumbs::resource('roles', $mls->messageLanguage('only_name', 'role', 2));
/*------------- Admin Permissions ------------------------*/
Breadcrumbs::resource('permissions', $mls->messageLanguage('only_name', 'permission', 2));

/*------------- Admin Battles ------------------------*/
Breadcrumbs::resource('battles', $mls->messageLanguage('only_name', 'battle', 2));

/*------------- Admin Consultants ------------------------*/
Breadcrumbs::resource('consultants', $mls->messageLanguage('only_name', 'consultant', 2));

/*------------- Admin Advisory ------------------------*/
Breadcrumbs::resource('advisorys', $mls->messageLanguage('only_name', 'advisory', 2));

/*------------- Admin Category ------------------------*/
Breadcrumbs::resource('categorys', $mls->messageLanguage('only_name', 'petcategory', 2));

/*------------- Admin SubCategory ------------------------*/
Breadcrumbs::resource('subcategorys', $mls->messageLanguage('only_name', 'petsubcategory', 2));

/*------------- Admin User Service Type ------------------------*/
Breadcrumbs::resource('userservices', $mls->messageLanguage('only_name', 'userservice', 2));

/*------------- Admin hostel company ------------------------*/
Breadcrumbs::resource('hostelservices', $mls->messageLanguage('only_name', 'hostelservice', 2)); 

/*------------- Admin hostel add service ------------------------*/
Breadcrumbs::resource('hosteladdsers', $mls->messageLanguage('only_name', 'hosteladdser', 2)); 

/*------------- Admin hostel appoinment ------------------------*/
Breadcrumbs::resource('appoinments', $mls->messageLanguage('only_name', 'appoinment', 2));

/*------------- Admin doctor availbilty ------------------------*/
Breadcrumbs::resource('doctoravas', $mls->messageLanguage('only_name', 'doctorava', 2));

/*------------- Admin doctor capacitys ------------------------*/
Breadcrumbs::resource('doctorcapacitys', $mls->messageLanguage('only_name', 'doctorcapacity', 2));

/*------------- Admin doctor apt slot ------------------------*/
Breadcrumbs::resource('doctoraptsolts', $mls->messageLanguage('only_name', 'doctoraptsolt', 2));

/*------------- Admin trainer capacity ------------------------*/
Breadcrumbs::resource('trainercapacitys', $mls->messageLanguage('only_name', 'trainercapacity', 2));

/*------------- Admin trainer appt slot ------------------------*/
Breadcrumbs::resource('trainerappslots', $mls->messageLanguage('only_name', 'trainerappslot', 2));

/*------------- Admin sallon availbilty ------------------------*/
Breadcrumbs::resource('sallonavas', $mls->messageLanguage('only_name', 'sallonava', 2));

/*------------- Admin sallon appt slot ------------------------*/
Breadcrumbs::resource('sallonappslots', $mls->messageLanguage('only_name', 'sallonappslot', 2));

/*------------- Admin sallon appoinment ------------------------*/
Breadcrumbs::resource('sallonappionments', $mls->messageLanguage('only_name', 'sallonappionment', 2));

/*------------- Admin sallon services ------------------------*/
Breadcrumbs::resource('sallonservices', $mls->messageLanguage('only_name', 'sallonservice', 2));

/*------------- Admin sallon ------------------------*/
Breadcrumbs::resource('sallons', $mls->messageLanguage('only_name', 'sallon', 2));

/*------------- Admin user address ------------------------*/
Breadcrumbs::resource('useradds', $mls->messageLanguage('only_name', 'useradd', 2));

/*------------- Admin customer appoinment ------------------------*/
Breadcrumbs::resource('customers', $mls->messageLanguage('only_name', 'customer', 2));

/*------------- Admin sallon appt capacity ------------------------*/
Breadcrumbs::resource('sallonapptcapacitys', $mls->messageLanguage('only_name', 'sallonapptcapacity', 2));

/*------------- Admin trainer appoinment ------------------------*/
Breadcrumbs::resource('trainerappoinments', $mls->messageLanguage('only_name', 'trainerappoinment', 2));

/*------------- Admin trainer availbilty ------------------------*/
Breadcrumbs::resource('traineravas', $mls->messageLanguage('only_name', 'trainerava', 2));

/*------------- Admin trainer service ------------------------*/
Breadcrumbs::resource('trainerservices', $mls->messageLanguage('only_name', 'trainerservice', 2));

/*------------- Admin trainer image ------------------------*/
Breadcrumbs::resource('trainerimages', $mls->messageLanguage('only_name', 'trainerimage', 2));

/*------------- Admin doctor appoinment ------------------------*/
Breadcrumbs::resource('doctorappoinments', $mls->messageLanguage('only_name', 'doctorappoinment', 2));

/*------------- Admin doctor service ------------------------*/
Breadcrumbs::resource('doctorsers', $mls->messageLanguage('only_name', 'doctorser', 2));

/*------------- Admin hostel availbilty ------------------------*/
Breadcrumbs::resource('hostelavailbiltys', $mls->messageLanguage('only_name', 'hostelavailbilty', 2));

/*------------- Admin doctor clinic image ------------------------*/
Breadcrumbs::resource('doctorimages', $mls->messageLanguage('only_name', 'doctorimage', 2));

/*------------- Admin doctor speciality ------------------------*/
Breadcrumbs::resource('docspecialitys', $mls->messageLanguage('only_name', 'docspeciality', 2));

/*------------- Admin hostel profile ------------------------*/
Breadcrumbs::resource('hostelprofiles', $mls->messageLanguage('only_name', 'hostelprofile', 2));

/*------------- Admin Petdetails ------------------------*/
Breadcrumbs::resource('petdetails', $mls->messageLanguage('only_name', 'petdetail', 2)); 

/*------------- Admin Managehostelservice ------------------------*/
Breadcrumbs::resource('managehostels', $mls->messageLanguage('only_name', 'managehostel', 2)); 

/*------------- Admin Appointment ------------------------*/
Breadcrumbs::resource('bookanappointments', $mls->messageLanguage('only_name', 'bookanappointment', 2));

/*------------- Admin Notification ------------------------*/
Breadcrumbs::resource('notifications', $mls->messageLanguage('only_name', 'notification', 2));

/*------------- Admin Package ------------------------*/
Breadcrumbs::resource('packages', $mls->messageLanguage('only_name', 'package', 2));

/*------------- Admin Contact Us ------------------------*/
Breadcrumbs::resource('contactus', $mls->messageLanguage('only_name', 'contactus', 2));

/*------------- Admin Promocode ------------------------*/
Breadcrumbs::resource('promocodes', $mls->messageLanguage('only_name', 'promocode', 2)); 