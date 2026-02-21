<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lismoredb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to validate username
function validate_username($username) {
    if (strlen($username) < 5 || strlen($username) > 20) {
        return "Username must be between 5 and 20 characters.";
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        return "Username can only contain letters and numbers.";
    }
    return "";
}

// Function to validate password
function validate_password($password) {
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    } elseif (!preg_match("/[A-Z]/", $password)) {
        return "Password must contain at least one uppercase letter.";
    } elseif (!preg_match("/[a-z]/", $password)) {
        return "Password must contain at least one lowercase letter.";
    } elseif (!preg_match("/[0-9]/", $password)) {
        return "Password must contain at least one number.";
    } elseif (!preg_match("/[\W]/", $password)) {
        return "Password must contain at least one special character.";
    }
    return "";
}

// Check if the form is submitted using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminName = test_input($_POST["adminName"]);
    $password = test_input($_POST["password"]);

    // Validate username and password
    $username_error = validate_username($adminName);
    $password_error = validate_password($password);

    // encrypting the password
    if (empty($username_error) && empty($password_error)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO admin_login (admin_name, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $adminName, $hashed_password);
        $stmt->execute();
        $stmt->close();

        echo "Registration successful!";
    } else {
        echo $username_error . "<br>" . $password_error;
    }
}

$conn->close();
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
                <a class="navbar-title position-absolute top-50 start-50 translate-middle" href="register.php">
                    Admin Register</a>
            </div>
        </nav>
    </header>
    <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="adminName">Username:</label>
        <input type="text" id="adminName" class="form-control" name="adminName" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" class="form-control" name="password" required>
        <br>
        <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
    </form>
</body>
</html>
