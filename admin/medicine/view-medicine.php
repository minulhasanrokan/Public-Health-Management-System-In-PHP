<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Medicine.php";

    $medicine = new Medicine();

    $id = 0;
    if(isset($_SESSION['medicine_id'])){
        $id = $_SESSION['medicine_id'];
        unset($_SESSION['medicine_id']);
    }

    $single_medicine = $medicine ->get_single_medicine($id);

    if($single_medicine==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/medicine/404"; ?>";</script>
        <?php
    }
    else{

        $single_medicine = mysqli_fetch_array($single_medicine);
    }

?>
<title><?php echo $system_data_title;?> View Medicine Details - <?php echo $single_medicine['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/admin/medicine/all-medicine" class="btn btn-info">All Medicine</a>&nbsp;
                            <a href="<?php echo BASEPATH?>/admin/medicine/add-medicine" style="margin-left: 10px;" class="btn btn-info">Add Medicine</a>
                            <a href="<?php echo BASEPATH?>/admin/medicine/action?id=<?php echo $single_medicine['medicine_id'];?>&action=edit_medicine" style="margin-left: 10px;" class="btn btn-info">Edit Medicine</a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
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
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/medicine/<?php if($single_medicine['image']!=''){ echo $single_medicine['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_medicine['name']; ?>">
                            <div class="card-body">
                                <h3 class="card-text">Name :<?php echo $single_medicine['name']; ?></h3>
                                <h3 class="card-text">Buy Price :<?php echo $single_medicine['buy_price']; ?></h3>
                                <h3 class="card-text">Regular Name :<?php echo $single_medicine['regular_price']; ?></h3>
                                <h3 class="card-text">Sale Name :<?php echo $single_medicine['sale_price']; ?></h3>
                                <h4 class="card-text">Category Name :<a href="<?php echo BASEPATH;?>/admin/medicine/action?id=<?php echo $single_medicine['category_id'];?>&action=view_medicine_category"><?php echo $single_medicine['category_name'];?></a></h4>
                                <?php echo $single_medicine['description']; ?>
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





        