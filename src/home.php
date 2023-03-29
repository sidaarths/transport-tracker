<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            margin: 0% 0% 0% 0%;
            padding: 0;
        }

        body{
            background-color: antiquewhite;
        }

        #app-view {
            border-style: ridge;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        #app-menu {
            width: 100%;
            margin: 0px;
            padding: 0px;
            display: flex;
            flex-direction: row;
            text-align: center;
        }

        #app-menu li {
            display: list-item;
            list-style: none;
            flex: 1;
            background-color: lightblue;
            padding-top: 15px;
            padding-bottom: 15px;    
        }

        #app-menu li a {
            text-decoration: none;
            text-transform: uppercase;
            padding-left: 10px;
            font-family: sans-serif;
            font-weight: bold;
        }

        #page-view {
            background-color: antiquewhite;
            height: 500px;
            width: 100%;
            margin: 5% 5% 5% 5%;
            padding-top: 50px;
            padding-right: 30px;
            padding-bottom: 50px;
            padding-left: 80px;
        }
    </style>
    <title>CPSC 304 Project</title>
  </head>
  <body>
  <div id="app-view">
            <ul id="app-menu">
                <li class="menu-item">
                    <a href="home.php">
                    Home</a>
                </li>
                <li class="menu-item">
                    <a href="stop.php">
                    Stop</a>
                </li>
                <li class="menu-item">
                    <a href="line.php">
                    Line</a>
                </li>
                <li class="menu-item">
                <a href="operator.php">
                    Operator</a>
                </li>
                <li class="menu-item">
                    <a href="hasworked.php">
                    Operator History</a>
                </li>
                <li class="menu-item">
                    <a href="garage.php">
                    Garage</a>
                </li>
                <li class="menu-item">
                    <a href="user.php">
                    User</a>
                </li>
                <li class="menu-item">
                    <a href="login.php">
                    Login</a>
                </li>
            </ul>
        </div>
    <div id="page-view">
        <div class="content">
            <!-- replace below div with content of page -->
            <h1> Transit App Homepage </h1>
            <h2> Navigate to Page: </h2>
            <div class="horizontal button list">
                <a href="line.php">
                    <input type="submit" value = "Line">
                </a>

                <a href="stop.php">
                    <input type="submit" value="Stop">
                </a>
                <a href="operator.php">
                    <input type="submit" value="Operator">
                </a>
                <a href="garage.php">
                    <input type="submit" value="Garage">
                </a>
            </div>
                
            <div>&nbsp;</div>
            <div>&nbsp;</div>

            <h2>Reset</h2>
                <p>Reloads ALL the data</p>

                <form method="POST">
                    <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
                    <p><input type="submit" value="Reset" name="reset"></p>
                </form>

            <div>&nbsp;</div>
            <div>&nbsp;</div>
        </div>
      </div>
        <?php
        include '../resources/login_info.php';
        include 'functions.php';

        function handleResetRequest() {
            deleteAndPurge();
            echo "<br> creating new tables <br>";
            createTables();
            populateTables();
        }

        function deleteAndPurge(){
            echo "<br> dropping old tables <br>";
            execSQLFromFile("sql/drop-tables.sql");
        }

        function createTables(){
            echo "<br> re-creating new tables <br>";
            execSQLFromFile("sql/database-setup.sql");
        }

        function populateTables(){
            // Order is important here
            echo "<br> populating new tables <br>";
            execSQLFromFile("sql/stop-setup.sql");
            execSQLFromFile("sql/poi-setup.sql");
            // GARAGE SETUP NOW IN VEHICLE
            // execSQLFromFile("sql/garage-setup.sql");
            execSQLFromFile("sql/vehicle-setup.sql");
            execSQLFromFile("sql/line-setup.sql");
            execSQLFromFile("sql/linestop-setup.sql");
            execSQLFromFile("sql/operator-setup.sql");
            execSQLFromFile("sql/account-setup.sql");
        }

        function execSQLFromFile($file_path){
            global $db_conn;
            debugAlertMessage("filepath $file_path");

            $file = fopen($file_path, "r");
            if ($file) {
                while (($line = fgets($file)) !== false) {
                    $line = str_replace(";","",$line).trim();
                    if(!ctype_space($line)){
                        executePlainSQL($line);
                    }
                    
                }
                fclose($file);
                OCICommit($db_conn);
            }
            
        }

		if (isset($_POST['reset'])) {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } 
                disconnectFromDB();
            }
        } 
		?>
	</body>
</html>
