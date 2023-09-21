<!-- "Taskiverse" is a portmanteau of "task" and "universe." 
In this context, it is a made-up word that combines the concept of tasks or to-dos with the idea of a vast, expansive universe. 
The term implies that within this digital or organizational universe, users can manage, organize, and explore their tasks and to-do lists.
It conveys a sense of comprehensive task management and suggests that the platform can handle all the different tasks and responsibilities,
one might have, creating a universe of tasks, so to speak. -->


<?php
// Start the session to access session variables
session_start();

// Check if the username session variable is set
if (isset($_SESSION["username"])) {
    $loggedInUsername = $_SESSION["username"];
} else {
    // If the user is not logged in, you can set $loggedInUsername to an empty string or handle it as needed.
    header("Location: LOGIN.php");
    exit();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskiverse</title>

    <link rel="icon" type="image/x-icon" href="favicon.jpg">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div id="wrapper">

        <div class="container">
            <div class="navbar">
                
                <div class="logo-container">
                    <img src="logo.jpg" class="logo">
                </div>
                <div class="nav-items">
                    <div>
                    <?php
                    if (!empty($loggedInUsername)) {
                        // Display the username in the navbar if the user is logged in
                        echo 'Welcome, ' . htmlspecialchars($loggedInUsername) . '!';
                    }
                    ?>
                    </div>
                    <div><a href="#Features">Features</a></div>
                    <div><a href="#skills">About US</a></div>
                    <div><?php
                    if (!empty($loggedInUsername)) {
                        echo '<a href="logout.php">Logout</a>'; // Add this line for logout
                    }
                    ?>
                    </div>
                </div>

            </div>

            <div class="hero-section">

                <div class="faded-text"">Taskiverse</div>
                <div class="hero-section-left">
                    <div class="hero-section-heading">Hi! "Welcome to the taskiverse, 
                        where your to-dos become cosmic triumphs."</div>
                    <div class="hero-section-heading hero-section-sub-heading">
                        You Can <span class="role"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="project-section" id="Features">
            <h2 class="page-header">Features</h2>

            <div class="project-container">
                <div class="project-card" id="project1">
                    <div class="project-number project-number-right">01</div>
                    <div class="project-content project-content-left">

                        <h2 class="project-heading">Add Tasks</h2>

                        <p class="project-subHeading">Hey! You can add your tasks with the help of
                            below shown button
                        </p>
                        <div class="btn-grp">
                        <a href="add.php"> <button class="btn-pink btn-project">Click Here </button> </a>
                            
                        </div>
                    </div>
                </div>

                <div class="project-card" id="project1">
                    <div class="project-number project-number-right">02</div>
                    <div class="project-content project-content-left">

                        <h2 class="project-heading">View Task</h2>

                        <p class="project-subHeading">
                            Want to Supervise your Tasks.?
                            <br\>
                            You can view all task by clicking on this Button
                        </p>
                        <div class="btn-grp">
                        <a href="view.php"> <button class="btn-pink btn-project">Click Here </button> </a>
                        </div>
                    </div>
                </div>

                <div class="project-card" id="project1">
                    <div class="project-number project-number-right">03</div>
                    <div class="project-content project-content-left">

                        <h2 class="project-heading">Edit Tasks</h2>
                        <p class="project-subHeading">
                            Want To Update Your Task ?
                            <br/>
                            You Can Edit Them By Clicking On This Button.
                        </p>
                        <div class="btn-grp">
                        <a href="edit.php"><button class="btn-pink btn-project">Click Here</button></a>
                            
                        </div>
                    </div>
                </div>
          
            </div>

        </div>
        
        <div id="skills" class="container skills-container ">
          <div class="skill-fade-text">About Us</div>

          <div class="responsive-container-block outer-container">
  <div class="responsive-container-block inner-container">
    <p class="text-blk section-head-text">
      Meet Our Experts
    </p>
    <p class="text-blk section-subhead-text">
    Meet our talented team of dedicated professionals who bring passion and expertise to every project.
    </p>


    <div class="responsive-container-block">
      <div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 team-card-container">
        <div class="team-card">
          <div class="img-wrapper">
            <img class="team-img" src="apurv.jpg">
          </div>
          <p class="text-blk name">
            <br>
            Apurv Chudasama
          </p>
          <p class="text-blk position">
          <br>
           Data scientist <br><br>
           Web Developer
          </p>
          <div class="social-media-links">
            <a href="https://github.com/Apurv090405" target="_blank">
              <img src="github.svg">
            </a>
            <a href="https://www.linkedin.com/in/apurv-chudasama-744b05258/" target="_blank">
              <img src="linkedin.svg">
            </a>
            <a href="https://instagram.com/neptune_seeker_9?igshid=MzRlODBiNWFlZA==" target="_blank">
              <img src="instagram.svg">
            </a>
            <a href="mailto: apurvchudasama.edu@gmail.com" target="_blank">
              <img src="mail.svg">
            </a>
          </div>
        </div>
      </div>

      <div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 team-card-container">
        <div class="team-card">
          <div class="img-wrapper">
            <img class="team-img" src="jay.jpg">
          </div>
          <p class="text-blk name">
            <br>
            <br>
            Jay Bhagat
          </p>
          <p class="text-blk position">
          <br><br>
            Web Developer  <br><br>
            Coding Enthusiast
          </p>
          <div class="social-media-links">
            <a href="https://github.com/Jay1811004" target="_blank">
            <img src="github.svg">
            </a>
            <a href="https://www.linkedin.com/in/jay-bhagat-04a51a255/" target="_blank">
              <img src="linkedin.svg">
            </a>
            <a href="https://instagram.com/jaybhagat.18?igshid=MzRlODBiNWFlZA==" target="_blank">
            <img src="instagram.svg">
            </a>
            <a href="mailto: jaybhagat02701@gmail.com" target="_blank">
            <img src="mail.svg">
            </a>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
        </div>
        
    </div>
  <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
  <script src="https://kit.fontawesome.com/58a810656e.js" crossorigin="anonymous"></script>
  <script>
    var typeData = new Typed(".role", {
      strings: [
        "Add The Task",
        "Edit The Task",
        "View The Task",
        "Edit The Task",
      ],
      loop: true,
      typeSpeed: 100,
      backSpeed: 80,
      backDelay: 1000,
    });
  </script>
</body>
</html>
