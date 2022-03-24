<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">My Timesheets</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">My Timesheets</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">

                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>attendance/Attendance" class="text-white"><i class="" aria-hidden="true"></i>  Attendance List</a></button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>leave/Application" class="text-white"><i class="" aria-hidden="true"></i>  Leave Application</a></button>
                    </div>
                </div>  


<!-- pageheader ends here begin content -->


                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"> My Timesheets </h4>
                            </div>
                            <div class="card-body">
                                    
                            <table id="employees123" class="display nowrap table table-hover table-striped table-bordered datatable" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>SNO.</th>
                                                <th>Date</th>
                                                
                                                <th>Sumbitted On </th>
                                                <!-- <th> </th> -->
                                                <th> Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>

                                        <?php
                                        $sno=1;
                                        foreach($result as $row)
                                        {
                                            echo '<tr>
                                            <td>'.$sno.'</td>
                                            <td>'.$row->date.'</td>
                                            <td>'.$row->submitted_on.'</td>';
                                            if($row->status==1)
                                            {echo '<td>Submitted</td><td></td>';
                                              
                                            }
                                            else{
                                            echo '<td>Saved</td>
                                            <td><a href="'.base_url().'timesheet/fill_timesheet/'.urlencode(base64_encode($row->id)).'" title="Edit" class="btn btn-sm btn-info waves-effect waves-light taskmodal" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <a onclick="deletetimesheet('.$row->id.')" href="#" title="Delete" class="btn btn-sm btn-info waves-effect waves-light TasksDelet" data-id="<?php echo $value->id ?>"><i class="fa fa-trash-o"></i></a></td>';
                                            }

                                           
                                            
                                            echo '</tr>';
                                            $sno+=1;
                                        }


?>
                                      
                                        </tbody>
                                    </table>
                                    
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="modal fade" id="holysmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Holidays</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="Add_Holidays" id="holidayform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label class="control-label">Holidays name</label>
                                                <input type="text" name="holiname" class="form-control" id="recipient-name1" minlength="4" maxlength="25" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Holidays Start Date</label>
                                                <input type="date" name="startdate" class="form-control" id="recipient-name1"  value="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Holidays End Date</label>
                                                <input type="date" name="enddate" class="form-control" id="recipient-name1" value="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Number of Days</label>
                                                <input type="number" name="nofdate" class="form-control" id="recipient-name1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label"> Year</label>
                                                <textarea class="form-control" name="year" id="message-text1"></textarea>
                                            </div>                                           
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="id" value="" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                      
<?php $this->load->view('backend/footer'); ?>
<script>




    $('#employees123').DataTable({
        "aaSorting": [[1,'asc']],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });


    function deletetimesheet(id)
    {
        alert("Are you sure you want to delete timesheet?");
        $.ajax({
url:'<?php echo base_url()?>timesheet/delte_timeshhet_by_date/'+id,
type:'post',
success:function(msg){
    $('#message').html(msg);
    $('#message').show();

    window.location="<?php echo base_url();?>timesheet/my_timesheets";

},
error:function(){
alert("something went wrong");
}
        });
    }
</script>    