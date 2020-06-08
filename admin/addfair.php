<?php
$title = 'Add Fair | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("../dbCon.php");
$conn =connect();
?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<small><?php if(isset($_GET['station'])){?> Edit	<?php }else{ ?> Add <?php } ?> Fair Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-dashboard"></i> Dashboard</li>
			<li class="active">Add Fair</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h4 class="text-center"><b><?php if(isset($_GET['station'])){?> Edit	<?php }else{ ?> Add <?php } ?>Fair</b></h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="col-sm-8 col-sm-offset-2">
          <form class="form-horizontal" action="addController/addFairSave.php" method="post">
            <?php
            $sql="SELECT * FROM base_fair";
            $result= $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
						$ssql="SELECT * FROM fair_per_km";
            $fairdata= $conn->query($ssql);
            $fair = mysqli_fetch_assoc($fairdata);
             ?>
            <div class="form-group well">
              <label  class="col-sm-2 control-label">Base Fair :</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="baseFair" value="<?=$row['base_fair']?>" placeholder="base fair">
              </div>
							<label  class="col-sm-3 control-label">Fair per Kilometer :</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="fair_per" value="<?=$fair['fair']?>" placeholder="fair per km">
							</div>
            </div>
            <table class="table table-bordered">
             <thead>
               <tr>
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
                 <input type="hidden" name="sourceID[]" value="<?=$val[$i]['id']?>">
                 <input type="hidden" name="desID[]" value="<?=$val[$j]['id']?>">
                 <td><?=$val[$i]['stationName']?> </td>
                 <td><span class="glyphicon glyphicon-arrow-right block"></span></td>
                 <td><?=$val[$j]['stationName']?></td>
                 <td><input type="text" class="form-control" name="distance[]" value="<?php if(isset($val[$i]['distance'])){ echo $val[$i]['distance'];}?>" placeholder="Add fair"> </td>
               </tr>
             <?php  } ?>
             </tbody>
             <tfoot>
               <tr>
                 <th>Source Station</th>
                 <th></th>
                 <th>Destination</th>
                 <th>Distance (In KM)</th>
               </tr>
             </tfoot>
           </table>
             <div class="form-group">
               <a class="btn btn-danger col-md-4" href="viewFair" role="button" ><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
               <button type="submit" class="btn btn-success col-md-4 pull-right"  name="fairsave"><i class="fa fa-save"></i> Save</button>
            </div>
          </form>
				</div>
			</div>
	</section>
	<!-- /.content -->
<?php
include_once 'includes/footer.php';
?>
<script type="text/javascript">
$(function () {
	//Initialize Select2 Elements
	$('.select2').select2()
});

</script>
</body>
</html>
