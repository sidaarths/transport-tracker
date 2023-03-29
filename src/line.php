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
            <div class = "search-form">
                <h2>Find Line Information</h2>
                <form method="GET">
                    <input type="hidden" id="lineRequest" name="lineRequest">
                    Line: <input type="text" name="lineCode"> <br /><br />
                    <input type="submit" name="Search For Line" value="Search for Line"></p>
                </form>
            </div>
        </div>
    </div>
        <?php
        include '../resources/login_info.php';
        include 'functions.php';

        function printLineResult($statement, $lineCode) {
            $count = 0;
            $result = array();
            while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
                $result[] = $row;
                $count = $count +1;
            }

            if($count == 0){
                echo "Line " .$lineCode. " Not Found";
                return;
            }
            echo "<div> <h2> Showing Results For Line: ". $lineCode . "</h2></div>";
            echo "<div><table>";
            echo "<tr><th>Line Code</th><th>Stop Name</th><th>Stop ID</th></tr>";
            foreach ($result as $result_row) {
                $stopNum = $result_row["STOPNUM"];
                $stopLink = "stop.php?getStopInfoReq=&stopCode=".$stopNum."&Search+For+Stop=Search+for+Stop";
                echo "<tr><td>" . $result_row["LINECODE"] . "</td><td>" . $result_row["NAME"] . "</td><td><a href=".$stopLink.">".$stopNum."</a></td></tr>";
            }

            echo "</table></div>";
        }

        function getLineRequest() {
            $lineCode = $_GET["lineCode"];
            if(is_numeric($lineCode)){
                $lineCode = str_pad($lineCode, 3, "0", STR_PAD_LEFT);
            }
            $query = "SELECT linecode,name,stopnum FROM LineStops LS, Stop S WHERE lineCode='". $lineCode ."' AND LS.stopnum = s.num ORDER BY stopOrder ASC";
            $result = executePlainSQL($query);
            printLineResult($result, $lineCode);
        }

        if(isset($_GET['lineRequest'])){
            if (connectToDB()) {
                if (array_key_exists('lineRequest', $_GET)) {
                    getLineRequest();
                }

                disconnectFromDB();
            }
        }
		?>
	</body>
</html>
