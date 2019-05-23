<html>
    <head>
        <title>Customer Addition</title>
        <style>
            body {
                font-family: sans-serif;
                text-align: center;
                background-color: gainsboro;
            }
        </style>

    </head>

    <body>

        <br>
        <br>
            
        <?php
        try {
            // setup our connection information
            $server = "localhost";
            $username = "root";
            $password = "";  // no password
            $db = "classicmodels";  // database name

            // create a connection object
            $dbh = new PDO("mysql:host=$server;dbname=$db", $username, $password);

            // set error mode of connection object (if an exception is to be thrown, then the below line will cause it)
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare SQL select statement
            $prepSQL = $dbh->prepare("delete from customers where customerNumber = :custNum;");

            // bind the data to the placeholders
            $custNum = $_POST["custNum"];
            $prepSQL->bindParam(':custNum', $custNum);
                        
            // execute SQL statement
            $prepSQL->execute();
            
            // execute the SQL statement
            $return = $prepSQL->execute();

            // check if the insert succeeded
            if ($return == TRUE) {
                print("<br>Customer deletion was successful.<br>");
            } else {
                print("<br>Customer deletion failed.<br>");
            }
            // close database connection
            $dbh = null;

        } catch (PDOException $e) {
            printf("Connection creation failed: %s", $e->getMessage());
        }



        ?>
        <br>
        <br>
        <a href="test2.html">Back to Home</a>
        
    </body>


</html>