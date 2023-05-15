<?php $this->load->view("admin/partial/header"); ?>
<?php
$id         = $result['student_id'];
$student_image         = $result['student_image'];
$std_name         = $result['std_name'];
$std_id         = $result['std_id'];
$std_reg         = $result['std_reg'];
$fname         = $result['fname'];
$location         = $result['location'];
$phone         = $result['phone'];
$edu_qualification         = $result['edu_qualification'];
$blood         = $result['blood'];
$student_course_id         = $result['student_course_id'];
$session         = $result['session'];
$admit_date         = $result['admit_date'];
$course_name         = $result['course_name'];
$total_cls         = $result['total_cls'];
$start_cls         = $result['start_cls'];
$end_cls         = $result['end_cls'];
$attendance         = $result['attendance'];
$absence         = $result['absence'];
$xm_date         = $result['xm_date'];
$xm_attend         = $result['xm_attend'];
$xm_result         = $result['result'];
$grade         = $result['grade'];
$certificate_no         = $result['certificate_no'];
$delivery_date         = $result['delivery_date'];
$comment         = $result['comment'];
$course_fee         = $result['course_fee'];
$first_installment         = $result['first_installment'];
$first_ins_date         = $result['first_ins_date'];
$second_installment         = $result['second_installment'];
$second_ins_date         = $result['second_ins_date'];
$third_installment         = $result['third_installment'];
$third_ins_date         = $result['third_ins_date'];
$total_paid         = $result['total_paid'];
$due_payment         = $result['due_payment'];
$less_payment         = $result['less_payment'];
$total_amount         = $result['total_amount'];


?>


<div class="content-wrapper">
    <div class="container printableArea">

        <div class="row">

            <div class="col-md-12 text-center heading-top">

                <a href="https://bornocomputers.com/">
                    <img src="<?php echo base_url('public/front/img/logo-borno.png');?>" alt="">
                </a> <br>
                
                <p><b>Address</b> - Hasan Market (1st Floor), North Chowmuhony, College Rd, Barlekha, Moulvibazar.</p>
                <p><b>Mobile</b> - 01717141416 ( Office Time ), 01740623331</p>
                <p><b>Email</b>- bornocomputers@gmail.com</p>
                <br>
            </div>
        </div>


        <form action="<?php $this->uri->uri_string(); ?>" method="POST" enctype="multipart/form-data" class="std_view_form">

            <div class="row">

                <div class="personal_info_view col-md-10 offset-md-1">
                    <div class="text-center std-img">
                        <img src="<?php echo base_url($result['student_image']);?>" alt="" class="img-fluid">
                        <hr> <br>
                    </div>
                    <table class="table table-striped std_view_tab">
                        <tbody>
                            <tr>
                                <th scope="row">Student's Name</th>
                                <td>
                                    <?php echo $std_name?>
                                </td>

                                <th scope="row">Father's Name</th>
                                <td>
                                    <?php echo $fname?>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Student's ID</th>
                                <td>
                                    <?php echo $std_id?>
                                </td>

                                <th scope="row">Registration No.</th>
                                <td>
                                    <?php echo $std_reg?>
                                </td>
                            </tr>

                            <tr>

                                <th scope="row">Address</th>
                                <td>
                                    <?php echo $location?>
                                </td>

                                <th scope="row">Edu. Qualification</th>
                                <td>
                                    <?php echo $edu_qualification?>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Phone</th>
                                <td>
                                    <?php echo $phone?>
                                </td>

                                <th scope="row">Blood Group</th>
                                <td>
                                    <?php echo $blood?>
                                </td>
                            </tr>

                            <tr>


                                <th scope="row">Session</th>
                                <td>
                                    <?php echo $session?>
                                </td>
                            </tr>


                        </tbody>
                    </table>

                </div>
            </div>

            <div class="row">
                <div class="personal_info_view col-md-10 offset-md-1 printableArea">
                    <div class="text-center std-img">
                        <h5>Course Info</h5>
                        <hr>
                    </div> <br>
                    <table class="table table-striped std_view_tab">
                        <tbody>

                            <tr>

                                <th scope="row">Course ID</th>
                                <td>
                                    01
                                </td>


                                <th scope="row">Course Name</th>
                                <td>
                                    <?php echo $course_name?>
                                </td>

                            </tr>


                            <tr>


                                <th scope="row">Admission Date</th>
                                <td>
                                    <?php echo $admit_date?>
                                </td>


                                <th scope="row">Class Started</th>
                                <td>
                                    <?php echo $start_cls?>
                                </td>
                            </tr>

                            <tr>

