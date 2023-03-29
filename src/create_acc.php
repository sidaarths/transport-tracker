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
                <h2>Create an Account</h2>
                <form method="POST">
                    <input type="hidden" id="info" name="info">
                    email: <input type="text" name="email"> <br /><br />
                    name:  <input type="text" name="name"> <br /><br />
                    password: <input type="password" name="password"> <br/><br/>
                    <input type="submit" name="createAcc" value="Create Account"></p>
                </form>
            </div>
        </div>
    </div>
        <?php
        include "functions.php";
        include "../resources/login_info.php";

        function createAccount() {
            $email = $_POST["email"];
            $name = $_POST["name"];
            $query = "INSERT INTO Account VALUES(add_account_id.NEXTVAL,'".$email."', '".$name."')";
            executePlainSQL($query);
            // OCICommit($db_conn);
            echo "Account Created! <a href=\"login.php\"><input type=\"submit\" value=\"Login\"></a>";
        }

        if (isset($_POST['info'])) {
            if(connectToDB()){
                if(array_key_exists('email', $_POST) && array_key_exists('name', $_POST)){
                    createAccount();
                    OCI_Commit($db_conn);
                } else {
                    echo "Please input email and name";
                }
                disconnectFromDB();
            }
        }
		?>
	</body>
</html>