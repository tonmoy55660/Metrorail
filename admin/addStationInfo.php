<?php
 if(isset($_GET['station'])){
	 $title = 'Edit Station | MetroRail';
 }else{
	 $title = 'Add Station | MetroRail';
 }
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("../dbCon.php");
$conn =connect();
?>
<!-- Content Header (Page header) -->

<?php
if(isset($_GET['station'])){
        $station=$_GET['station'];
				$sql="SELECT s.*,n.Name,s.id FROM stationinfo as s Left JOIN `admin_user` as a on a.id = s.stationMasterID LEFT JOIN national_id as n on n.N_id=a.NID Where s.stationName='$station'";
				$result= $conn->query($sql);
				$row=mysqli_fetch_assoc($result);
}

?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<small><?php if(isset($_GET['station'])){?> Edit	<?php }else{ ?> Add <?php } ?> Station Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-dashboard"></i> Dashboard</li>
			<li class="active">Add station</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h4 class="text-center"><b><?php if(isset($_GET['station'])){?> Edit	<?php }else{ ?> Add <?php } ?>Station Name and Station Master</b></h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="col-sm-6 col-sm-offset-3">
					<form action="addController/addStationSave" method="post">
						<input type="hidden" name="id" value="<?php if(isset($_GET['station'])){ echo $row['id'];}?>">
						<input type="hidden" name="stationMid" value="<?php if(isset($_GET['station'])){ echo $row['stationMasterID'];}?>">
						<div class="form-group">
							<label>Station Name :</label>
								<input type="text" class="form-control" name="stationName" placeholder="station name" value="<?php if(isset($_GET['station'])){ echo $row['stationName'];}?>">
						</div>

							<div class="form-group">
							<label>Select Station Master (can be added later) :</label>
								<select class="form-control select2" name="masterID"  style="width: 100%;">
									<?php if(($row['Name']) !== null){?>
							 		<option value="<?=$row['stationMasterID']?>"  selected="true" disabled="disabled"><?=$row['Name']?></option>
								<?php }else{ ?>
									<option value=""  selected="true" disabled="disabled">Select from here</option>
									<?php } ?>
						 			<?php
										 $sql="SELECT n.name,a.id FROM `admin_user` as a  LEFT JOIN stationinfo as s on a.id = s.stationMasterID JOIN national_id as n on a.NID = n.N_id WHERE a.role=1 AND s.stationMasterID IS NULL";
										 $resultData=$conn->query($sql);
										 foreach ($resultData as $row){
									?>
						 			<option value="<?=$row['id']?>" ><?=$row['name']?></option>
					 			<?php } ?>
					 			</select>
						</div></br>
							<div class="form-group">
							 <a class="btn btn-danger col-md-4" href="viewStation" role="button" ><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
							 	<?php if(isset($_GET['station'])){?>
									<button type="submit" class="btn btn-info col-md-4 pull-right"  name="edit"><i class="fa fa-edit"></i> Edit</button>
								<?php }else{ ?>
									<button type="submit" class="btn btn-success col-md-4 pull-right"  name="save"><i class="fa fa-save"></i> Save</button>
								<?php } ?>

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
