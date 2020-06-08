<?php
$title = 'Staffs | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
?>

	<section class="content-header">
       <h1>
         <a class="btn btn-success"  href="addStaff" onlclick = "<?php  unset($_SESSION['staff_id']);  ?>" role="button" > <i class="fa fa-plus" aria-hidden="true"></i> Click to Add New Station Master </a>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Station Master's Info</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-danger">
					<div class="box-header with-border">
					  <h4 class=" text-center"><b>View All Station Master's Information</b></h4>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php if (isset($_SESSION['msg'])){?>
						<div class="callout callout-success msg"  ><p><?=$_SESSION['msg']?></p></div>
						<?php unset ($_SESSION['msg']);} ?>
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
								  <th>No.</th>
								  <th>Name</th>
								  <th>Email</th>
								  <th>Phone</th>
								  <th>Assigned Station</th>
								  <th>Edit</th>
								</tr>
							</thead>
							<tbody>
								<?php
								include_once("../dbCon.php");
								$conn =connect();
								$sql="SELECT *, a.id as ID FROM national_id as nd RIGHT JOIN `admin_user` as a on nd.N_id= a.NID Left JOIN stationinfo as s on a.id = s.stationMasterID WHERE a.role = 1";
								$result= $conn->query($sql);
								foreach($result as $key => $value){
								?>
								<tr>
								  <td><?php echo $key+1;?></td>
								  <td><?=$value['Name']?></td>
								  <td><?=$value['email']?></td>
								  <td><?=$value['phone']?></td>
								  <td><?php if($value['stationName']==null){echo '<span style="color:red;">'; echo 'Not Assigned';echo '</span>';}else{ echo $value['stationName'];}?></td>
										<form action="addController/sessions" method="post">
											<input type="hidden" name="staff_id" value="<?=$value['ID']?>">
											<td><button type="submit" class="btn btn-primary" name="staff_edit"><i class="fa fa-edit"></i> Edit</button></td>
										</form>
									</tr>
							<?php } ?>


							</tbody>
							<tfoot>
								<tr>
									<th>No.</th>
								  <th>Name</th>
								  <th>Email</th>
								  <th>Phone</th>
								  <th>Assigned Station</th>
								  <th>Edit</th>
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
         null,
         null, // <-- disable sorting for column 3
         { "bSortable": false },
      ]
    })
  })
</script>
