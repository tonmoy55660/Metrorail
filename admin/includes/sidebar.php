
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
			  <img  class="img-circle" >
			</div>
			<div class="pull-left info">
			  <p><?php if(isset($_SESSION['role'])){
          if($_SESSION['role']==0){
            echo 'Welcome!!ADMIN';
          }elseif($_SESSION['role']==1){
            echo 'Welcome ! Moderator';}}?>
          </p>
			  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
			<li class="<?= ($activePage == 'dashboard') ? 'active':''; ?>" ><a href="dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
			<li class="<?= (($activePage == 'viewStaffs')||($activePage == 'addStaff')) ? 'active':''; ?>" ><a href="viewStaffs"><i class="fa fa-users"></i> <span>Staff Panel</span></a></li>
			<li class="<?= (($activePage == 'viewStation')||($activePage == 'addStationInfo')) ? 'active':''; ?>"><a href="viewStation"><i class="fa fa-exchange"></i> <span>Station Info</span></a></li>
      <li class="<?= (($activePage == 'viewTrain')||($activePage == 'addTrainInfo')) ? 'active':''; ?>" ><a href="viewTrain"><i class="fa fa-train"></i> <span>Train Info</span></a></li>
			<li class="<?= (($activePage == 'viewRoutes')||($activePage == 'addRouteInfo')) ? 'active':''; ?>" ><a href="viewRoutes"><i class="fa fa-road"></i> <span>Routes Management</span></a></li>
			<li class="<?= (($activePage == 'viewSchedule')||($activePage == 'addScheduleInfo')||($activePage == 'addTimeSchedule')) ? 'active':''; ?>"  ><a href="viewSchedule"><i class="fa fa-clock-o"></i> <span>Schedule Management</span></a></li>
			<li class="<?= (($activePage == 'viewFair')||($activePage == 'addfair')) ? 'active':''; ?>"  ><a href="viewFair"><i class="fa fa-money"></i> <span>Fair info</span></a></li>
			<li class="<?= (($activePage == 'viewUsers')||($activePage == 'addusers')) ? 'active':''; ?>"  ><a href="viewUsers"><i class="fa fa-users"></i> <span>User Accounts</span></a></li>
  </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
