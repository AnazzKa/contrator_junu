<?php
session_start();
include('session-handle.php');
include('ChkLogout.php');
include './db.php';
?>
<?php
include "db.php";
$name = "";
$address = "";
$contact = "";
$email = "";
$post = "";
$photo = "";

if (isset($_POST['submit']))
{
    $name =strtoupper($_POST["name"]);
    $address =strtoupper($_POST["address"]);
    $contact =$_POST["contact"];
    $email =$_POST["email"];

    if(isset($_FILES["photo"]))
    {
        $image_name=$_FILES['photo']['name'];
        $image_type=$_FILES['photo']['type'];
        $image_size=$_FILES['photo']['size'];
        $image_tmp=$_FILES['photo']['tmp_name'];
        $image_explode=explode(".",$image_name);
        $end=end($image_explode);
        $image_extension=strtolower($end);
        $extensions=array("jpeg","jpg","png");
        $image=date("ymdHis").".".$image_extension;
    }
    $sql ="UPDATE  company_profile SET company_name='$name',company_address='$address',company_phone='$contact',company_email='$email',company_log='$image' WHERE company_id=1";
    if (mysqli_query($conn,$sql))
    {
        echo "Updated Successfully";
        move_uploaded_file($image_tmp,"images/".$image);

    } else {
        echo "Error Occured:" . mysqli_error($conn);
    }

}
$sql2="SELECT * FROM company_profile";
$result=mysqli_query($conn,$sql2);
$row=mysqli_fetch_assoc($result);
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
            <form role="form" method="post" enctype="multipart/form-data" action="">

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading" style="text-align: center">
                                <strong>Company Profile </strong>
                            </header>
                        </section>
                    </div>


                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="form-group col-md-8">
                                    <label>Company Name </label>
                                    <input type="text" name="name" value="<?php echo $row["company_name"]; ?>"  class="form-control col-md-4">
                                </div>

                                <div class="form-group col-md-8">
                                    <label>Address</label>
                                    <input type="text" name="address"  value="<?php echo $row["company_address"]; ?>"  class="form-control">
                                </div>


                                <div class="form-group col-md-8">
                                    <label>Contact Number</label>
                                    <input type="text" name="contact"  value="<?php echo $row["company_phone"]; ?>"  class="form-control">
                                </div>

                                <div class="form-group col-md-8">
                                    <label>Email</label>
                                    <input type="email" name="email"  value="<?php echo $row["company_email"]; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Logo</label>
                                    <input type="file" name="photo" class="form-control">
                                    <img src="images/<?php echo $row["company_log"];?>" width="130" height="130">
                                </div>

                            </div>

                            <div class="text-center invoice-btn">
                                <input class="btn btn-success " value=" Update" type="submit" name="submit"
                                       id="submit">

                            </div>
                        </section>
                    </div>


            </form>
        </section>
       </section>
<?php include './footer.php'; ?>
</section>
<?php include './script.php'; ?>

</body>
</html>
