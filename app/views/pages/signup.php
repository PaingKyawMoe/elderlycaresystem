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
        <?php require APPROOT . '/views/components/auth_message.php'; ?>
        <p class="title">Welcome Our New User </p>
        <p class="message">Signup now and get full access to our app. </p>

        <label>
            <p class="text-danger ml-4">
                <?php
                if (isset($data['name-err']))
                    echo $data['name-err'];
                ?>
            </p>
            <input required="" placeholder="" type="text" name="name" class="input">
            <span>Enter Your Name</span>
        </label>

        <label>
            <p class="text-danger ml-4">
                <?php
                if (isset($data['email-err']))
                    echo $data['email-err'];
                ?>
            </p>
            <p style="color:red;" id="email-error">
                <?php
                if (isset($_SESSION['error_email']))
                    echo $_SESSION['error_email'];
                unset($_SESSION['error_email']);
                ?>
            </p>
            <input required="" placeholder="" type="email" name="email" class="input">
            <span>Enter Your Email</span>
        </label>


        <label>
            <p style="color:red;">
                <?php
                if (isset($data['password-err']))
                    echo $data['password-err'];
                ?>
            </p>
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
<script>
    setTimeout(function() {
        const err = document.getElementById('email-error');
        if (err) err.style.display = 'none';
    }, 3000); // 3 seconds
</script>