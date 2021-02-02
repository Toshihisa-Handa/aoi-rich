<?php 
session_start();
include('funcs.php');
loginCheck();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="css/style.css" rel="stylesheet">
  <link href="css/con.css" rel="stylesheet">

</head>
<body>
<?php 
include('header.php');
?>

  <div class='contact-header'>
      <div class="container">
          <div class="contact-header-area">
        <div class=><img src="imgs/contact.jpg" class="tama"></div>          
          </div>
      </div>
  </div>

  <div class="form-wrapper">
      <div class="container">
          <div class="form-area">
            <form action="contactInsert.php"  method='post'>
            <div class='formBox'>
                <input type="text" name="name" placeholder='Name' class='formNav in'>
                <input type="text" name="email"  Placeholder='Email' class='formNav in'>
                <textarea name="message" id="" rows="10" placeholder='Message' class='formNav'></textarea>
                <input type="submit" value='Send Message'class='sub'>
             </div> 
            </form>
          </div>
      </div>
   </div>








   <?php 
include('footer.php');
?>

</body>
</html>
