<?php

function update($id, $newName, $newEmail, $newSubStatus){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crm";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $newName = $conn->real_escape_string($newName);
    $newEmail = $conn->real_escape_string($newEmail);
    $newSubStatus = $conn->real_escape_string($newSubStatus);

    $sql = "UPDATE klienci SET imie_klienta='$newName', email_klienta='$newEmail', status_sub='$newSubStatus' WHERE id_klienta=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id_klienta"];
    $newName = $_POST["nowe_imie"];
    $newEmail = $_POST["nowy_email"];
    $newSubStatus = $_POST["nowy_status_sub"];
}

if (!empty($id) && !empty($newName) && !empty($newEmail) && !empty($newSubStatus)) {
    update($id, $newName, $newEmail, $newSubStatus);
    header("Location: crm.html.php");
}

?>
