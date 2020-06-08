</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header" >
    <a href="dashboard" class="logo" style="background-color: lightgray;color:  black">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Metro</b>-E</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Metro-rail E-ticketing</b> </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="dashboard" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li >
            <a>
              <span class="user-image"> <?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?></span>
            </a>
          </li>
          <li>
              <a href="logout.php">
                <span class="user-image"> Sign out</span>
              </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
