<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Blood.php";

    $blood = new Blood();

    $id = 0;
    if(isset($_SESSION['blood_group_id'])){
        $id = $_SESSION['blood_group_id'];
        unset($_SESSION['blood_group_id']);
    }

    $single_blood_group = $blood ->get_single_blood_group($id);

    if($single_blood_group==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/laboratorist/blood-bank/404"; ?>";</script>
        <?php
    }
    else{

        $single_blood_group = mysqli_fetch_array($single_blood_group);
    }

?>
<title><?php echo $system_data_title;?> View Blood Group Details - <?php echo $single_blood_group['name']; ?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/laboratorist/blood-bank/action?action=edit_blood_group&id=<?php echo $single_blood_group['blood_group_id']; ?>" style="margin-left: 10px;" class="btn btn-info">Edit Blood Group </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/laboratorist">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Blood Group Details</li>
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
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/blood_group/<?php if($single_blood_group['image']!=''){ echo $single_blood_group['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_blood_group['name']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <h3 class="card-text">Name: <?php echo $single_blood_group['name']; ?></h3>
                                <h3 class="card-text">Mobile: <?php echo $single_blood_group['mobile']; ?></h3>
                                <h3 class="card-text">Email: <?php echo $single_blood_group['email']; ?></h3>
                                <h4 class="card-text">Blood Group: <?php echo $single_blood_group['blood_group']; ?></h4>
                                <p class="card-text"><?php echo $single_blood_group['address']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <?php echo $single_blood_group['description']; ?>
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





        