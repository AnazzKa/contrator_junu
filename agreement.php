<?php
session_start();
include('session-handle.php');
include('ChkLogout.php');
include './db.php';

if(isset($_POST["add"]))
{



    $item=$_POST["item"];
    $desc=$_POST["desc"];
    $unit=$_POST["unit"];
    $quant=$_POST["quantity"];
    $total=$_POST["total"];


    $sql="insert into temp_agree(temp_item,temp_decr,temp_unit,temp_quantity,temp_total) VALUES ('$item','$desc','$unit','$quant','$total')";

    mysqli_query($conn,$sql);



}



?>
<!DOCTYPE html>
<html lang="en">
<?php include './head.php'; ?>

<body>

<section id="container" class="">
<?php include './header.php'; ?>
<section id="main-content">
<section class="wrapper">
<!-- page start-->
<form role="form" method="post">

<div class="row">
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading" style="text-align: center">
            <strong> Agreement Form </strong>
        </header>
    </section>
</div>

<div class="col-lg-12">
    <section class="panel">
        <div class="panel-body">


            <div class="form-group col-md-2 pull-right">
                <label>Date</label>
                <input type="date" class="form-control">
            </div>

            <div class="form-group col-md-8">
                <label>To</label>
                <input type="text" class="form-control">
            </div>


            <div class="form-group col-md-8">
                <label>Company Name</label>
                <input type="text" class="form-control">
            </div>

            <p>

            <div class="form-group col-md-8">
                <strong>Dear Sir,<br>
                    As per my request please find below the quotes</strong>
            </div>
            </p>

            <div class="form-group col-md-12">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Item</th>
                        <th class="hidden-phone">Description</th>
                        <th class="">Unit Cost</th>
                        <th class="">Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>

                        <td>
                            <div class="col-sm-12">
                                <input class="form-control " type="number" readonly>
                            </div>
                        </td>
                        <td>
                            <div class="col-sm-12">
                                <input class="form-control" type="text" name="item">
                            </div>
                        </td>

                        <td>
                            <div class="col-sm-12">
                                <input class="form-control" name="desc" type="text">
                            </div>
                        </td>
                        <td>
                            <div class="col-sm-12">
                                <input class="form-control" name="unit" type="number" >
                            </div>
                        </td>

                        <td>
                            <div class="col-sm-12">
                                <input class="form-control" name="quantity" type="number">
                            </div>
                        </td>

                        <td>
                            <div class="col-sm-12">
                                <input class="form-control" name="total" type="number" >
                            </div>
                        </td>

                        <td>
                            <input type="submit" name="add" class="btn btn-success btn-lg fa fa-plus">
                        </td>

                        <td>
                            <a class="btn btn-danger btn-lg fa fa-minus"></a>
                        </td>

                    </tr>
                    <tr>
                        <?php
                        $sql="SELECT * FROM temp_agree";
                       $result= mysqli_query($conn,$sql);
                        $i=0;
                        if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_assoc($result)){


                        ?>


                        <td>
                            <div class="col-sm-12">
                                <input class="form-control " type="number" value="<?php echo $row['temp_agree_id']; ?>" readonly>
                            </div>
                        </td>
                        <td>
                            <div class="col-sm-12">
                                <input class="form-control" type="text" name="item" value="<?php echo $row['temp_item']; ?>">
                            </div>
                        </td>

                        <td>
                            <div class="col-sm-12">
                                <input class="form-control" name="desc" type="text" value="<?php echo $row['temp_decr']; ?>">
                            </div>
                        </td>
                        <td>
                            <div class="col-sm-12">
                                <input class="form-control" name="unit" type="number" value="<?php echo $row['temp_unit']; ?>" >
                            </div>
                        </td>

                        <td>
                            <div class="col-sm-12">
                                <input class="form-control" name="quantity" type="number" value="<?php echo $row['temp_quantity']; ?>">
                            </div>
                        </td>

                        <td>
                            <div class="col-sm-12">
                                <input class="form-control" name="total" type="number" value="<?php echo $row['mp_total']; ?>">
                            </div>
                        </td>

                        <td>
                            <input type="submit" name="add" class="btn btn-success btn-lg fa fa-plus">
                        </td>

                        <td>
                            <a class="btn btn-danger btn-lg fa fa-minus"></a>
                        </td>

                    </tr>
                    <?php
                    }
                    }
                    ?>




                    </tbody>

                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 invoice-block pull-right">
                    <ul class="unstyled amounts">
                        <li><strong>Sub - Total amount :</strong> <input class="form-control" name="subtotal"
                                                                         type="number" readonly></li>
                        <li><strong>Discount :</strong><input class="form-control" name="dico" type="number"></li>

                        <li><strong>Grand Total :</strong><input class="form-control" name="grandtotal" type="number"
                                                                 readonly></li>
                    </ul>
                </div>
            </div>
            <div class="text-center invoice-btn">
                <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg">
                <a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print
                </a>
            </div>
        </div>
</div>
</form>

</section>
</section>

<?php include './footer.php'; ?>
</section>
<?php include './script.php'; ?>

</body>
</html>
