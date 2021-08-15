<?php
include_once "../phpFunctions/standingsPageData.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../styles/navBar.css">
    <link rel="stylesheet" href="../styles/standings.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Standings</title>
</head>
<body>
    <div class="header fixed-top">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../mainPage.php"><img src="../f1_logo.png" alt="F1 logo" id="f1_logo" title="Home"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Standings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="teamsAndDriversPage.php">Teams/Drivers</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="row site_info">
        <div class="col-md-7">
            <h2 id="standings_page_title">Standings<h2>
        </div>

        <div class="col-md-5 standings_buttons">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a class="btn btn-primary btn-lg" data-bs-toggle="collapse" href="#driverStandings" role="button" aria-expanded="true" aria-controls="collapseExample">
                    Driver standings
                </a>
                <a class="btn btn-primary btn-lg" data-bs-toggle="collapse" href="#constructorStandings" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Constructor standings
                </a>
            </div>
        </div>
    </div>

    

    <div class="standings_tables">
        <div class="collapse show" id="driverStandings">

            <h1 class="table_title">Drivers</h1>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Position</th>
                        <th scope="col">Driver name</th>
                        <th scope="col">Team</th>
                        <th scope="col">Points</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php
                    $driver_standings_data = array();
                    $driver_standings_data = getdriverStandings();
                    foreach ($driver_standings_data as $driver_data){
                ?>
                    <tr>
                        <th scope="row"><?php echo $driver_data["Position"];?></th>
                        <td><?php echo $driver_data["Driver name"];?></td>
                        <td><?php echo $driver_data["Team"];?></td>
                        <td><?php echo $driver_data["Points"];?></td>
                    </tr>

                <?php
                    }
                ?>

                </tbody>
            </table>
        </div>


        <div class="collapse" id="constructorStandings">

        <h1 class="table_title">Constructors</h1>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Position</th>
                        <th scope="col">Team</th>
                        <th scope="col">Team logo</th>
                        <th scope="col">Points</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $constructor_standings_data = array();
                        $constructor_standings_data = getConstructorStandings();
                        foreach ($constructor_standings_data as $constructor_data){
                    ?>

                    <tr>
                        <th scope="row"><?php echo $constructor_data["Position"];?></th>
                        <td><?php echo $constructor_data["Team"];?></td>
                        <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($constructor_data['Team logo']).'" height="50px" alt="...">'?></td>
                        <td><?php echo $constructor_data["Points"];?></td>
                    </tr>

                    <?php
                        }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <div class="footer_content">
            <p>Ova web aplikacija napravljena je za završni rad na Fakultetu Elektroitehnike, Računarstva i Informacijaskih Tehnologija.</p>
            <p>Luka Šarčević, preddiplomski studij računarstva, 2020./2021. akademska godina</p>
        </div>
    </footer>


    <script src="../js/bootstrap.js"></script>
</body>
</html>