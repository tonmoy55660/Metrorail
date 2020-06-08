<?php
$title = 'Routes | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
?>
<script type="text/javascript">

	function routes(rou_id){
		$.ajax({
			type:'POST',
			url:'addController/addRoutesSave.php',
			data:{rou_id:rou_id},
			success : function(response){
				console.log(response)
				document.getElementById("routeMap").innerHTML=response;
			}
		});

	}

</script>
<?php
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
?>

	<section class="content-header">
       <h1>
         <a class="btn btn-success"  href="addRouteInfo" onclick="<?php unset($_SESSION['route_id']);  ?>" role="button" > <i class="fa fa-plus" aria-hidden="true"></i> Click to Add Route details </a>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Routes</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-danger">
					<div class="box-header with-border">
					  <h4 class=" text-center"><b>View All Routes Information</b></h4>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php if (isset($_SESSION['msg'])){?>
						<div class="callout callout-success msg"  ><p><?=$_SESSION['msg']?></p></div>
						<?php unset ($_SESSION['msg']);} ?>
						<div class="col-xs-12">
						<table id="example1" class="table table-bordered table-hover">
							<thead>
								<tr>
								  <th class="nosort">No.</th>
								  <th>Routes Name</th>
								  <th>Total Station</th>
								  <th>View Routes-Station</th>
								  <th>Edit</th>
								</tr>
							</thead>
							<tbody>
								<?php
								include_once("../dbCon.php");
								$conn =connect();
								$sql="SELECT count(O.route_id) as c , R.* FROM routes_info R JOIN routes_order O ON R.`id` = O.route_id GROUP BY o.route_id ORDER BY r.routesName ASC";
								$result= $conn->query($sql);
								foreach($result as $key=>$value){
								?>
								<tr>
								  <td><?php echo $key+1;?></td>
								  <td><?=$value['routesName']?></td>
								  <td><?=$value['c']?></td>
								  <td><a type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default" onclick="routes('<?=$value['id']?>');" ><i class="fa fa-eye"></i>View Routes</td>
								<form  action="addController/sessions.php" method="post">
									<input type="hidden" name="routes" value="<?=$value['id']?>">
									<td><button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</button></td>
								</form>
								  </tr>
							<?php } ?>


							</tbody>
							<tfoot>
								<tr>
									<th class="nosort">No.</th>
								  <th>Routes Name</th>
								  <th>Total Station</th>
								  <th>View Routes-Station</th>
								  <th>Edit</th>
								</tr>
							</tfoot>
						</table>
					</div>
					</div>
				</div>
			</div>
		</div>
    </section>



		<div class="modal fade" id="modal-default">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Routes Map:</h4>
					</div>
					<div class="modal-body">
						<ul class="timeline" id="routeMap">

						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger text-center" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
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
         { "bSortable": false },
         { "bSortable": false },
      ]
    })
  })
</script>
</body>
</html>
