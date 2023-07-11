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
        <title>Register - <?php echo $system_data['title'];?></title>
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
    
                        <h4 class="text-muted text-center font-size-18"><b>Register</b></h4>

                        <div class="p-3">
                            <form method="POST" class="form-horizontal mt-3" action="action">
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="text" name="mobile" id="mobile" required="" placeholder="Enter Your Mobile Number" maxlength="11" value="<?php if(isset($_POST['email'])){ echo $_POST['mobile']; }?>">
                                        <input class="form-control" type="hidden" name="action" id="action" value="patient_register" required>
                                    </div>
                                </div>
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="email" name="email" id="email" required="" placeholder="Enter Your Email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; }?>">
                                    </div>
                                </div>
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" required="" name="password" id="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" name="c_password" id="c_password" required="" placeholder="Confirm Password">
                                    </div>
                                </div>
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="customCheck1" required>
                                            <label class="form-label ms-1 fw-normal" for="customCheck1">I accept <a href="#" class="text-muted">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </div>
    
                                <div class="form-group mt-2 mb-0 row">
                                    <div class="col-12 mt-3 text-center">
                                        <a href="<?php echo BASEPATH; ?>/" class="text-muted">Already have account?</a>
                                    </div>
                                </div>
                            </form>
                            <!-- end form -->
                        </div>
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

    </body>
</html>
