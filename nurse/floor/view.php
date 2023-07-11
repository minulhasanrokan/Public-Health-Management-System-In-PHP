<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Floor.php";

    $floor = new Floor();

    $id = 0;
    if(isset($_SESSION['floor_id'])){
        $id = $_SESSION['floor_id'];
        unset($_SESSION['floor_id']);
    }

    $single_floor = $floor ->get_single_floor($id);

    if($single_floor==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/nurse/floor/404"; ?>";</script>
        <?php
    }
    else{

        $single_floor = mysqli_fetch_array($single_floor);
    }

?>
<title><?php echo $system_data_title;?> View Floor Details - <?php echo $single_floor['name']; ?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/nurse/floor/all" class="btn btn-info">All Floor </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/nurse/floor/add" style="margin-left: 10px;" class="btn btn-info">Add Floor </a>
                            <a href="<?php echo BASEPATH?>/nurse/floor/action?id=<?php echo $single_floor['floor_id'];?>&action=edit_floor" style="margin-left: 10px;" class="btn btn-info">Edit Floor </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Floor Details</li>
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
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/floor/<?php if($single_floor['image']!=''){ echo $single_floor['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_floor['name']; ?>">
                            <div class="card-body">
                                <h3 class="card-text"><?php echo $single_floor['name']; ?></h3>
                                <h4 class="card-text"><?php echo $single_floor['department_name']; ?></h4>
                                <?php echo $single_floor['description']; ?>
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
</script>
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>

<?php require_once __DIR__.'/../body/footer.php';?>





        