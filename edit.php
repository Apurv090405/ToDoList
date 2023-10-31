<?php
include("connection.php");
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

$edit_task_name = $task_name = $task_dis = $st_date = $end_date = $tsk_id = "";

if (isset($_GET["task_name"]) || isset($_POST["search_task_name"])) {
    $edit_task_name = isset($_POST["search_task_name"]) ? mysqli_real_escape_string($conn, trim($_POST["search_task_name"])) : mysqli_real_escape_string($conn, trim($_GET["task_name"]));
    // Add user_id condition to the SQL query
    $sql = "SELECT task_name, task_dis, st_date, end_date, tsk_id FROM add_task WHERE task_name = '$edit_task_name' AND user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        extract($row);
    } else {
        echo '<script>alert("Task Not Found!");</script>';
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_task"])) {
    $new_task_name = mysqli_real_escape_string($conn, $_POST["new_task_name"]);
    $new_task_dis = mysqli_real_escape_string($conn, $_POST["new_task_dis"]);
    $new_st_date = $_POST["new_st_date"];
    $new_end_date = $_POST["new_end_date"];
    $tsk_id = $_POST["tsk_id"]; // Add a hidden input field in your HTML form to store tsk_id

    $update_query = "UPDATE add_task SET task_name = '$new_task_name', task_dis = '$new_task_dis', st_date = '$new_st_date', end_date = '$new_end_date' WHERE tsk_id = '$tsk_id'";

    if (mysqli_query($conn, $update_query)) {
        echo '<script>alert("Updated Sucessfully");</script>';
        header("Location: view.php");
        exit();
    } else {
        echo '<script>alert("Error Occurs!! Update failed:");</script>';
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300&display=swap">
    <link rel="icon" type="image/x-icon" href="favicon.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300&display=swap");
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
            font-family: "Be Vietnam Pro", sans-serif;
            scroll-behavior: smooth;
        }

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

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 95%;
            max-width: 950px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 20px;
            animation: fade-in 1s ease-in-out;
            margin: 20px auto;
        }

        .title {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .task-card {
            align-items: center;
            border: 2px solid #ff6347;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            transition: transform 0.3s;
            animation: slide-in 0.5s ease-in-out;
            height: 250px;
            max-width: 400px;
            width: 100%;
        }

        .task-card:hover {
            transform: scale(1.02);
        }

        .task-title {
            color: #333;
            font-size: 20px;
        }

        .task-info {
            margin: 10px 0;
            color: #666;
        }

        .task-info strong {
            color: #333;
        }

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

        .search-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #333;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px;
            transition: border-color 0.3s, transform 0.3s;
            animation: slide-in 0.5s ease-in-out;
        }

        .search-input:focus {
            outline: none;
            border-color: #ff6347;
            transform: scale(1.02);
        }

        .search-button {
            padding: 15px 30px;
            background-color: #797975;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .search-button:hover {
            background-color: darkblue;
        }

        .edit-form {
            display: none;
            align-items: center;
            border: 2px solid #797975;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #fdf9f9;
            transition: transform 0.3s;
            animation: slide-in 0.5s ease-in-out;
        }

        .edit-form.active {
            display: flex;
        }

        .edit-title {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .edit-input {
            width: 80%;
            padding: 15px;
            border: 2px solid #333;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .edit-input:focus {
            outline: none;
            border-color: #ff6347;
        }

        .edit-button {
            padding: 15px 30px;
            background-color: #797975;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .edit-button:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="home.php"><button class="btn-pink btn-project">Home</button></a>
        <a href="add.php"><button class="btn-pink btn-project">Add Task</button></a>
        <a href="view.php"><button class="btn-pink btn-project">View Task</button></a>
    </div>

    <div class="container">
        <h1 class="title">Edit Task</h1>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="search-form">
            <input type="text" name="search_task_name" class="search-input" placeholder="Search Task by Name">
            <button type="submit" class="search-button">Search</button>
        </form>

        <div class="edit-form <?php echo !empty($task_name) ? 'active' : ''; ?>">
            
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <h4 class="edit-title"><?php echo htmlspecialchars($task_name); ?></h4>
                <input type="hidden" name="update_task" value="1">
                <input type="hidden" name="tsk_id" value="<?php echo htmlspecialchars($tsk_id); ?>">
                <input type="hidden" name="tsk_id" value="<?php echo htmlspecialchars($tsk_id); ?>">
                <input type="text" name="new_task_name" class="edit-input" placeholder="New Task Name" value="<?php echo htmlspecialchars($task_name); ?>" required>
                <textarea name="new_task_dis" class="edit-input" placeholder="Task Description" required><?php echo htmlspecialchars($task_dis); ?></textarea>
                <input type="date" name="new_st_date" class="edit-input" value="<?php echo htmlspecialchars($st_date); ?>" required>
                <input type="date" name="new_end_date" class="edit-input" value="<?php echo htmlspecialchars($end_date); ?>" required><br><br>
                <button type="submit" class="edit-button" name="update_task" value="update_task">Update Task</button>
            </form>
        </div>
    </div>
</body>
</html>
