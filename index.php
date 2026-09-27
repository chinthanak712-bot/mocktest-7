<?php

session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);

    if ($name == "" || $email == "") {
        $error = "Please fill all fields.";
    } else {

        $stmt = $conn->prepare(
            "INSERT INTO users (name, email) VALUES (?, ?)"
        );

        $stmt->bind_param("ss", $name, $email);

        if ($stmt->execute()) {

            $_SESSION["user_id"] = $conn->insert_id;
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;

            header("Location: quiz.php");
            exit();

        } else {

            $error = "Registration failed.";

        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mock Test - Registration</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>Mock Test</h1>

    <p class="subtitle">
        Online Quiz Application
    </p>

    <?php if (isset($error)): ?>

        <p class="error">
            <?php echo htmlspecialchars($error); ?>
        </p>

    <?php endif; ?>

    <form method="POST">

        <label>Enter Your Name</label>

        <input
            type="text"
            name="name"
            placeholder="Enter your name"
            required
        >

        <label>Enter Your Email</label>

        <input
            type="email"
            name="email"
            placeholder="Enter your email"
            required
        >

        <button type="submit">
            Start Mock Test
        </button>

    </form>

</div>

</body>

</html>