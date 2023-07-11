<?php require_once __DIR__.'/body/header.php';?>
<?php require_once __DIR__.'/body/left_menu.php';?>

<?php
    require_once __DIR__."/../classes/Medicine.php";
    
    $medicine = new Medicine();
    $number_of_medicine_category = $medicine->number_of_pmedicine_category();
    $number_of_medicine = $medicine->number_of_medicine();

?>
<title><?php echo $system_data_title;?> Dashboard</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/pharmacist/medicine/all-category">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Medicine Category</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_medicine_category)){ echo $number_of_medicine_category;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="mdi mdi-medical-bag font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>
                            </a>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/pharmacist/medicine/all-medicine">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Medicine</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_medicine)){ echo $number_of_medicine;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="mdi mdi-medical-bag font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>
                            </a>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">All Notice</h4>
                            <div class="table-responsive" id="notice_div">
                                <?php require_once 'body/notice.php';?>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        
    </div>
    <!-- End Page-content -->

    <?php require_once __DIR__.'/body/footer_content.php';?>
    
</div>
<!-- end main content-->

<?php require_once __DIR__.'/body/footer.php';?>

        