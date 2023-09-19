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
                <button type="submit" placeholder="Search"><?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="#1C274C" stroke-width="1.5"/>
                    <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>';
        }
    ?>

    <div class="taskList">
    </div>
</body>
</html>