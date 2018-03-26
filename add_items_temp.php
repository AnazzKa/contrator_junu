<?php
include('db.php');
$arr = "";
$amount = "";
if (isset($_POST['item'])) {
    $item = $_POST['item'];
    $desc = $_POST['desc'];
    $unit = $_POST['unit'];
    $quantity = $_POST['quantity'];
    $total = $_POST['total'];

    mysqli_query($conn, "INSERT INTO temp_items(item, description, unit_cost, qu, total) VALUES ('$item','$desc','$unit','$quantity','$total')");
    $re = mysqli_query($conn, "SELECT * FROM `temp_items`");
    $cnt = 0;
    while ($ro = mysqli_fetch_array($re)) {
        $cnt++;
        $item = $ro['item'];
        $desc = $ro['description'];
        $unit = $ro['unit_cost'];
        $quantity = $ro['qu'];
        $total = $ro['total'];
        $amount += $total;
        $arr .= "<tr>";
        $arr .= "<td><div class='col-sm-12'><input class='form-control'  type='number' value='" . $cnt . "' readonly></div></td>";
        $arr .= "<td><div class='col-sm-12'>";

        $arr .= "<select class='form-control' style='width: 150px' name='item[]' id='item_$cnt' onchange='get_unit(".$cnt.")'>";
        $arr .= "<option>--SELECT--</option>";

        $get_item = mysqli_query($conn, "SELECT * FROM cont_item");
        while ($row = mysqli_fetch_assoc($get_item)) {
            $rwid = $row['item_id'];
            $val = $row['item_name'];
            $arr .= "<option ";
            if ($rwid == $item) {
                $chk = "selected";
            } else {
                $chk = "";
            }
            $arr .= " $chk value='" . $rwid . "'>$val</option>";
        }
        $arr .= "</select>";

        $arr .= "</div></td>";
        $arr .= "<td><div class='col-sm-12'><input class='form-control' name='desc[]' id='desc_$cnt' value='" . $desc . "' type='text'></div></td>";
        $arr .= "<td><div class='col-sm-12'><input class='form-control' name='unitcost[]' id='unit_$cnt' value='" . $unit . "' type='number' readonly></div></td>";
        $arr .= "<td><div class='col-sm-12'><input class='form-control' name='quantity[]' id='quantity_$cnt' value='" . $quantity . "' type='number' onkeyup='showTotal(" . $cnt . ")' ></div></td>";
        $arr .= "<td><div class='col-sm-12'><input class='form-control' name='total[]' id='total_$cnt' value='" . $total . "' type='number' readonly></div></td>";
        $arr .= " <td><a class='btn btn-danger btn-sm fa fa-minus'></a>";
        $arr .= "</td></tr>";
    }
    $cnt++;
    $arr .= "<tr><td><div class='col-sm-12'>";
    $arr .= "<input class='form-control ' type='number' value='" . $cnt . "' readonly></div></td>";
    $arr .= "<td><div class='col-sm-12'>";

        $arr .= "<select class='form-control' style='width: 150px' name='item[]' id='item_$cnt' onchange='get_unit(".$cnt.")'>";
        $arr .= "<option>--SELECT--</option>";

        $get_item = mysqli_query($conn, "SELECT * FROM cont_item");
        while ($row = mysqli_fetch_assoc($get_item)) {
            $rwid = $row['item_id'];
            $val = $row['item_name'];
            $arr .= "<option ";
            $arr .= " value='" . $rwid . "'>$val</option>";
        }
        $arr .= "</select>";

        $arr .= "</div></td>";
    $arr .= "<td><div class='col-sm-12'><input class='form-control' name='desc[]' id='desc_" . $cnt . "' value='' type='text'></div></td>";
    $arr .= "<td><div class='col-sm-12'><input class='form-control' name='unitcost[]'id='unit_" . $cnt . "' value='' type='number' readonly></div></td>";
    $arr .= "<td><div class='col-sm-12'><input class='form-control'  name='quantity[]' id='quantity_" . $cnt . "' value='' type='number' onkeyup='showTotal(" . $cnt . ")' ></div></td>";
    $arr .= "<td><div class='col-sm-12'><input class='form-control'  name='total[]' id='total_" . $cnt . "' value='0' type='number' readonly></div></td>";
    $arr .= "<td><a onclick='add_row(" . $cnt . ")' class='btn btn-success btn-sm fa fa-plus'></a>";
    $arr .= "</td></tr>";

    $return_array = array('table_rows' => $arr, 'total' => $amount);
    echo json_encode($return_array);
}

if (isset($_POST['value'])) {
    $value = $_POST['value'];
    $re = mysqli_query($conn, "SELECT * FROM `cont_item` WHERE `item_id`='$value'");
    $as = mysqli_fetch_object($re);
    echo $as->item_price;
}