<?php 
include("connection.php");

// Ensure the user is logged in and retrieve their user_id from the session
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page or handle it as needed
    header("Location: LOGIN.php");
    exit();
}
$loggedInUsername = $_SESSION['username'];

// Retrieve the user_id based on the logged-in username
$stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
$stmt->bind_param("s", $loggedInUsername);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
} else {
    // Handle the case where the user is not found or other errors
    // Redirect or display an error message as needed
    exit();
}

if (isset($_POST['add'])) {
    $task_name = $_POST["task_name"];
    $task_dis = $_POST["task_dis"];
    $st_date = $_POST["st_date"];
    $end_date = $_POST["end_date"];
    
    // Insert the task into the tasks table with the user_id
    $sql = "INSERT INTO add_task (task_name, task_dis, st_date, end_date, user_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $task_name, $task_dis, $st_date, $end_date, $user_id);
    
    if ($stmt->execute()) {
        echo '<script>alert("Task added successfully!");</script>';
    } else {
        echo '<script>alert("ERROR!!!! Task Is Not Added successfully!");</script>';
    }
}
?>

<!-- Your HTML form goes here -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.jpg">
    <title>Add Task</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Be Vietnam Pro", sans-serif;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: rgb(253, 249, 249);
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        /* Navigation Bar */
        .navbar {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .navbar button {
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
            padding: 5px 10px;
            transition: background-color 0.3s;
        }

        .navbar button:hover {
            background-color: #797975;
        }

        /* Center the container */
        .container {
            width: 80%;
            max-width: 400px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 20px;
            animation: fade-in 1s ease-in-out;
        }

        .title {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .task-form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .task-input {
            padding: 10px;
            border: none;
            border-bottom: 2px solid #333;
            font-size: 16px;
            margin-bottom: 10px;
            transition: border-color 0.3s;
        }

        .task-input:focus {
            outline: none;
            border-color: #ff6347;
        }

        .add-button {
            padding: 10px 20px;
            background-color: #1f1f1f;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .add-button:hover {
            background-color: #797975;
        }

        /* List styling */
        .task-list {
            list-style-type: none;
            padding: 0;
        }

        li {
            display: flex;
            flex-direction: column;
            border: 2px solid #ff6347;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fff;
            transition: transform 0.3s;
            animation: slide-in 0.5s ease-in-out;
        }

        li:hover {
            transform: scale(1.02);
        }

        .task-info {
            margin: 10px 0;
            color: #666;
        }

        .task-info strong {
            color: #333;
        }

        li button {
            background-color: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px 10px;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        li button:hover {
            background-color: #ff4500;
        }

        /* Keyframe animations */
        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slide-in {
            from {
                transform: translateY(-20px);
            }
            to {
                transform: translateY(0);
            }
        }
    </style>
    <title>To-Do List</title>
</head>
<body>
    <!-- Navigation Bar -->
    <div class="navbar">
    <a href="home.php"> <button class="btn-pink btn-project">Home</button> </a>
    <a href="view.php"> <button class="btn-pink btn-project">View Task</button> </a>
    <a href="edit.php"> <button class="btn-pink btn-project">Edit task</button> </a>
    </div>
        <br> <br> <br> <br> <br> <br> <br> <br> <br> 
        <div class="container">
        <h1 class="title">Add Task</h1>
        <form method="POST" action=""> <!-- Corrected the action attribute -->
            <div class="task-form">
                <input type="text" id="taskInput" class="task-input" placeholder="Enter Task Name" name="task_name" value="">
                <input type="text" id="taskDescription" class="task-input" placeholder="Enter Task Description" name="task_dis" value="">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" class="task-input" name="st_date">
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" class="task-input" name="end_date">
                <button type="submit" id="addTask" class="add-button" name="add" value="ADD">Add Task</button>
            </div>
        </form>
    </div>    
</body>
</html>
