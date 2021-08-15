<?php
include 'phpFunctions/mainPageData.php';
include 'phpFunctions/finishedRacesPodiumDetails.php';
include 'phpFunctions/upcommingRacesDetails.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="styles/mainPage.css">
    <link rel="stylesheet" href="styles/navBar.css">
    <link rel="stylesheet" href="styles/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2021 Formula 1 Season</title>
</head>
<body>
    <div class="header fixed-top">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="f1_logo.png" alt="F1 logo" id="f1_logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/standingsPage.php">Standings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/teamsAndDriversPage.php">Teams/Drivers</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    
    <div class="content-wrapper">
        <div class="row site_info">
            <div class="col-md-8">
                <h1 id="schedule_page_title">FORMULA 1 SCHEDULE</h1>
            </div>

            <div class="col-md-4 upcomming_race">
                <div class="row">
                    <div class="col-3">
                        Next up:
                    </div>
                    <div class="col-6">
                        
                        <?php 
                            $upcomming_races_data = array();
                            $upcomming_races_data = getUpcommingRaces();
                            $upcomming_race = $upcomming_races_data[0];
                            echo $upcomming_race['Race name'];
                        ?>
                    </div>
                    <div class="col-3">
                        <?php 
                            echo '<img src="data:image/jpeg;base64,'.base64_encode($upcomming_race['Country flag']).'" height="50px" alt="...">';
                        ?>
                    </div>        
                </div> 
            </div>
        </div>


        <div class="row race_schedule row-cols-1 row-cols-md-3 row-cols-lg-5 g-5">
        <?php
            $finished_races_data = array();
            $finished_races_data = getFinishedRaces();

            $first_driver_data = array();
            $first_driver_data = getFirstPlaces();
            $second_driver_data = array();
            $second_driver_data = getSecondPlaces();
            $third_driver_data = array();
            $third_driver_data = getThirdPlaces();

            $finished_races_results = array();
            $finished_races_results = getFinishedRacesResults();

            $finished_qualys_results = array();
            $finished_qualys_results = getFinishedQualysResults();

            $podium_counter = 0;
            $race_row_counter = 0;
            $qualys_row_counter = 0;
            foreach($finished_races_data as $datas){
        ?>
                <div class="col">
                    <div class="card h-100">
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($datas['Country flag']).'" class="card-img-top" alt="...">'?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $datas["Beggining Date"];?> - <?php echo $datas["Finishing Date"];?></h5>
                            <p class="card-text"><?php echo $datas["Race name"];?></p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $datas["Race name PK"];?>">
                            More detail
                        </button>
                    </div>
                </div>

                <div class="modal fade modal_finished" id="<?php echo $datas["Race name PK"];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?php echo $datas["Race name PK"];?>Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="<?php echo $datas["Race name PK"];?>Label"><?php echo $datas["Race name"];?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <h3>Podium</h3>
                                <table class="table">
                                    <tbody>

                                        <?php
                                            $data_first=$first_driver_data[$podium_counter];
                                            $data_second=$second_driver_data[$podium_counter];
                                            $data_third=$third_driver_data[$podium_counter];
                                        ?>

                                        <tr>
                                            <td>2nd</td>
                                            <td>1st</td>
                                            <td>3rd</td>
                                        </tr>
                                        <tr>
                                            <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($data_second['Driver picture']).'" alt="...">'?></td>
                                            <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($data_first['Driver picture']).'" alt="...">'?></td>
                                            <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($data_third['Driver picture']).'" alt="...">'?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $data_second["Driver name"];?></td>
                                            <td><?php echo $data_first["Driver name"];?></td>
                                            <td><?php echo $data_third["Driver name"];?></td>
                                        </tr>

                                    </tbody>
                                </table>

                                <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                        Race results
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Position</th>
                                                                    <th scope="col">Driver name</th>
                                                                    <th scope="col">Team</th>
                                                                    <th scope="col">Time</th>
                                                                    <th scope="col">Points</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                            <?php
                                                                $finished_races_results_counter = 0;
                                                                while($finished_races_results_counter <= 19){
                                                                    $race_result = $finished_races_results[$race_row_counter+$finished_races_results_counter];
                                                                
                                                            ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $race_result["Position"];?></th>
                                                                    <td><?php echo $race_result["Driver name"];?></td>
                                                                    <td><?php echo $race_result["Team"];?></td>
                                                                    <td><?php echo $race_result["Time"];?></td>
                                                                    <td><?php echo $race_result["Points"];?></td>
                                                                </tr>

                                                            <?php
                                                                ++$finished_races_results_counter;
                                                                }
                                                            ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Qualifying results
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Position</th>
                                                                    <th scope="col">Driver name</th>
                                                                    <th scope="col">Team</th>
                                                                    <th scope="col">Time</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $finished_qualys_results_counter = 0;
                                                                while($finished_qualys_results_counter <= 19){
                                                                    $qualys_result = $finished_qualys_results[$qualys_row_counter+$finished_qualys_results_counter];
                                                                
                                                            ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $qualys_result["Position"];?></th>
                                                                    <td><?php echo $qualys_result["Driver name"];?></td>
                                                                    <td><?php echo $qualys_result["Team"];?></td>
                                                                    <td><?php echo $qualys_result["Time"];?></td>
                                                                </tr>
                                                                
                                                            <?php
                                                                ++$finished_qualys_results_counter;
                                                                }
                                                            ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="track">
                                            <h3>Track details:</h3>
                                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($datas['Track picture']).'"width="100%" alt="...">'?>
                                            <table class="table">
                                                <tr>
                                                    <th>Track name:</th>
                                                    <td><?php echo $datas["Track name"];?></td>
                                                </tr>
                                                <tr>
                                                    <th>Country:</th>
                                                    <td><?php echo $datas["Country"];?></td>
                                                </tr>
                                                <tr>
                                                    <th>Lap length:</th>
                                                    <td><?php echo $datas["Track length"];?></td>
                                                </tr>
                                                <tr>
                                                    <th>Number of laps:</th>
                                                    <td><?php echo $datas["Number of laps"];?></td>
                                                </tr>
                                                <tr>
                                                    <th>Race length:</th>
                                                    <td><?php echo $datas["Race distance"];?></td>
                                                </tr>
                                                <tr>
                                                    <th>Number of corners:</th>
                                                    <td><?php echo $datas["Number of corners"];?></td>
                                                </tr>
                                            </table>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            ++$podium_counter;
            $race_row_counter += 20;
            $qualys_row_counter += 20;
            }
        ?>

        <?php
            $upcomming_race_details_data = array();
            $upcomming_race_details_data = getUpcommingRaceDetails();
            $upcomming_races_counter = 0;

            foreach($upcomming_races_data as $datas){
        ?>
                <div class="col">
                     <div class="card h-100">
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($datas['Country flag']).'" class="card-img-top" alt="...">'?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $datas["Beggining Date"];?> - <?php echo $datas["Finishing Date"];?></h5>
                            <p class="card-text"><?php echo $datas["Race name"];?></p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $datas["Race name PK"];?>">
                            More detail
                        </button>
                    </div>
                </div>

                <div class="modal fade modal_upcomming" id="<?php echo $datas["Race name PK"];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?php echo $datas["Race name PK"];?>Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="<?php echo $datas["Race name PK"];?>Label"><?php echo $datas["Race name"];?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <h3>Weekend details:</h3>
                                    <table class="table">
                                        <?php
                                        $race_details=$upcomming_race_details_data[$upcomming_races_counter];
                                        ?>

                                        <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Session</th>
                                                <th scope="col">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $race_details["Qualy date"];?></th>
                                                <td>Qualifying</td>
                                                <td><?php echo $race_details["Qualy time"];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo $race_details["Race date"];?></th>
                                                <td>Race</td>
                                                <td><?php echo $race_details["Race time"];?></td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <div class="track">
                                        <h3>Track details:</h3>
                                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($datas['Track picture']).'"width="100%" alt="...">'?>
                                        <table class="table">
                                            <tr>
                                                <th>Track name:</th>
                                                <td><?php echo $datas["Track name"];?></td>
                                            </tr>
                                            <tr>
                                                <th>Country:</th>
                                                <td><?php echo $datas["Country"];?></td>
                                            </tr>
                                            <tr>
                                                <th>Lap length:</th>
                                                <td><?php echo $datas["Track length"];?></td>
                                            </tr>
                                            <tr>
                                                <th>Number of laps:</th>
                                                <td><?php echo $datas["Number of laps"];?></td>
                                            </tr>
                                            <tr>
                                                <th>Race length:</th>
                                                <td><?php echo $datas["Race distance"];?></td>
                                            </tr>
                                            <tr>
                                                <th>Number of corners:</th>
                                                <td><?php echo $datas["Number of corners"];?></td>
                                            </tr>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            ++$upcomming_races_counter;
            }
        ?>
        </div>
    </div>
    <footer class="footer">
        <div class="footer_content">
            <p>Ova web aplikacija napravljena je za završni rad na Fakultetu Elektroitehnike, Računarstva i Informacijaskih Tehnologija.</p>
            <p>Luka Šarčević, preddiplomski studij računarstva, 2020./2021. akademska godina</p>
        </div>
    </footer>

    <script src="js/bootstrap.js"></script>
</body>
</html>