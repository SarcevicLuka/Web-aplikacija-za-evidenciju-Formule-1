<?php
include_once 'connection.php';


function getFinishedRaces(){
    $conn = connectToDB();

    $sql = "SELECT CONCAT(DAY(rw.beginning_date),'.',MONTH(rw.beginning_date),'.') AS 'Beggining Date', 
    CONCAT(DAY(finishing_date),'.',MONTH(finishing_date),'.') AS 'Finishing Date', r.name_PK AS 'Race name', 
    c.country_flag AS 'Country flag', r.modal_id AS 'Race name PK', t.picture AS 'Track picture', t.name_PK AS 'Track name', 
    t.country_FK AS 'Country', t.length AS 'Track length', t.num_of_corners AS 'Number of corners', r.race_distance AS 'Race distance', 
    r.num_of_laps AS 'Number of laps' 
    FROM `race_weekend` AS rw, `race` AS r, `track` AS t, `country` AS c 
    WHERE rw.race_weekend_PK=r.race_weekend_FK AND r.track_FK=t.name_PK AND t.country_FK=c.countryName_PK AND r.beginning_date <= NOW() 
    ORDER BY rw.beginning_date";

    $finished_races_query_result = mysqli_query($conn, $sql);

    $finished_races = array();

    if (mysqli_num_rows($finished_races_query_result) > 0) {
        while($row = $finished_races_query_result-> fetch_assoc()) {
            $finished_races[]=$row;
        }

    }
    else{
        echo "No result found";
    }
    mysqli_close($conn);

    return $finished_races;
}




function getUpcommingRaces(){
    $conn = connectToDB();

    $sql = "SELECT CONCAT(DAY(rw.beginning_date),'.',MONTH(rw.beginning_date),'.') AS 'Beggining Date', 
    CONCAT(DAY(finishing_date),'.',MONTH(finishing_date),'.') AS 'Finishing Date', r.name_PK AS 'Race name', 
    c.country_flag AS 'Country flag', r.modal_id AS 'Race name PK', t.picture AS 'Track picture', t.name_PK AS 'Track name', 
    t.country_FK AS 'Country', t.length AS 'Track length', t.num_of_corners AS 'Number of corners', r.race_distance AS 'Race distance', 
    r.num_of_laps AS 'Number of laps' 
    FROM `race_weekend` AS rw, `race` AS r, `track` AS t, `country` AS c 
    WHERE rw.race_weekend_PK=r.race_weekend_FK AND r.track_FK=t.name_PK AND t.country_FK=c.countryName_PK AND r.beginning_date >= NOW() 
    ORDER BY rw.beginning_date";

    $upcomming_races_query_result = mysqli_query($conn, $sql);

    $upcomming_races = array();

    if (mysqli_num_rows($upcomming_races_query_result) > 0) {
        while($row = $upcomming_races_query_result-> fetch_assoc()) {
        $upcomming_races[]=$row;
    }

    }
    else{
        echo "No result found";
    }
    mysqli_close($conn);

    return $upcomming_races;
}


function getFinishedRacesResults(){
    $conn = connectToDB();

    $sql = "SELECT rt.position AS 'Position', d.name AS 'Driver name', t.name_PK AS 'Team', 
    rt.time_set AS 'Time', rt.points AS 'Points' 
    FROM race_table AS rt, race AS r, driver AS d, team AS t
    WHERE rt.race_FK=r.name_PK AND rt.driver_FK=d.driver_PK AND rt.team_FK=t.name_PK
    ORDER BY r.race_weekend_FK";

    $finished_races_results_query_result = mysqli_query($conn, $sql);

    $finished_races_results = array();

    if (mysqli_num_rows($finished_races_results_query_result) > 0) {
        while($row = $finished_races_results_query_result-> fetch_assoc()) {
        $finished_races_results[]=$row;
    }

    }
    else{
        echo "No result found";
    }
    mysqli_close($conn);

    return $finished_races_results;
}


function getFinishedQualysResults(){
    $conn = connectToDB();

    $sql = "SELECT qt.qualifying_FK AS 'Qualy key', qt.position AS 'Position', d.name AS 'Driver name', t.name_PK AS 'Team', qt.time_set AS 'Time'
    FROM qualifying_table AS qt, driver AS d, team AS t
    WHERE qt.driver_FK=d.driver_PK AND qt.team_FK=t.name_PK
    ORDER BY qt.qualifying_FK";

    $finished_qualys_results_query_result = mysqli_query($conn, $sql);

    $finished_qualys_results = array();

    if (mysqli_num_rows($finished_qualys_results_query_result) > 0) {
        while($row = $finished_qualys_results_query_result-> fetch_assoc()) {
        $finished_qualys_results[]=$row;
    }

    }
    else{
        echo "No result found";
    }
    mysqli_close($conn);

    return $finished_qualys_results;
}

?>