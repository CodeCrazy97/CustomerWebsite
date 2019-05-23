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
            $prepSQL = $dbh->prepare("insert into customers (customerName, contactLastName, contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, country) values (:cname, :lname, :fname, :pnum, :addr1, :addr2, :city, :state, :pcode, :country);");

            // bind the data to the placeholders
            $cname = $_POST["cname"];
            $prepSQL->bindParam(':cname', $cname);
            $lname = $_POST["lname"];
            $prepSQL->bindParam(':lname', $lname);
            $fname = $_POST["fname"];
            $prepSQL->bindParam(':fname', $fname);
            $pnum = $_POST["pnum"];
            $prepSQL->bindParam(':pnum', $pnum);
            $addr1 = $_POST["addr1"];
            $prepSQL->bindParam(':addr1', $addr1);
            $addr2 = $_POST["addr2"];
            $prepSQL->bindParam(':addr2', $addr2);
            $city = $_POST["city"];
            $prepSQL->bindParam(':city', $city);
            $state = $_POST["state"];
            $prepSQL->bindParam(':state', $state);
            $pcode = $_POST["pcode"];
            $prepSQL->bindParam(':pcode', $pcode);
            $country = $_POST["country"];
            $prepSQL->bindParam(':country', $country);

            // execute SQL statement
            $prepSQL->execute();
            
            // execute the SQL statement
            $return = $prepSQL->execute();

            // check if the insert succeeded
            if ($return == TRUE) {
                print("<br>Customer addition was successful.<br>");
            } else {
                print("<br>Customer creation failed.<br>");
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