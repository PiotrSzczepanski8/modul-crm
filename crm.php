<?php

function zapis($data){
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "crm"; 

    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql_create_db) === TRUE) {
        echo "Database created successfully or already exists<br>";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    $conn->select_db($dbname);

    $sql_create_table = "CREATE TABLE IF NOT EXISTS klienci (
        id_klienta INT AUTO_INCREMENT PRIMARY KEY,
        imie_klienta VARCHAR(255) NOT NULL,
        email_klienta VARCHAR(255) NOT NULL,
        status_sub VARCHAR(50) NOT NULL
    )";
    if ($conn->query($sql_create_table) === TRUE) {
        echo "Table klienci created successfully or already exists<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $imie = $conn->real_escape_string($data['imie']);
    $email = $conn->real_escape_string($data['email']);
    $status_sub = $conn->real_escape_string($data['status_sub']);

    $sql_insert_data = "INSERT INTO klienci (imie_klienta, email_klienta, status_sub) VALUES ('$imie', '$email', '$status_sub')";
    if ($conn->query($sql_insert_data) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql_insert_data . "<br>" . $conn->error;
    }

    $conn->close();
}

$imie = null;
$email = null;
$status_sub = null;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $imie = $_POST["imie"]; 
    $email = $_POST["email"];
    $status_sub = $_POST["status_sub"];
    
}

$errors = [];
$retutn = [];

if(empty($errors)){
    $data = ["imie" => $imie, "email" => $email, "status_sub" => $status_sub];
    zapis($data);
    header("Location: crm.html.php");
}

?>
