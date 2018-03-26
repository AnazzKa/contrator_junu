<?php
session_start();
include('session-handle.php');
include('ChkLogout.php');
include './db.php';
?>
<?php
$bill_id = "";
$date = "";
$to = "";
$company = "";
$subtotal = "";
$discount = "";
$grand = "";
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $to = strtoupper($_POST['to']);
    $company = strtoupper($_POST['company']);
    $subtotal = $_POST['subtotal'];
    $discount = $_POST['dico'];
    $grand = $_POST['grandtotal'];
    $item = $_POST['item'];
    $limit = count($_POST['item']);
    $sql = "INSERT INTO cont_invoice(invoice_date,invoice_to,invoice_company,invoice_sub,invoice_discount,invoice_grand) VALUES ('$date','$to','$company','$subtotal','$discount','$grand')";
    if (mysqli_query($conn, $sql)) {
        $bill_id = mysqli_insert_id($conn);
        $sql = "INSERT INTO invoice_sub(sub_invoice_id,sub_item,sub_description,sub_unit,sub_quantity,sub_total)VALUES ";

        $val = array();
        for ($i = 0; $i < $limit; $i++) {
            $item = $_POST['item'][$i];
            $desc = $_POST['desc'][$i];
            $unitcost = $_POST['unitcost'][$i];
            $quantity = $_POST['quantity'][$i];
            $total = $_POST['total'][$i];
            $val[] = "('$bill_id','$item','$desc','$unitcost','$quantity','$total')";
        }
        $sql .= implode(',', $val);
        if(mysqli_query($conn, $sql))
        {
            mysqli_query($conn,"TRUNCATE temp_items");
            header('Location:invoice_print.php');
        }
    } else {
        echo "Error Occured:" . mysqli_error($conn);
    }


}
?>