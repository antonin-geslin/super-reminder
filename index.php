<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  type="text/css" rel="stylesheet" href="./style/style.css">
    <title>To-Do-List</title>
    <script src="script.js"></script>
</head>
<body>
    <header>
        <h1>To do list</h1>
        <a href="index.php"><img src="style/img/liste.png"></a>
            <?php
                session_start();
                if (isset($_SESSION['login'])) {
                    $username = $_SESSION['login'];
                    echo "<div class='sign_out'><p class='login_check'>Bienvenue, " .strip_tags($username). "!</p><form method='post'><button type='submit' name='signout'>Sign Out</button></form></div>";
                    if (isset($_POST['signout'])) {
                        session_destroy();
                        header('location: index.php');
                        exit();
                    }
                } else {
                    echo "<a href='./server/connexion.php'>connexion</a>";
                }
            ?>
    </header>
    <?php
        session_start();
        if (isset($_SESSION['login'])) {
            echo '<div class="add_task">
                <input id="myInput" type="text" name="task" placeholder="Task">
                <button type="submit" placeholder="Search">Add Task</button>
            </div>';
        }
    ?>

    <div class="taskList">
        <div class="task">
                <h1>Task 2</h1>
                <input type="checkbox" name="check"/>
        </div>
        <div class="task">
                <h1>Task 2</h1>
                <input type="checkbox" name="check"/>
        </div>
    </div>
</body>
</html>