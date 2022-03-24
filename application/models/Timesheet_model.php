<?php

class Timesheet_model extends CI_Model
{

  public function gettimesheetlist( $date = null)
  {
      # code...
      $sql='SELECT details,`date`,submitted_on,CONCAT(employee.first_name," ",employee.last_name) AS emp_name,timesheet.status  FROM timesheet LEFT JOIN employee ON timesheet.emp_id=employee.em_id WHERE `date`=\''.$date.'\' AND employee.dep_id='.$this->session->userdata('dep_id');
     return $this->db->query($sql)->result();
      
  }

  public function gettimesheetlistforsuperadmin( $date = null)
  {
    # code...
    $sql='SELECT details,`date`,submitted_on,CONCAT(employee.first_name," ",employee.last_name) AS emp_name,timesheet.status  FROM timesheet LEFT JOIN employee ON timesheet.emp_id=employee.em_id WHERE `date`=\''.$date.'\' ';
    return $this->db->query($sql)->result();
  }


}

?>
