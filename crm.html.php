<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Moduł CRM</title>
    <script src="crm.js" defer></script>
  </head>
  <body>
    <div class="container">
      <header><h1>Moduł CRM</h1></header>
      <main>
        <button type="button" class="collapsible">Nowy Klient</button>
        <div class="content" id="opcja1">
          <form action="crm.php" method="post" id="form1">
            <label for="imie"></label>
            <input
              type="text"
              id="imie"
              name="imie"
              placeholder="Imię"
              required
              class="form1"
            />
            <label for="email"></label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="E-mail"
              required
              class="form1"
            />
            <label for="status_sub"></label>
            <input
              type="text"
              id="status_sub"
              name="status_sub"
              placeholder="Status subskrypcji"
              required
              class="form1"
            />
            <input type="submit" value="Potwierdź" class="submit" />
          </form>
        </div>
        <button type="button" class="collapsible">Wszyscy klienci</button>
        <div class="content" id="opcja2">
          <p class="wyswietlanie">

          <?php
                $servername = "localhost";
                $username = "root"; 
                $password = ""; 
                $dbname = "crm"; 

                $conn = new mysqli($servername, $username, $password,/* $dbname*/);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
              
                $sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
                if ($conn->query($sql_create_db) === TRUE) {
                    
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
                    
                } else {
                    echo "Error creating table: " . $conn->error;
                }

                $sql = "SELECT * FROM klienci";
                $result = $conn->query($sql);
              
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "| ID: " . $row["id_klienta"]. " | Imię: " . $row["imie_klienta"]. " | Email: " . $row["email_klienta"]. " | Status subskrypcji: " . $row["status_sub"]. "| <br>";
                    }
                } else {
                    echo "nie znaleziono żadnych klientów w bazie";
                }
              
                $conn->close();
            ?>
          </p>
        </div>
        <button type="button" class="collapsible">Aktualizuj klienta</button>
        <div class="content" id="opcja3">
          <form action="crmupdate.php" method = "POST">
            <label for="id_klienta"></label>
            <input
              type="text"
              id="id_klienta"
              name="id_klienta"
              placeholder="Identyfikator klienta"
              required
            />

            <label for="nowe_imie"></label>
            <input
              type="text"
              id="nowe_imie"
              name="nowe_imie"
              placeholder="Nowe imię"
              required
            />
            <label for="nowy_email"></label>
            <input
              type="email"
              id="nowy_email"
              name="nowy_email"
              placeholder="Nowy e-mail"
              required
            />
            <label for="nowy_status_sub"></label>
            <input
              type="text"
              id="nowy_status_sub"
              name="nowy_status_sub"
              placeholder="Nowy status subskrypcji"
              required
            />

            <input type="submit" value="Potwierdź" class="submit" />
          </form>
        </div>
        <button type="button" class="collapsible">Usuń klienta</button>
        <div class="content" id="opcja4">
          <form action="crmdelete.php" method = "post">
            <label for="id_klienta_do_usuniecia"></label>
            <input
              type="text"
              id="id_klienta_do_usuniecia"
              name="id_klienta_do_usuniecia"
              placeholder="ID klienta do usuniecia"
              required
            />
            <input type="submit" value="Usuń" class="submit" />
          </form>
        </div>
        <button type="button" class="collapsible">
          E-maile wszystkich klientów
        </button>
        <div class="content" id="opcja5">
        <p class="wyswietlanie">

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "crm";
                  
              $conn = new mysqli($servername, $username, $password /*, $dbname*/);
                  
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
        if ($conn->query($sql_create_db) === TRUE) {
            
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
            
        } else {
            echo "Error creating table: " . $conn->error;
        }
      
        $sql = "SELECT email_klienta FROM klienci";
        $result = $conn->query($sql);
      
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["email_klienta"] . "<br>";
            }
        } else {
            echo "nie znaleziono żadnych klientów w bazie";
        }
      
        $conn->close();
        ?>
          </p>
        </div>
      </main>
    </div>
    <script>
      var coll = document.getElementsByClassName("collapsible");

      for (let i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          if (content.style.maxHeight) {
            content.style.maxHeight = null;
          } else {
            content.style.maxHeight = content.scrollHeight + "em";
          }
        });
      }
    </script>
  </body>
</html>
