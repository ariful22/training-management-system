<?php $this->load->view("admin/partial/header"); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url("dashboard")?>">Student Database</a>
            </li>
            <li class="breadcrumb-item active">Student Info</li>
        </ol>
  <?php
if($this->session->flashdata('item')) {
  $message = $this->session->flashdata('item');
  ?>
  <div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> <?php echo $message['message']; ?>
</div>

<?php 
}
?>

        <div class="card mb-3">
            <div class="card-header">
                <!-- Button trigger modal -->
                <a href="<?php echo base_url("students/add_student")?>"><button type="button" class="btn btn-dark bg-btn">
                    <i class="fa fa-plus"></i> &nbsp;Add New Student
                    </button></a>
				<div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    
                                    
                                    <th>Student Name</th>
                                    <th>Phone</th>
                                    <th>Course Name</th>
                                    <th>Batch Name</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
								<?php foreach ($list as $studentlist) { ?>
                                    
                                    <td><?php echo $studentlist->std_name?></td>
                                    <td><?php echo $studentlist->phone?></td>
									<td><?php echo $studentlist->course_name?></td>
									<td><?php echo $studentlist->batch_name?></td>
									<td><?php echo $studentlist->location?></td>
									<td><img width="100px"height="100px" src="<?php echo base_url($studentlist->student_image);?>" alt=""></td>
                                    
                                    <td>
                                        <a href="<?php echo base_url('students/ajax_edit/'.$studentlist->student_id)?>"><button type="button" class="btn btn-info" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>
                                        
                                        <a href="<?php echo base_url('students/delete/'.$studentlist->student_id)?>"><button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button></a>
                                
                                        <!--<a href="<?php echo base_url('students/view/'.$studentlist->student_id)?>"><button type="submit" class="btn btn-success" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button></a>-->
                                </td>
                                </tr>
								<?php } ?> 
                            </tbody>
							</table>
                                                                         

                    
                    </div>
                </div>
               
                
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->


    </div>
	<script type="text/javascript">

    $(".remove").click(function(){

        var id = $(this).parents("tr").attr("id");


        if(confirm('Are you sure to remove this record ?'))

        {

            $.ajax({

               url: 'item-list/'+id,

               type: 'DELETE', 

               error: function() {

                  alert('Something is wrong');

               },

               success: function(data) {

                    $("#"+id).remove();

                    alert("Record removed successfully");  

               }

            });

        }

    });


</script>

    <?php $this->load->view("admin/partial/footer"); ?>