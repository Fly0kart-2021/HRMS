<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"> Timesheet List</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"> Timesheets List</li>
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

<form method="POST" action="<?php echo base_url();?>timesheet/viewall"  id="frm1">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">  Timesheets List </h4>
                            </div>
                        
                            <div class="col-12 mt-4 ">
                   <div class="row">
                            <div class="col-2">
                            <input type="text" class="mydatepicker form-control" placeholder="Date" name="date" value="<?php echo $date;?>" >
                            </div>
                            <div class="col-2"><input type="submit" class="btn btn-info" value="Filter" /> </div> 
                            </div>
                            </div>
                         
                            <div class="card-body">
                                    
                            <table id="employees123" class="display nowrap table table-hover table-striped table-bordered datatable" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
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
                                            <td>'.$row->emp_name.' <div style="display:none;"  id="rec_'.$sno.'">'.$row->details.'</div> </td>
                                            <td>'.$row->date.'</td>
                                            <td>'.$row->submitted_on.'</td>';
                                            if($row->status==1)
                                            {echo '<td>Submitted</td><td></td>';
                                              
                                            }
                                            else{
                                            echo '<td>Saved</td>
                                            <td><a href="#" onclick="viewtimesheet('.$sno.',\''.$row->emp_name.'\',\''.$row->date.'\')" title="Edit" class="btn btn-sm btn-info waves-effect waves-light taskmodal" data-id="<?php echo $value->id ?>"><i class="fa fa-eye"></i></a>';
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
                </div>  </form>
                        <div class="modal fade" id="holysmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" >
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Holidays</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="Add_Holidays" id="holidayform" enctype="multipart/form-data">
                                    <div class="modal-body" >
                                        <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Project</th>
                                            <th>Task</th>
                                            <th>Description</th>
                                            <th>Hours</th>
                                            </tthead>

                                            <tbody id="records">

                                            </tbody>
                                        </table>
                                         
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="id" value="" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                     
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


    function viewtimesheet(id,name,date)
    {
        debugger;
        filldata="";
        var data=$('#rec_'+id).html();
        data=JSON.parse(data);
        for(i=0;i<data.length;i++)
        {
                filldata+='<td>'+data[i].pro_name+'</td><td>'+data[i].task+'</td><td>'+data[i].desc+'</td><td>'+data[i].hours+'</td>'
        }
        $('#records').html('');
        $('#records').html(filldata);
        $('#holysmodel').modal('show');
        $('#exampleModalLabel1').html(name+'<br><span class="text-secondary">'+date+'</span>');


    }





  
</script>    
