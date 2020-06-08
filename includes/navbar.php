</head>
<body>
  <!-- Header Section Start -->
  <div class="header">
    <nav class="navbar navbar-default main-navigation" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <!-- Stat Toggle Nav Link For Mobiles -->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- End Toggle Nav Link For Mobiles -->
          <a class="navbar-brand logo" href="index"><img src="assets/img/logo.png" alt=""></a>
        </div>
        <!-- brand and toggle menu for mobile End -->

        <!-- Navbar Start -->


        <div class="collapse navbar-collapse" id="navbar">
          <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_SESSION['isLogged'])){?>
              <li><a><i class="lnr lnr-enter"> </i><?php if(isset($_SESSION['user_mail'])){echo $_SESSION['user_mail'];}?></a></li>
              <li><a href="logout"><i class="lnr lnr-enter"></i> Logout</a></li>

            <?php }else{ ?>
                <li><a href="login"><i class="lnr lnr-enter"></i> Login</a></li>
                <li><a href="signup"><i class="lnr lnr-enter"></i> Sign Up</a></li>
            <?php } ?>
          </ul>
        </div>
        <!-- Navbar End -->
      </div>
    </nav>
    <!-- Off Canvas Navigation -->
    <div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
    <!--- Off Canvas Side Menu -->
