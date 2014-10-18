<?php include("config.php"); ?>
<?php
session_start();
if(!(isset($_SESSION['username']) && $_SESSION['username']!= '')) {
header ("Location: index.php");
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="css/favicon.ico">
    <title>New SanStop</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/start.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate-1.13.0.js"></script>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
      $(document).ready(function(){
        $('#regowner').validate({
      	rules: {
            fname: { minlength: 4, required: true},
      		lname: { minlength: 4, required: true},
      		mnum:  { number: true, minlength: 10, required: true},
            uemail: { email: true, required: true},
            reuemail: {email: true, required: true, equalTo: '#uemail' },
      		passwd: {minlength: 8, required: true},
            repasswd: {required: true, equalTo: '#passwd' }      
             },
      highlight: function(element) {            
      		var id_attr = "#" + $( element ).attr("id") + "1";
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');        
         },
              unhighlight: function(element) {
        var id_attr = "#" + $( element ).attr("id") + "1";
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');        
      },
         errorElement: 'span',
         errorClass: 'help-block',
         errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            }else {
                error.insertAfter(element);
            }
            }
         });
      }); // end document.ready
    </script>
  </head>
  <body>
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a id="logo" class="navbar-brand" href="/" style="font-weight: bold; font-size: 36px; color:#004080;">SanStop</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-right">
            <?php
            if($_SESSION["username"]) {
            ?>
            <button type="button" class="btn btn-success navbar-btn btn-primary" role="button" data-toggle="modal" data-target="#myModal">
            <a id="logout" href="logout.php" style="color: #FFF;text-decoration: none;">
            <span class="glyphicon glyphicon-log-out" style="padding-right: 5px;"></span>Log Out</a></button>
            <?php
            }
            else
            {
            ?>
            <button type="button" class="btn btn-success navbar-btn btn-primary" role="button" data-toggle="modal" data-target="#myModal">
            <span class="glyphicon glyphicon-log-in" style="padding-right: 5px;"></span> Sign in</button>
            <?php } ?>
          </ul>
          <form class="navbar-form navbar-right" role="form" action="http://www.google.co.in" id="cse-search-box" target="_blank">
            <div>
              <input type="hidden" name="cx" value="partner-pub-1879196179393585:4862902035" />
              <input type="hidden" name="ie" value="UTF-8" />
              <input class="form-control" type="text" name="q" size="36" />
              <input class="btn btn-default" type="submit" name="sa" value="Search" />
            </div>
          </form>
          <script type="text/javascript" src="http://www.google.co.in/coop/cse/brand?form=cse-search-box&amp;lang="></script>
          <ul class="nav navbar-right" style="padding-top: 15px;">
          <div class="topdetails">Welcome<span style="font-weight: bold;margin-left: 5px;margin-right: 2px;"><?php echo $_SESSION['username']; ?></span>!</div>
          </ul>
        </div>
        <!--/.navbar-collapse -->
      </div>
    </div>
    <div class="container theme-showcase" role="main">
      <div>
        <ul class="nav nav-tabs" role="tablist">
          <li class=><a href="/"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Banking Gateway</a></li>
              <li><a href="#">Insurance Premiums Payment</a></li>
              <li><a href="#">Electricity Bill Payment</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Mobile</li>
              <li><a href="#">Telephone/Mobile Bill Payment</a></li>
              <li><a href="#">Online Mobile Recharge Gateway</a></li>
              <li><a href="#">Online DTH Recharge Gateway</a></li>
            </ul>
          </li>
          <li><a href="#">Offers</a></li>
          <li><a href="#">Testimonials</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
      </div>
      <div style="background:#FFF" class="well">
        <div class="row">
          <div class="col-md-6">
          <p style="font-weight: bold;">Tenant Registration Page</p>
            <p>We will have content here.</p>
          </div>
          <div class="col-md-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Tenant Registration</h3>
              </div>
              <div class="panel-body">
                  <?php
                  error_reporting(E_ERROR | E_PARSE);
                  $output = "";
                  $errorop ="";
                  $submit = $_POST['submit'];
                  if(isset($submit))
                  {
                  $firstname = $_POST['fname'];
                  $lastname = $_POST['lname'];
                  $mobile = $_POST['mnum'];
                  $uemail = $_POST['uemail'];
                  //$reuemail  $_POST['reuemail'];
                  $passwd = $_POST['passwd'];
                  //$repasswd = $_POST['repasswd'];
                  $active = "0";
                  
                  
                       $query = "insert into pg_user (first_name, last_name, mobile_no, email, password, active) values ('$firstname','$lastname','$mobile','$uemail','$passwd','$active')";
                       
                       $result = mysqli_query($con,$query);
                       
                       if ($result) 
                        {
                           $output = "Registration Success!!";
                        }
                        else
                        {
                            $errorop = "Registration not success!!";
                        }
                       
                    
                  }
                  ?>
                 <div class="has-feedback">
                    <?php if(isset($output)&& $output != "") { ?>
                    <div class="control-label output"><?php echo $output; ?></div>
                    <?php } ?>
                    <?php if(isset($errorop) && $errorop != "") { ?>
                    <div class="control-label erroroutput"><?php echo $errorop; ?></div>
                    <?php } ?>
                  </div>
                <form id="regowner" role="form" class="col-xs-10" enctype="multipart/form-data" method="post" action="">
                  <div class="form-group has-feedback">
                    <label class="control-label" for="fname">First Name</label>
                    <input name="fname" id="fname" type="text" maxlength="40"  class="form-control" />
                    <span class="glyphicon form-control-feedback" id="fname1"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label class="control-label" for="lname">Last Name</label>
                    <input name="lname" id="lname" type="text" maxlength="40" class="form-control" />
                    <span class="glyphicon form-control-feedback" id="lname1"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label class="control-label" for="mnum">Mobile</label>  
                    <div class="input-group">
                      <span class="input-group-addon">+91 -</span>
                      <input name="mnum" id="mnum" type="text" maxlength="10" class="form-control" />
                    </div>
                    <span class="glyphicon form-control-feedback" id="mnum1"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label class="control-label" for="uemail">Email</label>
                    <input name="uemail" id="uemail" type="email" placeholder="@" maxlength="70" class="form-control" />
                    <span class="glyphicon form-control-feedback" id="uemail1"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label class="control-label" for="reuemail">Re-enter Email</label>
                    <input name="reuemail" id="reuemail" type="email" placeholder="@" maxlength="70" class="form-control" />
                    <span class="glyphicon form-control-feedback" id="reuemail1"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label class="control-label" for="passwd">Password</label>
                    <input name="passwd" id="passwd" type="password" class="form-control" />
                    <span class="glyphicon form-control-feedback" id="passwd1"></span>  
                  </div>
                  <div class="form-group has-feedback">
                    <label class="control-label" for="repasswd">Re-enter Password</label>
                    <input name="repasswd" id="repasswd" type="password" class="form-control" />
                    <span class="glyphicon form-control-feedback" id="repasswd1"></span>
                  </div>
                  <div class="form-group">
                    <span class="help-block">By clicking on "Register Me" below, you are agreeing to the <a href="#">Terms of Service</a> and the <a href="#">Privacy Policy</a>.</span>
                  </div>
                  <button type="submit" id="submit" name="submit" class="btn btn-primary">Register Me</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /.container theme-showcase -->
    <div class="footer">
<div class="container">
  <div class="myline"></div>
  <div style="float:left">
 <p>
      <a href="#">Terms</a>
      <a href="#">Privacy</a>
      <a href="#">Security</a>
      <a href="#">Sitemap</a>
      </p>
</div>
  <div style="float:right">
    <p>
        <a href="#">RSS Articles</a>
        <a href="#">RSS Pages</a>
        <a href="#">RSS Comments</a>
      </p>
  
  </div>
  <div style="clear:both">
  <p id="copy">&copy; 2011-2014 Sanstop.com. All rights reserved worldwide.</p>    </div>
</div>
</div>    <!-- Bootstrap core JavaScript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/docs.min.js"></script>
  </body>
</html>
