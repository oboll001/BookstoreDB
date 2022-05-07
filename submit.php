<?php
if(isset($_POST['firstname'])){
    $fname = $_POST['firstname'];
}
if(isset($_POST['lastname'])){
    $lname = $_POST['lastname'];
}
if(isset($_POST['address'])){
    $caddress = $_POST['address'];
}
if(isset($_POST['phone'])){
    $phone = $_POST['phone'];
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
if(isset($_POST['password'])){
    $password = $_POST['password'];
}
if(isset($_POST['ifadmin'])){
    $admin = 1;
}else{
    $admin = 0;
}

if (!empty($fname) || !empty($lname) || !empty($caddress) || !empty($phone) || !empty($email) || !empty($password) || !empty($admin)){
	include("connectiondb.php");

    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
    }

    $sql = "INSERT INTO Contact_Details(ContactID) VALUES(NULL);";
    mysqli_query($conn, $sql);

    $SELECT = "SELECT ContactID FROM Contact_Details ORDER BY ContactID DESC LIMIT 1";
    $query = mysqli_query($conn, $SELECT);
    $result = mysqli_fetch_array($query);
    $ContactID = $result[0];

    $null = NULL;
    $INSERT = "INSERT INTO Customers(CustomerID, FirstName, LastName, ContactID, CPassword, IfAdmin) VALUES(?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("bssisi", $null, $fname, $lname, $ContactID, $password, $admin);
    $stmt->execute();

    $INSERT = "INSERT INTO Email(EmailAddress, ContactID) VALUES(?, ?)";
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("si", $email, $ContactID);
    $stmt->execute();

    $INSERT = "INSERT INTO CAddress(PhysicalAddress, ContactID) VALUES(?, ?)";
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("si", $caddress, $ContactID);
    $stmt->execute();

    $INSERT = "INSERT INTO Phone(PhoneNumber, ContactID) VALUES(?, ?)";
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("ii", $phone, $ContactID);
    $stmt->execute();

    header("location: mainpage.php");
}


    
    ?>