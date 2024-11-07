<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../public/css/web_design.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/info-col.css"> <!-- Add this line to include advertisement CSS -->

    <title>Delete User - Website ni Cruz</title>

</head>

<body class="body">
<div class="wrapper">

    <?php include '../../includes/header.php'; ?>

    <main class="main-content">
        <h2> Deleting Record </h2>
        <?php
            if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
                $id = $_GET['id'];
            }elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
                $id = $_POST['id'];
            }else { //no valid id number. stop script
                echo '<a href="../../public/index.php" class="homepage-link"> Go to Homepage </a>';
            }
            require('../config/mysqli_connect.php');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['sure'] == 'Yes') {
                    $q = "DELETE FROM users WHERE id = ?"; //delete specific user
                    $result = @mysqli_query ($dbconnect, $q);
                    if (mysqli_affected_rows($dbconnect) == 1){
                        echo "<p>Deleted Successfully</p>";
                    }else{
                        echo "<p>Error, please contact system administrator for maintenance</p>";
                    }
                }else{
                    echo "<p>Record was not deleted, go back to user's page</p>";
                    echo '<a class="nav-link" href="../src/views/register-view-users.php">Registered Users</a>';
                }
            }else{ // display users na idedelete
                $q = "SELECT CONCAT(fname, ' ', lname) FROM users WHERE user_id = $id";
                $result = @mysqli_query($dbconnect, $q);
                if (mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
                    echo "<h3> Are you sure you want to delete $row[0]?</h3>";
                    echo '
                        <form action="delete_user.php" method="post">
                        <input id = "submit-yes" type="submit" name="sure" value="Yes">
                        <input id = "submit-no" type="submit" name="sure" value="No">
                        <input type="hidden" name="id" value=".$id.">
                        </form>
                    ';
                }else{ //not valid id, no user found
                    echo "<h3>You are not Registered</h3>";
                    echo '<a class="nav-link" href="../src/views/register-view-users.php">Registered Users</a>';

                }
            }
            mysqli_close($dbconnect);

        ?>
    </main>
    <?php include '../src/views/about_us.php'; ?>
    <?php include '../../includes/footer.php'; ?>

</div>
</body>
</html>
