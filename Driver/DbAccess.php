<?php


class DbAccess
{

    function saveToLocalDatabase($animal, $longitude, $latitude, $broadcasted)
    {

        date_default_timezone_set('	Asia/Colombo');


        $displayed = "notlocallyDisplayed";
        $conn1 = new SQLite3('mydatabase.sqlite');
        $sql = "INSERT INTO Animal (`animalName`, `longitude`, `latitude`,`globalStatus`,`localStatus`) VALUES ('$animal','$longitude','$latitude','$broadcasted' ,'$displayed')";
        $conn1->query($sql);


    }

    function saveToWebServer($animal, $longitude, $latitude, $deviceId)
    {
        $conn2 = new mysqli("localhost", "root", "", "animaltracer1");
        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        date_default_timezone_set('	UTC');
        $time = date("Y-m-d H:i:s", time());
        mysqli_query($conn2, "INSERT INTO animalscenery (animalName,longitude,latitude,time,deviceId)
				VALUES('$animal','$longitude','$latitude','$time','$deviceId')");


    }

    function queryWebServer()
    {


    }

    function queryLocalDatabase()
    {
        $conn1 = new SQLite3('mydatabase.sqlite');
        $conn1->busyTimeout(5000);
        $conn1->exec('PRAGMA journal_mode = wal;');
        $sql1 = "Select animalName ,longitude, latitude , cast(((strftime('%s', CURRENT_TIMESTAMP ) - strftime('%s', time)) /(60  )) as timeDiff) as diff from Animal where localStatus=='notlocallyDisplayed' and diff < 30 ";

        $sql2 = "UPDATE Animal SET localStatus='locallyDisplayed' where localStatus=='notlocallyDisplayed' and cast(((strftime('%s', CURRENT_TIMESTAMP ) - strftime('%s', time)) /(60  )) as timeDiff) < 30  ";
        $conn1->query("begin transaction");

        $sth = $conn1->prepare($sql1);
        $result = $sth->execute();
        $myArray = array(); //...create an array...
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $myArray[] = $row;

        }


        $conn1->query($sql2);
        $conn1->query("commit");
        $conn1->close();
        return $myArray;
    }

    function setMap($deviceId)
    {
        $conn2 = new mysqli("localhost", "root", "", "animaltracer1");
        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        $sql2 = "SELECT longitude,latitude from park natural join device where deviceId='" . $deviceId . "'";


        $result = mysqli_query($conn2, $sql2);

        return $result;

    }

}

?>