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
                <div class = "search-form" style="clear:both">
                    </br>
                    <h2>Operator History</h2>
                    <form method="GET">
                        <input type="hidden" id="operatorName" name="operatorName"></br>
                        <h4>Operator ID</h4>
                        <input type="text" name="opID" style="float:left;margin-right:2%">
                        <input type="submit" name="operatorName" value="Search for operator"></p>
                        </br>
                    </form>
                    <?php
                    include '../resources/login_info.php';
                    include 'functions.php';
                    function printOperators($statement){
                        $count = 0;
                        $result = array();
                        while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
                            $result[] = $row;
                            $count = $count +1;
                        }
                        // echo "results";
                        if($count == 0){
                            echo "No operator match found";
                            return;
                        }
                        echo "<div><table>";
                        echo "<tr><th>Line Code</th><th>Line Name</th><th>Garage</th></tr>";
                        foreach ($result as $result_row) {
                            echo "<tr><td>" . $result_row["LINECODE"] . "</td><td>" . $result_row["LINENAME"] . "</td><td>" . $result_row["GARAGENAME"] . "</td></tr>";
                        }
            
                        echo "</table></div>";
                    }

                    function getOperatorReq(){
                        $opID = $_GET["opID"];
                        $query = 
                        "SELECT Transitline.lineName, Transitline.lineCode, TransitLine.garageName
                        FROM Operator INNER JOIN HasWorked on ID=operatorID INNER JOIN TransitLine on HasWorked.Linecode=Transitline.Linecode
                        WHERE Operator.ID = ".$opID;
                        $result = executePlainSQL($query);
                        printOperators($result);
                    }

                    if(isset($_GET['operatorName'])){
                        if (connectToDB()) {
                            if (array_key_exists('opID', $_GET)) {
                                getOperatorReq();
                            }
            
                            disconnectFromDB();
                        }
                    }
                    ?>
                    
                </div>
                <div class = "search-form" style="clear:both">
                    </br>
                    <h2>Lines Worked Statistics</h2>
                    <form method="GET">
                        <input type="hidden" id="getStats" name="getStats"></br>
                        <input type="submit" name="getStats" value="Search for stats"></p>
                        </br>
                    </form>
                    <?php
                    function printTotalWorkedLines($statement){
                        $count = 0;
                        $result = array();
                        while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
                            $result[] = $row;
                            $count = $count +1;
                        }
                        // echo "results";
                        echo "<div><table>";
                        echo "<tr><th>Operator ID</th><th>Lines Worked</th></tr>";
                        foreach ($result as $result_row) {
                            echo "<tr><td>" . $result_row["ID"] . "</td><td>" . $result_row["COUNT(*)"] ."</td></tr>";
                        }
            
                        echo "</table></div>";
                    }

                    function getTotalWorkedLines(){
                        $opID = $_GET["opID"];
                        $query = 
                        "SELECT id, COUNT(*) FROM operator INNER JOIN hasworked ON ID=operatorID GROUP BY id ORDER BY id ASC";
                        $result = executePlainSQL($query);
                        printTotalWorkedLines($result);
                    }

                    if(isset($_GET['getStats'])){
                        if (connectToDB()) {
                            getTotalWorkedLines();
                            disconnectFromDB();
                        }
                    }
                    ?>
                    
                </div>
            </div>
        </div>
	</body>
</html>
