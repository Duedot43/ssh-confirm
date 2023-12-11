<?php

if (!file_exists("db.lck")) {
    $json_file = file_get_contents("db.json");
    $json = json_decode($json_file, true);
    file_put_contents("db.lck", "");
} else {
    echo "database is currently used by another instance please try again";
    exit;
}

if (!isset($_COOKIE["name"]) || !isset($json[$_COOKIE['name']])) {
    echo "YOU DO NOT HAVE THE MAGIC!!!<br>Please register";
    unlink("db.lck");
    exit;
}

if ($json[$_COOKIE["name"]]['complete_ssh'] == "1" && $json[$_COOKIE["name"]]["complete_scp"]) {
    echo "You are already finished with both labs";
    unlink("db.lck");
    exit;
}

if (file_exists("/tmp/" . $json[$_COOKIE["name"]]["uid"] . ".txt")) {
    $file = file_get_contents("/tmp/" . $json[$_COOKIE["name"]]["uid"] . ".txt");
    if ($file == $_COOKIE["name"]) {
        echo "You did the SCP lab!";
        $json[$_COOKIE["name"]]["complete_scp"] = "1";
        file_put_contents("db.json", json_encode($json));
    }
    unlink("db.lck");
    exit;
}

if (file_exists("/tmp/" . $json[$_COOKIE["name"]]["uid"])) {
    echo "You did the SSH lab!";
    $json[$_COOKIE["name"]]["complete_ssh"] = "1";
    file_put_contents("db.json", json_encode($json));
    unlink("db.lck");
    exit;
}
echo "You did not complete the lab!";
unlink("db.lck");

