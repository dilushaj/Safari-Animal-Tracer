<?php
/**
 * Created by PhpStorm.
 * User: Dilusha
 * Date: 3/30/2018
 * Time: 5:09 PM
 */

class Park
{
    function savePark($park,  $latitude ,$longitude)
    {
        echo "<script> alert('Look Dilusha i came here')</script>";
        $conn = new mysqli("localhost", "root", "", "animaltracer1");
        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        mysqli_query($conn, "Insert into park(parkName,longitude, latitude) values ('$park','$longitude','$latitude')");


    }
}