<?php
    require_once __DIR__."/../../classes/Notice.php";

    $notice= new Notice();

    $limit = 6;
    
    if (isset($_POST['page'])) {

        $page = $_POST['page'];
    }
    else{
        $page = 1;
    }

    $ofset = ($page-1)*$limit;

    $all_notice = $notice->get_all_notice($ofset, $limit,$notice_for=null,$user_id=null,$notice_date=null,$published_date=null);

    $number_of_notice = $notice->number_of_notice($notice_for=null,$user_id=null,$notice_date=null,$published_date=null);

    $notice_for_arr = array("0"=>"All","1"=>"Patient","2"=>"Doctor","3"=>"Nurse","4"=>"Pharmacist","5"=>"Laboratorist","6"=>"Accountant",
            );
?>

<table class="table table-centered mb-0 align-middle table-hover table-nowrap">
    <thead class="table-light">
        <tr>
            <th width="10">Notice For</th>
            <th width="70">Title</th>
            <th width="5">Notice Date</th>
            <th width="5">Published date</th>
            <th width="5">File</th>
            <th width="10">Action</th>
        </tr>
    </thead><!-- end thead -->
    <tbody>
        <?php

            If(isset($all_notice)){
                foreach($all_notice as $notice)
                {
        ?>
                <tr>
                    <td><h6 class="mb-0"><?php echo $notice_for_arr[$notice['user_type']]; ?></h6></td>
                    <td><?php echo substr($notice['title'],0,40); ?></td>
                    <td><?php echo date("d-m-Y",strtotime($notice['notice_date']));?></td>
                    <td><?php echo date("d-m-Y",strtotime($notice['published_date']));?></td>
                    <td>
                        <?php

                            if($notice['file_url']!=''){
                                ?>
                                <a class=" btn btn-primary" onclick="download_file('notice','<?php echo $notice['file_url'];  ?>');" aria-label="Last">
                                    <i class="fa fa-angle-double-down"></i>
                                </a>
                                <?php
                            }
                        ?>
                            
                    </td>
                    <td>
                        <a class=" btn btn-primary" aria-label="Last">Details</a>
                    </td>
                </tr>
        <?php
                }
            }
        ?>
    </tbody>
</table>
<br>
    <?php
        if ($number_of_notice) {

            $totalPage = ceil($number_of_notice/$limit);

            if($totalPage>1){
      ?>
      <nav aria-label="Page navigation">
          <ul style="float: right;" class="pagination pagination-basic pagination-primary mg-b-0">
            <?php
                if ($page>5) {
              ?>
            <li class="page-item">
              <a class="page-link" onclick="pagination_for_notice('page',1);" aria-label="Last">
                <i class="fa fa-angle-double-left"></i>
              </a>
            </li>
            <?php
                }
            ?>
            <?php
                if ($page>1) {
            ?>
            <li class="page-item">
              <a class="page-link" onclick="pagination_for_notice('page',<?php echo $page-1;  ?>);" aria-label="Next">
                <i class="fa fa-angle-left"></i>
              </a>
            </li>
            <?php
                  }
              ?>
            <?php
              $k = 0;
              $l =6;
              for ($i=1; $i<=$totalPage ; $i++) { 
            ?>
            <?php
              if (($page+6)>=$i and $i>=$page) {

            ?>
            <li class="page-item <?php if($i==$page){echo "active";}?>"><a class="page-link" onclick="pagination_for_notice('page',<?php echo $i;  ?>);"><?php echo $i;?></a></li>
            <?php
              }
            ?>
            
            <?php
              $k++;
              $l++;
              }
            ?>
            <?php
                if ($totalPage>1 and $page<$totalPage) {
            ?>
            <li class="page-item">
              <a class="page-link" onclick="pagination_for_notice('page',<?php echo $page+1;  ?>);" aria-label="Next">
                <i class="fa fa-angle-right"></i>
              </a>
            </li>
             <?php
                  }
              ?>
              <?php
                  if ($totalPage-$page>5) {
              ?>
              <li class="page-item">
                <a class="page-link" onclick="pagination_for_notice('page',<?php echo $totalPage;  ?>);" aria-label="Last">
                  <i class="fa fa-angle-double-right"></i>
                </a>
              </li>
           <?php
                }
            ?>
          </ul>
      </nav>
      <?php
          }
        }
    ?>

