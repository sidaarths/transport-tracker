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
                width: 50%;
                margin: 0% 0% 0% 0%;
                padding-top: 5px;
                padding-right: 5px;
                padding-bottom: 5px;
                padding-left: 5px;
            }

            .search-form {
                width: 50%;
                margin: 0% 0% 0% 0%;
                padding-top: 5px;
                padding-right: 5px;
                padding-bottom: 15px;
                padding-left: 5px;
            }
            td {
                padding: 0 10px;
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
                <div class="split right" style="float: left; margin-right:10%;">
                    <?php
                    echo "<h2>Operator Information</h2>";
                    include '../resources/login_info.php';
                    include 'functions.php';

                    function printOperatorResult($statement) {
                        $count = 0;
                        $result = array();
                        while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
                            $result[] = $row;
                            $count = $count +1;
                        }

                        if($count == 0){
                            echo "No operators found";
                            return;
                        }
                        echo "<div><table>";
                        echo "<tr><th>Operator ID</th><th>Name</th><th>Assigned Vehicle ID</th><th>Assigned Vehicle Type</th><th>Assigned Transit Line</th><th>GarageName</th></tr>";
                        foreach ($result as $result_row) {
                            $id = $result_row["ID"];
                            $historyLink = "hasworked.php?operatorName=&opID=".$id."&operatorName=Search+for+Operator";
                            echo "<tr><td><a href=".$historyLink.">".$id.
                                "</a></td><td>".$result_row["NAME"].
                                "</td><td>".$result_row["VEHICLEID"].
                                "</td><td>".$result_row["VEHICLETYPE"].
                                "</td><td>".$result_row["WORKINGLINE"].
                                "</td><td>".$result_row["GARAGENAME"]."</td></tr>";
                        }

                        echo "</table></div>";
                    }

                    function getOperatorRequest() {
                        $query = "SELECT * FROM Operator";
                        $result = executePlainSQL($query);
                        printOperatorResult($result);
                    }
                    
                    if (connectToDB()) {
                        getOperatorRequest();
                        disconnectFromDB();
                    }
                    ?>
                </div>
                <div class = "search-form;split left" style="float: left;">
                    </br>
                    <h2>Find Operators who worked all Lines by type</h2>
                    <form method="GET">
                        <input type="hidden" id="searchHasWorked" name="searchHasWorked"></br>
                        <h4>Type Selection</h4>
                        <input type="radio" id="Bus" name="LineTypeFilter" value="Bus">
                        <label for="Bus">Bus</label></br>
                        <input type="radio" id="RapidBus" name="LineTypeFilter" value="RapidBus">
                        <label for="RapidBus">RapidBus</label> </br>
                        <input type="radio" id="Metro" name="LineTypeFilter" value="Metro">
                        <label for="Metro">Metro</label></br>
                        <input type="radio" id="Rail" name="LineTypeFilter" value="Rail">
                        <label for="Rail">Rail</label>  </br>
                        <input type="radio" id="Trolley" name="LineTypeFilter" value="Trolley">
                        <label for="Trolley">Trolley</label></br>
                        <input type="radio" id="SeaBus" name="LineTypeFilter" value="SeaBus">
                        <label for="SeaBus">SeaBus</label></br>
                        <input type="submit" name="searchHasWorked" value="Search">
                        </br>
                    </form>
                    <?php

                    function printOps($statement){
                        $count = 0;
                        $result = array();
                        while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
                            $result[] = $row;
                            $count = $count +1;
                        }
                        // echo "results";
                        if($count == 0){
                            echo "No Operators have worked all lines";
                            return;
                        }
                        echo "<div><table>";
                        echo "<tr><th>Operators</th>";
                        foreach ($result as $result_row) {
                            echo "<tr><td>" . $result_row["NAME"] . "</td></tr>";
                        }
            
                        echo "</table></div>";
                    }

                    function operatorsWorkedAllLines(){
                        $type = returnLineSel();
                        $query = 
                        "SELECT o.name
                        FROM Operator o
                        WHERE NOT EXISTS(
                            SELECT lineCode from TransitLine INNER JOIN Garage on garageName=name WHERE type='".$type."'
                            MINUS
                            SELECT lineCode from hasWorked hw WHERE hw.operatorID = o.ID
                        )";
                        $result = executePlainSQL($query);
                        printOps($result);
                    }

                    function returnLineSel(){
                        switch($_GET['LineTypeFilter']){
                            case('Bus'):
                                return "BUS";
                            case('Metro'):
                                return "METRO";
                            case('RapidBus'):
                                return "RAPIDBUS";
                            case('Rail'):
                                return "RAIL";
                            case('Trolley'):
                                return "TROLLEY";
                            case('SeaBus'):
                                return "SEABUS";
                        }
                    }

                    if(isset($_GET['LineTypeFilter'])){
                        if (connectToDB()) {
                            if (array_key_exists('LineTypeFilter', $_GET)) {
                                operatorsWorkedAllLines();
                            }
            
                            disconnectFromDB();
                        }
                    }
                    ?>
                </div>
                <div style="clear:both"></div>
                <div class= "search-form">
                    <h2>Assign Operator to New Line</h2>
                    <form method="POST" action="operator.php">
                        <input type="hidden" id="operatorRequest" name="operatorRequest">
                        Operator ID: <input type="text" name="operatorID"> <br /><br />
                        Line ID: <input type="text" name="lineID"> <br /><br /> 
                        <input type="submit" name="updateOperator" value="Update"></p>
                    </form>
                    <h2>Delete an Operator</h2>
                    <form method="POST" action="operator.php"> 
                        <input type="hidden" id="deleteRequest" name="deleteRequest">
                        Operator ID: <input type="text" name="id"> <br /><br />

                        <input type="submit" value="Delete" name="deleteSubmit"></p>
                    </form>
                
                    <?php
                    function handleUpdateRequest() {
                        global $db_conn;
                        $operatorID = $_POST["operatorID"];
                        $lineCode = $_POST["lineID"];
                        if(is_numeric($lineCode)){
                            $lineCode = str_pad($lineCode, 3, "0", STR_PAD_LEFT);
                        }
                        $query1 = "SELECT workingline FROM Operator WHERE ID=".$operatorID;
                        $res = executePlainSQL($query1);
                        $res = oci_fetch_row($res);
                        if(!$res){
                            echo "ID not found";
                            return;
                        }
                        $oldLineCode = $res[0];
                        $query2 = "INSERT INTO hasworked (SELECT '".$oldLineCode."', ".$operatorID." FROM dual WHERE NOT EXISTS (SELECT NULL FROM HasWorked WHERE linecode='".$oldLineCode."'AND operatorID=".$operatorID."))";
                        executePlainSQL($query2);
                        $query3 = "UPDATE Operator SET workingLine='".$lineCode."' WHERE ID=".$operatorID;
                        executePlainSQL($query3);
                        OCICommit($db_conn);
                    }

                    function handleDeleteRequest() {
                        $ID = $_POST["id"];
                        executePlainSQL("DELETE FROM Operator WHERE ID=" . $ID);
                        OCICommit($db_conn);
                    }

                    if(isset($_POST['updateOperator']) || isset($_POST['deleteSubmit'])) {
                        if (connectToDB()) {
                            if (array_key_exists('operatorRequest', $_POST)) {
                                handleUpdateRequest();
                            } else if (array_key_exists('deleteRequest', $_POST)) {
                                handleDeleteRequest();
                            }
                            OCICommit($db_conn);
                            disconnectFromDB();
                            ?>
                            <script type="text/javascript">
                                window.location = "operator.php";
                            </script>
                            <?php
                        }
                        
                    }
                    header("Location: operator.php");
                    die();
                    ?> 
                </div>
            </div>
        </div>
	</body>
</html>
