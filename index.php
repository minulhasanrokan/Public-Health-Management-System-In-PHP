<?php
    session_start();

    require_once __DIR__."/classes/Setting.php";

    $setting = new Setting();

    $system_data = $setting->get_system_data(1);

    $system_data = mysqli_fetch_array($system_data);

?>  
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login - <?php echo $system_data['title'];?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?php echo strip_tags($system_data['description']);?>" name="description" />
        <meta content="<?php echo $system_data['name'];?>" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" type="image/jpg/png" href="<?php echo BASEPATH; ?>/uploads/setting/<?php if($system_data['icon']!=''){ echo $system_data['icon']; } else{ echo "avatar.jpg";}?>">

        <!-- Bootstrap Css -->
        <link href="<?php echo BASEPATH; ?>/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo BASEPATH; ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo BASEPATH; ?>/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <script type="text/javascript">
            
            <?php
                if (isset($_SESSION['meassage_data'])){

                    echo "alert('".$_SESSION['meassage_data']."');";
                    unset($_SESSION['meassage_data']);
                }   
            ?>
           
        </script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    </head>
    <body class="auth-body-bg">
        <div class="bg-overlay"></div>
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="<?php echo BASEPATH; ?>" class="auth-logo">
                                    <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/setting/<?php if($system_data['image']!=''){ echo $system_data['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $system_data['title'];?>" width="100" id="photo"/>
                                </a>
                            </div>
                        </div>
                        <h4 class="text-muted text-center font-size-18"><b>Sign In</b></h4>
                        <div class="p-3">
                            <form class="form-horizontal mt-3" method="POST" autocomplete="off" action="action.php">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <select name="action" id="action" class="form-control" required>
                                          <option value="">Select User Type</option>
                                            <option value="login_patient">Patient</option>
                                            <option value="login_admin">Admin</option>
                                            <option value="login_doctor">Doctor</option>
                                            <option value="login_nurse">Nurse</option>
                                            <option value="login_pharmacist">Pharmacist</option>
                                            <option value="login_laboratorist">Laboratorist</option>
                                            <option style="display: none;" value="login_accountant">Accountant</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" name="user_name" id="user_name" type="text" value="<?php if(isset($_POST['user_name'])){ echo $_POST['user_name']; }?>" required="" placeholder="Username Or Email">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" name="password" id="password" required="" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="form-label ms-1" for="customCheck1">Remember me</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row mt-2">
                                    <div class="col-sm-7 mt-3">
                                        <a href="reset-password" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                    </div>
                                    <div class="col-sm-5 mt-3">
                                        <a href="register" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end -->
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->
        <!-- JAVASCRIPT -->
        <script src="<?php echo BASEPATH; ?>/assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/js/app.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
        <?php
            if(isset($_SESSION['message'])){

                echo "var type = '".$_SESSION['alert-type']."';\n";
            }

            if(isset($_SESSION['message'])){
                ?>
                switch(type){
                    case 'info':
                    toastr.info("<?php echo $_SESSION['message'];?>");
                    break;

                    case 'success':
                    toastr.success("<?php echo $_SESSION['message'];?>");
                    break;

                    case 'warning':
                    toastr.warning("<?php echo $_SESSION['message'];?>");
                    break;

                    case 'error':
                    toastr.error("<?php echo $_SESSION['message'];?>");
                    break; 
                }
                <?php

                unset($_SESSION['message']);
            }
        ?>
        </script>
    </body>
</html>
