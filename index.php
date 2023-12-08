<?php

if (isset($_COOKIE['name'])) {
    echo "You are currently logged in as " . $_COOKIE['name'] . "<br>";
} else {
    echo 'You aren currenly not logged in please register<br>';
}

?>

<a href="register.php">
    <button>Register</button>
</a><br>

<a href="login.php">
    <button>Check Progress</button>
</a><br><br>

uname: ssh-lab<br>
passwd: 12345678!Aa