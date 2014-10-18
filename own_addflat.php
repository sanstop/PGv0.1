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
     <!--   <link href="incld/css/bootstrap-datetimepicker.min.css" rel="stylesheet">    -->
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
<!--        <script src="incld/js/bootstrap-datetimepicker.js"></script> -->
        
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
    </head>
    <body>
        <div id="wrapper">
        <?php require 'nav.php'; ?>
        <div id="page-wrapper">
            <div class="row">
            <div class="col-lg-12">
              <div class="page-header"></div>
              </div>
           </div>
            <!-- /.row -->
            <div id="content-row" class="row">
                <div class="col-lg-9">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h5 class="panel-title"><i class="fa fa-building fa-fw"></i><strong> Add Flat</strong></h5>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php //require "own_addflatreg.php";
							require "own_addflatreg.html"; ?>
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
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- Custom Theme JavaScript -->
        <script src="incld/js/sb-admin-2.js"></script>
           <!-- Metis Menu Plugin JavaScript -->
    <script src="incld/js/plugins/metisMenu/metisMenu.min.js"></script>
 
    </body>
</html>
