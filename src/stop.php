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
                width: 50%;
                margin: 0% 0% 0% 0%;
                padding-top: 5px;
                padding-right: 5px;
                padding-bottom: 15px;
                padding-left: 5px;
            }
            td {
                padding: 0 15px;
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
        <div class = "search-form">
            <h2>Find all Lines at Stop</h2>
            <form method="GET">
                <input type="hidden" id="getStopInfoReq" name="getStopInfoReq">
                Stop: <input type="text" name="stopCode"> <br /><br />
                <input type="submit" name="Search For Stop" value="Search for Stop"></p>
            </form>
        </div>
    </div>

    <?php
        include '../resources/login_info.php';
        include 'functions.php';

        function getStopInfoRequest(){
            $stopCode = $_GET["stopCode"];
            if(!is_numeric($stopCode)){
                echo "<br> Stop ".$stopCode. " is invalid</br>";
                return;
            }
            $query = "SELECT * FROM stop WHERE num=". $stopCode ."";
            $result = executePlainSQL($query);
            printStopInfo($result, $stopCode);
            getAllLinesFromStop($stopCode);
           
        }

        function printStopInfo($statement, $stopCode){
            $count = 0;
            $result = array();
            while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
                $result[] = $row;
                $count = $count +1;
            }
            if($count == 0){
                echo "Stop " .$stopCode. " Not Found";
                return;
            }
            echo "<div> <h2> Showing Results For Stop: ". $stopCode . "</h2></div>";
            echo "<div><table>";
            echo "<tr><th>Stop Num</th><th> Stop Name</th><th>Latitude</th><th>Longitude</th></tr>";
            foreach ($result as $result_row) {
                echo "<tr><td>" . $result_row["NUM"] . "</td><td>" . $result_row["NAME"] . "</td><td>" . number_format((float)$result_row["LAT"], 5, '.', ''). "</td><td>" . number_format((float)$result_row["LON"], 5, '.', '') . "</td>";
            }
            echo "</table></div>";
        }

        function getAllLinesFromStop($stopCode){
            if(!is_numeric($stopCode)){
                echo "<br> Stop ".$stopCode. " is invalid</br>";
                return;
            }
            $query = "SELECT linecode, linename, frequency 
            FROM (((TransitLine NATURAL INNER JOIN Linestops) 
            INNER JOIN Garage ON TransitLine.garagename=Garage.name) 
            INNER JOIN VehicleType ON garage.type=vehicletype.type) 
            WHERE LineStops.stopNum=". $stopCode . "";
            $result = executePlainSQL($query);
            printAllLinesAtStopResult($result, $stopCode);
        }

        function printAllLinesAtStopResult($statement, $stopCode) {
            $count = 0;
            $result = array();
            while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
                $result[] = $row;
                $count = $count +1;
            }

            if($count == 0){
                return;
            }
            echo "<div> <h2> Serviced Lines </h2></div>";
            echo "<div><table>";
            echo "<tr><th>Line Code</th><th>Line Name</th><th>Frequency</th></tr>";
            foreach ($result as $result_row) {
                $freq = intval($result_row["FREQUENCY"]) + 1;
                $lineCode = $result_row["LINECODE"];
                $lineURL = "line.php?lineRequest=&lineCode=".$lineCode."&Search+For+Line=Search+for+Line";
                echo "<tr><td><a href=".$lineURL.">".$lineCode."</a></td><td>" . $result_row["LINENAME"] . "</td><td>" . $freq . " > min</td></tr>";
            }

            echo "</table></div>";
        }

        if(isset($_GET['getStopInfoReq'])){
            if (connectToDB()) {
                if (array_key_exists('getStopInfoReq', $_GET)){
                    getStopInfoRequest();
                }
                disconnectFromDB();
            }
        }
		?>
	</body>
</html>
