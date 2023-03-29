<?php
    if(!isset($_COOKIE['user_id'])){
        header("Location: login.php");
    }
?>
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
            margin: 1% 1% 1% 1%;
            padding-top: 5px;
            padding-right: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
        }
        td {
            padding: 0 10px;
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
            <div>
                <?php
                // ONLY CALL IMPORTS ONCE PER PHP PAGE... I FOUND THIS OUT THE HARD WAY
                include "functions.php";
                include "../resources/login_info.php";
                // ---------------------------------------------------------------------
                connectToDB();
                $userID = $_COOKIE["user_id"];
                $query1 = "SELECT name FROM Account WHERE ID=".$userID;
                $res = executePlainSQL($query1);
                $name = oci_fetch_row($res);
                disconnectFromDB();
                echo "<h2> Hello ".$name[0]."!</h2></br>";
                ?>
            </div>
            <div style="float: left;margin-right:10%;">
                <?php
                
                connectToDB();
                $userID = $_COOKIE["user_id"];
                $query2 = "SELECT * FROM Visited INNER JOIN Stop on stopnum=num WHERE accountID=".$userID;
                $res2 = executePlainSQL($query2);
                echo "<div style=\"text-aline:center\" > <h3 style=\"text-aline:center\"> Visited Stops </h3> </div>";
                echo "<div><table>";
                echo "<tr><th>Stop Name</th><th>Stop Num</th><th>Date Visited</th></tr>";
                while ($row = OCI_Fetch_Array($res2, OCI_BOTH)) {
                    $stopNum = $row["STOPNUM"];
                    $stopLink = "stop.php?getStopInfoReq=&stopCode=".$stopNum."&Search+For+Stop=Search+for+Stop";
                    echo "<tr><td>".$row['NAME'].  "</td><td><a href=".$stopLink.">".$stopNum."</a></td><td>  ".$row["VISITEDDATE"]."</td></tr>";
                }
                echo "</table></div>";
                disconnectFromDB();
                ?>
            </div>
            <div style="float: left">
                <?php
                connectToDB();
                $userID = $_COOKIE["user_id"];
                $query = "SELECT * FROM BusCard WHERE ID=".$userID;
                $res = executePlainSQL($query);
                echo "<div style=\"text-aline:center\" > <h3 style=\"text-aline:center\"> Bus Cards </h3> </div>";
                echo "<div><table>";
                echo "<tr><th>Card Number</th><th>Card Type</th><th>Card Balance</th></tr>";
                while ($row = OCI_Fetch_Array($res, OCI_BOTH)) {
                    echo "<tr><th>".$row['CARDNUM']."</th><th>".$row["CARDTYPE"]."</th><th> $".number_format((float)$row["BALANCE"], 2, '.', '')."</th></tr>";
                }
                echo "</table></div>";
                disconnectFromDB();
                ?>
            </div>
            <div style="clear:both"> </div>
            <div class = "search-form" style="float: left;margin-right:10%;">
            </br>
                <h2>Find Avid Transit Riders!</h2>
                <p>Find riders who have visited every stop with similar names</p>
                <form method="GET">
                    <input type="hidden" id="stopNameIncludes" name="stopNameIncludes"></br>
                    <h4>Stop Name Includes</h4>
                    <input type="text" name="stopNameIncludes" style="float:left;margin-right:2%">
                    <input type="submit" name="Search For Line" value="Search for users"></p>
                    </br>
                </form>
                <?php

                function printUsers($statement){
                    $count = 0;
                    $result = array();
                    while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
                        $result[] = $row;
                        $count = $count +1;
                    }
                    // echo "results";
                    if($count == 0){
                        echo "No Users have visited all stops in one day... You can be the first!";
                        return;
                    }
                    echo "<div><table>";
                    echo "<tr><th>Users</th><th>Date</th></tr>";
                    foreach ($result as $result_row) {
                        echo "<tr><td>" . $result_row["NAME"] . "</td><td>" . $result_row["VISITEDDATE"] . "</td></tr>";
                    }
        
                    echo "</table></div>";
                }

                function getUsersRequest(){
                    $stopNameIncludes = strtoupper($_GET["stopNameIncludes"]);
                    $query = 
                    "SELECT name, visitedDate
                    FROM (SELECT ID, visitedDate
                    FROM Account INNER JOIN Visited on ID = accountID INNER JOIN Stop on stopNum=num    
                    WHERE UPPER(Stop.name) LIKE '%".$stopNameIncludes."%'
                    GROUP BY ID, visitedDate
                    HAVING COUNT(*) = (SELECT COUNT(*) FROM Stop WHERE UPPER(name) LIKE '%".$stopNameIncludes."%')) NATURAL INNER JOIN Account
                    ORDER BY visitedDate ASC";
                    $result = executePlainSQL($query);
                    printUsers($result);
                }

                if(isset($_GET['stopNameIncludes'])){
                    if (connectToDB()) {
                        if (array_key_exists('stopNameIncludes', $_GET)) {
                            getUsersRequest();
                        }
        
                        disconnectFromDB();
                    }
                }
                ?>
            </div>
        </div>
    </div>
	</body>
</html>