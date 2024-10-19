<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
   
            $_SESSION['email'] = $email;
            header("Location: Home page\index.html");
            exit();
        } else {
            $_SESSION['email'] = $email;
            header("Location: Home page\index.html");
            exit();

            echo "<script>alert('Invalid password.'); window.history.back();</script>";
            exit();
        }
    } else {
        echo "<script>alert('No user found with that email.'); window.history.back();</script>";
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
