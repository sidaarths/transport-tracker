<!DOCTYPE html>
<html>
    <head>
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
                width: 100%;
                margin: 0% 0% 0% 0%;
                padding-top: 5px;
                padding-right: 5px;
                padding-bottom: 5px;
                padding-left: 5px;
            }

            .search-form {
                width: 90%;
                margin: 0% 0% 0% 0%;
                padding-top: 5px;
                padding-right: 5px;
                padding-bottom: 15px;
                padding-left: 5px;
            }

            table {
                padding-left: 40px;
            }

            #horizontal {
                display: flex;
            }

            .output {
                border-style: solid;
                padding: 15px;
                width: 90%;
            }
        </style>
        <title>CPSC 304 PHP/Oracle Demonstration</title>
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
            <div class = "Table infromation">
            </div>
            <div class = "search-form">
                <h2>Search Transport Network</h2>
                <div class = "search-elements">
                    <form method="post">
                        <input type="hidden" id="attributes" name="attributes">
                            Information Required: <input type="text" name="attributes"> <br />
                        <p>From:</p>
                        <select name="table" id="table">
                            <option value="Vehicle">Vehicles</option>
                            <option value="VehicleType">Vehicle Types</option>
                            <option value="VehicleLicense">Vehicle Licences</option>
                            <option value="Garage">Garage</option>
                        </select>
                        <p>Filter:</p>
                        <div id="horizontal">
                            <input type="hidden" id="filters" name="filters">
                            <input type="text" name="filter-attr"> <br /><br />
                            <select name="filter-condition" id="filter-condition">
                                <option value="<"><</option>
                                <option value=">">></option>
                                <option value="<="><=</option>
                                <option value=">=">>=</option>
                                <option value="!=">!=</option>
                                <option value="=">=</option>
                            </select>
                            <input type="text" name="filter-value"> <br /><br />
                        </div>
                        <br>
                        <div id="horizontal">
                            <input type="hidden" id="filters2" name="filters2">
                            <input type="text" name="filter-attr2"> <br /><br />
                            <select name="filter-condition2" id="filter-condition2">
                                <option value="<"><</option>
                                <option value=">">></option>
                                <option value="<="><=</option>
                                <option value=">=">>=</option>
                                <option value="!=">!=</option>
                                <option value="=">=</option>
                            </select>
                            <input type="text" name="filter-value2">
                        </div>
                        <br>
                        <input type="submit" value="Submit" name="submit-btn">
                        <br><br>
                        <p>Press the button below to view average turnover/productivity for all Translink Service Centers: </p>
                        <input type="submit" value="View Average Service Frequency For All Lower Mainland Garages" name="submit-btn2">
                    </form>                    
                </div>
            </div>
            <div class="Available Entries">
                <h2>Available Information:</h2>
                <h3>Vehicles:</h3>
                <p>ID, Type, Enteredservice (DD-MMM-YY), Servicefrequency, Lastservicedate (DD-MMM-YY), Garagename</P> 
                <h3>Vehicle Types</h3>
                <p>Type, Topspeed, Capacity,</p>
                <h3>Vehicle Licenses</h3>
                <p>Vehicleid, Vehicletype, Licensedtype</p>
                <h3>Garage</h3>
                <p>Name, Capacity, Type</p>
            </div>    
        </div>
    </div>
    <div class="output">
        <?php
        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; 
        $show_debug_alert_messages = false; 
        
        
        function debugAlertMessage($message) {
            global $show_debug_alert_messages;

            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
        }

        function executePlainSQL($cmdstr) {
            global $db_conn, $success;

            $statement = OCIParse($db_conn, $cmdstr);

            if (!$statement) {
                debugAlertMessage("statement false");
                $success = False;
            }

            $resp = OCIExecute($statement, OCI_DEFAULT);
            if (!$resp) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
                echo htmlentities($e['message']);
                $success = False;
            }

            return $statement;
        }

        function printLineResult($statement, $attributes) {
            $count = 0;
            $result = array();
            while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
                $result[] = $row;
                $count = $count +1;
            }

            $attribute_arr = explode(",", $attributes);
            
            echo "<table width = 90%>";
            foreach($result as $row)
            {
                echo "<tr>\n";
                foreach($row as $index=>$value)
                {   
                    if (is_numeric($index)) {
                        echo "<th>".$attribute_arr[$index].":</th>";
                        echo "<td>$value</td>\n";
                    }
                }
                echo "</tr>\n";
            }
            echo "</table>";
        }

        function connectToDB() {
            global $db_conn;
            
            $db_conn = OCILogon("ora_samdai01", "a69249357", "dbhost.students.cs.ubc.ca:1522/stu");

            if ($db_conn) {
                debugAlertMessage("Database is Connected");
                return true;
            } else {
                debugAlertMessage("Cannot connect to Database");
                $e = OCI_Error();
                echo htmlentities($e['message']);
                return false;
            }
        }

        function disconnectFromDB() {
            global $db_conn;

            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }

        function executeSELECT() {
            $attributes = strtolower($_POST["attributes"]);
            $table = $_POST["table"];
            $filter_attr = $_POST["filter-attr"];
            $filter_attr2 = $_POST["filter-attr2"];
            $filter_value = $_POST["filter-value"];
            $filter_value2 = $_POST["filter-value2"];
            $filter_condition = $_POST["filter-condition"];
            $filter_condition2 = $_POST["filter-condition2"];

            if ($filter_attr != "" && $filter_value != "" && $filter_attr2 != "" && $filter_value2 != "") {
                $query = "SELECT ".$attributes." FROM ".$table." WHERE ".$filter_attr."".$filter_condition."'".$filter_value."' AND ".$filter_attr2."".$filter_condition2."'".$filter_value2."'";
                $result = executePlainSQL($query);
                printLineResult($result, $attributes);
            } else if ($filter_attr != "" && $filter_value != "" && $filter_attr2 == "" && $filter_value2 == "") {
                $query = "SELECT ".$attributes." FROM ".$table." WHERE ".$filter_attr."".$filter_condition."'".$filter_value."'";
                $result = executePlainSQL($query);
                printLineResult($result, $attributes);
            } 
            else if ($filter_attr == "" && $filter_value == "" && $filter_attr2 != "" && $filter_value2 != "") {
                $query = "SELECT ".$attributes." FROM ".$table." WHERE ".$filter_attr2."".$filter_condition2."'".$filter_value2."'";
                $result = executePlainSQL($query);
                printLineResult($result, $attributes);
            } else {
                $query = "SELECT ".$attributes." FROM ".$table;
                $result = executePlainSQL($query);
                printLineResult($result, $attributes);
            }            
        }
        
        function executeNestedAggro() {
            $query = "SELECT V.garageName, AVG (V.serviceFrequency) as avgserv FROM Vehicle V GROUP BY V.garageName HAVING 1 < (SELECT COUNT(*) FROM Vehicle S WHERE V.garageName = S.garageName)";
            $result = executePlainSQL($query);
            $attributes = "Garage, Average Service Frequency (in months)";
            echo "<h3>Average Maintance Frequency For Each Lower Mainland Garage:</h3>";
            printLineResult($result, $attributes);
        }

        if (isset($_POST["submit-btn"])) {
            if (connectToDB()) {
                if (array_key_exists("attributes", $_POST) && array_key_exists("table", $_POST) && array_key_exists("filters", $_POST)) {
                    executeSELECT();

                }
                disconnectFromDB();
            }
        }

        if (isset($_POST["submit-btn2"])) {
            if (connectToDB()) {
                executeNestedAggro();
                disconnectFromDB();
            }
        }
		?>
    </div>
	</body>
</html>
