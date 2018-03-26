<?php
session_start();
include ('db.php');
?>
<?php
if(isset($_POST['submit']))
{

}else{
    mysqli_query($conn,"TRUNCATE temp_items");
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
            <form method="post" action="invoicesubmit.php">

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading" style="text-align: center">
                                <strong> Invoice Form </strong>
                            </header>
                        </section>
                        <?php
                        if(isset($_REQUEST['Data']))
                        {
                           ?>
                            <p>Data Saved Successfully</p>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">


                                <div class="form-group col-md-4 pull-right">
                                    <label>Date</label>
                                    <input type="date" name="date" class="form-control">
                                </div>

                                <div class="form-group col-md-8">
                                    <label>To</label>
                                    <input type="text" name="to" class="form-control">
                                </div>


                                <div class="form-group col-md-8">
                                    <label>Company Name</label>
                                    <input type="text"  name="company" class="form-control">
                                </div>


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

                                        <tbody id="tbody">

                                        <tr>
                                            <td>
                                                <div class="col-sm-12">
                                                    <input class="form-control " type="number" value="1" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12">
                                                    <select class="form-control" style="width: 150px" name="item" id="item_1" onchange="get_unit(1)">
                                                        <option>--SELECT--</option>
                                                        <?php
                                                        $option="";
                                                        $get_item=mysqli_query($conn,"SELECT * FROM cont_item");
                                                        while($row=mysqli_fetch_assoc($get_item))
                                                        {
                                                            $option.='<option value="'.$row['item_id'].'">'.$row['item_name'].'</option>';
                                                        }
                                                        ?>
                                                    <?php echo $option;?>


                                                        </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12">
                                                    <input class="form-control" name="decription" id="desc_1" type="text">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12">
                                                    <input class="form-control"name="unit" id="unit_1"  type="number"
                                                           readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12">
                                                    <input class="form-control" id="quantity_1" name="quantity" type="number" onkeyup="showTotal(1)">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12">
                                                    <input class="form-control" id="total_1" name="total" value="" type="number"
                                                           readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <a onclick="add_row(1)" id="plus_1"
                                                   class="btn btn-success btn-sm fa fa-plus"></a>

                                            </td>

                                        </tr>


                                        </tbody>

                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 invoice-block pull-right">
                                        <ul class="unstyled amounts">
                                            <li><strong>Sub - Total amount :</strong> <input class="form-control"
                                                                                             name="subtotal" id="sub_total"
                                                                                             type="number" value="0" readonly>
                                            </li>
                                            <li><strong>Discount :</strong><input class="form-control" name="dico" id="disco"
                                                                                  type="number" onkeyup="grandTotal()"></li>

                                            <li><strong>Grand Total :</strong><input class="form-control" id="grandtotal"
                                                                                     name="grandtotal" type="number"
                                                                                     readonly></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="text-center invoice-btn">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg"><i
                                            class="fa fa-check"></i> Submit Invoice
                                    </button>

                                </div>
                            </div>
                    </div>
            </form>

        </section>
    </section>

    <?php include './footer.php'; ?>
</section>
<?php include './script.php'; ?>


    <script>

    function showTotal(id){
        var unit = parseInt($('#unit_' + id).val());
        var quantity = parseInt($('#quantity_' + id).val());
        var total= parseInt(unit*quantity);
        $('#total_' + id).val(total);
        var sub=parseInt($('#sub_total').val());
        $('#sub_total').val('00.00');
        var sum=0;
        var i;
        for(i=1;i<10;i++){
          if($('#total_' + i).length)
          {
              sum=sum+parseInt($('#total_' + i).val());
          }
        }
        $('#sub_total').val(sum);

        grandTotal();
    }
    function get_unit(id)
    {
          var value=$('#item_' + id).val();
        $.ajax({
            type: "POST",
            url: "./add_items_temp.php",
            async: false,
            data: {value:value},
            success: function (response) {
                $('#unit_' + id).val(response);
            }
        });
    }

    function grandTotal(){
        var subtotal=parseInt($('#sub_total').val());
        var disco=parseInt($('#disco').val());
        var grand=subtotal-disco;
        $('#grandtotal').val(grand);
    }



function add_row(id) {
        $('#plus_' + id).hide();
        var item = $('#item_' + id).val();
        var desc = $('#desc_' + id).val();
        var unit = $('#unit_' + id).val();
        var quantity = $('#quantity_' + id).val();
        var total = $('#total_' + id).val();
        $('table tbody').empty();
        $.ajax({
            type: "POST",
            url: "./add_items_temp.php",
            async: false,
            data: {item: item, desc: desc, unit: unit, quantity: quantity, total: total},
            success: function (response) {
              var data=JSON.parse(response);
                $('table tbody').append(data.table_rows);
$('#sub_total').val(data.total);
            }
        });
    }
</script>
</body>
</html>

