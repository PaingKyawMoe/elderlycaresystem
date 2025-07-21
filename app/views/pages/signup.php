<?php require_once APPROOT . '/views/inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <div class="hero-image2">
      <img class="main-img2" src="https://images.pexels.com/photos/7345474/pexels-photo-7345474.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Caregiver with elderly man">
    </div>
    <!--/controller name -->
<form class="form" method="POST" action="<?= URLROOT ?>/Users/register">
    <p class="title">Welcome Our New User </p>
    <p class="message">Signup now and get full access to our app. </p>
        <label>
            <input required="" placeholder="" type="text" name="name" class="input">
            <span>Enter Your Name</span>
        </label>
      
            
    <label>
        <input required="" placeholder="" type="email" name="email" class="input">
        <span>Enter Your Email</span>
    </label> 
        
    <label>
        <input required="" placeholder="" type="password" name="password" class="input">
        <span>Enter Your Password</span>
    </label>
    <label>
        <input required="" placeholder="" type="password" class="input">
        <span>Confirm password</span>
    </label>
    <button class="submit">Submit</button>
    <p class="signin">Already have an acount ? <a href="<?php echo URLROOT; ?>/pages/signin">Signin</a> </p>
</form>
</body>
</html>