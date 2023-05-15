<?php $this->load->view('front/header');



/*if($results){
  foreach ($results as $count) {
    $id = $count['std_id'];
    $name = $count['std_name'];
    $phone = $count['phone'];
  
    echo '<tr>
          <td>'.$id.'</td>
          <td>'.$name.'</td>
          <td>'.$phone.'</td>

        </tr>';
  }
}
else{
  echo '<tr><td colspan="4">No Data available</td></tr>';
}*/
        
?>





<div class="container profile">

  <form action="" method="post">

    <div class="row">



      <?php if(!empty($results)){ 
				   

	//foreach($results as $row){

?>

      



      <?php foreach ($results as $count) {?>

      <div class="row std-info">

      <div class="col-md-4 text-center">
      <div class="alert alert-success" role="alert">
       <h5>Student's Info</h5>
</div>
      <div>
      <img src="<?php echo base_url($count['student_image']);?>" class="img-fluid" alt="">
      </div> <br> 

<table class="table text-left">
  <tbody>
  

    <tr>
      <th scope="row">Student's ID</th>
      <td><?php echo $count['std_id'];?></td>
    </tr>

    <tr>
      <th scope="row">Registration No.</th>
      <td><?php echo $count['std_reg'];?></td>
    </tr>
    <tr>
      <th scope="row">Student's Name</th>
      <td><?php echo $count['std_name'];?></td>
    </tr>
    
  </tbody>
</table>
</div>




<div class="col-md-4 text-center course">
      <div class="alert alert-primary" role="alert">
       <h5>Course Info</h5>
</div>

<table class="table text-left">
  <tbody>

    <tr>
      <th scope="row">Course Name</th>
      <td><?php echo $count['course_name'];?></td>
    </tr>

    <tr>
      <th scope="row">Admission Date</th>
      <td><?php echo $count['admit_date'];?></td>
    </tr>

    <tr>
      <th scope="row">Class Started</th>
      <td><?php echo $count['start_cls'];?></td>
    </tr>

    <tr>
      <th scope="row">Class Ended</th>
      <td><?php echo $count['end_cls'];?></td>
    </tr>

    <tr>
      <th scope="row">Total Class</th>
      <td><?php echo $count['total_cls'];?></td>
    </tr>

    <tr>
      <th scope="row">Present</th>
      <td><?php echo $count['attendance'];?></td>
    </tr>

     <tr>
      <th scope="row">Absence</th>
      <td> <?php echo $count['absence'];?></td>
    </tr>
  </tbody>
</table>
</div>

             






<div class="col-md-4 text-center exam">
      <div class="alert alert-danger" role="alert">
       <h5>Exam Info</h5>
</div>
<table class="table text-left">
  <tbody>

    <tr>
      <th scope="row">Exam Date</th>
      <td> <?php echo $count['xm_date'];?></td>
    </tr>

    <tr>
      <th scope="row">Exam Attendance</th>
      <td><?php echo $count['xm_attend'];?></td>
    </tr>

    <tr>
      <th scope="row">Result</th>
      <td> <?php echo $count['result'];?></td>
    </tr>

    <tr>
      <th scope="row">Total Marks / GPA</th>
      <td>4.00</td>
    </tr>

    <tr>
      <th scope="row">Grade</th>
      <td><?php echo $count['grade'];?></td>
    </tr>

    <tr>
      <th scope="row">Certificate No</th>
      <td><?php echo $count['certificate_no'];?></td>
    </tr>

    <tr>
      <th scope="row">Delivery Date</th>
      <td><?php echo $count['delivery_date'];?></td>
    </tr>

    <tr>
      <th scope="row">Comments</th>
      <td><?php echo $count['comment'];?></td>
    </tr>
  </tbody>
</table>
</div>




      </div>
    </div>



</form>

</div> 

<?php } }

			   else{

            echo 'No Records ! &nbsp; <br>';  ?> 
            
      <a href="<?php echo base_url('stsearch');?>">Back to Search</a>

		<?php  } ?>	  

			   

</div>

</div>

<div class="container">
<div class="row">
    

    <div class="col-md-12 text-center">
    <a href="https://bornocomputers.com/"><button type="button" class="btn btn-info">Back to Home</button></a>

    <a href="<?php echo base_url('stsearch');?>"><button type="button" class="btn btn-primary">Search Again</button></a>


</div>
</div>
</div> <br> <br>


<?php $this->load->view('front/footer');?>