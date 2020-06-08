<?php
$title = 'Stations | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
?>
<?php
include_once("../dbCon.php");
$conn =connect();
if(isset($_GET['delete_id'])){
	$del = $_GET['delete_id'];
	$sql = "DELETE FROM `stationinfo` WHERE id = '$del'";
	$conn->query($sql);
}
 ?>
	<section class="content-header">
       <h1>
         <a class="btn btn-success"  href="addStationInfo.php" role="button" > <i class="fa fa-plus" aria-hidden="true"></i> Click to Add Station details </a>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Stations</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-danger">
					<div class="box-header with-border">
					  <h4 class=" text-center"><b>View All Stations Information</b></h4>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php if (isset($_SESSION['msg'])){?>
						<div class="callout callout-success msg"  ><p><?=$_SESSION['msg']?></p></div>
						<?php unset ($_SESSION['msg']);} ?>
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
								  <th class="nosort">No.</th>
								  <th>Station Name</th>
								  <th>Station Master</th>
								  <th>Edit</th>
								  <th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql="SELECT s.stationName,n.Name,s.id FROM stationinfo as s Left JOIN `admin_user` as a on a.id = s.stationMasterID LEFT JOIN  national_id as n on n.N_id=a.NID";
								$result= $conn->query($sql);
								foreach($result as $key=>$value){
								?>
								<tr>
								  <td><?=$key+1?></td>
								  <td><?=$value['stationName']?></td>
								  <td><?php if($value['Name']==null){echo '<span style="color:red;">'; echo 'Not Assigned';echo '</span>';}else{ echo $value['Name'];}?></td>
								  <td><a type="button" class="btn btn-primary" href="addStationInfo?station=<?=$value['stationName']?>"><i class="fa fa-edit"></i> Edit</td>
								  <td><a type="button" class="btn btn-danger" href="viewStation?delete_id=<?=$value['id']?>"><i class="fa fa-trash"></i> Delete</td>
								</tr>
							<?php } ?>


							</tbody>
							<tfoot>
								<tr>
								  <th class="no-sort" >No.</th>
								  <th>Station Name</th>
								  <th>Station Master</th>
								  <th>Edit</th>
								  <th>Delete</th>
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
         null, // <-- disable sorting for column 3
         { "bSortable": false },
      ]
    })
  })
</script>
