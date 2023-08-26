<?php
include("config.php");

session_start();

$action = $_POST['action'];

if ($action === 'register') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('sss', $username, $email, $password);

    if ($stmt->execute()) {
        echo 'Success';
    } else {
        echo 'Error';
    }
} elseif ($action === 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        echo 'sucess';
    } else {
        echo 'error';
    }
}
?>