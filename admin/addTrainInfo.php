<?php
$title = 'Add Train | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<small><?php if(isset($_SESSION['train_id'])){ ?> Edit <?php }else{ ?> Add  <?php } ?> Train Details Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-dashboard"></i> Dashboard</li>
			<li class="active"><?php if(isset($_SESSION['train_id'])){ ?> Edit <?php }else{ ?> Add  <?php } ?> train</li>
		</ol>
	</section>
	<?php
	include_once("../dbCon.php");
	$conn =connect();
	if(isset($_SESSION['train_id'])){
		$id = $_SESSION['train_id'];
		$sql = "SELECT * FROM train_info WHERE id = '$id'";
		//echo $sql;
		$result= $conn->query($sql);
		$row=mysqli_fetch_assoc($result);
	}
	 ?>

	<!-- Main content -->
	<section class="content ">
		<div class="box box-warning ">
			<div class="box-header with-border">
				<h4 class="text-center"><b><?php if(isset($_SESSION['train_id'])){ ?> Edit <?php }else{ ?> Add  <?php } ?> Train Details</b></h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body ">
				<form action="addController/addTrainSave.php" method="post">
				<div class="col-sm-6 col-md-offset-3">
					<?php if (isset($_SESSION['emsg'])){?>
					<div class="callout callout-danger msg" ><p><?php echo $_SESSION['emsg'];?></p></div>
					<?php unset ($_SESSION['emsg']); }?>
						<div class="form-group">
							<label>Train Name</label>
								<input type="text" class="form-control" name="train_name" placeholder="train name" value="<?php if(isset($row['train_name'])){ echo $row['train_name'];}?>">
						</div>
						<div class="form-group">
							<label>Approxmt. Capacity</label>
								<input type="text" class="form-control" name="seat" placeholder="Capacity" value="<?php if(isset($row['total_seat'])){ echo $row['total_seat'];}?>">
						</div></br>
						<div class="form-group">
							 <a class="btn btn-danger col-md-4" href="viewTrain" role="button" ><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
							<?php if(isset($_SESSION['train_id'])){ ?>
	 						 <button type="submit" class="btn btn-info col-md-4 pull-right"  name="train_edit"><i class="fa fa-save"></i> Edit</button>
	 					 <?php }else{ ?>
	 						<button type="submit" class="btn btn-success col-md-4 pull-right"  name="train_add"><i class="fa fa-save"></i> Save</button>
	 					<?php }?>
						</div>
				</div>
				</form>
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
