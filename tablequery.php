<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        <title>Contacts</title>
        <link rel="stylesheet" type="text/css" href="cmstyles.css">
    </head>
    <body>
        <header>
            <img img src="modelcars.jpg" style="float:right;width:75px;height:75px;">
            <h3 class="title">Classic Models</h3>
        </header>
        <nav>
            <h2>Links</h2>
            <h4><a href="test2.html">Classic Models Home</a></h4>
            <h4><a href="addcustomer.html">Add a new Customer</a></h4>
            <h4><a href="deletecustomer.html">Delete a Customer</a></h4>             
            <h4><a href="tablequery.php">Find Contact Information</a></h4>
            <h4><a href="ordersquery.html">Display Orders</a></h4>   
            
        </nav>
        <main>
            <h2>Contact Information Page</h2>
            <br>
            <br>
            <h4>
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
                    $prepSQL = $dbh->prepare("select city, phone, addressLine1 from offices order by city asc;");

                    // execute SQL statement
                    $prepSQL->execute();

                    // fetch results
                    // print results one row at a time
                    // fetch() method returns one row of results at a time until none are left and then it returns FALSE
                    // FETCH_ASSOC says "fetch into an associative array"
                    print("<table align=\"center\">");
                    print("<tr>");
                    print("<th>City</th>");
                    print("<th>Phone</th>");
                    print("<th>Address</th></tr>");

                    while ($results = $prepSQL->fetch(PDO::FETCH_ASSOC)) {
                        print("<tr>");
                        print("<td>$results[city]</td>");
                        print("<td>$results[phone]</td>");
                        print("<td>$results[addressLine1]</td>");
                        print("</tr>");
                    }
                    print("</table>");

                    // close database connection
                    $dbh = null;

                } catch (PDOException $e) {
                    printf("Connection creation failed: %s", $e->getMessage());
                }




                ?>
                <br>
                <br>
                
            </h4>
        </main>
        <footer>
            <br>
            <br>
            <br>
            <br>
            Ethan Vaughan
            <br>
            Test 2 Take-Home
            <br>
            April 10, 2018
        </footer>
    </body>
</html>


