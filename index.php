<?php

if (isset($_POST['search'])) {
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT users.firstname, users.surname, courses.description, enrolments.completionstatus, enrolments.enrolmentID
    FROM users
    JOIN enrolments
    ON users.userID = enrolments.userID 
    JOIN courses 
    on courses.courseID = enrolments.courseID
    WHERE CONCAT(`firstname`, `surname`, `description`, `completionstatus`) LIKE '%" . $valueToSearch . "%'";
    $search_result = filterTable($query);
} else {
    $query =
    "SELECT users.firstname, users.surname, courses.description, enrolments.completionstatus, enrolments.enrolmentID
    FROM users
    JOIN enrolments
    ON users.userID = enrolments.userID 
    JOIN courses 
    on courses.courseID = enrolments.courseID;";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    include 'config.php';
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF8">
    <meta name="author" content="Yang Song">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,
    shrink-to-fit=no">
    <title>MindAtlas Course Report</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .navbar-header {
            float: left;
            padding: 15px;
            text-align: center;
            width: 100%;
        }

        .navbar-brand {
            float: none;
        }
    </style>
</head>

<body class="bg-secondary">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">MindAtlas Course Report</a>
        </div>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 bg-light mt-2 rounded pb-3 text-primary text-center">
                <h1>Search Function using PHP & MYSQL</h1>
                <hr>
                <form action="index.php" class = "form-inline" method="post">
                    <!-- <label for="search" class="font-weight-bold lead text-dark">Search Record</label>&nbsp;&nbsp;&nbsp;&nbsp; -->
                    <input type="text" name="valueToSearch" class="form-control form-control-lg rounded-0 border-primary" placeholder="Search anything..."> &nbsp;&nbsp;&nbsp;&nbsp;
                    <br><br>
                    <input type="submit" class="btn btn-primary" name="search" value="Search"><br><br>

                    <table class="table table-hover table-light table-striped" id="table-data">
                        <thead>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>Course Name</th>
                            <th>Completion Status</th>
                        </thead>
                    

                    <!-- populate table from mysql database -->
                    <?php while ($row = mysqli_fetch_array($search_result)) : ?>
                        <tr>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['surname']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['completionstatus']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </table>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
