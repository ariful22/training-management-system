<?php $this->load->view("admin/partial/header"); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url(" dashboard ")?>">Student Database</a>
            </li>
            <li class="breadcrumb-item active">Course Info</li>
        </ol>


        <div class="card mb-3">
            <div class="card-header">
                <button type="button" class="btn btn-dark bg-btn" onclick="addactivity()">
                    <i class="fa fa-plus"></i> &nbsp;Add Activities
                </button>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>

                                    <th>Student ID</th>
                                    <th>Total Class</th>
                                    <th>Result</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <script type="text/javascript">
                            var save_method; //for save method string
                            var table;

                            $(document).ready(function () {

                                //datatables
                                table = $('#dataTable').DataTable({

                                    "processing": true, //Feature control the processing indicator.
                                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                                    "order": [], //Initial no order.

                                    // Load data for the table's content from an Ajax source
                                    "ajax": {
                                        "url": "Activities/ajax_list",
                                        "type": "POST"
                                    },

                                    //Set column definition initialisation properties.
                                    "columnDefs": [{
                                            "targets": [0], //first column
                                            "orderable": false, //set not orderable
                                        },
                                        {
                                            "targets": [-1], //last column
                                            "orderable": false, //set not orderable
                                        },

                                    ],


                                });





                            });



                            function addactivity() {
                                save_method = 'add';
                                $('#form2')[0].reset(); // reset form on modals
                                $('.form-group').removeClass('has-error'); // clear error class
                                $('.help-block').empty(); // clear error string
                                $('#modal_form2').modal('show'); // show bootstrap modal
                                $('.modal-title').text('Final Activities'); // Set Title to Bootstrap modal title
                            }

                            function editactivity(id) {
                                save_method = 'update';
                                $('#form2')[0].reset(); // reset form on modals
                                //$('.form-group').removeClass('has-error'); // clear error class
                                //$('.help-block').empty(); // clear error string

                                //Ajax Load data from ajax
                                $.ajax({
                                    url: "Activities/ajax_edit/" + id,
                                    type: "GET",
                                    dataType: "JSON",
                                    success: function (data) {

                                        $('[name="student_activty_id"]').val(data.student_activty_id);
                                        $('[name="std_id"]').val(data.std_id);
                                        $('[name="total_cls"]').val(data.total_cls);
                                        $('[name="start_cls"]').val(data.start_cls);
                                        $('[name="end_cls"]').val(data.end_cls);
                                        $('[name="attendance"]').val(data.attendance);
                                        $('[name="absence"]').val(data.absence);
                                        $('[name="xm_date"]').val(data.xm_date);
                                        $('[name="xm_attend"]').val(data.xm_attend);
                                        $('[name="result"]').val(data.result);
                                        $('[name="grade"]').val(data.grade);
                                        $('[name="certificate_no"]').val(data.certificate_no);
                                        $('[name="delivery_date"]').val(data.delivery_date);
                                        $('[name="comment"]').val(data.comment);
                                        $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
                                        $('.modal-title').text('Edit Student'); // Set title to Bootstrap modal title

                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        alert('Error getting data from ajax');
                                    }
                                });
                            }

                            function reloadTable() {
                                table.ajax.reload(null, false); //reload datatable ajax

                            }

                            function save() {
                                $('#btnSave').text('saving...'); //change button text
                                $('#btnSave').attr('disabled', true); //set button disable
                                var url;

                                if (save_method == 'add') {
                                    url = "Activities/ajax_add";
                                } else {
                                    url = "Activities/ajax_update";
                                }

                                // ajax adding data to database
                                $.ajax({
                                    url: url,
                                    type: "POST",
                                    data: $('#form2').serialize(),
                                    dataType: "JSON",
                                    success: function (data) {

                                        if (data.status) //if success close modal and reload ajax table
                                        {
                                            $('#modal_form2').modal('hide');
                                            reloadTable();
                                        } else {

                                        }
                                        $('#btnSave').text('Save'); //change button text
                                        $('#btnSave').attr('disabled', false); //set button enable


                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        alert('Error adding / update data');
                                        $('#btnSave').text('Save'); //change button text
                                        $('#btnSave').attr('disabled', false); //set button enable

                                    }
                                });
                            }

                            function deleteactivity(id) {
                                if (confirm('Are you sure to remove the Activities?')) {
                                    // ajax delete data to database
                                    $.ajax({
                                        url: "Activities/ajax_delete/" + id,
                                        type: "POST",
                                        dataType: "JSON",
                                        success: function (data) {
                                            //if success reload ajax table
                                            $('#modal_form2').modal('hide');
                                            reloadTable();
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            alert('Error deleting data');
                                        }
                                    });

                                }
                            }
                        </script>


                        <!-- modal -->
                        <div class="modal fade" id="modal_form2" tabindex="-1" role="dialog" aria-labelledby="activitiesTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="activitiesLongTitle">Final Activities</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="form2" class="final_act">
                                            <input type="hidden" value="" name="id" />
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input name="student_activty_id" class="form-control" type="hidden">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="xd" class="col-sm-2 col-form-label">Student ID</label>
                                                <div class="col-sm-4">
                                                    <select name="std_id" class="form-control">
                                                        <option value="">--Select Student ID--</option>
                                                        <?php
                                    foreach($list as $value){
                                      echo '<option value="'.$value->std_id.'">'.$value->std_id.'</option>';
                                    }
                                    ?>
                                                    </select>
                                                </div>

                                    <label for="" class="col-sm-2 col-form-label">Total Class</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="payable_amount" onkeyup="dueAmount()" name="total_cls" placeholder="Total Class">
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="cs" class="col-sm-2 col-form-label">Class Started</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control datepicker" id="cs" name="start_cls" placeholder="Class Started">
                                                </div>

                                                <label for="ce" class="col-sm-2 col-form-label">Class Ended</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control datepicker" id="ce" name="end_cls" placeholder="Class Ended">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Attendance</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="paid_money" onkeyup="dueAmount()" name="attendance" placeholder="Class Attendance">
                                                </div>

                                                <label for="" class="col-sm-2 col-form-label">Absence</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="due" name="absence" placeholder="Class Absence" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="xd" class="col-sm-2 col-form-label">Exam Date</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control datepicker" id="xd" name="xm_date" placeholder="Exam Date">
                                                </div>

                                                <label for="xd" class="col-sm-2 col-form-label">Exam Attendance</label>
                                                <div class="col-sm-4">
                                                    <select name="xm_attend" class="form-control">
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="result" class="col-sm-2 col-form-label">Result</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="result" name="result" placeholder="Exam Result">
                                                </div>

                                                <label for="grade" class="col-sm-2 col-form-label">Grade</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="grade" name="grade" placeholder="Exam Grade">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cn" class="col-sm-2 col-form-label">Certificate N0.</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="cn" name="certificate_no" placeholder="Certificate Number">
                                                </div>

                                                <label for="dd" class="col-sm-2 col-form-label">Delivery Date</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control datepicker" id="dd" name="delivery_date" placeholder="Delivery Date">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cm" class="col-sm-2 col-form-label">Comments</label>
                                                <div class="col-sm-10">
                                                    <textarea name="comment" placeholder="Place Your Comments Here" class="form-control" type="text"></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save </button>
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

    <script>
        function dueAmount() {
            var p_amount = parseInt(document.getElementById('payable_amount').value);
            var paid_amount = parseInt(document.getElementById('paid_money').value);
            var due_money = p_amount - paid_amount;

            if (p_amount < paid_amount) {
                document.getElementById('due').value = 0;
            } else {
                document.getElementById('due').value = due_money;
            }
        }
    </script>

    <?php $this->load->view("admin/partial/footer"); ?>