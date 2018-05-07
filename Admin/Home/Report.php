<?php
/**
 * Created by PhpStorm.
 * User: Dilusha
 * Date: 5/2/2018
 * Time: 11:41 AM
 */

class Report
{
    function webServerConnect()
    {
       /* $user="sql2236776";
          $password="cT6!mE8!";
          $database="sql2236776";
          $hostname="sql2.freesqldatabase.com";
          $port="3306";

        $conn = mysqli_connect($hostname,$user,$password,$database);
        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        */$conn = new mysqli("localhost", "root", "", "animaltracer1");

        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }

    function setMap($park)
    {
        $conn = $this->webServerConnect();
        $sql = "SELECT longitude,latitude from park  where parkName='" . $park . "'";
        $result = mysqli_query($conn, $sql);

        return $result;
    }


    function queryDb($park, $animal, $duration)
    {
        $conn = $this->webServerConnect();
        $sql = "";
        if ($animal == "all") {
            if ($duration == "prevoius day") {
                $sql = "Select animalName ,longitude, latitude from animalscenery natural join device where parkName='" . $park . "' and time > DATE_ADD(UTC_TIMESTAMP() , INTERVAL '-1' DAY) ";

            } else if ($duration == "last week") {
                $sql = "Select animalName ,longitude, latitude from animalscenery natural join device where parkName='" . $park . "' and  time > DATE_ADD(UTC_TIMESTAMP() , INTERVAL '-7' DAY) ";

            } else if ($duration == "last month") {
                $sql = "Select animalName ,longitude, latitude from animalscenery natural join device where parkName='" . $park . "' and  time > DATE_ADD(UTC_TIMESTAMP() , INTERVAL '-1' MONTH) ";


            } else if ($duration == "three months") {
                $sql = "Select animalName ,longitude, latitude from animalscenery natural join device where parkName='" . $park . "' and  time > DATE_ADD(UTC_TIMESTAMP() , INTERVAL '-3' MONTH)";

            }
        } else {
            if ($duration == "prevoius day") {
                $sql = "Select animalName ,longitude, latitude from animalscenery natural join device where parkName='" . $park . "' and  time > DATE_ADD(UTC_TIMESTAMP() , INTERVAL '-1' DAY) and animalName='" . $animal . "' ";

            } else if ($duration == "last week") {
                $sql = "Select animalName ,longitude, latitude from animalscenery natural join device where parkName='" . $park . "' and  time > DATE_ADD(UTC_TIMESTAMP() , INTERVAL '-7' DAY) and animalName='" . $animal . "' ";

            } else if ($duration == "last month") {
                $sql = "Select animalName ,longitude, latitude from animalscenery natural join device where parkName='" . $park . "' and  time > DATE_ADD(UTC_TIMESTAMP() , INTERVAL '-1' MONTH) and animalName='" . $animal . "'  ";


            } else if ($duration == "three months") {
                $sql = "Select animalName ,longitude, latitude from animalscenery natural join device where parkName='" . $park . "' and  time > DATE_ADD(UTC_TIMESTAMP() , INTERVAL '-3' MONTH) and animalName='" . $animal . "' ";

            }
        }
        $myArray = array();
        if ($is_query_run = mysqli_query($conn, $sql)) {

            while ($row = mysqli_fetch_array($is_query_run, MYSQLI_ASSOC)) {
                $myArray[] = $row;


            }
        }
        return $myArray;
    }
}