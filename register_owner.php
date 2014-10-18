<?php 
include("config.php"); 
include_once ("functions.php");
require ("passcomp.php"); 
require ("header.html");
?>
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
 <!-- Log in Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 350px!important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Login</h4>
        </div>
        <div class="modal-body">
          <form action="index.php" name="login" id="login" method="POST">
            <div class="form-group">
              <input class="form-control" type="email" name="username" id="username" placeholder="Email"/>
            </div>
            <div class="form-group">
              <input class="form-control" type="password" name="password" id="password" placeholder="Password"/>
            </div>
            <div class="checkbox">
              <label><input type="checkbox"> Remember Me</label>
            </div>
            <div style="float:left">
              <input type="submit" name="submitlogin" id="submitlogin" class="btn btn-primary" value="Log In" />
            </div>
            <div style="float:right">
              <a href="#"><button type="button" class="btn btn-link" style="color:#F60">Forgot Password</button></a>
            </div>
            <div style="clear:both">
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Log in Modal -->
  <?php
    error_reporting(E_ALL & ~E_NOTICE);
    $username = mysqli_real_escape_string($link,$_POST['username']);
    $password = mysqli_real_escape_string($link,$_POST['password']);
    
    $qry = $dbh->prepare("SELECT first_name, hpasswd FROM pg_user WHERE  email = ?");
    $qry->execute(array($username));
    $row = $qry->fetch(PDO::FETCH_ASSOC);
    if(password_verify($password, $row["hpasswd"]))
    {
        session_start();
    $_SESSION['username'] = $username;
        $_SESSION['fname'] = strtoupper($row["first_name"]);
    header("location: owndashboard.php");
    }
    
    ?>
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
            if($_SESSION["fname"]) {
            ?>
          <a href="owndashboard.php"><button type="button" class="btn navbar-btn btn-success" role="button">
          <span class="glyphicon glyphicon-dashboard" style="padding-right: 5px;"></span>Dashboard</button></a>
          <a id="logout" href="logout.php"><button type="button" class="btn navbar-btn btn-primary" role="button">
          <span class="glyphicon glyphicon-log-out" style="padding-right: 5px;"></span>Log Out</button></a>
          <?php
            }
            else
            {
            ?>
          <button type="button" class="btn btn-success navbar-btn" role="button" data-toggle="modal" data-target="#myModal">
          <span class="glyphicon glyphicon-log-in" style="padding-right: 5px;"></span> Sign in</button>
          <div class="btn-group">
            <button type="button" class="btn btn-primary navbar-btn dropdown-toggle" role="button" data-toggle="dropdown">Register <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="register_owner.php"><span class="glyphicon glyphicon-user"></span> Owner</a></li>
              <li><a href="register_tenant.php"><span class="glyphicon glyphicon-user"></span> Tenant</a></li>
            </ul>
          </div>
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
        <?php
          if($_SESSION["fname"]) {
          ?>
        <ul class="nav navbar-right" style="padding-top:14px">
          <div style="font-size:medium ; margin-left: 5px;margin-right: 2px; color:#408080">Welcome
            <span style="font-weight: bold"><?php echo $_SESSION['fname']; ?></span>!
          </div>
        </ul>
        <?php } ?>
      </div> <!--/.navbar-collapse -->
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
          <p>We will have content here.</p>
        </div>
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Owner Registration</h3>
            </div>
            <div class="panel-body">
              <?php require "ownreg.php"; ?> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container theme-showcase -->
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
        <?php
          echo "<p id=\"copy\">&copy; 2011-".date("Y")." Sanstop.com. All rights reserved worldwide.</p>";?>
      </div>
    </div>
  </div>
</body>
</html>