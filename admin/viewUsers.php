<?php
$title = 'Users | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
?>

	<section class="content-header">
		<label for="">View Users</label>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Users</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-danger">
					<div class="box-header with-border">
					  <h4 class=" text-center"><b>View All Users Information</b></h4>
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
								  <th>National ID</th>
								  <th>User Mail</th>
								  <th>NID photocopy</th>
								  <th>Accept</th>
								  <th>Decline</th>
								</tr>
							</thead>
							<tbody>
								<?php
								include_once("../dbCon.php");
								$conn =connect();
								$sql="SELECT * FROM users_info WHERE isAccepted = 0 ";
								$result= $conn->query($sql);
								foreach($result as $key=>$value){
								?>
								<tr>
								  <td><?php echo $key+1;?></td>
								  <td><?=$value['NID']?></td>
								  <td><?=$value['user_mail']?></td>
									<td><img src="../assets/<?=$value['img_NID']?>" height="80px" width="100px"></td>
									<td>
										<form class="" action="addController/sessions.php" method="post">
											<input type="hidden" name="mail" value="<?=$value['user_mail']?>">
											<input type="hidden" name="id" value="<?=$value['id']?>">
											<button type="submit" class="btn btn-success" name="sent_mail"><i class="fa fa-plus"></i> Accept</button>
										</form>
									</td>
									<td><button type="submit" class="btn btn-danger" name=""><i class="fa fa-minus"></i> Decline</button></td>
									</tr>
							<?php } ?>


							</tbody>
							<tfoot>
								<tr>
									<th class="nosort">No.</th>
								  <th>National ID</th>
								  <th>User Mail</th>
								  <th>NID photocopy</th>
								  <th>Accept</th>
								  <th>Decline</th>
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
         null,
         null,
         null,
      ]
    })
  })
</script>
