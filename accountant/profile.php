<?php require_once 'body/header.php';?>
<?php require_once 'body/left_menu.php';?>


<?php
    require_once __DIR__."/../classes/Accountant.php";

    $accountant = new Accountant();

    $id = 0;
    if(isset($_SESSION['accountantId'])){
        $id = $_SESSION['accountantId'];
    }

    $single_accountant = $accountant ->get_single_accountant($id);

    if($single_accountant==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/accountant/404"; ?>";</script>
        <?php
    }
    else{

        $single_accountant = mysqli_fetch_array($single_accountant);
    }

?>
<title><?php echo $system_data_title;?> View Profile Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/accountant/action?action=edit_profile" style="margin-left: 10px;" class="btn btn-info">Edit Profile </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/accountant">Dashboard</a></li>
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
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/accountant/<?php if($single_accountant['image']!=''){ echo $single_accountant['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_accountant['name']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <h3 class="card-text">Name: <?php echo $single_accountant['name']; ?></h3>
                                <h3 class="card-text">Mobile: <?php echo $single_accountant['mobile']; ?></h3>
                                <h3 class="card-text">Email: <?php echo $single_accountant['email']; ?></h3>
                                <h4 class="card-text">Speciality: <?php echo $single_accountant['speciality']; ?></h4>
                                <p class="card-text"><?php echo $single_accountant['address']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <?php echo $single_accountant['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <?php require_once 'body/footer_content.php';?>
</div>
<!-- end main content-->
<?php require_once 'body/footer.php';?>