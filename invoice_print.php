<?php
session_start();
include('session-handle.php');
include('ChkLogout.php');
include './db.php';
?>
<?php
$t = mysqli_query($conn, "SELECT * FROM `cont_invoice` ORDER BY `inoice_id` DESC LIMIT 0,1");
$re = mysqli_fetch_object($t);
?>
<!DOCTYPE html>
<html lang="en">
<?php include './head.php'; ?>
<body>
<section id="container" class="">
    <!--header start-->
    <?php include './header.php'; ?>
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- invoice start-->
            <section>
                <div id='DivIdToPrint'>
                <div class="panel panel-primary">
                    <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                    <div class="panel-body">
                        <div class="row invoice-list">
                            <div class="text-center corporate-id">
                                <img src="img/vector-lab.jpg" alt="">
                            </div>
                            <style>
                                .t{
                                width:33.33%;
                                float:left;
                                    position:relative;
                                    min-height:1px;
                                    padding-left:15px;
                                    padding-right:15px;
                                    color:#797979;
                                    font-family:'Open Sans', sans-serif;
                                    font-size:13px;
                                }
                            </style>
                            <div class="t" >
                                <h4>BILLING ADDRESS</h4>

                                <p>
                                    Jonathan Smith <br>
                                    44 Dreamland Tower, Suite 566 <br>
                                    ABC, Dreamland 1230<br>
                                    Tel: +12 (012) 345-67-89
                                </p>
                            </div>
                            <div class="t">
                                <h4>SHIPPING ADDRESS</h4>

                                <p>
                                    Vector Lab<br>
                                    Road 1, House 2, Sector 3<br>
                                    ABC, Dreamland 1230<br>
                                    P: +38 (123) 456-7890<br>
                                </p>
                            </div>
                            <div class="t">
                                <h4>INVOICE INFO</h4>
                                <ul class="unstyled">
                                    <li>Invoice Number : <strong><?php echo "INV" . $re->inoice_id; ?></strong></li>
                                    <li>Invoice Date : <?php echo $re->invoice_date; ?></li>
                                    <li>Due Date : 2013-03-20</li>
                                    <li>Invoice Status : Paid</li>
                                </ul>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th class="hidden-phone">Description</th>
                                <th class="">Unit Cost</th>
                                <th class="">Quantity</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $id = $re->inoice_id;
                            $cnt = 0;
                            $qw = mysqli_query($conn, "SELECT * FROM invoice_sub i INNER JOIN cont_item it ON i.sub_item=it.item_id WHERE i.sub_invoice_id='$id'");
                            while ($row = mysqli_fetch_array($qw)) {
                                $cnt++;
                                ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['sub_item'] ?></td>
                                    <td class="hidden-phone"><?php echo $row['sub_description']; ?></td>
                                    <td class="">$ <?php echo $row['sub_unit']; ?></td>
                                    <td class=""><?php echo $row['sub_quantity']; ?></td>
                                    <td>$ <?php echo $row['sub_total']; ?></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                        <style>
                            .r{
                                margin-left:-15px;
                                margin-right:-15px;
                            }
                        </style>
                        <div class="r">
                            <div class="t" style="text-align:right;float:right!important">
                                <ul class="unstyled amounts">
                                    <li><strong>Sub - Total amount :</strong> $<?php echo $re->invoice_sub; ?></li>
                                    <li><strong>Discount :</strong> <?php echo $re->invoice_discount; ?></li>
                                    <li><strong>VAT :</strong> -----</li>
                                    <li><strong>Grand Total :</strong> $<?php echo $re->invoice_grand; ?></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
                <div class="text-center invoice-btn">
                    <a class="btn btn-info btn-lg" onclick="printDiv();"><i class="fa fa-print"></i> Print </a>
                </div>
            </section>

            <!-- invoice end-->
        </section>
    </section>
    <!--main content end-->
    <!--footer start-->
    <?php include './footer.php'; ?>
    <!--footer end-->
</section>
<?php include './script.php'; ?>
<script>
    function printDiv()
    {

        var divToPrint=document.getElementById('DivIdToPrint');

        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write('<html><head>');

        newWin.document.write('<link href="css/bootstrap.min.css" rel="stylesheet">');
        newWin.document.write(' <link href="css/bootstrap-reset.css" rel="stylesheet">');
        newWin.document.write('<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />');
        newWin.document.write('<link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/><link rel="stylesheet" href="css/owl.carousel.css" type="text/css"><link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" /><link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" /><link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" /><link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" /><link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" /><link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" /><link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" /><link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" /><link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker-bs3.css" /><link rel="stylesheet" type="text/css" href="assets/bootstrap-datetimepicker/css/datetimepicker.css" /><link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" /> ');
        newWin.document.write('<link href="css/style.css" rel="stylesheet">');
        newWin.document.write('<link href="css/style-responsive.css" rel="stylesheet" />');
        newWin.document.write('</head><body onload="window.print()">'+divToPrint.innerHTML +'');
        newWin.document.write('</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);

    }

</script>
</body>
</html>
