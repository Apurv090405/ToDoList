<?php
    include("connection.php");
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: LOGIN.php");
        exit();
    }
    $loggedInUsername = $_SESSION['username'];

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
    $stmt->bind_param("s", $loggedInUsername);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
    } else {
        // Handle the case where the user is not found or other errors
        exit();
    }

    function markTaskAsCompleted($conn, $taskName)
    {
        // Update the task status as completed in your database here
        // Make sure to include the user_id in the SQL query to filter tasks for the logged-in user

        // Return a message to display in the task card
        return '<p class="task-info completed blink">Completed</p>';
    }

    if (isset($_POST['mark_completed'])) {
        $completed_task_name = $_POST['completed'];
        $completed_message = markTaskAsCompleted($conn, $completed_task_name);
    }

    if (isset($_POST['filter'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Add user_id to the SQL query to filter tasks for the logged-in user
        $sql = "SELECT task_name, task_dis, st_date, end_date FROM add_task 
                WHERE user_id = ? AND st_date >= ? AND end_date <= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        // If the "Filter" button is not clicked, retrieve tasks for the logged-in user without date filtering
        $sql = "SELECT task_name, task_dis, st_date, end_date FROM add_task WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    }
?>


<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/x-icon" href="favicon.jpg">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Task</title>
<head>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300&display=swap");
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(253, 249, 249);
            margin: 0;
            padding: 0;
            height: 100vh;
        }
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
            font-family: "Be Vietnam Pro", sans-serif;
            scroll-behavior: smooth;
        }

        /* Navigation Bar */
        .navbar {
            width: 100%;
            display: flex;
            justify-content: flex-end; /* Fixed typo here */
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
            background-color:  #797975
        }

        /* Content Container */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center horizontally */
            justify-content: center;
            width: 95%;
            max-width: 900px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 25px;
            animation: fade-in 1s ease-in-out;
            margin: 25px auto;
        }

        .title {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Task Card Styling */
        .task-card {
            align-items: center;
            border: 2px solid #797975;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            background-color:rgb(253, 249, 249);
            transition: transform 0.3s;
            animation: slide-in 0.5s ease-in-out;
            /* Increase height and adjust width here */
            height: 250px;
            max-width: 400px;
            width: 100%;
        }

        .task-card:hover {
            transform: scale(1.08);
            background-color:lightgrey;
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

        /* Blink Animation */
        @keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .blink {
            animation: blink 1s infinite; /* Adjust animation duration as needed */
        }

        /* Keyframe Animations */
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

        /* Search Bar Styles */
        .search-bar {
            display: inline-block;
            margin-right: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            font-size: 16px;
            transition: width 0.3s, border-color 0.3s;
        }

        /* Add animation for expanding search bar on focus */
        .search-bar:focus {
            width: 250px; /* Adjust the expanded width as needed */
            border-color: #007bff; /* Change border color on focus */
        }

        /* Filter Button Styles */
        /* Date Filter Form Styles */
            .date-filter {
                display:block;
                background-color:#797975;
                color:#fff;
                align-items: center;
                margin-bottom: 20px;
                margin-block-end: auto;
                padding: 10px 20px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2)
            }
            .date-filter:hover{
                background-color:darkgray;
            }

            .date-filter label {
                margin-right: 10px;
            }

            /* Filter Button Styles */
            .filter-button {
                background-color: #1f1f1f;
                color: #fff;
                border:0em;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                padding: 8px 16px;
                transition: background-color 0.3s;
            }

            /* Add animation for changing button background color on hover */
            .filter-button:hover {
                background-color:darkblue; /* Darker blue color on hover */
            }
            .date-filter br {
                margin-bottom: 10px; /* Adjust the margin as needed for your desired spacing */
            }
    </style>
</head>
<body>
    <!-- Add your navigation bar here -->
    <div class="navbar">
        <a href="home.php"><button class="btn-pink btn-project">Home</button></a>
        <a href="add.php"><button class="btn-pink btn-project">Add Task</button></a>
        <a href="edit.php"><button class="btn-pink btn-project">Edit Task</button></a>
    </div>
    <!-- ... -->

    <!-- Content for View Task Page -->
    <div class="container">
        <h1 class="title">View Task</h1>

        <!-- Add Date Filters -->
        <form method="POST" action="" class="date-filter">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date">
            
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date"><br><br>
            
            <input type="submit" name="filter" value="Filter" class="filter-button">
        </form>
        <br> <br>

        <?php
        // Loop through the retrieved tasks and display them for the logged-in user
        while ($row = $result->fetch_assoc()) {
            // Extract task details from the $row variable
            $task_name = $row["task_name"];
            $task_dis = $row["task_dis"];
            $st_date = $row["st_date"];
            $end_date = $row["end_date"];
            
            // ... (existing code to display tasks)
            // Add Checkbox for Task Completion within the loop
            echo '<div class="task-card">';
            echo '<h2 class="task-title">' . $task_name . '</h2>';
            echo '<p class="task-info"><strong>Description:</strong> ' . $task_dis . '</p>';
            echo '<p class="task-info"><strong>Start Date:</strong> ' . $st_date . '</p>';
            echo '<p class="task-info"><strong>End Date:</strong> ' . $end_date . '</p>';
            
            // Check if a completed message should be displayed
            if (isset($completed_message) && $completed_task_name === $task_name) {
                echo $completed_message;
            }
            
            echo '<form method="POST" action="">';
            echo '<label for="completed">Completed:</label>';
            echo '<input type="checkbox" id="completed" name="completed" value="' . $task_name . '">';
            echo '<br>';
            echo '<input type="submit" name="mark_completed" value="Mark Completed" class="filter-button">';
            echo '</form>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>

