<?php
include "db.php";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";

    if (mysqli_query($conn, $sql)) {
        $id = mysqli_insert_id($conn);
        header("Location: quiz.php?id=$id");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
    <h1>Online Mock Test</h1>

    <form method="POST">
        <input type="text" name="name" placeholder="Enter your name" required>

        <input type="email" name="email" placeholder="Enter your email" required>

        <button type="submit" name="register">Start Quiz</button>
    </form>
</div>

</body>
</html>