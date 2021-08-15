<?php
    include '../phpFunctions/teamsAndDriversPageData.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../styles/teamsAndDrivers.css">
    <link rel="stylesheet" href="../styles/navBar.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams and drivers</title>
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
                            <a class="nav-link" href="standingsPage.php">Standings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Teams/Drivers</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <h1 id="teams_and_drivers_page_title">Teams and drivers</h1>

    <div class="row row-cols-lg-2 row-cols-md-1 row-cols-sm-1 g-5">

        <?php
            $teams_data = array();
            $teams_data = getTeamsData();
            $driver_counter = 0;
            while ($driver_counter <=19){
                $team_data = $teams_data[$driver_counter];
        ?>


        <div class="col">
            <div class="team" id="<?php echo $team_data["Car name"];?>">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-<?php echo $team_data["Car name"];?>" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Team</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-driver-<?php echo $team_data["Car name"];?>" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Drivers</button>
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($team_data['Team logo']).'"height="50px" alt="..." id="teamLogo">'?>
                    </div>                    
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-<?php echo $team_data["Car name"];?>" role="tabpanel" aria-labelledby="nav-home-tab">
                        <p><?php echo $team_data["Team name"];?></p>
                        <div class="row">
                            <div class="col-sm-7 team-car"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($team_data['Car picture']).'"width="100%" alt="...">'?></div>
                            <div class="col-sm-5 team-info">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Principal:</th>
                                        <td><?php echo $team_data["Team principal"];?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Base:</th>
                                        <td><?php echo $team_data["Team base"];?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Car:</th>
                                        <td><?php echo $team_data["Car name"];?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>                
                    </div>


                    <div class="tab-pane fade" id="nav-driver-<?php echo $team_data["Car name"];?>" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row drivers_data">
                            <div class="col">
                                <div class="col"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($team_data['Driver picture']).'"width="150px" alt="...">';?></div>
                                <div class="col">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Name:</th>
                                                <td><?php echo $team_data["Driver name"];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Number:</th>
                                                <td><?php echo $team_data["Driver number"];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Country:</th>
                                                <td><?php echo $team_data["Country of origin"];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <?php
                                ++$driver_counter;
                                $team_data = $teams_data[$driver_counter];
                            ?>
                            
                            <div class="col">
                                <div class="col"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($team_data['Driver picture']).'"width="150px" alt="...">';?></div>
                                <div class="col">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Name:</th>
                                                <td><?php echo $team_data["Driver name"];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Number:</th>
                                                <td><?php echo $team_data["Driver number"];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Country:</th>
                                                <td><?php echo $team_data["Country of origin"];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
                ++$driver_counter;
            }
        ?>
        
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