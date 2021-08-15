<?php
include_once 'connection.php';

function getDriverStandings(){
    $conn = connectToDB();

    $sql="SELECT ROW_NUMBER() OVER (ORDER BY SUM(rt.points) DESC) AS 'Position', SUM(rt.points) AS 'Points', 
    d.name AS 'Driver name', t.name_PK AS 'Team'
    FROM race_table AS rt, driver AS d, team AS t
    WHERE rt.driver_FK=d.driver_PK AND rt.team_FK=t.name_PK
    GROUP BY d.driver_PK
    ORDER BY SUM(rt.points) DESC";

    $driver_standings_query_result = mysqli_query($conn, $sql);
    $driver_standings = array();

    if (mysqli_num_rows($driver_standings_query_result) > 0) {
        while($row = $driver_standings_query_result-> fetch_assoc()) {
        $driver_standings[]=$row;
    }

    }
    else{
        echo "No result found";
    }
    mysqli_close($conn);

    return $driver_standings;
}


function getConstructorStandings(){
    $conn = connectToDB();

    $sql="SELECT ROW_NUMBER() OVER (ORDER BY SUM(rt.points) DESC) AS 'Position', SUM(rt.points) AS 'Points', t.name_PK AS 'Team', t.logo AS 'Team logo'
    FROM race_table AS rt, driver AS d, team AS t
    WHERE rt.driver_FK=d.driver_PK AND rt.team_FK=t.name_PK
    GROUP BY t.name_PK
    ORDER BY SUM(rt.points) DESC";

    $constructor_standings_query_result = mysqli_query($conn, $sql);
    $constructor_standings = array();

    if (mysqli_num_rows($constructor_standings_query_result) > 0) {
        while($row = $constructor_standings_query_result-> fetch_assoc()) {
        $constructor_standings[]=$row;
    }

    }
    else{
        echo "No result found";
    }
    mysqli_close($conn);

    return $constructor_standings;
}

?>