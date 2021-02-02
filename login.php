<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/login.css" rel="stylesheet">
  <title>Log In</title>
</head>
<body>
  <div class="main-wrapper">
      <div class="container">
          <div class="main-area">
            <div class="imgBox"><img src="imgs/login.jpg" alt=""></div>
            <div class="formBox">

                <form  method='post' action="login_act.php" class=' Flog'>
                    <h2 class='login-title'>Aois MakeUp gallary</h2>
                    <input type="text" name="uid" placeholder='AcountName' class='login Fin '>
                    <input type="password" name="upass"  Placeholder='Password' class='login Fin '>
                    <input type="submit" name="password"  value='Sign In' class='login Fin Lcolor'>
                </form>

                <form method='post' action="insert.php">
                    <p class="registerBtn">Click here for new registration</p>
                    <div class="rhidden">
                    <input type="text" name="uname" placeholder='UserName' class='login Fin '>
                    <input type="text" name="uid"  Placeholder='AcountName' class='login Fin '>
                    <input type="password" name="upass"  Placeholder='Password' class='login Fin '>
                    <input type="submit" name="password"  value='Sign Up' id='register' class='login Fin  Lcolor'>

                    </div>
                </form>
            </div>
          </div>
      </div>
   </div>
<?php 
include('footer.php');
?>
<script>
const hiddenBtn = document.getElementsByClassName('.registerBtn');
const hidden = document.getElementsByClassName('rhidden');


hiddenBtn.onclick = function(){
console.log('hello');
}



</script>
</body>
</html>
