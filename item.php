<?php
session_start();
include('session-handle.php');
include('ChkLogout.php');
include './db.php';
?>
<?php
$item_name = "";
$item_price = "";

if (isset($_POST['submit'])) {
    $item_name = strtoupper($_POST["name"]);
    $item_price = $_POST["price"];
    $sql = "INSERT INTO cont_item(item_name,item_price) VALUES ('$item_name','$item_price')";
    if (mysqli_query($conn, $sql)) {
        echo "Item Inserted";
    } else {
        echo "Error Occured:" . mysqli_error($conn);
    }

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

            <form role="form" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading" style="text-align: center">
                            <strong> Add Items </strong>
                        </header>
                    </section>
                </div>

                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">

                            <div class="form-group col-md-4">
                                <label>Item Name</label>
                                <input name="name" type="text" autofocus="autofocus" required="required"
                                       class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Item price</label>
                                <input name="price" type="number" required="required" class="form-control">
                            </div>
                            <div class="text-center invoice-btn">
                                <input class="btn btn-success btn-lg" id="submit" type="submit" name="submit"
                                       value="Add">

                            </div>
                        </div>
                    </section>
                </div>
                    </div>
            </form>


        </section>

        <?php include './footer.php'; ?>
    </section>
    <?php include './script.php'; ?>
</body>
</html>


