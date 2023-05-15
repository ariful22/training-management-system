<?php $this->load->view("admin/partial/header"); ?>

<div class="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->

        <ol class="breadcrumb">

            <li class="breadcrumb-item">

                <a href="<?php echo base_url(" dashboard ")?>">Student Database</a>

            </li>

            <li class="breadcrumb-item active">Payment Info</li>

        </ol>





        <div class="card mb-3">

            <div class="card-header">

                <button type="button" class="btn btn-dark bg-btn" onclick="addpayment()">

                    <i class="fa fa-plus"></i> &nbsp;Add Payment

                </button>



                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">

                            <thead>

                                <tr>



                                    <th>Student Name</th>
                                    <th>Course Name</th>
                                    <th>Batch Name</th>
                                    <th>Course Fee</th>



                                    <th>Total Pay</th>
                                    <th>Less</th>
                                    <th>Due</th>
                                    <th>Due after less</th>

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

                                        "url": "Finance/ajax_list",

                                        "type": "POST"

                                    },



                                    //Set column definition initialisation properties.

                                    "columnDefs": [

                                        {

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







                            function addpayment()

                            {

                                save_method = 'add';

                                $('#form2')[0].reset(); // reset form on modals

                                $('.form-group').removeClass('has-error'); // clear error class

                                $('.help-block').empty(); // clear error string

                                $('#modal_form2').modal('show'); // show bootstrap modal

                                $('.modal-title').text('Payment Form'); // Set Title to Bootstrap modal title

                            }



                            function editfinance(id)

                            {

                                save_method = 'update';

                                $('#form2')[0].reset(); // reset form on modals

                                //$('.form-group').removeClass('has-error'); // clear error class

                                //$('.help-block').empty(); // clear error string



                                //Ajax Load data from ajax

                                $.ajax({

                                    url: "Finance/ajax_edit/" + id,

                                    type: "GET",

                                    dataType: "JSON",

                                    success: function (data)

                                    {



                                        $('[name="payment_id"]').val(data.payment_id);

                                        $('[name="std_name"]').val(data.std_name);

                                        $('[name="course_fee"]').val(data.course_fee);

                                        $('[name="first_installment"]').val(data.first_installment);

                                        $('[name="first_ins_date"]').val(data.first_ins_date);

                                        $('[name="second_installment"]').val(data.second_installment);

                                        $('[name="second_ins_date"]').val(data.second_ins_date);

                                        $('[name="third_installment"]').val(data.third_installment);

                                        $('[name="third_ins_date"]').val(data.third_ins_date);

                                        $('[name="total_paid"]').val(data.total_paid);

                                        $('[name="due_payment"]').val(data.due_payment);

                                        $('[name="less_payment"]').val(data.less_payment);
                                        $('[name="less_due"]').val(data.less_due);

                                        $('[name="total_amount"]').val(data.total_amount);

                                        $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded

                                        $('.modal-title').text('Edit Student'); // Set title to Bootstrap modal title



                                    },

                                    error: function (jqXHR, textStatus, errorThrown)

                                    {

                                        alert('Error getting data from ajax');

                                    }

                                });

                            }



                            function reloadTable()

                            {

                                table.ajax.reload(null, false); //reload datatable ajax



                            }



                            function save()

                            {

                                $('#btnSave').text('saving...'); //change button text

                                $('#btnSave').attr('disabled', true); //set button disable

                                var url;



                                if (save_method == 'add') {

                                    url = "Finance/ajax_add";

                                } else {

                                    url = "Finance/ajax_update";

                                }



                                // ajax adding data to database

                                $.ajax({

                                    url: url,

                                    type: "POST",

                                    data: $('#form2').serialize(),

                                    dataType: "JSON",

                                    success: function (data)

                                    {



                                        if (data.status) //if success close modal and reload ajax table

                                        {

                                            $('#modal_form2').modal('hide');

                                            reloadTable();

                                        } else

                                        {


                                        }

                                        $('#btnSave').text('Save'); //change button text

                                        $('#btnSave').attr('disabled', false); //set button enable





                                    },

                                    error: function (jqXHR, textStatus, errorThrown)

                                    {

                                        alert('Error adding / update data');

                                        $('#btnSave').text('Save'); //change button text

                                        $('#btnSave').attr('disabled', false); //set button enable



                                    }

                                });

                            }



                            function deletefinance(id)

                            {

                                if (confirm('Are you sure to remove the Payment?'))

                                {

                                    // ajax delete data to database

                                    $.ajax({

                                        url: "Finance/ajax_delete/" + id,

                                        type: "POST",

                                        dataType: "JSON",

                                        success: function (data)

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

                        <div class="modal fade" id="modal_form2" tabindex="-1" role="dialog" aria-labelledby="paymodalTitle" aria-hidden="true">

                            <div class="modal-dialog modal-lg" role="document">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="paymodalLongTitle">Payment Information</h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                            <span aria-hidden="true">&times;</span>

                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <form action="#" id="form2" class="payement_frm">
                                            <input type="hidden" value="" name="id" />
                                            <div class="col-md-9">
                                                <input name="payment_id" class="form-control" type="hidden">
                                                <span class="help-block"></span>
                                            </div>

                                            <div class="form-group row">

                                                <label for="xd" class="col-sm-2 col-form-label">Student Name</label>

                                                <div class="col-sm-4">

                                                    <select id="book" name="std_name" class="form-control">
                                                        <?php
                                    foreach($list as $value){
                                      echo '<option value="'.$value->std_name.'">'.$value->std_name.'</option>';
                                    }
                                    ?>
                                                    </select>

                                                </div>

                                                <label for="" class="col-sm-2 col-form-label">Course Fee's</label>

<div class="col-sm-4">

    <input type="number" class="form-control" id="payable_amount" name="course_fee" placeholder="Total Course Fee">

</div>

                                            </div>

                                            

                                            <div class="form-group row">

                                                <label for="" class="col-sm-2 col-form-label">1st Installment</label>

                                                <div class="col-sm-4">

                                                    <input type="number" class="form-control" id="v0" value="0" onkeyup="calculate()" name="first_installment" placeholder="First Installment (TK)">

                                                </div>

                                                <label for="firstdate" class="col-sm-2 col-form-label">Date</label>

<div class="col-sm-4">

    <input type="text" class="form-control datepicker" id="firstdate" name="first_ins_date" placeholder="First Installment Date">

</div>

                                            </div>




                                            <div class="form-group row">

                                                <label for="" class="col-sm-2 col-form-label">2nd Installment</label>

                                                <div class="col-sm-4">

                                                    <input type="number" class="form-control" id="v1" value="0" onkeyup="calculate()" name="second_installment" placeholder="Second Installment (TK)">

                                                </div>

                                                <label for="sec_date" class="col-sm-2 col-form-label">Date</label>

<div class="col-sm-4">

    <input type="text" class="form-control datepicker" id="sec_date" name="second_ins_date" placeholder="Second Installment Date">

</div>

                                            </div>



                                            <div class="form-group row">

                                                <label for="" class="col-sm-2 col-form-label">3rd Installment</label>

                                                <div class="col-sm-4">

                                                    <input type="number" class="form-control" id="v2" value="0" onkeyup="calculate()" name="third_installment" placeholder="Third Installment (TK)">

                                                </div>

                                                <label for="thirddate" class="col-sm-2 col-form-label">Date</label>

<div class="col-sm-4">

    <input type="text" class="form-control datepicker" id="thirddate" name="third_ins_date" placeholder="Third Installment Date">

</div>

                                            </div>



                                            <div class="form-group row">

                                                <label for="" class="col-sm-2 col-form-label">Total Pay</label>

                                                <div class="col-sm-4">

                                                    <input type="text" class="form-control" id="result" onkeyup="calculate()" readonly name="total_paid" placeholder="Total Pay">

                                                </div>

                                                <label for="due" class="col-sm-2 col-form-label">Due</label>

<div class="col-sm-4">

    <input type="number" class="form-control" id="a" name="due_payment" placeholder="Due Amount" readonly>

</div>

                                            </div>
											
											



                                            <!--    <div class="form-group row">

                                                                <label for="due" class="col-sm-4 col-form-label">Due</label>

                                                                <div class="col-sm-8">

                                                                    <input type="number" class="form-control" id="due" name="due_payment" placeholder="Due Amount"readonly>

                                                                </div>

                                                            </div> -->
                                            <div class="form-group row">

                                                <label for="less" class="col-sm-2 col-form-label">Less</label>

                                                <div class="col-sm-4">

                                                    <input type="number" class="form-control" id="less" name="less_payment" placeholder="Less Amount">

                                                </div>

                                                 <label for="total_amount" class="col-sm-2 col-form-label">In Total Amount</label>

<div class="col-sm-4">

    <input type="number" class="form-control" id="c" value="0" name="total_amount" placeholder="In Total Amount (TK)" readonly="">

</div>

                                            </div>
											<div class="form-group row">

                                               

                                                <label for="" class="col-sm-2 col-form-label">Less Due</label>

<div class="col-sm-4">

    <input type="number" class="form-control" id="d" name="less_due" placeholder="less due" readonly>

</div>

                                            </div>



                                            <!--     <div class="form-group row">

                                                                <label for="total_amount" class="col-sm-4 col-form-label">In Total Amount</label>

                                                                <div class="col-sm-8">

                                                                    <input type="number" class="form-control" name="total_amount" id="total_amount" placeholder="In Total Amount (TK)">

                                                                </div>

                                                            </div> -->




                                            <!--<div class="form-group row">

                                                                <label for="paid" class="col-sm-4 col-form-label">Paid</label>

                                                                <div class="col-sm-8">

                                                                    <select name="paid" class="form-control" id="paid">

                                    <option value="1">Yes</option>                     <option value="2">No</option>

                                </select>

                                                                </div>

                                                            </div>-->

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

    <script type="text/javascript">
        function calculate() {

            var result = document.getElementById('result');

            var el, i = 0,
                total = 0;

            while (el = document.getElementById('v' + (i++))) {

                el.value = el.value.replace(/\\D/, "");

                total = total + Number(el.value);

            }

            result.value = total;

            if (document.getElementById('v0').value == "" && document.getElementById('v1').value == "" && document.getElementById(
                    'v2').value == "") {

                result.value = "";

            }

        }

        /*function dueAmount(){

        	var p_amount    = parseInt(document.getElementById('payable_amount').value);

        	var paid_amount = parseInt(document.getElementById('result').value);

        		var due_money   = p_amount - paid_amount;

        		

        	if(p_amount < paid_amount){

        		document.getElementById('due').value = 0;

        	} else {

        		document.getElementById('due').value = due_money;

        	}

        }*/
    </script>


    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
    <script>
        $("#v0, #v1, #v2").keyup(function () {
            var first = parseFloat($("#v0").val());
            var second = parseFloat($("#v1").val());
            var third = parseFloat($("#v2").val());
            // var less   = parseFloat($("#less").val());
            var tpay = parseFloat($("#payable_amount").val());
            $("#b").val((tpay));
            $("#a").val((tpay - first - second - third));
            // $("#b").val((tpay-first-second-third));


            var res = parseFloat($("#b").val());

            // var less   = parseFloat($("#less").val());

            // if(less > 0) {
            //     $("#b").val((tpay-less));
            //     var res2    = parseFloat($("#b").val());
            // }
        });

        $("#payable_amount, #less").keyup(function () {
            
			var pa = parseFloat($("#payable_amount").val());
            var less = parseFloat($("#less").val());
            if (less > 0) {
                $("#c").val((pa - less));
                var res2 = parseFloat($("#c").val());
            } else {
                // alert(pa);
                $("#c").val((pa));
                var res3 = parseFloat($("#b").val());
            }
        });
		
		$("#a, #less").keyup(function () {
            
			var da = parseFloat($("#a").val());
            var dless = parseFloat($("#less").val());
            if (dless > 0) {
                $("#d").val((da - dless));
                var res2 = parseFloat($("#d").val());
            } else {
                 //alert(pa);
                $("#d").val((da));
                var res3 = parseFloat($("#b").val());
            } 
        });
		

		/*$("#a, #less").keyup(function () {
			var due = parseFloat($("#a").val());
			$("#d").val((due));
            var paa = parseFloat($("#a").val());
            var less = parseFloat($("#less").val());
            if (less > 0) {
                $("#a").val((paa - less));
                var res22 = parseFloat($("#a").val());
            } else {
                // alert(pa);
                $("#a").val((paa));
                var res3 = parseFloat($("#d").val());
            }
        });*/
    </script>



    <?php $this->load->view("admin/partial/footer"); ?>