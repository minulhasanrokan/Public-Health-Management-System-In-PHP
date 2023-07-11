<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Floor.php";

    $floor = new Floor();

    $all_floor = $floor ->get_all_active_floor($ofset=null, $limit=null);

?>
<title><?php echo $system_data_title;?> Add Bed Fee Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/accountant/bed-fee/all" class="btn btn-info">All Bed Fee</a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/accountant">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Bed Fee Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/accountant/bed-fee/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Floor Number</label>
                                    <div class="col-sm-10">
                                        <select name="floor_id" id="floor_id" onchange="get_bed_by_floor(this.id,this.value);" class="form-control" required>
                                          <option value="">Select Floor Number</option>
                                          <?php
                                            foreach($all_floor as $floor){
                                          ?>
                                            <option value="<?php echo $floor['floor_id']?>"><?php echo $floor['name']?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Bed Number</label>
                                    <div class="col-sm-10" id="bed_display_id">
                                        <select name="bed_id" id="bed_id" class="form-control" required>
                                          <option value="">Select Bed Number</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Bed Fee</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="bed_fee" id="bed_fee" type="number" placeholder="Enter Bed Fee" required value="">
                                        <input class="form-control" name="action" id="action" type="hidden" required value="add_bed_fee">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Add Bed Fee" class="btn btn-info">
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

<script type="text/javascript">
	function get_bed_by_floor(id,value){

		var data = "&floor_id="+value+"&action=get_bed_by_floor";

	    http.open("POST","action",true);
	    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	    http.send(data);
	    http.onreadystatechange = get_bed_by_floor_reponse;
	}

	function get_bed_by_floor_reponse(){

	    if(http.readyState == 4) 
	    {   
	      var reponse=http.responseText;

	      $("#bed_display_id").html(reponse);
	    }
	}

</script>

<?php require_once __DIR__.'/../body/footer.php';?>
