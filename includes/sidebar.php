<div class="close" data-toggle="offcanvas" data-target=".navmenu">
    <i class="fa fa-close"></i>
</div>
  <h3 class="title-menu">All Pages</h3>
  <ul class="nav navmenu-nav"> <!--- Menu -->
    <li><a href="index">Welcome</a></li>
    <li><a href="fareMeter">Calculate Fair</a></li>
    <?php if(isset($_SESSION['isLogged'])){?>
    <li><a href="tripHistory">Your Trips</a></li>
    <li><a href="profile">Your Profile</a></li>
    <li><a href="balance">E-wallet</a></li>
  <?php } ?>
</ul><!--- End Menu -->
</div> <!--- End Off Canvas Side Menu -->
</div> <!--- End Off Canvas Side Menu -->
<div class="tbtn wow pulse" id="menu" data-wow-iteration="infinite" data-wow-duration="500ms" data-toggle="offcanvas" data-target=".navmenu">
<p><i class="fa fa-file-text-o"></i> All Pages</p>
</div>
</div>
<!-- Header Section End -->
