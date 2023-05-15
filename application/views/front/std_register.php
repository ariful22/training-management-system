<?php $this->load->view('front/header');?>
<section class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Student Registration</h2>
        </div>
    </div>

    <section class="std-form">
        <form action="<?php echo base_url('students/ajax_add');?>" method="post" enctype="multipart/form-data" class="new_std_add">
            <div class="form-group row">
                <label for="stdname" class="col-sm-2 col-form-label">Name in Bengali</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="stdname" name="std_name_bangla" placeholder="Student's Name in Bengali">
                </div>

                <label for="fname" class="col-sm-2 col-form-label">Name in English</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="fname" name="std_name_eng" placeholder="Student's Name in English">
                </div>
            </div>

            <div class="form-group row">
            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                </div>

                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                </div>
            </div>


            <div class="form-group row">
                <label for="eq" class="col-sm-2 col-form-label">Edu. Qualification</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="eq" name="edu_qualification" placeholder="Educational Qualification">
                </div>

                <label for="occ" class="col-sm-2 col-form-label">Occupation</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="occ" name="occu" placeholder="Occupation">
                </div>
            </div>

            <div class="form-group row">
                <label for="ftnameb" class="col-sm-2 col-form-label">Father's Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ftnameb" name="fname" placeholder="Father's Name in Bengali">
                </div>

                <label for="ftnamee" class="col-sm-2 col-form-label">Father's Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ftnamee" name="std_name_eng" placeholder="Father's Name in English">
                </div>
            </div>

            <div class="form-group row">
                <label for="mnameb" class="col-sm-2 col-form-label">Mother's Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="mnameb" name="mnameb" placeholder="Mother's Name in Bengali">
                </div>

                <label for="mnamee" class="col-sm-2 col-form-label">Mother's Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="mnamee" name="mnmee" placeholder="Mother's Name in English">
                </div>
            </div>

            <div class="form-group row">
                <label for="preadd" class="col-sm-2 col-form-label">Present Address</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="preadd" name="preadd" placeholder="Present Location">
                </div>

                <label for="peradd" class="col-sm-2 col-form-label">Permanent Address</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="peradd" name="peradd" placeholder="Permanent Address">
                </div>
            </div>



            <div class="form-group row">
                <label for="rel" class="col-sm-2 col-form-label">Religion</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control datepicker" id="rel" name="rel" placeholder="Religion">
                </div>

                <label for="bg" class="col-sm-2 col-form-label">Blood Group</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="bg" name="blood" placeholder="Blood Group">
                </div>
            </div>

            <div class="form-group row">
                <label for="nid" class="col-sm-2 col-form-label">NID No.</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control datepicker" id="nid" name="nid" placeholder="National ID Card No.">
                </div>

                <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="dob" name="birth" placeholder="Date of Birth">
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

                <label for="" class="col-sm-2 col-form-label">Session</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="session" placeholder="Session">
                </div>

                
            </div>


            <div class="form-group row">

                <label for="reg" class="col-sm-2 col-form-label">Registration No.</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="reg" name="reg-no" placeholder="Registration No.">
                </div>


                <label for="" class="col-sm-2 col-form-label">Upload Image</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control-file" name="student_image" />
                </div>



            </div>
            <br>
            <br>

            <button type="submit" class="btn btn-primary" id="btnSave"> Submit </button>
        </form>
    </section>
</section>

<?php $this->load->view('front/footer');?>