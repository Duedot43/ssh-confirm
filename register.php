<?php
if (isset($_COOKIE["name"])) {
    echo "You already registered";
    exit;
}

if (isset($_POST["username"])) {
    if (!file_exists("db.lck")) {
        $json_file = file_get_contents("db.json");
        $json = json_decode($json_file, true);
        file_put_contents("db.lck", "");
    } else {
        echo "database is currently used by another instance please try again";
        exit;
    }

    if (isset($json[$_POST["username"]])) {
        echo "You are already registered.";
        unlink("db.lck");
        exit;
    }

    $uid = uniqid(rand(0,99999), true);
    $json[$_POST["username"]] = array(
        "username" => $_POST["username"],
        "complete_scp" => "0",
        "complete_ssh" => "0",
        "uid" => $uid
    );

    setcookie("name", $_POST['username'], 0, "/", $_SERVER['SERVER_NAME']);

    file_put_contents("db.json", json_encode($json));
    unlink("db.lck");
    echo "your username is " . $_POST['username'];
    echo '<br><a download="' . $uid . '.txt' . '" href="data:text;base64,' . base64_encode($_POST['username']) . '">Download</a>';
    exit;
}
?>


<form method="post">
    <label>
        username:
        <input type="text" pattern="[a-zA-Z]+" name="username" id="username" required />
    </label>
    <button type="submit" name="Submit" value="Submit"> Register </button>
</form>