<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="GenIT Bangladesh">
    <!-- Favicon icon -->
    <?php $settingsvalue = $this->settings_model->GetSettingsValue(); ?>
    <link rel="icon" type="image/ico" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.ico">
    <title><?php echo $settingsvalue->sitetitle; ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/css/print.css" rel="stylesheet" media='print'>
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url(); ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/calendar/dist/fullcalendar.css" rel="stylesheet" type="text/css" />


    </style>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <?php
    $id = $this->session->userdata('user_login_id');
    $basicinfo = $this->employee_model->GetBasic($id);
    $settingsvalue = $this->settings_model->GetSettingsValue();
    $em_id = $basicinfo->em_code;
    $checkout = $this->employee_model->checkattend($em_id);
    $getattend = $this->employee_model->getattend($em_id);

    $year =  date('y');
    $y = substr($year, -2);
    $date = date("m/d/$y");
    #echo $date;
    $leavetoday = $this->leave_model->GetLeaveToday($date);
    ?>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><b>
                            <img src="<?php echo base_url(); ?>assets/images/logo-icon.png" alt="DRI" class="DRI-logo" style="width:50px;" />
                        </b>
                        <!-- Logo text --><span>
                            <img src="<?php echo base_url(); ?>assets/images/<?php echo $settingsvalue->sitelogo; ?>" alt="The TechCubes" class="dark-logo" height="60px" width="100px" />
                            <!-- Light Logo text -->
                        </span> </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> -->
                            <!-- </a> -->
                            <div class="dropdown-menu mailbox scale-up-left">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <?php foreach ($leavetoday as $value) : ?>
                                                <a href="#">
                                                    <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5><?php echo $value->first_name; ?></h5> <span class="mail-desc"><?php echo $value->reason; ?></span> <span class="time"><?php echo $value->start_date; ?></span>
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>

                    <div class="nav-item ml-4 mr-5">
                        <ul class="navbar-nav  nav-toggler waves-effect waves-dark">
                       <?php  foreach($getattend as $value) {$signin=$value->signin_time;$signout=$value->signout_time; $workinghour=$value->working_hour; } ?>
                       
                      <?php if ($checkout==1) { ?>

                        <li style="color:white;margin-top:3%;">  Time In :<b> <?php {echo $signin; }?></b> </li>
                      <?php } ?>
                        </ul>
                        </div>


                    <div class="nav-item ml-4 mr-5">
                        <ul class="navbar-nav  nav-toggler waves-effect waves-dark">
                          


                             

                           <?php if ($checkout==0 ) { ?>
                                <li class="nav-item"> <a href="#" id="timein" style="background-color:#1976d2;font-weight: bold; border-radius:25px;color:#ffe484;border-color: #ffe484;" class="btn">Time In</a>
                                    <input type="hidden" id="emid" name="emid" value="<?php echo $basicinfo->em_code;  ?>" />
                                </li>
                                

                            <?php }
                           foreach($getattend as $value) {$signin=$value->signin_time;$signout=$value->signout_time; $workinghour=$value->working_hour; }
                            
                        
                           if ($checkout==1 and $signout == "") { ?>
                          
                                <li class="nav-item"> <a id="timeout" style="font-weight: bold;background-color:#1976d2; border-radius:25px;color:#ffe484;border-color: #ffe484;" class="btn">Time Out</a> </li>
                                <input type="hidden" id="emid1" name="emid1" value="<?php echo $basicinfo->em_code;  ?>" />
                                <input type="hidden" id="signin" name="signin" value="<?php {echo $signin; }?>" />
                               

                            <?php  }  if($checkout==1 and $signin != "" and $signout != ""){?>
                                <div style="color:white;margin-top:6%;"><li class="nav-item"> Your Today Working Hour :<p style="font-weight:bold;"> <?php {echo $workinghour; }?> </p> </li> </div>
                           <?php } ?>
                            
                                
                        </ul>
                    </div>




                    <ul class="navbar-nav my-lg-0">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/images/users/<?php echo $basicinfo->em_image; ?>" alt="Genit" class="profile-pic" style="height:40px;width:40px;border-radius:50px" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?php echo base_url(); ?>assets/images/users/<?php echo $basicinfo->em_image; ?>" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?php echo $basicinfo->first_name . ' ' . $basicinfo->last_name; ?></h4>
                                                <p class="text-muted"><?php echo $basicinfo->em_email ?></p>
                                            </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>"><i class="ti-user"></i> My Profile</a></li>
                                    <?php if ($this->session->userdata('user_type') != 'EMPLOYEE') { ?>

                                        <li><a href="<?php echo base_url(); ?>settings/Settings"><i class="ti-settings"></i> Account Setting</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url(); ?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>


                    </ul>
                </div>
            </nav>
        </header>




        <script>
             var check=0;
            $("#timein").click(function(e) {
                e.preventDefault();
                 
                if(check==1)
                return false;
                else{
                    check=1;
                }
                debugger;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>Attendance/timein',
                    data: {
                        id: $("#emid").val(),

                    },
                    success: function($data) {
                        location.reload();
                        alert('Your Working Time Started');
                    },
                    error: function() {
                        alert('error');
                    }
                });
            });
        </script>


        <script>
           
            $("#timeout").click(function(e) {
                if (confirm("Do you want to TIME OUT ?") == true) {
                    $("#timeout").hide();
                e.preventDefault();
               
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>Attendance/timeout',
                    data: {
                        id: $("#emid1").val(),
                        signin: $("#signin").val(),

                    },
                    success: function($data) {
                        location.reload();
                             
                    },
                    error: function() {
                        alert('error');
                    }
                });
                }
            });
        </script>




        <!-- GetButton.io widget -->
        <script type="text/javascript">
            (function() {
                var options = {
                    whatsapp: "8707402649", // WhatsApp number
                    call_to_action: "Message us", // Call to action
                    position: "right", // Position may be 'right' or 'left'
                };
                var proto = document.location.protocol,
                    host = "getbutton.io",
                    url = proto + "//static." + host;
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = url + '/widget-send-button/js/init.js';
                s.onload = function() {
                    WhWidgetSendButton.init(host, proto, options);
                };
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
                var getbtn = document.getElementsByClassName('wh-widget-send-button-get-button');
                for (i = 0; i < getbtn.length; i++) {
                    getbtn[i].style.display = "none";
                }
            })();
        </script>
        <!-- /GetButton.io widget -->