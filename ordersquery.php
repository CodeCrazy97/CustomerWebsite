<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        <title>Order Results</title>
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
            <h2>Orders Results</h2>
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
                    $prepSQL = $dbh->prepare("select orderNumber, quantityOrdered, priceEach, round(quantityOrdered*priceEach, 2) as 'total' from orderdetails where productCode = :productCode;");
                    
                    // bind the data to the placeholders
                    $productCode = $_POST["productCode"];
                    $prepSQL->bindParam(':productCode', $productCode);
                    
                    // execute SQL statement
                    $prepSQL->execute();
                    print("<h4 style=\"text-align:center\">Product Code Entered: $_POST[productCode]</h4>");
                    print("<table align=\"center\">");
                    print("<tr>");
                    print("<th>Order Number</th>");
                    print("<th>Quantity</th>");
                    print("<th>Price Each ($)</th>");
                    print("<th>Total Sales ($)</th></tr>");
                    
                    while ($results = $prepSQL->fetch(PDO::FETCH_ASSOC)) {
                        print("<tr>");
                        print("<td>$results[orderNumber]</td>");
                        print("<td>$results[quantityOrdered]</td>");
                        print("<td>$results[priceEach]</td>");
                        print("<td>$results[total]</td>");
                        print("</tr>");
                    }
                    print("</table>");
                    
                    
                    $dbh2 = new PDO("mysql:host=$server;dbname=$db", $username, $password);

                    
                    // now fetch the grand total
                    $prepSQL2 = $dbh2->prepare("select round(sum(quantityOrdered*priceEach), 2) as 'grandTotal' from orderdetails where productCode = :productCode2 limit 1;");
                    
                    $results = $prepSQL2->fetch(PDO::FETCH_ASSOC);
                    
                    // bind the data to the placeholders
                    $productCode2 = $_POST["productCode"];
                    $prepSQL2->bindParam(':productCode2', $productCode2);
                    
                    $prepSQL2->execute();
                    while ($results = $prepSQL2->fetch(PDO::FETCH_ASSOC)) {
                        print("<h4 style=\"text-align:center\">Grand Total sales: $$results[grandTotal]</h4>");
                    }
                    
                    // close database connections
                    $dbh = null;
                    $dbh2 = null;

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


