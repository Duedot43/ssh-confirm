<?php

if (isset($_COOKIE['name'])) {
    if (!file_exists("db.lck")) {
        $json_file = file_get_contents("db.json");
        $json = json_decode($json_file, true);
        file_put_contents("db.lck", "");
    } else {
        echo "database is currently used by another instance please try again";
        exit;
    }
    echo "You are currently logged in as " . $_COOKIE['name'] . "<br> your ID is: " . $json[$_COOKIE['name']]['uid'] . "<br>";
    unlink("db.lck");
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