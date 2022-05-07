<html>
	<head>
        <title>Welcome!</title>
        <link rel="stylesheet" href="stylinglog.css">
    </head>
    <body>
        <div class="header">
	        <h2>Register</h2>
        </div>
    
        <form action="submit.php" method="POST">
            <table>
                <tr>
                    <td>First Name</td>
                    <td><input type ="text" name ="firstname" required></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type ="text" name ="lastname" required></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type ="text" name ="address" required></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><input type ="text" name ="phone" required></td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td><input type ="text" name ="email" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type ="text" name ="password" required></td>
                </tr>
                <tr>
                    <td>Admin?</td>
                    <td><input type ="checkbox" name ="ifadmin" value ="true"> Check this box if you are an Admin.</td>
                </tr>
                <tr>
                <td><input type="submit" value="Submit"></td>
                </tr>
            </table>
            <p>
                Already a member? <a href="login.php"> Sign in </a>
            </p>

        </form>
    
    </body>
</html>

