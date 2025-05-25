<?php

session_start();

include("../common/db.php");

if (isset($_POST["signup"])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $address = trim($_POST['address']);

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($address)) {
        echo "<h1> All fields are required for signup.</h1>";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }
    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters long.";
        exit;
    }

    $user = $conn->prepare("Insert into `users`
(`id`, `username`,`email`,`password`,`address`)
values(NULL, '$username', '$email', '$password','$address');
");

    $result = $user->execute();
    $user->insert_id;
    if ($result) {
        $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $user->insert_id];
        header("location: /discuss");
    } else {
        echo "New user not registered";
    }

} else if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation
    if (empty($email) || empty($password)) {
        echo "Email and password are required for login.";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }
    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters long.";
        exit;
    }

    $username = "";
    $user_id = 0;
    $query = "select * from users where email='$email' and password='$password' ";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        foreach ($result as $row) {
            $username = $row['username'];
            $user_id = $row['id'];
        }
        $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $user_id];
        header("location: /discuss");
    } else {
        echo "New user not registered";
    }
} else if (isset($_GET['logout'])) {

    session_unset();
    header("location: /discuss");
} else if (isset($_POST['ask'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category_id = trim($_POST['category']);
    $user_id = $_SESSION['user']['user_id'];

    // Validation
    if (empty($title)) {
        echo "Title is required.";
        exit;
    }
    if (empty($description)) {
        echo "Description is required.";
        exit;
    }
    if (empty($category_id) || !is_numeric($category_id) || intval($category_id) <= 0) {
        echo "Valid category is required.";
        exit;
    }

    $questions = $conn->prepare("Insert into `questions`
(`title`,`description`,`category_id`,`user_id`)
values(?,?,?,?);
");

    $questions->bind_param("ssii", $title, $description, $category_id, $user_id);

    $result = $questions->execute();
    $questions->insert_id;
    if ($result) {

        header("location: /discuss");

    } else {
        echo "Question not added to  webssite";
    }
} else if (isset($_POST["answer"])) {
    $answer = $_POST['answer'];
    $question_id = $_POST['question_id'];
    $user_id = $_SESSION['user']['user_id'];


    $query = $conn->prepare("Insert into `answers`
(`id`, `answer`,`question_id`,`user_id`)
values(NULL, '$answer','$question_id','$user_id');
");

    $result = $query->execute();
    if ($result) {

        header("location: /discuss?q-id=$question_id");

    } else {
        echo " Answer is not submitted";
    }

} else if (isset($_GET["delete"])) {
    $uid = $_GET["delete"];
    $query = $conn->prepare("DELETE FROM `questions` where `id`='$uid'");
    $result = $query->execute();
    if ($result) {
        header("location: /discuss");
    } else {
        echo "Question not deleted";
    }

}

?>