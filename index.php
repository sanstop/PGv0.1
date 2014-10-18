<?php
  ob_start();
  session_start();
  ?>
<?php require ("header.html"); ?>
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
  <?php include "config.php"; include "functions.php"; require "passcomp.php";  ?>
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
          <div class="text-success" style="font-size:medium ; margin-left: 5px; margin-right: 2px">Welcome
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
        <li class="active"><a href="/"><span class="glyphicon glyphicon-home"></span> Home</a></li>
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
    <div class="well">
      <div class="row">
        <div class="col-md-6">
          <h3>EasyLetOut</h3>
          <p class="big">Are you into the Paying Guest / Serviced Apartment Let Out Business? Do you get frustrated with the troublesome maintenance / tracking of different Records? Then its time to Welcome our New Generation Application <strong>EasyLetOut</strong>, to fulfil all your Business needs.</p>
          <p class="big">SanStop's EasyLetOut App does all the work for you. What's more you can checkout your Profit/Loss staticstics, take business decisions, grow your business many fold and much more.</p>
          <p class="big"> All you need to do is Contact us Right Away.</p>
          <p><a class="btn btn-default" href="#" role="button">Contact &raquo;</a></p>
        </div>
        <div class="col-md-6">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <li data-target="#myCarousel" data-slide-to="3"></li>
              <li data-target="#myCarousel" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
              <div class="item active">
                <img src="incld/imgs/carousel/01.jpg" alt="First slide">
              </div>
              <div class="item">
                <img src="incld/imgs/carousel/02.jpg" alt="Second slide">
              </div>
              <div class="item">
                <img src="incld/imgs/carousel/03.jpg" alt="Third slide">
              </div>
              <div class="item">
                <img src="incld/imgs/carousel/04.jpg" alt="Fourth slide">
              </div>
              <div class="item">
                <img src="incld/imgs/carousel/05.jpg" alt="Fifth slide">
              </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="well well-lg" style="background:none">
      <div class="row">
        <div class="col-md-4">
          <h2>Ad goes here</h2>
          <!-- NewAdUnit     
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
              style="display:inline-block;width:336px;height:280px"
              data-ad-client="ca-pub-1879196179393585"
              data-ad-slot="8631094922"></ins>
            <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            -->
        </div>
        <div class="col-md-4">
          <h3>Describe College Life</h3>
          <p>Most students like the freedom they have in college. Usually college students live on their own, in the dormitory or in an apartment. This means they are free to come and go as they like. Their parents can’t tell them when to get up, when to go to school, and when to come home. It also means that they are free to wear what they want. There are no parents to comment about their hair styles or their dirty jeans. Finally, they are free to listen to their favorite music without interference from parents.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h3>Crazy Horse</h3>
          <p>Celebrated for his ferocity in battle, Crazy Horse was recognized among his own people as a visionary leader committed to preserving the traditions and values of the Lakota way of life.</p>
        </div>
      </div>
      <div class="myline"></div>
      <div class="row">
        <div class="col-md-8">
          <h3>(Why Do People Lie?)</h3>
          <p>One reason people lie is to achieve personal power. Achieving personal power is helpful for someone who pretends to be more confident than he really is. For example, one of my friends threw a party at his house last month. He asked me to come to his party and bring a date. However, I didn’t have a girlfriend. One of my other friends, who had a date to go to the party with, asked me about my date. </p>
          <p>I didn’t want to be embarrassed, so I claimed that I had a lot of work to do. I said I could easily find a date even better than his if I wanted to. I also told him that his date was ugly. I achieved power to help me feel confident; however, I embarrassed my friend and his date. Although this lie helped me at the time, since then it has made me look down on myself. </p>
          <p><a class="btn btn-default" href="#" role="button">Contact &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <div>
            <p class="date">March 27, 2048</p>
            <h4><a href="#">Etiam a Dui et Eros Imperdiet</a></h4>
            <p>Morbi pellentesque, libero vitae fermentum tincidunt libero accumsan erat.</p>
          </div>
          <div>
            <p class="date">March 17, 2048</p>
            <h4><a href="#">Aenean Quis Nulla ac Nisl Rutrum</a></h4>
            <p>Libero accumsan erat, sit amet ornare lectus urna a turpis libero nibh vulputate.</p>
          </div>
          <div>
            <p class="date">March 10, 2048</p>
            <h4><a href="#">Etiam bibendum cursus tristiqu</a></h4>
            <p>Nam ac iaculis sapien. Duis nunc nisl, dignissim sed dictum in, eleifend a turpis.</p>
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
        <?php
          echo "<p id=\"copy\">&copy; 2011-".date("Y")." Sanstop.com. All rights reserved worldwide.</p>";?>
      </div>
    </div>
  </div>
</body>
</html>