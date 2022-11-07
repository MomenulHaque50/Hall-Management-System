<?php

//--------------------------------->> DB CONFIG
require_once "../config/configPDO.php";

//--------------------------------->> START SESSION
session_start();

//--------------------------------->> START SESSION
if (!isset($_SESSION["admin"])) {
    header("location: admin_login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HALL MANAGEMENT SYSTEM | MEAL CHART</title>

<!-- Include HeaderScripts -->
<?php include_once "../includes/headerScripts.php";?>
<link rel="stylesheet" href="../css/common.css">


</head>

<body>

    <!-- Include Admin Navbar -->
    <?php include_once "../includes/hallNavbar.php";?>


    <div class="container">
        <div class="row mt-5">
            <section class="col-md-12">

                <h1 class="text-center font-Staatliches-heading">MEAL CHART</h1>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">


                        <thead>
                            <tr class="tableizer-firstrow">
                                <th>Day</th>
                                <th>Breakfast</th>
                                <th>Lunch</th>
                                <th>Dinner</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php

try {

    # Sql Query
    $sql = "SELECT * FROM meal_chart";

    # Prepare Query
    $result = $conn->prepare($sql);

    # Execute Query
    $result->execute();

    # Checking Wether Count Greater than 0
    if ($result->rowCount() > 0) {

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            ?>

                            <tr>
                                <td><?php echo $row["day"]; ?></td>
                                <td><?php echo $row["breakfast"]; ?></td>
                                <td><?php echo $row["lunch"]; ?></td>
                                <td><?php echo $row["dinner"]; ?></td>
                            </tr>


                            <?php

        }

        ?>

                        </tbody>
                    </table>

                    <?php

    } else {
        echo "<tr><td class='text-center' colspan='4'>No Records Found</td></tr>";
    }

} catch (PDOException $e) {
    echo "<script>alert('We are sorry, there seems to be a problem with our systems. Please try again.');</script>";
    # Development Purpose Error Only
    echo "Error " . $e->getMessage();
}

?>
                </div>

            </section>
        </div>
    </div>




    <!-- Include FooterScripts -->
    <?php include_once "../includes/footerScripts.php";?>

</body>

</html>