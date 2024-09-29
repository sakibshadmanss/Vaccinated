<?php
$conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['userdata'])) {
        echo "<script> location.href='../index.php'; </script>";
        exit();
    } else if (isset($_SESSION['GenLuserdata'])) {
?>

<style type="text/css">
    body {
        background-image: url("../dist/img/bg.png");
        backdrop-filter: blur(10px);
    }

    .badge {
        display: inline-block;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 10px;
    }

    .badge-red {
        background-color: #ff0000;
        color: #fff;
    }

    .badge-yellow {
        background-color: #ffff00;
        color: #000;
    }

    .badge-green {
        background-color: #00ff00;
        color: #000;
    }
    .dataTable .table-striped{
        border-radius: 12px;
    color: white;
    background-color: #000239d9;

    }
    td{
        color: white;

    }
</style>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<div class="card">
  <div class="card-body">
    <div>
    <h2 class="text-light text-center">Hospital Dashboard</h2>
        <div class="d-inline d-flex justify-content-center">
            <a href="chat.php" class="btn btn-warning">Chat now</a>
            <a href="Logout.php" class="text-decoration-none btn btn-danger"> Logout </a>
        </div>
        <div class="d-inline-block text-end d-flex justify-content-center">
           
        </div>
    </div>
    </div>
</div>
<div class="container">
    <div class="row dataTable">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Registration No:</th>
                    <th>Indiviual Name</th>
                    <th>Vaccine Used:</th>
                    <th>Vaccinated By:</th>
                    <th>Vaccination Type:</th>
                    <th>Remarks:</th>
                    <th>Vaccine Date</th>
                </tr>
            </thead>
            <tbody>
    <?php
    // Retrieve the location_id from the session
    $session_location = $_SESSION["location_id"];

    // Modify your SQL query to fetch the specified columns and filter by location_id
    $qry = $conn->query("SELECT id, user_id, individual_id, vaccine_id, location_id, vaccination_type, vaccinated_by, remarks, date_created FROM vaccine_history_list WHERE location_id=$session_location");


    if ($qry->num_rows > 0) {
        while ($row = $qry->fetch_assoc()) {
            echo "<tr>";

            // Fetch and display data from individual_list
            $individualId = $row['individual_id'];
            $individualQuery = $conn->query("SELECT tracking_code, firstname FROM individual_list WHERE id = $individualId");
            $individualData = $individualQuery->fetch_assoc();
            echo "<td>" . $individualData['tracking_code'] ."</td>";
            echo "<td>" . $individualData['firstname'] ."</td>";

            // Fetch and display data from vaccine_list
            $vaccineId = $row['vaccine_id'];
            $vaccineQuery = $conn->query("SELECT name FROM vaccine_list WHERE id = $vaccineId");
            $vaccineData = $vaccineQuery->fetch_assoc();
            echo "<td>" . $vaccineData['name'] . "</td>";

            echo "<td>" . $row['vaccinated_by'] . "</td>";
            echo "<td>" . $row['vaccination_type'] . "</td>";
            echo "<td>" . $row['remarks'] . "</td>";
            echo "<td>" . $row['date_created'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No records found for this hospital.</td></tr>";
    }

    ?>
</tbody>

        </table>
    </div>
</div>

    <footer style="text-align: center;padding: 10px;">
    <p>Developed by Sakib</p>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<style type="text/css">
    .badge-yellow {
        background-color: #0000ff; /* Blue color */
        color: #fff;
    }
    .dataTable{
        position: relative;
        top:150px;
    }
    .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #00000036;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
    margin: 0 auto;
    top: 50px;
    width: 46%;
}
footer {
  position: absolute;
  bottom: 0;
  width: 100%;   
  background-color: #00000036;    
  color: #fff; 
  font-weight: 700;
}
</style>
<?php

    } else {
        echo "<script> location.href='../index.php'; </script>";
        exit();
    }
} else {
    echo "<script> location.href='../index.php'; </script>";
    exit();
}

?>
