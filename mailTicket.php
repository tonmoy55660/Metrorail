<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Mail </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>

  <script type="text/javascript">

  function myAlert(){
    swal({
      title: "Purchase Successfull",
      text:'Please check your mail to print ticket',
      type: "success",
      timer: 3000,
      showCancelButton: false,
      showConfirmButton: false,
      closeOnClickOutside: false,
    }, function() {
      window.location.href = "index";
    });
  }

  function erAlert(){
    swal({
      title: "Purchase Failed! Try Again!",
      type: "error",
      timer: 3000,
      showCancelButton: false,
      showConfirmButton: false,
      closeOnClickOutside: false,
    }, function() {
      window.location.href = "index";
    });
  }

  </script>
</head>
<body>
  <?php
  include_once 'dbCon.php';
  $conn = connect();

  if(isset($_GET['confirmation'])){
    $sc =  $_GET['sc_id'];
    $ar =  $_GET['ar_t'];
    $src =  $_GET['st_id'];
    $sql1 = "SELECT `stationName` FROM `stationinfo` WHERE `id` = $src";
    $re1= $conn->query($sql1);
    $r1 = mysqli_fetch_assoc($re1);
    $des = $_SESSION['destination'];
    $sql2 = "SELECT `stationName` FROM `stationinfo` WHERE `id` = $des";
    $re2= $conn->query($sql2);
    $r2 = mysqli_fetch_assoc($re2);
    $tr =  $_GET['tr_id'];
    $sql3 = "SELECT `train_name` FROM `train_info` WHERE `id` = $tr";
    $re3= $conn->query($sql3);
    $r3 = mysqli_fetch_assoc($re3);
    $pr =  $_GET['price'];
    $am =  $_GET['am'];
    $total = $pr * $am;
    $usermail = $_SESSION['user_mail'];
    //echo $usermail;
    $mailto = $usermail;
    $mailSub 	= "Purchase Mail";
    $message	='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="x-apple-disable-message-reformatting" />
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title></title>
      <style type="text/css" rel="stylesheet" media="all">
      /* Base ------------------------------ */

      @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");
      body {
        width: 100% !important;
        height: 100%;
        margin: 0;
        -webkit-text-size-adjust: none;
      }

      a {
        color: #3869D4;
      }

      a img {
        border: none;
      }

      td {
        word-break: break-word;
      }

      .preheader {
        display: none !important;
        visibility: hidden;
        mso-hide: all;
        font-size: 1px;
        line-height: 1px;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
      }
      /* Type ------------------------------ */

      body,
      td,
      th {
        font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
      }

      h1 {
        margin-top: 0;
        color: #333333;
        font-size: 22px;
        font-weight: bold;
        text-align: left;
      }

      h2 {
        margin-top: 0;
        color: #333333;
        font-size: 16px;
        font-weight: bold;
        text-align: left;
      }

      h3 {
        margin-top: 0;
        color: #333333;
        font-size: 14px;
        font-weight: bold;
        text-align: left;
      }

      td,
      th {
        font-size: 16px;
      }

      p,
      ul,
      ol,
      blockquote {
        margin: .4em 0 1.1875em;
        font-size: 16px;
        line-height: 1.625;
      }

      p.sub {
        font-size: 13px;
      }
      /* Utilities ------------------------------ */

      .align-right {
        text-align: right;
      }

      .align-left {
        text-align: left;
      }

      .align-center {
        text-align: center;
      }
      /* Buttons ------------------------------ */

      .button {
        background-color: #3869D4;
        border-top: 10px solid #3869D4;
        border-right: 18px solid #3869D4;
        border-bottom: 10px solid #3869D4;
        border-left: 18px solid #3869D4;
        display: inline-block;
        color: #FFF;
        text-decoration: none;
        border-radius: 3px;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
        -webkit-text-size-adjust: none;
        box-sizing: border-box;
      }

      .button--green {
        background-color: #22BC66;
        border-top: 10px solid #22BC66;
        border-right: 18px solid #22BC66;
        border-bottom: 10px solid #22BC66;
        border-left: 18px solid #22BC66;
      }

      .button--red {
        background-color: #FF6136;
        border-top: 10px solid #FF6136;
        border-right: 18px solid #FF6136;
        border-bottom: 10px solid #FF6136;
        border-left: 18px solid #FF6136;
      }

      @media only screen and (max-width: 500px) {
        .button {
          width: 100% !important;
          text-align: center !important;
        }
      }
      /* Attribute list ------------------------------ */

      .attributes {
        margin: 0 0 21px;
      }

      .attributes_content {
        background-color: #F4F4F7;
        padding: 16px;
      }

      .attributes_item {
        padding: 0;
      }
      /* Related Items ------------------------------ */

      .related {
        width: 100%;
        margin: 0;
        padding: 25px 0 0 0;
        -premailer-width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
      }

      .related_item {
        padding: 10px 0;
        color: #CBCCCF;
        font-size: 15px;
        line-height: 18px;
      }

      .related_item-title {
        display: block;
        margin: .5em 0 0;
      }

      .related_item-thumb {
        display: block;
        padding-bottom: 10px;
      }

      .related_heading {
        border-top: 1px solid #CBCCCF;
        text-align: center;
        padding: 25px 0 10px;
      }
      /* Discount Code ------------------------------ */

      .discount {
        width: 100%;
        margin: 0;
        padding: 24px;
        -premailer-width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        background-color: #F4F4F7;
        border: 2px dashed #CBCCCF;
      }

      .discount_heading {
        text-align: center;
      }

      .discount_body {
        text-align: center;
        font-size: 15px;
      }
      /* Social Icons ------------------------------ */

      .social {
        width: auto;
      }

      .social td {
        padding: 0;
        width: auto;
      }

      .social_icon {
        height: 20px;
        margin: 0 8px 10px 8px;
        padding: 0;
      }
      /* Data table ------------------------------ */

      .purchase {
        width: 100%;
        margin: 0;
        padding: 35px 0;
        -premailer-width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
      }

      .purchase_content {
        width: 100%;
        margin: 0;
        padding: 25px 0 0 0;
        -premailer-width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
      }

      .purchase_item {
        padding: 10px 0;
        color: #51545E;
        font-size: 15px;
        line-height: 18px;
      }

      .purchase_heading {
        padding-bottom: 8px;
        border-bottom: 1px solid #EAEAEC;
      }

      .purchase_heading p {
        margin: 0;
        color: #85878E;
        font-size: 12px;
      }

      .purchase_footer {
        padding-top: 15px;
        border-top: 1px solid #EAEAEC;
      }

      .purchase_total {
        margin: 0;
        text-align: right;
        font-weight: bold;
        color: #333333;
      }

      .purchase_total--label {
        padding: 0 15px 0 0;
      }

      body {
        background-color: #F4F4F7;
        color: #51545E;
      }

      p {
        color: #51545E;
      }

      p.sub {
        color: #6B6E76;
      }

      .email-wrapper {
        width: 100%;
        margin: 0;
        padding: 0;
        -premailer-width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        background-color: #F4F4F7;
      }

      .email-content {
        width: 100%;
        margin: 0;
        padding: 0;
        -premailer-width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
      }
      /* Masthead ----------------------- */

      .email-masthead {
        padding: 25px 0;
        text-align: center;
      }

      .email-masthead_logo {
        width: 94px;
      }

      .email-masthead_name {
        font-size: 16px;
        font-weight: bold;
        color: #A8AAAF;
        text-decoration: none;
        text-shadow: 0 1px 0 white;
      }
      /* Body ------------------------------ */

      .email-body {
        width: 100%;
        margin: 0;
        padding: 0;
        -premailer-width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        background-color: #FFFFFF;
      }

      .email-body_inner {
        width: 570px;
        margin: 0 auto;
        padding: 0;
        -premailer-width: 570px;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        background-color: #FFFFFF;
      }

      .email-footer {
        width: 570px;
        margin: 0 auto;
        padding: 0;
        -premailer-width: 570px;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        text-align: center;
      }

      .email-footer p {
        color: #6B6E76;
      }

      .body-action {
        width: 100%;
        margin: 30px auto;
        padding: 0;
        -premailer-width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        text-align: center;
      }

      .body-sub {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid #EAEAEC;
      }

      .content-cell {
        padding: 35px;
      }
      /*Media Queries ------------------------------ */

      @media only screen and (max-width: 600px) {
        .email-body_inner,
        .email-footer {
          width: 100% !important;
        }
      }

      @media (prefers-color-scheme: dark) {
        body,
        .email-body,
        .email-body_inner,
        .email-content,
        .email-wrapper,
        .email-masthead,
        .email-footer {
          background-color: #333333 !important;
          color: #FFF !important;
        }
        p,
        ul,
        ol,
        blockquote,
        h1,
        h2,
        h3 {
          color: #FFF !important;
        }
        .attributes_content,
        .discount {
          background-color: #222 !important;
        }
        .email-masthead_name {
          text-shadow: none !important;
        }
      }
      </style>
      <!--[if mso]>
      <style type="text/css">
        .f-fallback  {
          font-family: Arial, sans-serif;
        }
      </style>
    <![endif]-->
    </head>
    <body>

      <span class="preheader">This is the invoice of your ticket of metrorail.</span>
      <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="20" role="presentation">
        <tr>
          <td align="center">
            <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
              <tr>
                <td class="email-masthead">
                  <a href="https://example.com" class="f-fallback email-masthead_name">
                  MetroRail
                </a>
                </td>
              </tr>
              <!-- Email Body -->
              <tr>
                <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
                  <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="10" role="presentation">
                    <!-- Body content -->
                    <tr>
                      <td class="content-cell">
                        <div class="f-fallback">
                          <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                              <td class="attributes_content">
                                <table width="100%" cellpadding="0" cellspacing="10" role="presentation">
                                  <tr>
                                    <td class="attributes_item">
                                      <span class="f-fallback">
                <strong>Ticket ID #lhsd56 </strong>
              </span>
                                    </td>
                                  </tr>

                                </table>
                              </td>
                            </tr>
                          </table>
                          <table class="purchase" width="100%" cellpadding="0" cellspacing="0">

                            <tr>
                              <td colspan="2">
                                <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <th class="purchase_heading" align="left">
                                      <p class="f-fallback">Ticket Information</p>
                                    </th>
                                    <th class="purchase_heading" align="Right">
                                      <p class="f-fallback"></p>
                                    </th>
                                  </tr>
                                  <tr>

                                    <td width="60%" class="purchase_item"><span class="f-fallback">Pick up Station:</span></td>
                                    <td class="align-right" width="40%" class="purchase_item"><span class="f-fallback">'.$r1['stationName'].'</span></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" class="purchase_item"><span class="f-fallback">Train:</span></td>
                                    <td class="align-right" width="40%" class="purchase_item"><span class="f-fallback">'.$r3['train_name'].'</span></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" class="purchase_item"><span class="f-fallback">Arrival Time:</span></td>
                                    <td class="align-right" width="40%" class="purchase_item"><span class="f-fallback">'.$ar.'</span></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" class="purchase_item"><span class="f-fallback">Drop off Station :</span></td>
                                    <td class="align-right" width="40%" class="purchase_item"><span class="f-fallback">'.$r2['stationName'].'</span></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" class="purchase_item"><span class="f-fallback">Total person: </span></td>
                                    <td class="align-right" width="40%" class="purchase_item"><span class="f-fallback">'.$am.'</span></td>
                                  </tr>

                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <th class="purchase_heading" align="left">
                                      <p class="f-fallback">Detail</p>
                                    </th>
                                    <th class="purchase_heading" align="Right">
                                      <p class="f-fallback">Amount</p>
                                    </th>
                                  </tr>

                                  <tr>
                                    <td width="40%" class="purchase_item"><span class="f-fallback">Total Charge: </span></td>
                                    <td class="align-right" width="60%" class="purchase_item"><span class="f-fallback">'.$total.' taka</span></td>
                                  </tr>

                                  <tr>


                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                      <td class="content-cell" align="center">
                        <p class="f-fallback sub align-center">&copy; 2019 MetroRail. All rights reserved.</p>

                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </body>
    </html>
';
    $mailMsg 	= $message;
    require "admin/PHPMailer-master/PHPMailerAutoload.php";
    $mail 		= new PHPMailer();
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' 		=> false,
        'verify_peer_name' 	=> false,
        'allow_self_signed' => true
      )
    );
    $mail ->IsSmtp();
    $mail ->SMTPDebug = 0;
    $mail ->SMTPAuth = true;
    $mail ->SMTPSecure = 'ssl';
    $mail ->Host = "smtp.gmail.com";
    // $mail ->Port = 465; // or 587
    $mail ->Port = 465; // or 587
    $mail ->IsHTML(true);
    $mail ->Username = "testruhana@gmail.com";
    $mail ->Password = "test@123456";
    $mail->setFrom('Metrorail', 'BD');
    $mail ->Subject = $mailSub;
    $mail ->Body = $mailMsg;
    $mail ->AddAddress($mailto);
    //echo $message ;
    if(!$mail->Send())
    {
      echo '<script>erAlert()</script>';
    }
    else
    {
      $id = $_SESSION['id'];
      $balance = $_GET['balance'];
      $sources = $r1['stationName'];
      $dess = $r2['stationName'];
      $date =date('d-m-y');
      $sql = "INSERT INTO `trip_history`( `user_id`, `source_station`, `destination_station`, `time`, `amount`, `total_fare`, `date`)
              VALUES ('$id','$sources','$dess','$ar','$am','$total','$date')";
      $conn->query($sql);
      $newbalance = ($balance - $total);
      $ssql = "Update account_balance SET balance = '$newbalance' WHERE user_id = '$id'";
      $conn->query($ssql);
      echo '<script>myAlert()</script>';
    }
  }


  ?>
</body>
</html>
