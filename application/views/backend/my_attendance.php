<link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/js/MonthPicker.min.css" rel="stylesheet" type="text/css" />
<link rel="<?php echo base_url(); ?>assets/js/stylesheet" type="text/css" href="examples.css" />
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/MonthPicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/examples.js"></script>
<style type="text/css">
.month-picker-year-table tbody tr:first-child{
    background-color:#1976d2;
}
</style>




<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i> My Attendance</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Attedance</li>
            </ol>
        </div>
    </div>

    <div class="col-md-12 align-self-center">
        <form name="test" method="post" action="<?php echo base_url(); ?>/Myattendance/myattend">
            <center>
                <input class="form-control" style="width:20%" autocomplete="off" name="month" id="NoIconDemo" type="text" value="<?php echo $month?>" />

                <button type="submit" style="margin-bottom:5px;" class="btn btn-info" value="Apply">Apply</button>
            </center>
    </div>
    </form>



    <div class="container">
        <div class="col-12">
            <div class="row mt-5 mb-3">
                <?php if (isset($data)) echo $data; ?>

            </div>

        </div>
    </div>
</div>
</div>