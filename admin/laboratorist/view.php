<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Laboratorist.php";

    $laboratorist = new Laboratorist();

    $id = 0;
    if(isset($_SESSION['laboratorist_id'])){
        $id = $_SESSION['laboratorist_id'];
        unset($_SESSION['laboratorist_id']);
    }

    $single_laboratorist = $laboratorist ->get_single_laboratorist($id);

    if($single_laboratorist==''){
        
        ?>
            
        <?php
    }
    else{

        $single_laboratorist = mysqli_fetch_array($single_laboratorist);
    }

?>
<title><?php echo $system_data_title;?> View Laboratorist Details - <?php echo $single_laboratorist['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/admin/laboratorist/all" class="btn btn-info">All Laboratorist </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/admin/laboratorist/add" style="margin-left: 10px;" class="btn btn-info">Add Laboratorist </a>
                            <a href="<?php echo BASEPATH?>/admin/laboratorist/action?id=<?php echo $single_laboratorist['laboratorist_id'];?>&action=edit_laboratorist" style="margin-left: 10px;" class="btn btn-info">Edit Laboratorist </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Laboratorist Details</li>
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
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/laboratorist/<?php if($single_laboratorist['image']!=''){ echo $single_laboratorist['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_laboratorist['name']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <h3 class="card-text">Name: <?php echo $single_laboratorist['name']; ?></h3>
                                <h3 class="card-text">Mobile: <?php echo $single_laboratorist['mobile']; ?></h3>
                                <h3 class="card-text">Email: <?php echo $single_laboratorist['email']; ?></h3>
                                <h4 class="card-text">Speciality: <?php echo $single_laboratorist['speciality']; ?></h4>
                                <p class="card-text"><?php echo $single_laboratorist['address']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <?php echo $single_laboratorist['description']; ?>
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
