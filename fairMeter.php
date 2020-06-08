<?php
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("dbCon.php");
$conn =connect();
?>
      <!-- Main Carousel Section -->
      <div id="carousel-area">

        <div id="carousel-slider" class="carousel slide" data-interval="3000">
          <div class="carousel-inner">
            <!-- Carousel Items Strarts-->
            <div class="item active" style="background-image: url(assets/img/slider/slide1.jpg);">
              <div class="carousel-caption">
                <h2>
                  Welcome to ClassiX
                </h2>
                <h3>
                  Used Cars To Mobile Phones And Computers, Or Search</br> For Property, Jobs And More.
                </h3>
              </div>
            </div>
            <div class="item" style="background-image: url(assets/img/slider/slide2.jpg);">
              <div class="carousel-caption">
                <h2>
                  Buy and Sell Anything
                </h2>
                <h3>
                  Used Cars To Mobile Phones And Computers, Or Search</br> For Property, Jobs And More.
                </h3>
              </div>
            </div>
            <div class="item" style="background-image: url(assets/img/slider/slide3.jpg);">
              <div class="carousel-caption">
                <h2>
                  Get Business Exposure
                </h2>
                <h3>
                  Used Cars To Mobile Phones And Computers, Or Search</br> For Property, Jobs And More.
                </h3>
              </div>
            </div>
          </div><!-- Carousel Item Ends -->
          <a class="left carousel-control" href="#carousel-slider" role="button" data-slide="prev">
            <i class="lnr lnr-chevron-left">
            </i>
          </a>
          <a class="right carousel-control" href="#carousel-slider" role="button" data-slide="next">
            <i class="lnr lnr-chevron-right">
            </i>
          </a>
        </div>

      </div>
      <!-- Main Carousel Section End-->

    </div>
    <!-- Header Section End -->
    <div class="container">
      <!-- Search wrapper Start -->
      <hr>
        <div class="container">
          <div class="search-inner">
              <!-- Start Search box -->
              <div class="row search-bar">
                <div class="advanced-search">
                  <form class="search-form" method="get">
                    <div class="col-md-4 col-sm-6 search-col">
                      <div class="input-group-addon search-category-container">
                        <label class="styled-select">
                          <select class="dropdown-product selectpicker" name="source" >
                            <option selected="true" disabled="disabled">Source Station</option>
                            <?php
          										 $sql="SELECT * FROM stationinfo ";
          										 $resultData=$conn->query($sql);
          										 foreach ($resultData as $row){
          									?>
                            <option class="subitem" value="<?=$row['id']?>"><?=$row['stationName']?></option>
                            <?php } ?>
                          </select>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 search-col">
                      <div class="input-group-addon search-category-container">
                        <label class="styled-select location-select">
                          <select class="dropdown-product selectpicker" name="destination" >
                            <option selected="true" disabled="disabled">Destination Station</option>
                            <?php
                               $sql="SELECT * FROM stationinfo ";
                               $resultData=$conn->query($sql);
                               foreach ($resultData as $row){
                            ?>
                            <option class="subitem" value="<?=$row['id']?>"><?=$row['stationName']?></option>
                            <?php } ?>
                          </select>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 search-col">
                      <button class="btn btn-common btn-search btn-block" name="calculate"><strong>Calculate Fare</strong></button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- End Search box -->
          </div>
        </div>

      <!-- Search wrapper End -->
        <div class="col-sm-12 page-content">
          <div class="inner-box">
            <h2 class="title-2"><i class="fa fa-star-o"></i> Search Result</h2>
            <br>
            <div class="table-responsive">
              <table class="table table-striped table-bordered add-manage-table">
                <tbody>
                  <tr>
                    <?php
                    if(isset($_SESSION['source'])){
                    $sql1 = "SELECT base_fair from base_fair";
                    $sql2 = "SELECT fair from fair_per_km";
                    $result= $conn->query($sql1);
                    $row = mysqli_fetch_assoc($result);
                    $results= $conn->query($sql2);
                    $rows = mysqli_fetch_assoc($results);
                    $source = $_SESSION['source'];
                    $des = $_SESSION['destination'];
                    $query = "";
                  }

                     ?>
                    <td>
                      <p> <strong> Source Station </strong>:     </p>
                      <p> <strong>Destination </strong>:   </p>
                    </td>
                    <td>
                      <strong> Base Fare</strong> : <?=$row['base_fair']?>
                    </td>
                    <td>
                      <strong> Total Km</strong> :
                    </td>
                    <td>
                      <strong> Taka per Km </strong> :  <?=$rows['fair']?>
                    </td>
                    <td>
                      <strong> Total Price</strong>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

      <!-- Start Services Section -->
      <div class="features">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="0.3s">
                <div class="features-icon">
                  <i class="fa fa-book">
                  </i>
                </div>
                <div class="features-content">
                  <h4>
                    Full Documented
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="0.6s">
                <div class="features-icon">
                  <i class="fa fa-paper-plane"></i>
                </div>
                <div class="features-content">
                  <h4>
                    Clean & Modern Design
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="0.9s">
                <div class="features-icon">
                  <i class="fa fa-map"></i>
                </div>
                <div class="features-content">
                  <h4>
                    Great Features
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="1.2s">
                <div class="features-icon">
                  <i class="fa fa-cogs"></i>
                </div>
                <div class="features-content">
                  <h4>
                    Completely Customizable
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="1.5s">
                <div class="features-icon">
                 <i class="fa fa-hourglass"></i>
                </div>
                <div class="features-content">
                  <h4>
                    100% Responsive Layout
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="1.8s">
                <div class="features-icon">
                  <i class="fa fa-hashtag"></i>
                </div>
                <div class="features-content">
                  <h4>
                    User Friendly
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="2.1s">
                <div class="features-icon">
                  <i class="fa fa-newspaper-o"></i>
                </div>
                <div class="features-content">
                  <h4>
                    Awesome Layout
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="2.4s">
                <div class="features-icon">
                  <i class="fa fa-leaf"></i>
                </div>
                <div class="features-content">
                  <h4>
                    High Quality
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="features-box wow fadeInDownQuick" data-wow-delay="2.7s">
                <div class="features-icon">
                  <i class="fa fa-google"></i>
                </div>
                <div class="features-content">
                  <h4>
                    Free Google Fonts Use
                  </h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Services Section -->

    <!-- Counter Section Start -->
    <section id="counter">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="counting wow fadeInDownQuick" data-wow-delay=".5s">
              <div class="icon">
                <span>
                  <i class="lnr lnr-tag"></i>
                </span>
              </div>
              <div class="desc">
                <h3 class="counter">12090</h3>
                <p>Regular Ads</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="counting wow fadeInDownQuick" data-wow-delay="1s">
              <div class="icon">
                <span>
                  <i class="lnr lnr-map"></i>
                </span>
              </div>
              <div class="desc">
                <h3 class="counter">350</h3>
                <p>Locations</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="counting wow fadeInDownQuick" data-wow-delay="1.5s">
              <div class="icon">
                <span>
                  <i class="lnr lnr-users"></i>
                </span>
              </div>
              <div class="desc">
                <h3 class="counter">23453</h3>
                <p>Reguler Members</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="counting wow fadeInDownQuick" data-wow-delay="2s">
              <div class="icon">
                <span>
                  <i class="lnr lnr-license"></i>
                </span>
              </div>
              <div class="desc">
                <h3 class="counter">150</h3>
                <p>Premium Ads</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Counter Section End -->

    <?php
    include_once 'includes/footer.php';
    ?>
