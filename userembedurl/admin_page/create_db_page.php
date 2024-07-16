<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Database for Client</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            text-align: center;
            margin-top: 50px;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 70%;
            margin-right: 10px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .popup.active {
            display: block;
        }
        .popup button {
            margin-top: 10px;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .overlay.active {
            display: block;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Create Database for User</h1>
    <form method="post">
        <input type="text" name="user_name" placeholder="Enter user name" required>
        <button type="submit">Create Database for User</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userName = $_POST['user_name'];

        $databaseName = strtolower(str_replace(' ', '_', $userName));

        $servername = "localhost";
        $username = "root";
        $password = "*"; 

        $conn = new mysqli($servername, $username, $password);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "CREATE DATABASE IF NOT EXISTS `$databaseName`";
        if ($conn->query($sql) === TRUE) {
            echo "<script>showPopup('Database \"$databaseName\" created successfully.');</script>";  
        } 
        else {
            echo "<script>showPopup('Error creating database: " . addslashes($conn->error) . "');</script>";
        }

        // Close connection
        $conn->close();
    }
    ?>
</div>

<div class="overlay"></div>
<div class="popup">
    <p id="popup-message"></p>
    <button onclick="hidePopup()">OK</button>
</div>

<script>
    function showPopup(message) {
        document.getElementById('popup-message').innerText = message;
        document.querySelector('.popup').classList.add('active');
        document.querySelector('.overlay').classList.add('active');
    }

    function hidePopup() {
        document.querySelector('.popup').classList.remove('active');
        document.querySelector('.overlay').classList.remove('active');
    }
</script>
</body>
</html>

