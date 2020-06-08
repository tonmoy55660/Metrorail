<?php
$title = 'Add Users | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<small>Add Users Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-dashboard"></i> Dashboard</li>
			<li class="active">Add User</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content ">
		<div class="box box-warning ">
			<div class="box-header with-border">
				<h4 class="text-center"><b>Add User Info</b></h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body ">
				<form action="addController/addUsersSave.php" method="post">
				<div class="col-sm-6 col-md-offset-3">
					<?php if (isset($_SESSION['emsg'])){?>
					<div class="callout callout-danger msg" ><p><?php echo $_SESSION['emsg'];?></p></div>
					<?php unset ($_SESSION['emsg']); }?>
						<div class="form-group">
							<label>National ID</label>
								<input type="text" class="form-control" name="nid" placeholder="national identity">
						</div>
						<div class="form-group">
							<label>Card NO.</label>
								<input type="text" class="form-control" name="card_no" placeholder="card number">
						</div>
            <div class="form-group">
							<label>User E-mail</label>
								<input type="text" class="form-control" name="email" placeholder="users email">
						</div>
          </br>
						<div class="form-group">
							 <a class="btn btn-danger col-md-4" href="viewUsers" role="button" ><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
	 						 <button type="submit" class="btn btn-success col-md-4 pull-right"  name="user_add"><i class="fa fa-save"></i> Save</button>
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
