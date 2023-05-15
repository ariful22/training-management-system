<?php $this->load->view('front/header');?>
   <!-- <div class="container"> 
        <div class="row">
            <div class="col-md-12 text-center">
               <br> <br>
                <h1>Borno Computers</h1>
                <p>Hasan Market, North Chowmuhony</p>
                <p>Barlekha, Moulvibazar</p>
                <b>Bangladesh</b>
            </div>
        </div>
    </div>  -->
    
    <section class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <div class="register-photo">
                    <div class="form-container">

                        <form action="<?php echo base_url('stsearch/search');?>" method="post">
                            <h2 class="text-center"><strong>Search</strong> Student</h2>

                            <div class="form-group">
                                <input class="form-control" type="text" name="std_id" placeholder="Student ID"required>
                            </div>
 
                            <div class="form-group">
                                <input class="form-control" type="text" name="std_reg" placeholder="Registration No.">
                            </div>
							
							<div class="form-group">
                                <select name="course_name" class="form-control">
                                    <option value="">--Select Course Name--</option>
                                    <?php
                                    foreach($list as $value){
                                      echo '<option value="'.$value->student_course_id.'">'.$value->course_name.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
							<input class="btn btn-primary btn-block" type="submit" name="submit" value="Search">
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('front/footer');?>