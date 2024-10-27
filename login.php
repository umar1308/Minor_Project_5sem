<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            // Database connection
            $conn = new mysqli('localhost', 'root', 'root123', 'user');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        
            $sql = "SELECT * FROM credentials WHERE name='$username'";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($password==$row['password']) {
                    $_SESSION['username'] = $username;
                    header("Location: dashboard.html");
                    exit();
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "No user found with that username.";
            }
        
            $conn->close();
        }
        ?>
    ?>
</body>
</html>