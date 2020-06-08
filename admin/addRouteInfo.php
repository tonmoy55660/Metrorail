<?php
$title = 'Add-Edit Routes | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("../dbCon.php");
$conn =connect();
?>
<?php
if(isset($_SESSION['route_id'])){
	$id=$_SESSION['route_id'];
	$ssql = "SELECT routesName FROM routes_info WHERE id='$id'";
	//	echo $ssql;
	$results=$conn->query($ssql);
	$rows = mysqli_fetch_assoc($results);
	$route =  $rows['routesName'];
	$sql="SELECT s.id, stationName FROM stationinfo as s, routes_info as ri,routes_order as ro WHERE ri.id = ro.route_id AND ro.station_id = s.id AND ro.route_id='$id' ORDER BY ro.ordering ASC";
	//	echo $sql;
	$resultData= $conn->query($sql);
	$row = mysqli_fetch_array($resultData);
	$rowcount=mysqli_num_rows($resultData);
	$ssql = "SELECT count(id) as size FROM stationinfo";
	$result=$conn->query($ssql);
	$rows = mysqli_fetch_assoc($result);
	$Length = $rows['size'];
	$_SESSION['length'] = $Length;
	if($rowcount != $Length){
		//echo 'sss';
		$sql="SELECT id , stationName FROM stationinfo ORDER BY stationName ASC";
		$resultData=$conn->query($sql);
	}
}else{
	$sql="SELECT id , stationName FROM stationinfo ORDER BY stationName ASC";
	$resultData=$conn->query($sql);
	$row = mysqli_fetch_array($resultData);
	$ssql = "SELECT count(id) as size FROM stationinfo";
	$result=$conn->query($ssql);
	$rows = mysqli_fetch_assoc($result);
	$_SESSION['length'] = $rows['size'];
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<small>Route <?php if(isset($id)){ echo 'Edit'; }else{echo 'Add';} ?> Form</small>
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-dashboard"></i> Dashboard</li>
		<li class="active"><?php if(isset($id)){ echo 'Edit'; }else{echo 'Add';} ?> routes</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h4 class="text-center"><b><?php if(isset($id)){ echo 'Edit'; }else{echo 'Add';} ?> Route Details</b></h4>
		</div>
		<!-- /.box-header -->
		<div class="box-body ">
			<div class="col-md-10 col-md-offset-1">
				<form action="addController/addRoutesSave.php" method="post">
					<input type="hidden" name="r_id" value="<?php if(isset($_SESSION['route_id'])){ echo $_SESSION['route_id'];}?>" >
					<div class="form-group">
						<label>Route Name :</label>
						<input type="text" class="form-control" name="routeName" value="<?php
						if(isset($_SESSION['route_id'])){
							echo $route;
						}?>" placeholder="Routes Name">
					</div>
					<div class="row">
						<?php if (isset($_SESSION['emsg'])){?>
							<div class="callout callout-danger msg"  ><p><?=$_SESSION['emsg']?></p></div>
							<?php unset ($_SESSION['emsg']);} ?>
							<div class="col-md-5">
								<label>Stations Name <?php if(isset($id)){ echo '(Showing as Previously Serialized) :'; }?></label>
									<select class="form-control" id ="stations"  multiple="multiple" style="height:200px;">
										<?php
										foreach ($resultData as $key=>$val){
											?>
											<option value="<?=$val['id']?>" ><?=$val['stationName']?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-2"></br></br>
									<button type="button" value="" class="btn btn-primary btn-block" id="add"><i class="fa fa-sign-in" aria-hidden="true"> Add</i></button>
									<button type="button" value="" class="btn btn-danger btn-block" id="remove"><i class="fa fa-remove" aria-hidden="true"> Remove</i></button>
								</div>
								<div class="col-md-5">
									<label>Serial One stopage after another:</label>
									<select class="form-control" name="station[]" size="19" id="selectedStation" multiple="multiple" style="height:200px;">

									</select>
								</div>

							</div></br></br>
							<div class="form-group">
								<a class="btn btn-danger col-md-3" href="viewRoutes" role="button" ><i class="fa fa-arrow-left"></i> Back</a>
								<?php if(isset($id)){ ?>
									<button type="submit" class="btn btn-info col-md-3 pull-right" name="edit"><i class="fa fa-edit"></i> Edit</button>
								<?php }else{ ?>
									<button type="submit" class="btn btn-success col-md-3 pull-right" name="save"><i class="fa fa-save"></i> Save</button>
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

			function save(){
				var a = document.getElementById('selectedStation').value;
				console.log(a);
			}

			$(document).ready(function(){
				$('#add').click(function() {
					return !$('#stations option:selected')
					.remove().appendTo('#selectedStation');
				});
				$('#remove').click(function() {
					return !$('#selectedStation option:selected')
					.remove().appendTo('#stations');
				});
			});
		</script>
	</body>
	</html>
