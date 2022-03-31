<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timesheet extends CI_Controller
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
        $this->load->model('timesheet_model');

        $this->load->library('csvimport');
    }


    public function my_timesheets( $var = "")
    {

     
        # code...

        
        $em_id=$this->session->userdata('user_login_id');

    $this->db->select('*');
    $this->db->from('timesheet');
    $this->db->where(array('emp_id' =>$em_id ));
    $result= $this->db->get()->result();


        $this->load->view('backend/mytimesheet',array('result'=>$result));
  

    }
    public function fill_timesheet( $var = "")
    {   $id=base64_decode(urldecode($var));
        # code...
        if(!empty($var) && $var)
        {
            $this->db->select('*');
            $this->db->from('timesheet');
            $this->db->where(array('id' =>$id ));
           $result= $this->db->get()->result();
           $data=$result[0]->details;
         
    
           $this->load->view('backend/fill_timesheet',array('data'=>$data,'date'=>date_format(date_create($result[0]->date),'m/d/Y'),'id'=>$result[0]->id));
        }
        else{
        $this->load->view('backend/fill_timesheet');
        }
    }

    public function add_new_timesheet( $var = null)
    {
        
        # code...
        $timesheets=array();
        $count=$this->input->post('count');
        $date=$this->input->post('date');
        $date=date_create($date);
        $date=date_format($date,"Y-m-d");

        for($i=1;$i<=$count;$i++)
        {
            if($this->input->post('pro_'.$i))
        {
            $timesheet=array();
            $timesheet['project']=$this->input->post('pro_'.$i);

            $this->db->select('*');
            $this->db->from('project');
            $this->db->where(array('id' => $timesheet['project'] ));
           $result= $this->db->get()->result();

            $timesheet['pro_name']=$result[0]->pro_name;


            $timesheet['task']=$this->input->post('task_'.$i);
            $timesheet['desc']=$this->input->post('desc_'.$i);
            $timesheet['hours']=$this->input->post('hours_'.$i);
            array_push($timesheets,$timesheet);
        }
            

        }
        $data=json_encode($timesheets);


       if(isset($_POST['submit'])){
        $filldata=array(
            'emp_id'=>$this->session->userdata('user_login_id'),
            'details'=>$data,
            'date'=>$date,
            'submitted_on'=>date("Y-m-d"),
            'status'=>1
        );
if(!$this->input->post('tsid'))
        $this->db->insert('timesheet',$filldata);
        else{
            $this->db->where('id',$this->input->post('tsid')); 
            $this->db->set('status',$filldata['status']);
            $this->db->update('timesheet');
        }
    }
    if(isset($_POST['save'])){
        $filldata=array(
            'emp_id'=>$this->session->userdata('user_login_id'),
            'details'=>$data,
            'date'=>$date,
            'submitted_on'=>date("Y-m-d"),
            'status'=>0
        );

        $this->db->insert('timesheet',$filldata);
    }

    if(isset($_POST['update'])){
        $filldata=array(
            'emp_id'=>$this->session->userdata('user_login_id'),
            'details'=>$data,
            'date'=>$date,
            'submitted_on'=>date("Y-m-d"),
            'status'=>0
        );

        $this->db->where('id',$this->input->post('tsid')); 
        $this->db->set('details',$filldata['details']);
        $this->db->update('timesheet');
    }


        // $this->timesheet_model->add_new_timesheet($filldata);
       
        $a=1;
    }


    public function delte_timeshhet_by_date($id)
    {
        # delete timesheet of curent employee by date

       
        $this->db->where('id', $id);
   if($this->db->delete('timesheet'))
   echo "Timesheet Deleted Successfully";
   

    }

    public function viewall()
    {
        # get all timesheets of department by date
 
      
            $date=$this->input->post('date');
            if(isset($date)){
            $date=date_create($date);
            $date=date_format($date,"Y-m-d");
            }
            else
            $date=date('Y-m-d');
            if($this->session->userdata('user_type')=='ADMIN')
            {
            $result= $this->timesheet_model->gettimesheetlist($date);
        }else{
            $result= $this->timesheet_model->gettimesheetlistforsuperadmin($date);
        }

            $this->load->view('backend/timesheet_list',array('result'=>$result,'date'=>date_format(date_create($date),'m/d/Y')));
        
       
    

    }
}
