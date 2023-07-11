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

    $all_category = $medicine ->get_all_active_medicine_category($ofset=null, $limit=null);

?>
<title><?php echo $system_data_title;?> Edit Medicine Details - <?php echo $single_medicine['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/admin/medicine/all-medicine" class="btn btn-info">All Medicine </a>
                            <a href="<?php echo BASEPATH?>/admin/medicine/add-medicine" style="margin-left: 10px;" class="btn btn-info">Add Medicine </a>
                            <a href="<?php echo BASEPATH?>/admin/medicine/action?id=<?php echo $single_medicine['medicine_id'];?>&action=view_medicine" style="margin-left: 10px;" class="btn btn-info">View Medicine </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Medicine Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="<?php echo BASEPATH?>/admin/medicine/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Medicine Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Medicine Name" required value="<?php echo $single_medicine['name'];?>">
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_medicine" required>
                                        <input class="form-control" name="medicine_id" id="medicine_id" type="hidden" value="<?php echo $single_medicine['medicine_id'];?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Medicine Category</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" id="category_id" class="form-control" required>
                                          <option value="">Select Medicine Category</option>
                                          <?php
                                            foreach($all_category as $category){
                                          ?>
                                            <option value="<?php echo $category['category_id']?>"><?php echo $category['name']?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Medicine Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Medicine Description" required><?php echo $single_medicine['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Medicine Buy Price</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="buy_price" id="buy_price" type="number" placeholder="Enter Medicine Buy Price" required value="<?php echo $single_medicine['buy_price'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Medicine Regular Price</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="regular_price" id="regular_price" type="number" placeholder="Enter Medicine Regular Price" required value="<?php echo $single_medicine['regular_price'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Medicine Sale Price</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="sale_price" id="sale_price" type="number" placeholder="Enter Medicine Sale Price" required value="<?php echo $single_medicine['sale_price'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Medicine Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/medicine/<?php if($single_medicine['image']!=''){ echo $single_medicine['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_medicine['name'];?>" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Doctor Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Medicine" class="btn btn-info">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <?php require_once __DIR__.'/../body/footer_content.php';?>
</div>
<!-- end main content-->

<script type="text/javascript">
    function readUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#photo').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById("category_id").value= <?php echo $single_medicine['category_id'];?>;
</script>
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>

<?php require_once __DIR__.'/../body/footer.php';?>





        