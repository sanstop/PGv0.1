<?php 
    session_start();
    if(!isset($_SESSION['fname'])){ header("Location:index.php"); }
    include("config.php"); 
    include_once ("functions.php");
    require ("passcomp.php");
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>EasyLetOut - Add Flat</title>
        <!-- Bootstrap Core CSS -->
        <link href="incld/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
    <link href="incld/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="incld/css/plugins/timeline.css" rel="stylesheet">
        <!-- Timeline CSS -->
        <link href="incld/css/plugins/timeline.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="incld/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="incld/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery Version 1.11.0 -->
        <script src="incld/js/jquery-1.11.1.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="incld/js/bootstrap.min.js"></script>
        <script src="incld/js/jquery.validate-1.13.0.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
              $('#regflat').validate({
            	rules: {
                  flatno: { minlength: 3, required: true},
            	  aptname: { minlength: 4, required: true},
				  societyname: { minlength: 4, required: true},
				  locality: { minlength: 4, required: true},
				  street: { minlength: 10, required: true},
				  town: { minlength: 4, required: true},
				  state: { minlength: 4, required: true},
            	  pincode:  { number: true, minlength: 6, required: true},
				  country: { minlength: 4, required: true},
                  tocc: { number: true, required: true}   
                   },
            highlight: function(element) {            
              $(element).closest('.form-group').removeClass('has-success').addClass('has-error');     
               },
                    unhighlight: function(element) {
              $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
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
 <!--   <script type="text/javascript">
    $(document).ready(function(){
        $("#pop").popover();
    });
    </script>-->
    </head>
    <body>
        <div id="wrapper">
        <?php require 'nav.php'; ?>
        <div id="page-wrapper">
		<div class="row">
            <div class="col-lg-12 page-header">
			</div>
			</div>
		<div id="content-row">
            <div class="row">
            <div class="col-lg-12">
              <h4 class="text-muted text-center"><u> Please Type the below details correctly</u></h4>
              <br>
            <form id="findflat" role="form" enctype="multipart/form-data" method="post" action="">
  <div class="row">
      <div class="form-group has-feedback col-sm-4">
        <label class="control-label" for="findtown">Village/Town/City</label>
        <input name="findtown" id="findtown" type="text" maxlength="40"  class="form-control"/>
      </div>
      <div class="form-group has-feedback col-sm-4">
        <label class="control-label" for="findlocality">Locality</label>
        <input name="findlocality" id="findlocality" type="text" maxlength="70" class="form-control" />
      </div>
       <div class="form-group has-feedback col-sm-4">
        <label class="control-label" for="findsociety">Society Name</label>
        <input name="findsociety" id="findsociety" type="text" maxlength="70" class="form-control" />
      </div>
  </div>
  <p class="text-center">
   <button type="submit" id="submitfindflat" name="submitfindflat" class="btn btn-success">Find Flat</button>
    <input type="reset" class="btn btn-warning" value="Reset Search Criteria" />
    </p>
</form>
</div>
</div>
<br>
            <div class="row">
            <div class="col-lg-12">
 <table class="table table-condensed table-hover table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Flat No</th>
          <th>Apartment</th>
          <th>Locality</th>
          <th>T Occ</th>
          <th>P Occ</th>
          <th>Facilties</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
          <td>12</td>
          <td>7</td>  
          <td>Facilties</td>        
        </tr>
        <tr>
          <td>2</td>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
		  <td>11</td>
          <td>4</td>
          <td>Facilties</td>         
        </tr>
        <tr>
          <td>3</td>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
		  <td>7</td>
          <td>6</td>           
          <td>
          <!--<a id="pop" href="#" tabindex="0" class="btn btn-xs btn-link" data-toggle="popover" data-placement="left" data-trigger="focus" title="Dismissible popover" data-content="And here's some amazing content. It's very engaging. Right?">Facilities Available</a>-->Facilities</td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
    
            <div id="content-row" class="row">
                <div class="col-lg-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="panel-title"> <i class="fa fa-building fa-fw"></i><strong> View Flat
                           <p class="pull-right text-primary">Occupancy: 4 / 6</p></strong>
                           </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php require "own_viewflatreg.php"; ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-9 -->
                <div class="col-lg-3">
                <div class="list-group">
            <li class="list-group-item active"> <i class="fa fa-building fa-fw"></i> Flats leased in this Society</li>
            <a href="#" class="list-group-item">G-103</a>
            <a href="#" class="list-group-item">H-102</a>
            <a href="#" class="list-group-item">B-304</a>
            <a href="#" class="list-group-item">I-701</a>
          </div>
                    
                       <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-building fa-fw"></i> Flats leased in this Locality
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group"></div>
                                
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                       
                    </div>
                    <!-- /.col-lg-3 -->
                </div>
                <!-- /.row -->
				</div>
				<!--- /. content-row --->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- Custom Theme JavaScript -->
        <script src="incld/js/sb-admin-2.js"></script>
           <!-- Metis Menu Plugin JavaScript -->
    <script src="incld/js/plugins/metisMenu/metisMenu.min.js"></script>
 
    </body>
</html>