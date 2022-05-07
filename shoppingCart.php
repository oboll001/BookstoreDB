<html>
	<head>
        <title>Books Worldwide</title>
        <link rel="stylesheet" href="mainstyle.css">
    </head>
    <body>
        <table class="TopTable">
            <tr>
            <th><h1>Shopping Cart</h1></th>
            <th>
                <?php 
				//Has header to swithch to different things
                session_start();	
                include("connectiondb.php");
                $cN = $_SESSION['emailOF'];
                $cNP = $_SESSION['passwordOF'];

                $sql = "SELECT * FROM Customers c, Contact_Details f, Email z WHERE 
	                c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$cNP' AND z.EmailAddress = '$cN'";

	            $result = mysqli_query($conn, $sql);

  	            if ($row = mysqli_fetch_assoc($result)) {
                    echo "Welcome, {$row['FirstName']}";
  	            }
                ?>
            </th>

            <th><p><a href="cPage.php">Your Account</a> </p></th>
			<th><p><a href ="mainpage.php">Home Page</a> </p></th>
			
            </tr>
        </table>
		<table class = "YourOrders">
		<tr>
		<th>In the Shopping cart</th>
		</tr>
		</table>
		<table class ="CartItem">
		<?php
		$curOrder = "SELECT * FROM orders o, order_items i, Customers c, Email e, books b
		WHERE c.ContactID = e.ContactID AND e.EmailAddress = '$cN' AND o.CustomerID = c.CustomerID
		AND o.OrderID = i.OrderID AND i.ISBN = b.ISBN";
		$query = $result = mysqli_query($conn, $curOrder);
		$count = mysqli_num_rows($query);
		if($count == 0){
			print("Shopping Cart Empty");
		}else {
			echo "<table>";
			echo"<tr><th>Books</th><th>Price</th></tr>";
			$sum = 0;
			while($row = mysqli_fetch_array($query)){
			echo"<tr><td>{$row['Title']}</td><td>{$row['ItemPrice']}</td></tr>";
			$sum = $row['OrderValue'];
			}
			
			
			echo "<tr><td>Your Total= </td><td>$$sum</td></tr>";
			echo"</table>";
		}
		
		?>
		
		
		</table>
		<form method="POST" >
            <div class="input-group">
		        <button type="submit" class="btn" name="order" > Order Now </button>
	        </div>
    </form>
	<?php
	
	if(isset($_POST['order'])){
		$date = date('Y-m-d');
		
		$query = mysqli_query($conn, "SELECT OrderID, OrderValue FROM Orders ORDER BY OrderID DESC LIMIT 1");
		$result = mysqli_fetch_array($query);
		$oID = $result[0];
		
		$query3 = mysqli_query($conn, "UPDATE Orders SET OrderDate ='$date' WHERE OrderID = '$oID'");
		
		$sql = "SELECT * FROM Customers c, Contact_Details f, Email z WHERE 
	                c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$cNP' AND z.EmailAddress = '$cN'";

	    $result = mysqli_query($conn, $sql);

		if ($row = mysqli_fetch_assoc($result)) {
            $idC = $row['CustomerID'];
  	     }
		$sql = "INSERT INTO Orders(OrderID, OrderValue, OrderDate, CustomerID) VALUES(NULL, 0.00, NULL, $idC)";
		mysqli_query($conn, $sql);
		echo "Your Items Are on your way!";	
	}
	?>
    </body>
</html>