<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<style>
.fa-plus{
    color:blue;
}
.fa-trash{
    color:red;
}
.fa{
    padding:5%;
}
.fas{
    padding:5%;
}
.fas:hover{
    transform:scale(1.2);
}
.fa:hover{
    transform:scale(1.2);
}
</style>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"> Timesheets</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Fill Timesheets</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
<form method="post" action="<?php echo base_url();?>timesheet/add_new_timesheet">
                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>attendance/Attendance" class="text-white"><i class="" aria-hidden="true"></i>  Attendance List</a></button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>leave/Application" class="text-white"><i class="" aria-hidden="true"></i>  Leave Application</a></button>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"> Fill Timesheet </h4> 
                            </div>
                            <div class="row m-t-10">
                            <div class="col-md-12 offset-3"><center><input type="text" placeholder="Select Date" name="date" id="date" class="mydatepicker datepicker " style="border-width:0.2px;padding-left:1%;" value="<?php if(isset($date)) echo $date;?>"  <?php if(isset($date)) echo "disabled"  ?>/></center></div>
                            </div>
                            <div class="card-body">
                                    
                            <table id="employees123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Project</th>
                                                <th>Task</th>
                                                
                                                <th>Description </th>
                                                <!-- <th> </th> -->
                                                <th> Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody id="records">
                                     
                                        </tbody>
                                    </table>
                                    
                            </div>
                            <div class="card-footer">
                            <input type="submit" value="Submit" name="submit" class="btn btn-info">
                            <?php if(!isset($date)) 
                            {echo
                            '<input type="submit" value="Save" name="save" class="btn btn-info right">';
                         
                            }
                            else{
                            echo '<input type="submit" value="Update" name="update" class="btn btn-info right">';
                            echo '<input type="hidden" value="'.$id.'" name="tsid">';
                        }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>

<input type="hidden" value="" id="count" name="count">


                </div></form>
                <span style="display:none;" id="list" ><?php if(isset($data))echo  $data;?></span>
                </div>
                                      
<?php $this->load->view('backend/footer'); ?>
<script src="https://kit.fontawesome.com/987a2b0675.js" crossorigin="anonymous"></script>
<script>
var projectlist;
$(document).ready(function(){

    
    debugger;
    var details=$('#list').html();
    if(details!="")
    details=JSON.parse(details);
  
    
    if(details){

        $.ajax({
url:'<?php echo base_url();?>projects/get_projectlist_by_dep',
type:'get',
success:function(data){
    var count =1;
    debugger;
    var filldata="";
    var projectdd="<select class='select2' id='pro_"+count+"' name='pro_"+count+"'>";
     projectlist=JSON.parse(data);

     for(i=0;i<details.length;i++){
        
            for(j=0;j<projectlist.length;j++){
                if(projectlist[j].id==details[i].project)
        projectdd+='<option value="'+projectlist[j].id+'" selected>'+projectlist[j].pro_name+'</option>';
        else
        projectdd+='<option value="'+projectlist[j].id+'" >'+projectlist[j].pro_name+'</option>';

    }
    projectdd+='</select>';
if(i==0)
    filldata+='<tr id="row_'+count+'"><td>'+projectdd+'</td><td><input class="form-control" type="text" placeholder="Task" id="task_1" name="task_'+count+'" value="'+details[i].task+'" /></td><td><input class="form-control" type="text" placeholder="Description" id="desc_1" name="desc_'+count+'" value="'+details[i].desc+'"/></td><td><input class="form-control" type="text" placeholder="Hours" id="hours_1" name="hours_'+count+'" value="'+details[i].hours+'"/></td><td id="action_1"><span class="fa fa-plus" id="plus" onclick="add_new_row();" title="Add Row"></span></td></tr>';
   else

   filldata+='<tr id="row_'+count+'"><td>'+projectdd+'</td><td><input class="form-control" type="text" placeholder="Task" id="task_1" name="task_'+count+'" value="'+details[i].task+'" /></td><td><input class="form-control" type="text" placeholder="Description" id="desc_1" name="desc_'+count+'" value="'+details[i].desc+'"/></td><td><input class="form-control" type="text" placeholder="Hours" id="hours_1" name="hours_'+count+'" value="'+details[i].hours+'"/></td><td id="action_1"><span class="fas fa-trash" title="Delete" onclick="delete_row('+count+');"></span></td></tr>';
  

    $('#records').html(filldata);
    $('.select2').select2();
    $('#count').val(count);
    count++;
    projectdd="<select class='select2' id='pro_"+count+"' name='pro_"+count+"'>";


       

}
}
        });
       

    }
    else{

   
    $.ajax({
url:'<?php echo base_url();?>projects/get_projectlist_by_dep',
type:'get',
success:function(data){
    debugger;
    var filldata="";
    var projectdd="<select class='select2' id='pro_1' name='pro_1'>";
     projectlist=JSON.parse(data);
    for(i=0;i<projectlist.length;i++){
        projectdd+='<option value="'+projectlist[i].id+'">'+projectlist[i].pro_name+'</option>';
    }
    projectdd+='</select>';

    //fill default new record
    filldata+='<tr id="row_1"><td>'+projectdd+'</td><td><input class="form-control" type="text" placeholder="Task" id="task_1" name="task_1" /></td><td><input class="form-control" type="text" placeholder="Description" id="desc_1" name="desc_1" /></td><td><input class="form-control" type="text" placeholder="Hours" id="hours_1" name="hours_1"/></td><td id="action_1"><span class="fa fa-plus" id="plus" onclick="add_new_row();" title="Add Row"></span></td></tr>';
    $('#records').html(filldata);
    $('.select2').select2();
    $('#count').val('1');

}
    });

    }

});

function add_new_row(){
    var count=parseInt($('#count').val())+1;
    var projectdd="<select class='select2' id='pro_"+count+"' name='pro_"+count+"'>";
  
    for(i=0;i<projectlist.length;i++){
        projectdd+='<option value="'+projectlist[i].id+'">'+projectlist[i].pro_name+'</option>';
    }
    projectdd+='</select>';
  
    row='<tr id="row_'+count+'"><td>'+projectdd+'</td><td><input class="form-control" type="text" placeholder="Task" id="task_'+count+'" name="task_'+count+'" /></td><td><input class="form-control" type="text" placeholder="Description" id="desc_'+count+'" name="desc_'+count+'" /></td><td><input class="form-control" type="text" placeholder="Hours" id="hours_'+count+'" name="hours_'+count+'" /></td><td id="action_'+count+'"><span class="fas fa-trash" title="Delete" onclick="delete_row('+count+');"></span></td></tr>';
    $('#records').append(row);
    $('.select2').select2();
   
    $('#count').val(count);
   
  

   
}

function delete_row(id){
    $('#row_'+id).remove();
    
}
</script>