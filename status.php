<?php

if (!file_exists("db.lck")) {
    $json_file = file_get_contents("db.json");
    $json = json_decode($json_file, true);
    file_put_contents("db.lck", "");
} else {
    echo "database is currently used by another instance please try again";
    exit;
}

if (isset($_GET['usr'])) {
    unset($json[$_GET['usr']]);
    file_put_contents('db.json', json_encode($json));
    unlink('db.lck');
    echo "user " . $_GET['usr'] . " deleted";
    exit;
}


foreach ($json as $value) {
    if ($value['complete_ssh'] == "1" && $value['complete_scp'] == "1") {
        echo "<a href='status.php?usr=" . $value['username'] . "'><font color='green'>" . $value['username'] . "</font></a><br>";
    } else if ($value['complete_ssh'] == "1" && $value['complete_scp'] == "0") {
        echo "<a href='status.php?usr=" . $value['username'] . "'><font color='yellow'>" . $value['username'] . "</font></a><br>";
    } else {
        echo "<a href='status.php?usr=" . $value['username'] . "'><font color='red'>" . $value['username'] . "</font></a><br>";   
    }
}

unlink("db.lck");

