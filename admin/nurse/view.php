<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Nurse.php";

    $nurse = new Nurse();

    $id = 0;
    if(isset($_SESSION['nurse_id'])){
        $id = $_SESSION['nurse_id'];
        unset($_SESSION['nurse_id']);
    }

    $single_nurse = $nurse ->get_single_nurse($id);

    if($single_nurse==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/nurse/404"; ?>";</script>
        <?php
    }
    else{

        $single_nurse = mysqli_fetch_array($single_nurse);
    }

?>
<title><?php echo $system_data_title;?> View Nurse Details - <?php echo $single_nurse['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/admin/nurse/all" class="btn btn-info">All Nurse </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/admin/nurse/add" style="margin-left: 10px;" class="btn btn-info">Add Nurse </a>
                            <a href="<?php echo BASEPATH?>/admin/nurse/action?id=<?php echo $single_nurse['nurse_id'];?>&action=edit_nurse" style="margin-left: 10px;" class="btn btn-info">Edit Nurse </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Nurse Details</li>
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
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/nurse/<?php if($single_nurse['image']!=''){ echo $single_nurse['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_nurse['name']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <h3 class="card-text">Name: <?php echo $single_nurse['name']; ?></h3>
                                <h3 class="card-text">Mobile: <?php echo $single_nurse['mobile']; ?></h3>
                                <h3 class="card-text">Email: <?php echo $single_nurse['email']; ?></h3>
                                <h4 class="card-text">Speciality: <?php echo $single_nurse['speciality']; ?></h4>
                                <h4 class="card-text">Doctor Name: <a href="<?php echo BASEPATH; ?>/admin/doctor/action?id=<?php echo $single_nurse['doctor_id']; ?>&action=view_doctor""><?php echo $single_nurse['doctor_name']; ?></a></h4>
                                <p class="card-text"><?php echo $single_nurse['address']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <?php echo $single_nurse['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <?php require_once '../body/footer_content.php';?>
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

<?php require_once '../body/footer.php';?>





        