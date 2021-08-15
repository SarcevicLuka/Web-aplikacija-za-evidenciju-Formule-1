<?php
include_once 'connection.php';


function getUpcommingRaceDetails(){
    $conn = connectToDB();

    $sql="SELECT CONCAT(DAY(q.beginning_date),'.',MONTH(q.beginning_date),'.') AS 'Qualy date', 
    CONCAT(LEFT(q.beginning_time,5),' - ',LEFT(q.finishing_time,5)) AS 'Qualy time', 
    CONCAT(DAY(r.beginning_date),'.',MONTH(r.beginning_date),'.') AS 'Race date', 
    LEFT(r.beginning_time,5) AS 'Race time' 
    FROM qualifying AS q, race AS r, race_weekend AS rw 
    WHERE q.race_weekend_FK=rw.race_weekend_PK AND r.race_weekend_FK=rw.race_weekend_PK AND q.beginning_date >= NOW() 
    GROUP BY rw.race_weekend_PK 
    ORDER BY q.beginning_date";

    $upcomming_Race_Details_query_result = mysqli_query($conn, $sql);
    $upcomming_Race_Details = array();

    if (mysqli_num_rows($upcomming_Race_Details_query_result) > 0) {
        while($row = $upcomming_Race_Details_query_result-> fetch_assoc()) {
        $upcomming_Race_Details[]=$row;
    }

    }
    else{
        echo "No result found";
    }
    mysqli_close($conn);

    return $upcomming_Race_Details;
}


?>