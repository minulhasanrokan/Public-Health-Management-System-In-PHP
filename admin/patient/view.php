<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Patient.php";

    $patient = new Patient();

    $id = 0; 
    if(isset($_SESSION['patient_id'])){
        $id = $_SESSION['patient_id'];
    }

    $single_patient = $patient ->get_single_patient($id);

    if($single_patient==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/patient/404"; ?>";</script>
        <?php
    }
    else{

        $single_patient = mysqli_fetch_array($single_patient);
    }

?>
<title><?php echo $system_data_title;?> View Patient Details - <?php echo $single_patient['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/admin/patient/all" class="btn btn-info">All Patient </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/admin/patient/add" style="margin-left: 10px;" class="btn btn-info">Add Patient </a>
                            <a href="<?php echo BASEPATH?>/admin/patient/action?id=<?php echo $single_patient['patient_id']; ?>&action=edit_patient" style="margin-left: 10px;" class="btn btn-info">Edit Patient </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Profile Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-4">
                    <div class="card-group">
                        <div class="card mb-12">
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/patient/<?php if($single_patient['image']!=''){ echo $single_patient['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_patient['name']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <h4 class="card-text">Name: <?php echo $single_patient['name']; ?></h4>
                                <h4 class="card-text">Mobile: <?php echo $single_patient['mobile']; ?></h4>
                                <h4 class="card-text">Email: <?php echo $single_patient['email']; ?></h4>
                                <h4 class="card-text">Gender: <?php echo $single_patient['sex']; ?></h4>
                                <h4 class="card-text">Date Of Birth: <?php if($single_patient['birth_date']!=''){ echo date("d-m-Y", strtotime($single_patient['birth_date'])); } ?></h4>
                                <p><?php echo $single_patient['address']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <?php echo $single_patient['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <?php require_once __DIR__.'/../body/footer_content.php';?>
</div>
<!-- end main content-->
<?php require_once __DIR__.'/../body/footer.php';?>
