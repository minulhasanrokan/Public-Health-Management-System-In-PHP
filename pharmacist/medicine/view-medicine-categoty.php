<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Medicine.php";

    $medicine = new Medicine();

    $id = 0;
    if(isset($_SESSION['medicine_category_id'])){
        $id = $_SESSION['medicine_category_id'];
        unset($_SESSION['medicine_category_id']);
    }

    $single_category = $medicine ->get_single_medicine_category($id);

    if($single_category==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/pharmacist/medicine/404"; ?>";</script>
        <?php
    }
    else{

        $single_category = mysqli_fetch_array($single_category);
    }

?>
<title><?php echo $system_data_title;?> View Medicine Category Details - <?php echo $single_category['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/pharmacist/medicine/all-category" class="btn btn-info">All Medicine Category </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/pharmacist/medicine/add-category" style="margin-left: 10px;" class="btn btn-info">Add Medicine Category </a>
                            <a href="<?php echo BASEPATH?>/pharmacist/medicine/action?id=<?php echo $single_category['category_id'];?>&action=edit_medicine_category" style="margin-left: 10px;" class="btn btn-info">Edit Medicine Category </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/pharmacist">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Medicine Category Details</li>
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
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/medicine/<?php if($single_category['image']!=''){ echo $single_category['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_category['name']; ?>">
                            <div class="card-body">
                                <h3 class="card-text"><?php echo $single_category['name']; ?></h3>
                                <h4 class="card-text"><?php echo $single_category['title']; ?></h4>
                                <?php echo $single_category['description']; ?>
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





        