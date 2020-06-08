<?php
$title = 'Fair | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("../dbCon.php");
$conn =connect();
?>

	<section class="content-header">
      <a class="btn btn-success"  href="addfair" role="button" ><i class="fa fa-plus" aria-hidden="true"></i> Click to Add/Edit Fair </a>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Fair</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-danger">
					<div class="box-header with-border">
					  <h4 class=" text-center"><b>View Fair Information</b></h4>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php if (isset($_SESSION['msg'])){?>
						<div class="callout callout-success msg"  ><p><?=$_SESSION['msg']?></p></div>
						<?php unset ($_SESSION['msg']);} ?>
		            <?php
		            $sql="SELECT * FROM base_fair";
		            $result= $conn->query($sql);
		            $row = mysqli_fetch_assoc($result);
								$ssql="SELECT * FROM fair_per_km";
		            $results= $conn->query($ssql);
		            $rows = mysqli_fetch_assoc($results);
		             ?>
		            <div class="col-sm-12 well text-center">
		              <label  class="col-sm-2 control-label">Base Fair :</label>
		               <label class="col-sm-4  control-label "><?=$row['base_fair']?> taka</label>
									 <label  class="col-sm-2 control-label">Fair Per Kilometer :</label>
 		               <label class="col-sm-4  control-label "><?=$rows['fair']?> taka</label>
		            </div>
		            <table id="example1" class="table table-bordered table-hover">
		             <thead>
		               <tr>
		                 <th>No</th>
		                 <th>Source Station</th>
		                 <th></th>
		                 <th>Destination</th>
		                 <th>Distance (In KM)</th>
		               </tr>
		             </thead>
		             <tbody>
		               <?php
		               $sql="SELECT s.id, s.stationName , f.distance FROM `stationinfo` as s LEFT JOIN distance as f on s.id = f.source_station_id";
		               $result= $conn->query($sql);
		               $val = array();
		                while($row = mysqli_fetch_assoc($result))
		                {
		                  $val[$row['id']] = array(
		                        'id' => $row['id'],
		                        'stationName' => $row['stationName'],
		                        'distance' => $row['distance'],
		                     );
		                }
		                for ($i=1; $i < sizeof($val) ; $i++) {
		                  $j = $i+1;
		                ?>
		               <tr>
		                 <td><?=$i?> </td>
		                 <td><?=$val[$i]['stationName']?> </td>
		                 <td><span class="glyphicon glyphicon-arrow-right block"></span></td>
		                 <td><?=$val[$j]['stationName']?></td>
		                 <td><?php if(isset($val[$i]['distance'])){ echo $val[$i]['distance'];}else{echo'Not given';}?></td>
		               </tr>
		             <?php  } ?>
		             </tbody>
		             <tfoot>
		               <tr>
		                 <th>No</th>
		                 <th>Source Station</th>
		                 <th></th>
		                 <th>Destination</th>
		                 <th>Distance (In KM)</th>
		               </tr>
		             </tfoot>
		           </table>
					</div>
				</div>
			</div>
		</div>
    </section>

<?php
include_once 'includes/footer.php';
?>

<script>
  $(function () {
    $('#example1').DataTable({
			"aoColumns": [
         null,
         null,
				 { "bSortable": false },
         null,
         null,
      ]
    })
  })

</script>
