<?php
$title = 'AddStaff | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<small><?php if(isset($_SESSION['staff_id'])){ ?> Edit <?php }else{ ?> Add  <?php } ?>  Staff Form</small>
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-dashboard"></i> Dashboard</li>
		<li class="active"><?php if(isset($_SESSION['staff_id'])){ ?> Edit <?php }else{ ?> Add  <?php } ?>  Station Master</li>
	</ol>
</section>
<?php
include_once("../dbCon.php");
$conn =connect();
if(isset($_SESSION['staff_id'])){
	$id = $_SESSION['staff_id'];
	$sql = "SELECT * FROM admin_user WHERE id = '$id'";
	//echo $sql;
	$result= $conn->query($sql);
	$row=mysqli_fetch_assoc($result);
}
?>
<!-- Main content -->
<section class="content">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h4 class="text-center"><b><?php if(isset($_SESSION['staff_id'])){ ?> Edit <?php }else{ ?> Add New <?php } ?>  Station Master</b></h4>

		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="col-sm-6 col-sm-offset-3">

				<?php if (isset($_SESSION['emsg'])){?>
					<div class="callout callout-danger msg" ><p><?php echo $_SESSION['emsg'];?></p></div>
					<?php unset ($_SESSION['emsg']); }?>
					<form method="post" action="addController/addStaffSave.php">
						<div class="form-group">
							<label>NID Number :</label>
							<input type="text" class="form-control" name="nid" value= "<?php if(isset($row['NID'])){ echo $row['NID'];} ?>" placeholder =  " National ID">
						</div>
						<div class="form-group">
							<label>Email :</label>
							<input type="email" class="form-control" name="email" value= "<?php if(isset($row['email'])){ echo $row['email'];} ?>" placeholder="email">
						</div>
						<div class="form-group">
							<label>Phone :</label>
							<input type="number" class="form-control" name="phone" value= "<?php if(isset($row['phone'])){ echo $row['phone'];} ?>" placeholder="phone">
						</div>
					</br>
					<div class="form-group">
						<a class="btn btn-danger col-md-4" href="viewStaffs" role="button" ><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
					 <?php if(isset($_SESSION['staff_id'])){ ?>
						 <button type="submit" class="btn btn-info col-md-4 pull-right"  name="staffedit"><i class="fa fa-save"></i> Edit</button>
					 <?php }else{ ?>
						<button type="submit" class="btn btn-success col-md-4 pull-right"  name="staffadd"><i class="fa fa-save"></i> Save</button>
					<?php }?>
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
