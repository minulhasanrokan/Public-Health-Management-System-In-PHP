<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Department.php";
    require_once __DIR__."/../../classes/Doctor.php";

    $department = new Department();
    $doctor = new Doctor();

    $id = 0;
    if(isset($_SESSION['department_id'])){
        $id = $_SESSION['department_id'];
        unset($_SESSION['department_id']);
    }

    $single_department = $department ->get_single_department($id);

    if($single_department==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/patient/404"; ?>";</script>
        <?php
    }
    else{

        $single_department = mysqli_fetch_array($single_department);
    }

    $all_doctor = $doctor ->get_all_active_doctor($ofset=null, $limit=null,$id);

?>
<title><?php echo $system_data_title;?> View Department Details - <?php echo $single_department['name']; ?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        &nbsp;
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/patient">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Department Details</li>
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
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/department/<?php if($single_department['image']!=''){ echo $single_department['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_department['name']; ?>">
                            <div class="card-body">
                                <h3 class="card-text"><?php echo $single_department['name']; ?></h3>
                                <h4 class="card-text"><?php echo $single_department['title']; ?></h4>
                                <?php echo $single_department['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php
                                if(isset($all_doctor) && $all_doctor>'0'){
                            ?>
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th width="20">Sl</th>
                                            <th align="center" width="40">Image</th>
                                            <th>Doctor Name</th>
                                            <th>Department Name</th>
                                            <th align="center" width="50">Mobile</th>
                                            <th align="center" width="100">Email</th>
                                            <th width="100">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i=1;
                                            foreach($all_doctor as $doctor){

                                                $image = "avatar.jpg";

                                                if($doctor['image']!='')
                                                {
                                                    $image = $doctor['image'];
                                                }
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
                                            <td align="center">
                                                <img width="30" src="<?php echo BASEPATH."/uploads/doctor/".$image;?>">
                                            </td>
                                            <td><?php echo $doctor['name'];?></td>
                                            <td><a href="<?php echo BASEPATH;?>/patient/doctor/action?id=<?php echo $doctor['department_id']; ?>&action=view_department"><?php echo $doctor['department_name'];?></a></td>
                                            <td align="center"><?php echo $doctor['mobile'];?></td>
                                            <td align="center"><?php echo $doctor['email'];?></td>
                                            <td align="center">
                                                <a href="<?php echo BASEPATH;?>/patient/doctor/action?id=<?php echo $doctor['doctor_id'];?>&action=view_shedule" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-timer"></i></a>
                                                <a href="<?php echo BASEPATH;?>/patient/doctor/action?id=<?php echo $doctor['doctor_id'];?>&action=view_doctor" class="btn btn-primary btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-monitor-eye"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                                $i++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                            <?php
                                }
                                else{
                            ?>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

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





        