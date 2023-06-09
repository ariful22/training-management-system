<?php
$edit_data	=	$this->db->get_where('invoice' , array('invoice_id' => $param2) )->result_array();
foreach ($edit_data as $row):
?>

<div class="row">
	<div class="col-md-12">
        <div class="panel panel-default panel-shadow" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title"><?php echo 'Payment history';?></div>
            </div>
            <div class="panel-body">

                <table class="table table-bordered">
                	<thead>
                		<tr>
                			<td>#</td>
                			<td><?php echo 'Amount';?></td>
                			<td><?php echo 'Method';?></td>
                			<td><?php echo 'Date';?></td>
                		</tr>
                	</thead>
                	<tbody>
                	<?php
                		$count = 1;
                		$payments = $this->db->get_where('payment' , array(
                			'invoice_id' => $row['invoice_id']
                		))->result_array();
                		foreach ($payments as $row2):
                	?>
                		<tr>
                			<td><?php echo $count++;?></td>
                			<td><?php echo $row2['amount'];?></td>
                			<td>
                				<?php
                					echo 'Cash';
                				?>
                			</td>
                			<td><?php echo date('d M,Y', $row2['timestamp']);?></td>
                		</tr>
                	<?php endforeach;?>
                	</tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-shadow" data-collapsed="0">
			<div class="panel-heading">
                <div class="panel-title"><?php echo 'Take payment';?></div>
            </div>
            <div class="panel-body">
				<?php echo form_open(site_url('admin/invoice/take_payment/'.$row['invoice_id']) , array(
					'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

					<div class="form-group">
		                <label class="col-sm-3 control-label"><?php echo 'Total amount';?></label>
		                <div class="col-sm-6">
		                    <input type="text" class="form-control" value="<?php echo $row['amount'];?>" readonly/>
		                </div>
		            </div>

		            <div class="form-group">
		                <label class="col-sm-3 control-label"><?php echo 'Amount paid';?></label>
		                <div class="col-sm-6">
		                    <input type="text" class="form-control" name="amount_paid" value="<?php echo $row['amount_paid'];?>" readonly/>
		                </div>
		            </div>

		            <div class="form-group">
		                <label class="col-sm-3 control-label"><?php echo 'Due';?></label>
		                <div class="col-sm-6">
		                    <input type="text" class="form-control" value="<?php echo $row['due'];?>" readonly/>
		                </div>
		            </div>

		            <div class="form-group">
		                <label class="col-sm-3 control-label"><?php echo 'Payment';?></label>
		                <div class="col-sm-6">
		                    <input type="text" class="form-control" name="amount" value=""
		                    	placeholder="<?php echo 'Enter payment amount';?>" required/>
		                </div>
		            </div>

		            

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo 'Status';?></label>
                        <div class="col-sm-6">
                            <select name="status" class="form-control" required>
                                <option value="unpaid"><?php echo 'Unpaid';?></option>
                                <option value="paid"><?php echo 'Paid';?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
	                    <label class="col-sm-3 control-label"><?php echo 'Date';?></label>
	                    <div class="col-sm-6">
	                        <input type="text" class="datepicker form-control" name="timestamp"
	                            value="<?php echo date('m/d/Y');?>"/>
	                    </div>
					</div>

                    <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id'];?>">
                    <input type="hidden" name="trainer_list_id" value="<?php echo $row['trainer_list_id'];?>">
                    <input type="hidden" name="title" value="<?php echo $row['title'];?>">
                    

		            <div class="form-group">
		                <div class="col-sm-5">
		                    <button type="submit" class="btn btn-info"><?php echo 'Take payment';?></button>
		                </div>
		            </div>

				<?php echo form_close();?>
			</div>
		</div>
	</div>
</div>


<?php endforeach;?>
<script type="text/javascript"><!--
      $( function() {
          $( ".datepicker" ).datepicker({
                dateFormat: "yy-mm-dd"
            });

      });

    </script>