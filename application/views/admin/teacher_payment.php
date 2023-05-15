<?php $this->load->view("admin/partial/header"); ?>
<div class="content-wrapper">
    <div class="container-fluid">
	
	<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>

<script type="text/javascript">
	toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
</script>

<?php endif;?>

<?php if ($this->session->flashdata('error_message') != ""):?>

<script type="text/javascript">
	toastr.error('<?php echo $this->session->flashdata("error_message");?>');
</script>

<?php endif;?>


<!-- Breadcrumbs-->
<ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url("dashboard")?>">Student Database</a>
            </li>
            <li class="breadcrumb-item active">Trainer Payment</li>
        </ol> <br>

        <div class="card mb-3">
            <div class="">
			
			    <!-- creation of single invoice -->
				<?php echo form_open(site_url('admin/invoice/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
				<div class="row">
					<div class="col-md-6">
	                        <div class="panel panel-default panel-shadow" data-collapsed="0">
	                            <div class="panel-heading">
	                                <div class="panel-title"><?php echo 'Invoice Informations';?></div>
	                            </div>
	                            <div class="panel-body">
	                                
	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo 'Batch';?></label>
	                                    <div class="col-sm-9">
	                                        <select name="student_batch_id" class="form-control selectboxit class_id"
	                                       >
	                                        	<option value=""><?php echo 'select Batch';?></option>
	                                        	<?php 
	                                        		$batches = $this->db->get('student_batch')->result_array();
	                                        		foreach ($batches as $row):
	                                        	?>
	                                        	<option value="<?php echo $row['student_batch_id'];?>"><?php echo $row['batch_name'];?></option>
	                                        	<?php endforeach;?>
	                                            
	                                        </select>
	                                    </div>
	                                </div>

	                                <div class="form-group">
		                                <label class="col-sm-3 control-label"><?php echo 'Trainer';?></label>
		                                <div class="col-sm-9">
		                                    <select name="trainer_list_id" class="form-control" style="width:100%;" id="student_selection_holder" required>
		                                        <option value=""><?php echo 'select Trainer';?></option>
	                                        	<?php 
	                                        		$trainers = $this->db->get('trainer_list')->result_array();
	                                        		foreach ($trainers as $row):
	                                        	?>
	                                        	<option value="<?php echo $row['trainer_list_id'];?>"><?php echo $row['trainer_name'];?></option>
	                                        	<?php endforeach;?>
		                                    </select>
		                                </div>
		                            </div>

	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo 'Title';?></label>
	                                    <div class="col-sm-9">
	                                        <input type="text" class="form-control" name="title"/>
	                                    </div>
	                                </div>
	                                

	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo 'Date';?></label>
	                                    <div class="col-sm-9">
	                                        <input type="text" class="datepicker form-control" name="date">
	                                    </div>
	                                </div>
	                                
	                            </div>
	                        </div>
	                    </div>

	                    <div class="col-md-6">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo 'Payment Informations';?></div>
                            </div>
                            <div class="panel-body"> 
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo 'Total';?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount"
                                            placeholder="<?php echo 'Enter total amount';?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo 'Payment';?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount_paid"
                                            placeholder="<?php echo 'Enter payment amount';?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo 'Status';?></label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control selectboxit">
                                            <option value="paid"><?php echo 'paid';?></option>
                                            <option value="unpaid"><?php echo 'unpaid';?></option>
                                        </select>
                                    </div>
                                </div>

                                
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-info submit"><?php echo 'Add Invoice';?></button>
                            </div>
                        </div>
                    </div>


	                </div>
	              	<?php echo form_close();?>

				<!-- creation of single invoice -->
			
			</div>
                           

            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->


    </div>

    <?php $this->load->view("admin/partial/footer"); ?>