<?php
$title = 'Add Schedule | MetroRail';
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
			<small>Schedule Add Form 1</small>
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-dashboard"></i> Dashboard</li>
			<li class="active">Select train-routes</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content ">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h4 class="text-center"><b>Select Train Routes Schedule</b></h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="col-md-8 col-md-offset-2">
					<form  action="addController/sessions.php" method="post">
						<div class="form-group">
								<label>Select Route :</label>
								<select class="form-control select2" name="route_id"  style="width: 100%;">
                  <option  selected="true" disabled="disabled">Select from here</option>
									<?php
										 $sql="SELECT * FROM routes_info ";
										 $resultData=$conn->query($sql);
										 foreach ($resultData as $row){
									?>
                  <option value="<?=$row['id']?>"><?=$row['routesName']?></option>
									<?php } ?>
                </select>
						</div>
						<div class="form-group">
							<label>Select Train :</label>
							<select class="form-control select2" name="train_id"  style="width: 100%;">
								<option  selected="true" disabled="disabled">Select from here</option>
								<?php
									 $sql="SELECT * FROM train_info ";
									 $resultData=$conn->query($sql);
									 foreach ($resultData as $row){
								?>
								<option value="<?=$row['id']?>" ><?=$row['train_name']?></option>
								<?php } ?>
							</select>
						</div>
						</br>
						<div class="form-group">
							 	<a class="btn btn-danger col-md-3" href="viewSchedule" role="button" ><span class="glyphicon glyphicon-arrow-left"></span>  Back </a>
								<button type="submit" class="btn btn-success col-md-3 pull-right" name="schedule"> Next <span class="glyphicon glyphicon-arrow-right"></span> </button>
						</div>
			</form>
		</div>
		</div>
	</section>
	<!-- /.content -->
<?php
include_once 'includes/footer.php';
?>
</body>
</html>
