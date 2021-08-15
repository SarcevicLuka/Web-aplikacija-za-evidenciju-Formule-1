<?php
include_once 'connection.php';



function getFirstPlaces(){
    $conn = connectToDB();

    $sql="SELECT driver.name AS 'Driver name', race.name_PK, driver.picture AS 'Driver picture'
    FROM driver, race_table, race, race_weekend 
    WHERE driver.driver_PK=race_table.driver_FK AND race_table.position=1 
    AND race_weekend.race_weekend_PK=race.race_weekend_FK AND race.name_PK=race_table.race_FK 
    ORDER BY race_weekend.race_weekend_PK";

    $first_place_query_result = mysqli_query($conn, $sql);
    $first_place = array();

    if (mysqli_num_rows($first_place_query_result) > 0) {
        while($row = $first_place_query_result-> fetch_assoc()) {
        $first_place[]=$row;
    }

    }
    else{
        echo "No result found";
    }
    mysqli_close($conn);

    return $first_place;
}



function getSecondPlaces(){
    $conn = connectToDB();

    $sql="SELECT driver.name AS 'Driver name', race.name_PK, driver.picture AS 'Driver picture' 
    FROM driver, race_table, race, race_weekend 
    WHERE driver.driver_PK=race_table.driver_FK AND race_table.position=2 
    AND race_weekend.race_weekend_PK=race.race_weekend_FK AND race.name_PK=race_table.race_FK 
    ORDER BY race_weekend.race_weekend_PK";

    $second_place_query_result = mysqli_query($conn, $sql);
    $second_place = array();

    if (mysqli_num_rows($second_place_query_result) > 0) {
        while($row = $second_place_query_result-> fetch_assoc()) {
        $second_place[]=$row;
    }

    }
    else{
        echo "No result found";
    }
    mysqli_close($conn);

    return $second_place;
}



function getThirdPlaces(){
    $conn = connectToDB();

    $sql="SELECT driver.name AS 'Driver name', race.name_PK AS 'Race name', driver.picture AS 'Driver picture', team.logo AS 'Team logo' 
    FROM driver, race_table, race, race_weekend, team 
    WHERE driver.driver_PK=race_table.driver_FK AND race_weekend.race_weekend_PK=race.race_weekend_FK 
    AND race.name_PK=race_table.race_FK AND race_table.position=3 AND team.name_PK=driver.team_FK 
    GROUP BY race_table.race_FK 
    ORDER BY race_weekend.race_weekend_PK";

    $third_place_query_result = mysqli_query($conn, $sql);
    $third_place = array();

    if (mysqli_num_rows($third_place_query_result) > 0) {
        while($row = $third_place_query_result-> fetch_assoc()) {
        $third_place[]=$row;
    }

    }
    else{
        echo "No result found";
    }
    mysqli_close($conn);

    return $third_place;
}

?>