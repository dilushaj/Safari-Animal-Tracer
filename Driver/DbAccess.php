<?php


class DbAccess
{
    function localDbConnect()
    {
        $conn1 = new SQLite3('mydatabase.sqlite');
        return $conn1;
    }

    function webServerConnect()
    {
        $user="sql12236689";
        $password="K5sNSDtjMl";
        $database="sql12236689";
        $hostname="sql12.freesqldatabase.com";
        $port="3306";

        $conn = mysqli_connect($hostname,$user,$password,$database);
        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        return $conn ;
    }

    function saveToLocalDatabase($animal, $longitude, $latitude, $broadcasted, $time)
    {
        $displayed = "notlocallyDisplayed";
        $conn1 = $this->localDbConnect();
        $sql = "INSERT INTO Animal (`animalName`, `longitude`, `latitude`,`time`,`globalStatus`,`localStatus`) VALUES ('$animal','$longitude','$latitude','$time','$broadcasted' ,'$displayed')";
        $conn1->query($sql);


    }

    function saveToWebServer($animal, $longitude, $latitude, $deviceId, $time)
    {
        $conn2 = $this->webServerConnect();

        mysqli_query($conn2, "INSERT INTO animalscenery (animalName,longitude,latitude,time,deviceId)
				VALUES('$animal','$longitude','$latitude','$time','$deviceId')");


    }

    function queryWebServer($deviceId)
    {
        $conn2 = $this->webServerConnect();

        $query = "Select animalName ,longitude, latitude ,time from animalscenery natural join device where((UNIX_TIMESTAMP(UTC_TIMESTAMP()) - UNIX_TIMESTAMP(time))/60) < 30 and parkName in(select parkName from device where deviceId='" . $deviceId . "' ) and deviceId!='" . $deviceId . "'";
        if ($is_query_run = mysqli_query($conn2, $query)) {

            while ($row = mysqli_fetch_array($is_query_run, MYSQLI_ASSOC)) {
                echo $row['animalName'] . '<br>';
                $this->saveToLocalDatabase($row['animalName'], $row['longitude'], $row['latitude'], "broadcasted", $row['time']);
            }
        }

    }


    function queryLocalDatabase()
    {
        $conn1 = $this->localDbConnect();
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
        $conn2 = $this->webServerConnect();
        $sql2 = "SELECT longitude,latitude from park natural join device where deviceId='" . $deviceId . "'";
        $result = mysqli_query($conn2, $sql2);
        return $result;
    }

    function refresh(){
        $conn1 = $this->localDbConnect();
        $conn1->query("begin transaction");
        $sql = "Delete from animal";
        $conn1->query($sql);
        $conn1->query("commit");
        $conn1->close();

    }
    function peerConnect(){
        $conn1 = $this->localDbConnect();
        $conn1->busyTimeout(5000);

        $sql1 = "Select animalName ,longitude, latitude ,globalStatus, time, cast(((strftime('%s', CURRENT_TIMESTAMP ) - strftime('%s', time)) /(60  )) as timeDiff) as diff from Animal where  diff < 30 ";

        $conn1->query("begin transaction");

        $sth = $conn1->prepare($sql1);
        $result = $sth->execute();
        $myArray = array(); //...create an array...
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $myArray[] = $row;

        }

        $conn1->query("commit");
        $conn1->close();
        return $myArray;
    }


}


?>