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

    function saveToWebServer($animal, $longitude, $latitude, $deviceId,$time)
    {
        $conn2 = new mysqli("localhost", "root", "", "animaltracer1");
        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        mysqli_query($conn2, "INSERT INTO animalscenery (animalName,longitude,latitude,time,deviceId)
				VALUES('$animal','$longitude','$latitude','$time','$deviceId')");


    }

    function queryWebServer($deviceId)
    {
        $conn = new mysqli("localhost", "root", "", "animaltracer1");
        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        mysqli_query($conn,"Select animalName ,longitude, latitude ,time, cast(((strftime('%s', CURRENT_TIMESTAMP ) - strftime('%s', time)) /(60  )) as timeDiff) as diff from animalscenery natural join device where  diff < 30 and parkName in(select parkName from device where deviceId='" . $deviceId . "') and deviceId!='" . $deviceId . "'");

    }//Select animalName ,longitude, latitude ,time,deviceId,UNIX_TIMESTAMP(CURRENT_TIMESTAMP),UNIX_TIMESTAMP(time),UNIX_TIMESTAMP(CURRENT_TIMESTAMP) - UNIX_TIMESTAMP(time) from animalscenery natural join device where UNIX_TIMESTAMP(CURRENT_TIMESTAMP) - UNIX_TIMESTAMP(time) > 30 and parkName in(select parkName from device where deviceId="150DE") and deviceId!="150DE"
//Select animalName ,longitude, latitude ,time,deviceId,UNIX_TIMESTAMP(CURRENT_TIMESTAMP),UNIX_TIMESTAMP(time),(UNIX_TIMESTAMP(CURRENT_TIMESTAMP) - UNIX_TIMESTAMP(time))/60 from animalscenery natural join device where (UNIX_TIMESTAMP(CURRENT_TIMESTAMP) - UNIX_TIMESTAMP(time))/60 > 30 and parkName in(select parkName from device where deviceId="150DE") and deviceId!="150DE"

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