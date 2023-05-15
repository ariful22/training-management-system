

<?php
$edit_data = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
foreach ($edit_data as $row):
?>
<center>
    <a onClick="PrintElem('#invoice_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
        Print Invoice
        
    </a>
</center>

    <br><br>

    <div id="invoice_print">
        <table width="100%" border="0">
            <tr>
                <td align="right">
                    <h5><?php echo 'Creation Date'; ?> : <?php echo date('d M,Y', $row['creation_timestamp']);?></h5>
                    <h5><?php echo 'Title'; ?> : <?php echo $row['title'];?></h5>
                    
                    <h5><?php echo 'Status'; ?> : <?php echo $row['status']; ?></h5>
                </td>
            </tr>
        </table>
        <hr>
        <table width="100%" border="0">    
            <tr>
                <td align="left"><h4><?php echo 'Payment To'; ?> </h4></td>
                <td align="right"><h4><?php echo 'Bill To'; ?> </h4></td>
            </tr>

            <tr>
                <td align="left" valign="top">
                    <?php echo 'Freelancerlab'; ?><br>
                    <?php echo 'Zindabazar'; ?><br>
                    <?php echo '01767474860'; ?><br>            
                </td>
                <td align="right" valign="top">
                    <?php echo $this->db->get_where('trainer_list', array('trainer_list_id' => $row['trainer_list_id']))->row()->trainer_name;?><br>
                    <?php 
                        echo $this->db->get_where('student_batch', array('student_batch_id' => $row['student_batch_id']))->row()->batch_name;
                    ?><br>
                </td>
            </tr>
        </table>
        <hr>

        <table width="100%" border="0">    
            <tr>
                <td align="right" width="80%"><?php echo 'Total Amount'; ?> :</td>
                <td align="right"><?php echo $row['amount']; ?></td>
            </tr>
            <tr>
                <td align="right" width="80%"><h4><?php echo 'Paid Amount'; ?> :</h4></td>
                <td align="right"><h4><?php echo $row['amount_paid']; ?></h4></td>
            </tr>
            <?php if ($row['due'] != 0):?>
            <tr>
                <td align="right" width="80%"><h4><?php echo 'Due'; ?> :</h4></td>
                <td align="right"><h4><?php echo $row['due']; ?></h4></td>
            </tr>
            <?php endif;?>
        </table>

        <hr>

        <!-- payment history -->
        <h4><?php echo 'Payment History'; ?></h4>
        <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th><?php echo 'Date'; ?></th>
                    <th><?php echo 'Amount'; ?></th>
                    <th><?php echo 'Method'; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $payment_history = $this->db->get_where('payment', array('invoice_id' => $row['invoice_id']))->result_array();
                foreach ($payment_history as $row2):
                    ?>
                    <tr>
                        <td><?php echo date("d M, Y", $row2['timestamp']); ?></td>
                        <td><?php echo $row2['amount']; ?></td>
                        <td>
                            <?php 
                                echo 'Cash';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tbody>
        </table>
    </div>
<?php endforeach; ?>


<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        var is_chrome = Boolean(mywindow.chrome);
        if (is_chrome) {
            setTimeout(function() {
                mywindow.print();
                mywindow.close();

                return true;
            }, 250);
        }
        else {
            mywindow.print();
            mywindow.close();

            return true;
        }

        return true;
    }

</script>
