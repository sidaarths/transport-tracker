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
                <h2>Login</h2>
                <form method="GET">
                    <input type="hidden" id="login" name="login">
                    email: <input type="text" name="email"> <br /><br />
                    password: <input type="password" name="password"> <br /><br />
                    <input type="submit" name="Login" value="Login"></p>

                </form>
                <h4>Create an Account</h4>
                <!-- <form method="POST">
                    <input type="hidden" id="createAcc" name="createAcc">
                    <input type="submit" name="createAccount" value="I don't have an account"></p>
                </form> -->
                <a href="create_acc.php"><input type="submit" value="I don't have an account" /></a>
            </div>
        </div>
    </div>
        <?php
        include '../resources/login_info.php';
        include 'functions.php';

        function determineSuccess($statement) {
            $count = 0;
            $result = array();
            while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
                $result[] = $row;
                $count = $count +1;
            }

            if($count == 0){
                echo "Account not found, try again";
                return false;
            }
            if($count > 1){
                echo "SYSTEM ERROR";
                return false;
            }
            $result_row = $result[0];
            $id = $result_row["ID"];
            setcookie("user_id", $id);
            return true;
        }

        function loginRequest() {
            $email = $_GET["email"];
            $password = $_GET["password"];
            if(empty($password)){
                echo "password invalid";
                return;
            }
            $query = "SELECT * FROM Account WHERE email='". $email ."'";
            $result = executePlainSQL($query);
            if(determineSuccess($result)){
                header("Location: user.php");
            }
        }

        function createAccount(){
            header("Location: create_acc.php");
        }

        if (isset($_GET['login'])) {
            if(connectToDB()){
                if(array_key_exists('login', $_GET)){
                    loginRequest();
                }
                disconnectFromDB();
            }
        } else if (isset($_POST['createAcc'])) {
            createAccount();
        }
		?>
	</body>
</html>
