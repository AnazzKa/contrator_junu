<?php
session_start();
include("./db.php");

if (isset($_POST["submit"])) 
{
$userName = $_REQUEST['user'];
$pass = $_REQUEST['pass'];
$sql = "SELECT * FROM personal_profile WHERE profile_email = '". $userName ."' AND profile_pass = '".$pass."'";
//echo $sql; exit;
$result = mysqli_query($conn,$sql);
$arr = mysqli_fetch_array($result);

if (mysqli_num_rows($result)==0)
{
	$invalid = "Invalid Username or Password";
	
}
else
{
	$userid = $arr['profile_id'];
	$user = $arr['profile_name'];
	$_SESSION['user']=$user;
	$_SESSION['userid']=$userid;
	$_SESSION['poto']=$arr['profile_photo'];

        header('Location: agreement.php');
}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include './head.php'; ?>

  <body class="login-body">
    <div class="container">

        <form class="form-signin" id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h2 class="form-signin-heading">sign in now</h2>
        <?php 
		if(isset($invalid))
		{
		?>
        <!--<center><span id='emailerr' style='color:#F00'>   </span></center>-->
        <div id="error_id" class="popover-title"  align="center" style="color:#09C"><?php echo $invalid; ?></div>
        <?php
		}
         ?>
        <div class="login-wrap">
            <div id="error_id" class="popover-title"  align="center" style="color:#09C"></div>
            <input type="text" id="user" name="user" class="form-control" placeholder="Email ID" autofocus>
            <input type="password" id="pass" name="pass" class="form-control" placeholder="Password">
            
            <button class="btn btn-lg btn-login btn-block" name="submit" id="btnsign" type="submit">Sign in</button>
            
            
            

        </div>

      </form>

    </div>


  </body>
</html>
