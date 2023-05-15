<?php //$this->load->view("admin/partial/header"); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url("dashboard")?>">Student Database</a>
            </li>
            <li class="breadcrumb-item active">Course Name</li>
        </ol>


		<table class="table table-bordered" id="invoices">
			<thead>
        		<tr>
        			<th width="40"><div><?php echo 'id';?></div></th>
            		<th><div><?php echo 'Trainer';?></div></th>
            		<th><div><?php echo 'title';?></div></th>
                    <th><div><?php echo 'total';?></div></th>
                    <th><div><?php echo 'paid';?></div></th>
                    <th><div><?php echo 'status';?></div></th>
            		<th><div><?php echo 'date';?></div></th>
            		<th><div><?php echo 'options';?></div></th>
				</tr>
			</thead>
		</table>
	

<script type="text/javascript">
	$(document).ready(function() {
		$.fn.dataTable.ext.errMode = 'throw';
        $('#invoices').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo site_url('admin/get_invoices') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "invoice_id" },
                { "data": "trainer_list" },
                { "data": "title" },
                { "data": "total" },
                { "data": "paid" },
                { "data": "status" },
                { "data": "date" },
                { "data": "options" },
            ],
            "columnDefs": [
            	{
					"targets": [1,3,4,6,7],
					"orderable": false
				},
			]
        });
	});

	function invoice_pay_modal(invoice_id) {
        showAjaxModal('<?php echo site_url('modal/popup/modal_take_payment/');?>' + invoice_id);
    }

	function invoice_view_modal(invoice_id) {
        showAjaxModal('<?php echo site_url('modal/popup/modal_view_invoice/');?>' + invoice_id);
    }

	function invoice_edit_modal(invoice_id) {
        showAjaxModal('<?php echo site_url('modal/popup/modal_edit_invoice/');?>' + invoice_id);
    }

    function invoice_delete_confirm(invoice_id) {
        confirm_modal('<?php echo site_url('admin/invoice/delete/');?>' + invoice_id);
    }
</script>

</div>
        </div>
		  <?php //$this->load->view("admin/partial/footer"); ?>