<?php
$title = 'Trains | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
?>
<?php
include_once("../dbCon.php");
$conn =connect();
if(isset($_GET['del_id'])){
	$del = $_GET['del_id'];
	$sql = "DELETE FROM `train_info` WHERE id = '$del'";
	$conn->query($sql);
}
 ?>
	<section class="content-header">
      <a class="btn btn-success" onclick="<?php unset($_SESSION['train_id']); ?>"  href="addTrainInfo" role="button" ><i class="fa fa-plus" aria-hidden="true"></i> Click to Add New Train details </a>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Trains</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-danger">
					<div class="box-header with-border">
					  <h4 class=" text-center"><b>View All Trains Information</b></h4>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					<?php if (isset($_SESSION['msg'])){?>
					<div class="callout callout-success msg"  ><p><?=$_SESSION['msg']?></p></div>
					<?php unset ($_SESSION['msg']);} ?>
						<table id="example1" class="table table-bordered table-hover ">
							<thead>
								<tr>
								  <th class="nosort">No.</th>
								  <th>Train Name</th>
								  <th>Capacity</th>
								  <th>Edit</th>
								  <th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								include_once("../dbCon.php");
								$conn =connect();
								$sql="SELECT * FROM train_info";
								$result= $conn->query($sql);
								foreach($result as $key=>$value){
								?>
								<tr>
								  <td><?php echo $key+1;?></td>
								  <td><?=$value['train_name']?></td>
								  <td><?=$value['total_seat']?></td>
									<form action="addController/sessions" method="post">
										<input type="hidden" name="train_id" value="<?=$value['id']?>">
									<td><button type="submit" class="btn btn-primary" name="train_edit"><i class="fa fa-edit"></i> Edit</button></td>
									<td><a type="button" class="btn btn-danger" href="viewTrain?del_id=<?=$value['id']?>"><i class="fa fa-trash"></i> Delete</td>
									</form>
									</tr>
							<?php } ?>


							</tbody>
							<tfoot>
								<tr>
									<th class="nosort">No.</th>
								  <th>Train Name</th>
								  <th>Capacity</th>
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