<th scope="row">Class Ended</th>
<td>
    <?php echo $end_cls?>
</td>


                                <th scope="row">Total Class</th>
                                <td>
                                    <?php echo $total_cls?>
                                </td>


                                
                            </tr>

                            <tr>
                                <th scope="row">Present</th>
                                <td>
                                    <?php echo $attendance?>
                                </td>

                                <th scope="row">Absence</th>
                                <td>
                                    <?php echo $absence?>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Exam Date</th>
                                <td>
                                    <?php echo $xm_date?>
                                </td>

                                <th scope="row">Exam Attendance</th>
                                <td>
                                    <?php echo $xm_attend?>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Result</th>
                                <td>
                                    <?php echo $xm_result?>
                                </td>

                                <th scope="row">GPA</th>
                                <td>
                                    4.00
                                </td>
                            </tr>

                            <tr>
                            

                                <th scope="row">Grade</th>
                                <td>
                                    <?php echo $grade?>
                                </td>

                                <th scope="row">Certificate No.</th>
                                <td>
                                    <?php echo $certificate_no?>
                                </td>

                            </tr>

                            <tr>
                            
                            <th scope="row">Delivery Date</th>
                                <td>
                                    <?php echo $delivery_date?>
                                </td>

                                <th scope="row">Comments</th>
                                <td>
                                    <?php echo $comment?>
                                </td>
                            </tr>


                        </tbody>
                    </table>

                </div>
            </div>

            <div class="row">

                <div class="personal_info_view col-md-10 offset-md-1 printableArea">
                    <div class="text-center std-img">
                        <h5>Payement Info</h5>
                        <hr>
                    </div> <br>
                    <table class="table table-striped std_view_tab">
                        <tbody>
                            <tr>
                                <th scope="row">Course Fee's</th>
                                <td>
                                    <?php echo $course_fee?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">1st Installment</th>
                                <td>
                                    <?php echo $first_installment?>
                                </td>
                                <th scope="row">Date</th>
                                <td>
                                    <?php echo $first_ins_date?>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">2nd Installment</th>
                                <td>
                                    <?php echo $second_installment?>
                                </td>
                                <th scope="row">Date</th>
                                <td>
                                    <?php echo $second_ins_date?>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">3rd Installment</th>
                                <td>
                                    <?php echo $third_installment?>
                                </td>
                                <th scope="row">Date</th>
                                <td>
                                    <?php echo $third_ins_date?>
                                </td>
                            </tr>



                            <tr>

                            
                            <th scope="row">Total Pay</th>
                                <td>
                                    <?php echo $total_paid?>
                                </td>
                                <th scope="row">Due</th>
                                <td>
                                    <?php echo $due_payment?>
                                </td>
                            </tr>

                            <tr>

                            <th scope="row">Due Payement</th>
                                <td>
                                    <?php echo $less_payment?>
                                </td>
                            
                            <th scope="row">Reduce</th>
                                <td>
                                    <?php echo $less_payment?>
                                </td>
                            </tr>

                            <tr>

 <th scope="row">In Total Pay</th>
                                <td>
                                    <?php echo $total_amount?>
                                </td>

<th scope="row">Paid</th>
    <td>
        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
    </td>
</tr>

                            
                           
                        </tbody>
                    </table>

                </div>
            </div>
        </form> <br> <br>


        <div class="row">
            <div class="col-md-12 text-center">
                <a href="javascript:void(0);" target="_blank" id="printButton">
                    <button type="button" class="btn btn-info waves-effect waves-light">Print Document</button>
                </a>
            </div>
        </div> <br>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#printButton").click(function () {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
</script>
<script type="text/javascript" src="<?php echo base_url('public/js/jquery.PrintArea.js');?>"></script>
<?php $this->load->view("admin/partial/footer"); ?>