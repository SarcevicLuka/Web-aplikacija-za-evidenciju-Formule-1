# Završni rad - Web aplikacija za evidenciju Formule 1

## Tema završnog rada

Napraviti web aplikaciju za evidenciju Formula 1 utrka, a uz to i
evidenciju cijele Formula 1 sezone jer osim utrka evidentiraju se timovi, vozači za pojedine timove
i poredak timova i vozača.

## Korištene tehnologije

### Front-end

* HTML 
* CSS
* Bootstrap

### Back-end

* XAMPP
* PHP
* SQL

## Kratak opis izrade
---
### Baza podataka 

Relacijska baza podataka izrađena je pomoću phpMyAdmin alata koji dolazi kao dio XAMPP-a. 
![E/R dijagram](https://user-images.githubusercontent.com/93555102/163152171-3d0b45f7-a634-4530-8b6a-f3f3eee69e48.png "E/R dijagram baze podataka")

### Front-end

Sučelje aplikacije izrađeno je pomoću Bootstrap-a za responzivan dizajn. Bootstrap također omogućava dodavanje komponenti kao što su modali, navigacijske trake, gridovi itd.

Primjer korištenja Bootstrapa možete pronaći u datoteci [mainPage.php](https://github.com/SarcevicLuka/Web-aplikacija-za-evidenciju-Formule-1/blob/main/mainPage.php) (linija 23-38 - stvaranje navigacijske trake).

### Back-end

Back-end aplikacije izrađen je u PHP-u uz SQL za upite koji se šalju bazi podataka pomoću PHP-a. 
Primjer korištenja PHP-a za izradu backenda možete pogledati u mapi [phpFunctions](https://github.com/SarcevicLuka/Web-aplikacija-za-evidenciju-Formule-1/tree/main/phpFunctions).
<br> <br>

### Primjer funkcije *getFirstPlaces()* iz mape *phpFunctions*
``` PHP
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
```

## Izgled aplikacije
---

### Početna stranica *mainPage.php*
<img src="https://user-images.githubusercontent.com/93555102/167248634-4aff5d44-c702-4400-bd85-b21ccb9d9283.png" alt="Početna stranica sa rasporedom utrka" width="800"/>
<img src="https://user-images.githubusercontent.com/93555102/167248695-506fed10-c41d-4114-9f72-a1737989b4d2.png" alt="Početna stranica - mobilni prikaz" width="200"/>
Mobilni prikaz

### Detalji o utrkama
<img src="https://user-images.githubusercontent.com/93555102/167248745-8639c31e-d3dc-4284-bc27-6fbf7c41ef7a.png" alt="Rezultati utrke" width="800"/>
<img src="https://user-images.githubusercontent.com/93555102/167248777-623468b0-ba2a-4aa5-be2a-56650edcce27.png" alt="Rezultati utrke - mobilni prikaz" width="200"/>
Mobilni prikaz

### Stranica poretka vozača i timova *standingsPage.php*
<img src="https://user-images.githubusercontent.com/93555102/167248879-3e83b2d9-91bc-4022-bbf8-7783221cffec.png" alt="Poredak timova" width="800"/>
<img src="https://user-images.githubusercontent.com/93555102/167248962-a33fa986-37d0-4ff1-861e-77a8e758faa1.png" alt="Poredak timova - mobilni prikaz" width="200"/>
Mobilni prikaz

### Stranica detalja o timovaima i vozačima *teamsAndDriversPage.php*
<img src="https://user-images.githubusercontent.com/93555102/167249057-02d8a87a-581b-4f29-8bf9-794cb437e7d6.png" alt="Informacije o timovima" width="800"/>
<img src="https://user-images.githubusercontent.com/93555102/167249076-45a02b35-49a0-44cb-9e3e-6034c5fd4847.png" alt="Informacije o timovima - mobilni prikaz" width="200"/>
Mobilni prikaz

---

Za dodatne inormacije o završnom radu pogledajte dokument [Završni rad - Luka Šarčević - Web aplikacija za evidenciju utrka Formule 1]()
