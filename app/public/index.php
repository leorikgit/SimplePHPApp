<?php
include __DIR__ .'../../core/ini.php';

$user = new User();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
Hello <?php echo ($user->isLoggedIn()) ?  $user->data()->username : '' ?>
<?php
    if($user->isLoggedIn()){
        ?>
            <p><a href="<?php echo BASE_URL."profile.php"?>">Profile</a></p>
            <p><a href="<?php echo BASE_URL."logout.php"?>">Logout</a></p>

        <?php
    }else{
        ?>
        <p><a href="<?php echo BASE_URL."login.php"?>">Login</a></p>
        <p><a href="<?php echo BASE_URL."register.php"?>">Register</a></p>

        <?php
    }
?>

</body>
</html>