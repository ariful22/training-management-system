<?php $this->load->view("admin/partial/header"); ?>
<div class="content-wrapper">
    <div class="container-fluid">
<!-- Breadcrumbs-->
<ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url("dashboard")?>">Student Database</a>
            </li>
            <li class="breadcrumb-item active">Add New Student</li>
        </ol> <br>

        <div class="card mb-3">
            <div class="">

                <form action="<?php echo base_url('students/ajax_add');?>" method="post" enctype="multipart/form-data" class="new_std_add">
                                    <div class="form-group row">
                                        <label for="stdname" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="stdname" name="std_name" placeholder="Student's Name">
                                        </div>

                                        <label for="fname" class="col-sm-2 col-form-label">Father's Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="fname" name="fname" placeholder="Father's Name">
                                        </div>
                                    </div>

                                    


                                    <div class="form-group row">
                                    <label for="eq" class="col-sm-2 col-form-label">Edu. Qualification</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="eq" name="edu_qualification" placeholder="Educational Qualification">
                                        </div>

                                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                    <label for="xd" class="col-sm-2 col-form-label">Course Name</label>
                                                                <div class="col-sm-4">
                                                                    <select name="course_name" class="form-control">
                                    <option value="">--Select Course Name--</option>
                                    <?php
                                    foreach($list as $value){
                                      echo '<option value="'.$value->student_course_id.'">'.$value->course_name.'</option>';
                                    }
                                    ?>
                                </select>
                                                                </div>
                                    
                                        <label for="adate" class="col-sm-2 col-form-label">Admission Date</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control datepicker" id="adate" name="admit_date" placeholder="Admission Date">
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">

                                     <label for="locate" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="locate" name="location" placeholder="Address">
                                        </div>

                                        
                                    <label for="" class="col-sm-2 col-form-label">Upload Image</label>
                                        <div class="col-sm-4">
                                            <input type="file" class="form-control-file" name="student_image"/>  
                                        </div>


                                       
                                    </div> 
									
									<div class="form-group row">
                                    <label for="xd" class="col-sm-2 col-form-label">Batch Name</label>
                                                                <div class="col-sm-4">
                                                                    <select name="batch_name" class="form-control">
                                    <option value="">--Select Batch Name--</option>
                                    <?php
                                    foreach($batchlist as $value){
                                      echo '<option value="'.$value->student_batch_id.'">'.$value->batch_name.'</option>';
                                    }
                                    ?>
                                </select>
                                                                </div>
                                    
                                    </div>
									
									<br> <br>
                                    
									<button type="submit" class="btn btn-primary"id="btnSave"> Add New Student </button>
                                </form>
                            </div>
                           

            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->


    </div>

    <?php $this->load->view("admin/partial/footer"); ?>