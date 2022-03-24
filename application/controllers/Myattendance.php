<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myattendance extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model');
        $this->load->model('employee_model');
        $this->load->model('loan_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
        $this->load->model('attendance_model');
        $this->load->model('project_model');
        $this->load->library('csvimport');
    }


    public function index()
    {
       $this->myattend();
    }


    public function myattend()
    {
        if(isset($_POST['month']))
        $month = $_POST['month'];
        else
        $month=date('m/Y');
        $mon = array();
        $mon = explode("/", $month);
        $totaldays = cal_days_in_month(CAL_GREGORIAN, $mon[0], $mon[1]);
        $data = "";
        for ($i = 1; $i <= $totaldays; $i++) {
            $date = date_create($mon[1] . "-" . $mon[0] . "-" . $i);
            $day = date_format($date, 'l');
            if ($day == 'Sunday') { //check if its weekoff
                $data .= '
                <div class="col-xs-6 col-md-2" style="padding:0px;border:1px solid lightgrey;min-height:150px;text-align:center;"><div class="btn btn-info" style="width:100%;">' . $i . ' ' . $day . '</div><div class="badge badge-secondary center" style="margin-top:25%">WeekOff</div></div>';
            } else { // check if its a holiday
                $countholiday = $this->leave_model->get_holiday_between_dates(date_format($date, 'Y-m-d'));
                if ($countholiday) { //if holiday is true
                    $data .= ' <div class="col-xs-6 col-md-2" style="padding:0px;border:1px solid lightgrey;text-align:center;min-height:150px;"><div class="btn btn-info" style="width:100%;">' . $i . ' ' . $day . '</div><div class="badge badge-warning" style="margin-top:25%">'.$countholiday->holiday_name.'</div></div>';
                } else { // not a holiday
                    #check if its a leave (paid/unpaid)
                    
                    $checkleave = $this->leave_model->checkleaveforattend(date_format($date, 'Y-m-d'));
                    if ($checkleave) { #check leave type i.e paid or unpaid then check halfday or fullday
                        if($checkleave->leave_type=='Half Day'){

                            $data .= '  <div class="col-xs-6 col-md-2" style="padding:0px;border:1px solid lightgrey;text-align:center;min-height:150px;"><div class="btn btn-info" style="width:100%;">' . $i . ' ' . $day . '</div><div class="badge badge-primary" style="margin-top:25%">Half Day</div></div>';

                        }
                        else{
                            $data .= '  <div class="col-xs-6 col-md-2" style="padding:0px;border:1px solid lightgrey;text-align:center;min-height:150px;"><div class="btn btn-info" style="width:100%;">' . $i . ' ' . $day . '</div><div class="badge" style="background-color:#a232a8;margin-top:25%">Leave</div></div>';

                        }


                    } else {
                        $attendance = $this->attendance_model->em_check_attendance(date_format($date, 'Y-m-d'));
                        if ($attendance) { // mark present
                            $data .= '  <div class="col-xs-6 col-md-2" style="padding:0px;border:1px solid lightgrey;text-align:center;min-height:150px;"><div class="btn btn-info" style="width:100%;">' . $i . ' ' . $day . '</div><div class="badge" style="background-color:green;margin-top:25%">Present</div></div>';
                        } else { #mark absent
                            $data .= '  <div class="col-xs-6 col-md-2" style="padding:0px;border:1px solid lightgrey;text-align:center;min-height:150px;"><div class="btn btn-info" style="width:100%;">' . $i . ' ' . $day . '</div><div class="badge badge-danger" style="margin-top:25%">Absent</div></div>';
                        }
                    }
                }
            }
        }
        $this->load->view('backend/header');
        $this->load->view('backend/sidebar');
        
        $this->load->view('backend/my_attendance',array('data'=>$data,'month'=>$month));
        $this->load->view('backend/footer');

    }
}
