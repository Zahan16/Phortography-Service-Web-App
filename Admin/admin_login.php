<?php
// Start the session to handle user login sessions
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lismoredb";

// Initialize variables for form data and error messages
$adminName = $pswd = "";
$nameErr = $pswdErr = "";

// Check if the form is submitted using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input data
    if (empty($_POST["adminName"])) {
        $nameErr = "Name is required";
    } else {
        $adminName = test_input($_POST["adminName"]);
    }

    if (empty($_POST["password"])) {
        $pswdErr = "Password is required";
    } else {
        $pswd = test_input($_POST["password"]);
    }

    // Proceed to connect to the database only if no errors
    if (empty($nameErr) && empty($pswdErr)) {
        // Create a connection to the MySQL database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection, and terminate the script if it fails
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind a statement to select the admin record
        $stmt = $conn->prepare("SELECT admin_id, admin_name, password FROM 
        admin_login WHERE admin_name = ?");
        $stmt->bind_param("s", $adminName);

        // Execute the query
        $stmt->execute();

        // Bind result variables
        $stmt->bind_result($id, $username, $hashed_password);

        // Fetch the results
        if ($stmt->fetch()) {
            // Verify the password against the hashed password in the database
            if (password_verify($pswd, $hashed_password)) {
                // Start a new session and store user information
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;

                // Redirect to the admin page
                header("Location: admin.html");
                exit();
            } else {
                // Display an error if the password is incorrect
                echo "Invalid username or password.";
            }
        } else {
            // Display an error if the username is not found
            echo "Invalid username or password.";
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../Common/CSS/main.css">
    <link rel="stylesheet" href="CSS\admn_lgin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> 
</head>
<body>
<header>
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">Malcolm Lismore Photography</a>
                <a class="navbar-title position-absolute top-50 start-50 translate-middle" href="admin_login.php">
                    Admin Login</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="hero text-center">
            <div class="container">
                <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <h1 class="h3 mb-3 font-weight-normal">Welcome..!!!</h1>
                    <input type="text" name="adminName" class="form-control" placeholder="User name" required="" 
                    autofocus="" value="<?php echo $adminName;?>">
                    <span class="error"><?php echo $nameErr;?></span>
                    <br>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="" 
                    value="<?php echo $pswd;?>">
                    <span class="error"><?php echo $pswdErr;?></span>
                    <br>
                    <button class="btn btn-primary w-100 py-2" type="submit">Log in</button>
                </form>    
            </div>
        </section>
    </main>
</body>
</html>
