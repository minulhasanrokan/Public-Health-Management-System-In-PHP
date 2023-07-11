<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Floor.php";

    $floor = new Floor();

    $id = 0;
    if(isset($_SESSION['bed_id'])){
        $id = $_SESSION['bed_id'];
        unset($_SESSION['bed_id']);
    }

    $single_bed = $floor ->get_single_bed($id);

    if($single_bed==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/nurse/bed/404"; ?>";</script>
        <?php
    }
    else{

        $single_bed = mysqli_fetch_array($single_bed);
    }

?>
<title><?php echo $system_data_title;?> View Bed Details - <?php echo $single_bed['name']; ?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/nurse/bed/all" class="btn btn-info">All bed </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/nurse/bed/add" style="margin-left: 10px;" class="btn btn-info">Add bed </a>
                            <a href="<?php echo BASEPATH?>/nurse/bed/action?id=<?php echo $single_bed['bed_id'];?>&action=edit_bed" style="margin-left: 10px;" class="btn btn-info">Edit bed </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Bed Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card-group">
                        <div class="card mb-12">
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/bed/<?php if($single_bed['image']!=''){ echo $single_bed['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_bed['name']; ?>">
                            <div class="card-body">
                                <h3 class="card-text"><?php echo $single_bed['name']; ?></h3>
                                <h4 class="card-text"><?php echo $single_bed['floor_name']; ?></h4>
                                <h4 class="card-text"><?php echo $single_bed['department_name']; ?></h4>
                                <?php echo $single_bed['description']; ?>
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





        