        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <?php
                $id = $this->session->userdata('user_login_id');
                $basicinfo = $this->employee_model->GetBasic($id);
            //    $salesemp=  $this->session->userdata('user_type');

                ?>
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $basicinfo->em_image ?>" alt="user" />
                        <!-- this is blinking heartbit-->
                        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </div>

                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5><?php echo $basicinfo->first_name . ' ' . $basicinfo->last_name; ?></h5>
                        <?php if ($this->session->userdata('user_type') != 'EMPLOYEE') {
                            echo '<a href="'.base_url().'settings/Settings" class="dropdown-toggle u-dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                            ';
                        }
                        ?>
                        
                        <a href="<?php echo base_url(); ?>login/logout" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>

                       <!-- <?php if($this->session->userdata('dep_id') == 8) {?>
                        <a target="_blank" href="<?php echo base_url(); ?>employee/sales" class=""  title="Sales"><i class="mdi mdi-transfer"></i></a>
                       <?php }?> -->
                    </div>
                   
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li> <a href="<?php echo base_url(); ?>"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a></li>
                        <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>
                            <li> <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employees </span></a>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Leave </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>
                                    <li><a href="<?php echo base_url(); ?>leave/EmApplication"> Leave Application </a></li>
                                    <li><a href="<?php echo base_url(); ?>leave/EmLeavesheet"> Leave Sheet </a></li>
                                </ul>
                            </li>
                            <li>
                            <?php if($this->session->userdata('dep_id') == 8) {?>
                        <a target="_blank" onclick='myCRM()' class="has-arrow"  title="Sales"><i class="mdi mdi-transfer"></i> <span class="hide-menu"> CRM </span></a>
                       <?php } else{?>
                            
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Projects </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo base_url(); ?>Projects/All_Projects">Projects </a></li>
                                    <li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Task List </a></li>
                                    <!--<li><a href="<?php #echo base_url(); 
                                                        ?>Projects/All_Tasks"> Field Visit</a></li>-->
                                </ul>
                       <?php } ?>

                            </li>

                            <li> <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url(); ?>myattendance" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">My Attendance </span></a>
                                <!-- <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Projects/All_Projects">Projects </a></li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Task List </a></li>
                                <li><a href="<?php #echo base_url(); 
                                                ?>Projects/All_Tasks"> Field Visit</a></li>
                            </ul> -->
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Timesheet </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo base_url(); ?>timesheet/fill_timesheet">Fill Timesheet </a></li>
                                    <li><a href="<?php echo base_url(); ?>timesheet/my_timesheets"> View Time Sheets </a></li>
                                    <!--<li><a href="<?php #echo base_url(); 
                                                        ?>Projects/All_Tasks"> Field Visit</a></li>-->
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-building-o"></i><span class="hide-menu">Organization </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo base_url(); ?>organization/Department">Department </a></li>
                                    <li><a href="<?php echo base_url(); ?>organization/Designation">Designation</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employees </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo base_url(); ?>employee/Employees">Employees </a></li>
                               <!--      <li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>
                                    <li><a href="<?php echo base_url(); ?>employee/Inactive_Employee">Inactive User </a></li> -->
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu">Attendance </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo base_url(); ?>attendance/Attendance">Attendance List </a></li>
                                    <li><a href="<?php echo base_url(); ?>attendance/Save_Attendance">Add Attendance </a></li>
                                    <li><a href="<?php echo base_url(); ?>attendance/Attendance_Report">Attendance Report </a></li>
                                    <?php if ($this->session->userdata('user_type') != 'SUPER ADMIN') {
                                        echo '<li><a href="' . base_url() . 'myattendance"> My Attendance </a></li>';
                                    } ?>

                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Leave </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>
                                    <li><a href="<?php echo base_url(); ?>leave/leavetypes"> Leave Type</a></li>
                                    <li><a href="<?php echo base_url(); ?>leave/Application"> Leave Application </a></li>
                                   <!--  <li><a href="<?php echo base_url(); ?>leave/Earnedleave"> Earned Leave </a></li> -->
                                    <li><a href="<?php echo base_url(); ?>leave/Leave_report"> Report </a></li>
                                    <?php if ($this->session->userdata('user_type') == 'ADMIN') echo '  <li><a href="' . base_url() . 'leave/EmApplication"> My Leaves </a></li>'; ?>
                                </ul>
                            </li>
                            
                            <li> <?php if($this->session->userdata('dep_id') == 8) {?>
                       <a target="_blank" onclick='myCRM()' class="has-arrow"  title="Sales"><i class="mdi mdi-transfer"></i> <span class="hide-menu"> CRM </span></a>
                       <?php } else{?>


                                 <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Project </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo base_url(); ?>Projects/All_Projects">Projects </a></li>
                                    <li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Task List </a></li>
                                    <!-- <li><a href="<?php echo base_url(); ?>Projects/Field_visit"> Field Visit</a></li> -->
                                </ul>
                            </li>

                       <?php }?>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Timesheet </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo base_url(); ?>timesheet/fill_timesheet">Fill Timesheet </a></li>
                                    <li><a href="<?php echo base_url(); ?>timesheet/my_timesheets"> My Time Sheets </a></li>
                                    <li><a href="<?php echo base_url(); ?>timesheet/viewall"> Timesheet List</a></li>
                                </ul>
                            </li>



                            <!-- <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Loan </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo base_url(); ?>Loan/View"> Grand Loan </a></li>
                                    <li><a href="<?php echo base_url(); ?>Loan/installment"> Loan Installment</a></li>
                                </ul>
                            </li> -->
                            <!-- <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Assets </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo base_url(); ?>Logistice/Assets_Category"> Assets Category </a></li>
                                    <li><a href="<?php echo base_url(); ?>Logistice/All_Assets"> Asset List </a></li> -->
                                    <!--<li><a href="<?php #echo base_url(); 
                                                        ?>Logistice/View"> Logistic Support List </a></li>-->
                                    <!-- <li><a href="<?php echo base_url(); ?>Logistice/logistic_support"> Logistic Support </a></li>
                                </ul>
                            </li> -->
                                    <?php  if ($this->session->userdata('user_type') == 'SUPER ADMIN') { ?>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-newspaper"></i><span class="hide-menu">Payroll </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <!--<li><a href="<?php #echo base_url(); 
                                                        ?>Payroll/Salary_Type"> Payroll Type </a></li>-->
                                    <li><a href="<?php echo base_url(); ?>Payroll/Salary_List"> Payroll List </a></li>
                                    <li><a href="<?php echo base_url(); ?>Payroll/Generate_salary"> Generate Payslip</a></li>
                                    <li><a href="<?php echo base_url(); ?>Payroll/Payslip_Report"> Payslip Report</a></li>
                                </ul>
                            </li>
                            <?php } ?>

                            <li> <a href="<?php echo base_url() ?>notice/All_notice"><i class="mdi mdi-treasure-chest"></i><span class="hide-menu">Notice <span class="hide-menu"></a></li>
                            <li> <a href="<?php echo base_url(); ?>settings/Settings"><i class="mdi mdi-settings"></i><span class="hide-menu">Settings <span class="hide-menu"></a></li>
                        <?php } ?>
                        <?php   if ($this->session->userdata('user_type') != 'SUPER ADMIN') {?>
                            <li><a class="has-arrow waves-effect waves-dark" href="<?php echo base_url(); ?>Payroll/Payslip_Report" aria-expanded="false"><i class="mdi mdi-newspaper"></i><span class="hide-menu">PaySlip </span></a></li>

                        <?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>


                
                
                <form id="sess" action="https://sales.thetechcubes.in/" method="POST">
                    <input type="text" name="user_login_id" value="<?php echo $this->session->userdata('user_login_id'); ?>" hidden>
                    <input type="text" name="name" value="<?php echo $this->session->userdata('name'); ?>" hidden>
                    <input type="text" name="email" value="<?php echo $this->session->userdata('email'); ?>" hidden>
                    <input type="text" name="user_image" value="<?php echo $this->session->userdata('user_image'); ?>" hidden>
                    <input type="text" name="user_type" value="<?php echo $this->session->userdata('user_type'); ?>" hidden>
                    <input type="text" name="dep_id" value="<?php echo $this->session->userdata('dep_id'); ?>" hidden>
                </form>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script>

                    function myCRM(){
                        $('#sess').submit();
                    }
            
                </script>
            