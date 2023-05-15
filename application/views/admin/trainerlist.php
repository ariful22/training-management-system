<?php $this->load->view("admin/partial/header"); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url("dashboard")?>">Student Database</a>
            </li>
            <li class="breadcrumb-item active">Trainer Name</li>
        </ol>


        <div class="card mb-3">
            <div class="card-header">
               <button type="button" class="btn btn-dark bg-btn" onclick="addcourse()">
                    <i class="fa fa-plus"></i> &nbsp;Add Trainer
                    </button> 
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    
                                    <th>Trainer ID</th>
                                    <th>Trainer Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
							</table>
                                    
  <script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table = $('#dataTable').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "Trainer/ajax_list",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [ 0 ], //first column
                "orderable": false, //set not orderable
            },
            {
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },

        ],


    });
    




});



function addcourse()
{
    save_method = 'add';
    $('#form2')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form2').modal('show'); // show bootstrap modal
    $('.modal-title').text('Course Form'); // Set Title to Bootstrap modal title
}

function editcourse(id)
{
    save_method = 'update';
    $('#form2')[0].reset(); // reset form on modals
    //$('.form-group').removeClass('has-error'); // clear error class
    //$('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "Trainer/ajax_edit/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            
            $('[name="trainer_list_id"]').val(data.trainer_list_id);
            $('[name="trainer_name"]').val(data.trainer_name);
            $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Trainer'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error getting data from ajax');
        }
    });
}

function reloadTable()
{
    table.ajax.reload(null,false); //reload datatable ajax
    
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add') {
        url = "Trainer/ajax_add";
    } else {
        url = "Trainer/ajax_update";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form2').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form2').modal('hide');
                reloadTable();
            }
            else
            {
                
            }
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}

function deletecourse(id)
{
    if(confirm('Are you sure to remove the Trainer?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "Trainer/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form2').modal('hide');
                reloadTable();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}


</script>   
                                   

                                        <!-- modal -->
                                        <div class="modal fade" id="modal_form2" tabindex="-1" role="dialog" aria-labelledby="activitiesTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="activitiesLongTitle">Trainer Form</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="#" id="form2">
     <input type="hidden" value="" name="id"/> <div class="form-group">
                          <div class="col-md-9">
                              <input name="trainer_list_id" class="form-control" type="hidden">
                              <span class="help-block"></span>
                          </div>
                      </div>                                                 
	 <div class="form-group row">
                                        <label for="cs" class="col-sm-4 col-form-label">Trainer Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="cs" name="trainer_name" placeholder="Trainer Name">
                                        </div>
                                    </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button"id="btnSave" onclick="save()" class="btn btn-primary">Save </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        
                                    
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->


    </div>

    <?php $this->load->view("admin/partial/footer"); ?>