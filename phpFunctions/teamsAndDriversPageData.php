<?php
include_once 'connection.php';

function getTeamsData(){
    $conn = connectToDB();

    $sql = "SELECT t.name_PK AS 'Team name', t.logo AS 'Team logo', t.car_name AS 'Car name', t.car_picture AS 'Car picture', 
    t.principal AS 'Team principal', t.base AS 'Team base', d.name AS 'Driver name', d.car_number AS 'Driver number', 
    d.picture AS 'Driver picture', d.country_FK AS 'Country of origin' 
    FROM team AS t, driver AS d 
    WHERE t.name_PK=d.team_FK 
    ORDER BY t.name_PK";

    $teams_query_result = mysqli_query($conn, $sql);

    $teams = array();

    if (mysqli_num_rows($teams_query_result) > 0) {
        while($row = $teams_query_result-> fetch_assoc()) {
            $teams[]=$row;
        }

    }
    else{
        echo "No result found";
    }
    mysqli_close($conn);

    return $teams;
}

?>