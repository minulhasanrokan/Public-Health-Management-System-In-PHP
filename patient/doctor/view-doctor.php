<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Doctor.php";

    $doctor = new Doctor();

    $id = 0;
    if(isset($_SESSION['doctor_id'])){
        $id = $_SESSION['doctor_id'];
        //unset($_SESSION['doctor_id']);
    }

    $single_doctor = $doctor ->get_single_doctor($id);

    if($single_doctor==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/patient/404"; ?>";</script>
        <?php
    }
    else{

        $single_doctor = mysqli_fetch_array($single_doctor);
    }

?>
<title><?php echo $system_data_title;?> View Doctor Details - <?php echo $single_doctor['name']; ?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/patient/doctor/all" class="btn btn-info">All Doctor </a>&nbsp;
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/patient">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Doctor Details</li>
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
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/doctor/<?php if($single_doctor['image']!=''){ echo $single_doctor['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_doctor['name']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <h3 class="card-text">Name: <?php echo $single_doctor['name']; ?></h3>
                                <h3 class="card-text">Mobile: <?php echo $single_doctor['mobile']; ?></h3>
                                <h3 class="card-text">Email: <?php echo $single_doctor['email']; ?></h3>
                                <h3 class="card-text">Department: <a href="<?php echo BASEPATH;?>/patient/doctor/action?id=<?php echo $single_doctor['department_id']; ?>&action=view_department"><?php echo $single_doctor['department_name'];?></a></h3>
                                <h4 class="card-text">Speciality: <?php echo $single_doctor['speciality']; ?></h4>
                                <p class="card-text"><?php echo $single_doctor['address']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <?php echo $single_doctor['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h2>Certificate</h2>

                <?php
                    $image_arr = explode("***",$single_doctor['certificate']);
                    $i=1;

                    foreach($image_arr as $img){

                        if($img!=''){

                            ?>
                                <div class="col-4">
                                    <div class="card-group">
                                        <div class="card mb-12">
                                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH; ?>/uploads/doctor/<?php echo $img;?>" alt="<?php echo $single_doctor['name']; ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php

                            $i++;
                        }
                    }
                ?>
            </div>        
            <!-- end row -->

            <?php
                require_once __DIR__."/../../classes/Shedule.php";

                $shedule = new Shedule();


                $id = $single_doctor['doctor_id'];

                $all_shedule = $shedule ->get_all_shedule($ofset=null, $limit=null,$doctor_id=$id,$nurse_id=null,$appointment_id=null,$appointment_status=0);
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php
                                if(isset($all_shedule) && $all_shedule>'0'){
                            ?>
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th width="20">Sl</th>
                                            <th align="center" width="40">Image</th>
                                            <th>Doctor Name</th>
                                            <th>Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th width="100">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i=1;
                                            foreach($all_shedule as $shedule){

                                                $image = "avatar.jpg";

                                                if($shedule['image']!='')
                                                {
                                                    $image = $shedule['image'];
                                                }
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
                                            <td align="center">
                                                <img width="30" src="<?php echo BASEPATH."/uploads/doctor/".$image;?>">
                                            </td>
                                            <td>
                                                <a href="<?php echo BASEPATH;?>/patient/doctor/action?id=<?php echo $shedule['doctor_id'];?>&action=view_doctor"><?php echo $shedule['doctor_name'];?></a>
                                            </td>
                                            <td><?php echo date("d-m-Y",strtotime($shedule['shedule_date']));?></td>
                                            <td><?php echo date("g:i a", strtotime($shedule['start_time']));?></td>
                                            <td><?php echo date("g:i a", strtotime($shedule['end_time']));?></td>
                                            <td align="center">
                                                <a href="<?php echo BASEPATH;?>/patient/doctor/action?id=<?php echo $shedule['shedule_id'];?>&action=add_appointment" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-folder-edit"></i></a>
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

<?php require_once '../body/footer.php';?>





        