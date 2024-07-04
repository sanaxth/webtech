<?php
session_start();
include('connection.php');

if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM login WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows == 1){  
        $_SESSION['user'] = $username;
        header("Location: welcome.php");
        exit();
    }  
    else{  
        echo '<script>
            alert("Login failed. Invalid username or password!");
            window.location.href = "index.php";
        </script>';
    }     
}
?>