<?php

function usun($id){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crm";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM klienci WHERE id_klienta=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id_klienta_do_usuniecia"];
}

if (!empty($id)) {
    usun($id);
    header("Location: crm.html.php");
}

?>
