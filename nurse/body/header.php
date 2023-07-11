<?php
require_once __DIR__."/../../config/Config.php";
require_once __DIR__."/../../lib/Session.php";
Session::checkSession();

if(!isset($_SESSION['nurseStatus'])){
  
  Session::destroySession();
} 

if(isset($_GET['status']) && $_GET['status']=='logout'){
  
    require_once __DIR__."/../../classes/Login.php";
    
    $login = new Login();

    $user_id = $_SESSION['nurseId'];

    $status = $login->add_logout_history(3,$user_id);

    if($status==1)
    {
        Session::destroySession();
    }
}

require_once __DIR__."/../../classes/Setting.php";
require_once __DIR__."/../../classes/Nurse.php";

$setting = new Setting();
$nurse = new Nurse();

$user_id = '';

if(isset($_SESSION['nurseId']))
{
    $user_id = $_SESSION['nurseId'];
}


$nurse_data = $nurse->get_single_nurse($user_id);
$nurse_data = mysqli_fetch_array($nurse_data);

$system_data = $setting->get_system_data(1);
$system_data = mysqli_fetch_array($system_data);

$system_data_title = '';

if(!empty($system_data['title']))
{
    //$system_data_title = $system_data['title']." -";
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?php echo strip_tags($system_data['description']);?>" name="description" />
        <meta content="<?php echo $system_data['name'];?>" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" type="image/jpg/png" href="<?php echo BASEPATH; ?>/uploads/setting/<?php if($system_data['icon']!=''){ echo $system_data['icon']; } else{ echo "avatar.jpg";}?>">
        <!-- jquery.vectormap css -->
        <link href="<?php echo BASEPATH; ?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="<?php echo BASEPATH; ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BASEPATH; ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BASEPATH; ?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?php echo BASEPATH; ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />  

        <!-- Bootstrap Css -->
        <link href="<?php echo BASEPATH; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo BASEPATH; ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo BASEPATH; ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
        <script src="<?php echo BASEPATH; ?>/assets/ckeditor/ckeditor.js"></script>
        <link href="<?php echo BASEPATH; ?>/assets/ckeditor/contents.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-topbar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="<?php echo BASEPATH; ?>/nurse" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?php echo BASEPATH; ?>/uploads/setting/<?php if($system_data['image']!=''){ echo $system_data['image']; } else{ echo "avatar.jpg";}?>" alt="<?php echo $system_data['title'];?>" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo BASEPATH; ?>/uploads/setting/<?php if($system_data['image']!=''){ echo $system_data['image']; } else{ echo "avatar.jpg";}?>" alt="<?php echo $system_data['title'];?>" height="20">
                                </span>
                            </a>

                            <a href="<?php echo BASEPATH; ?>/nurse" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?php echo BASEPATH; ?>/uploads/setting/<?php if($system_data['image']!=''){ echo $system_data['image']; } else{ echo "avatar.jpg";}?>" alt="<?php echo $system_data['name'];?>" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo BASEPATH; ?>/uploads/setting/<?php if($system_data['image']!=''){ echo $system_data['image']; } else{ echo "avatar.jpg";}?>" alt="<?php echo $system_data['name'];?>t" height="20">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="ri-menu-2-line align-middle"></i>
                        </button>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-search-line"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                    
                                <form class="p-3">
                                    <div class="mb-3 m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block user-dropdown">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?php echo BASEPATH; ?>/uploads/nurse/<?php if($nurse_data['image']!=''){ echo $nurse_data['image']; } else{ echo "avatar.jpg";}?>"
                                    alt="<?php echo $nurse_data['name'];?>">
                                <span class="d-none d-xl-inline-block ms-1"><?php echo $nurse_data['name'];?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="<?php echo BASEPATH;?>/nurse/profile"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                                <a class="dropdown-item d-block" href="<?php echo BASEPATH;?>/nurse/change-password"><i class="mdi mdi-onepassword align-middle me-1"></i>Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="?status=logout"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                            </div>
                        </div>
            
                    </div>
                </div>
            </header>