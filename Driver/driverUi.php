
<!DOCTYPE html>
<html>
  <head>
        <link rel="stylesheet" type="text/css" href="device.css">

        <script type= "text/javascript" src="jquery1.js" id="jq"></script>
        <script src="device.js"></script>

        <script sync defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnd_83H7sRNr3PBi3GyBwAtCL8seHFKso&callback=initMap">
     </script>

      <script>
         localDbQuery();//,query two databases also
      </script>



  </head>
  <body onload="broadCast(); setCoordinates();">


  <h3> Animal Tracer For Safari Drivers</h3>
  <div id="map"></div>

  <div id="animal">
      <button class="button" name="elephant"  onclick="animalInvoke(this.name)">Elephant</button><br>
      <button class="button" name="tiger" onclick="animalInvoke(this.name)" style="float: right">Tiger</button><br><br>
      <button class="button" name="lion" onclick="animalInvoke(this.name)" >Lion</button><br>
      <button class="button" name="fox" onclick="animalInvoke(this.name)" style="float: right">Fox</button><br><br>
      <button class="button" name="bear" onclick="animalInvoke(this.name)" >Bear</button><br>
      <button class="button"  name="wolf" onclick="animalInvoke(this.name)" style="float: right">Wolf</button><br><br>
      <button class="button"  name="crocodile" onclick="animalInvoke(this.name)" >Crocodile</button><br>
      <button class="button"  name="deer" onclick="animalInvoke(this.name)" style="float: right">Deer</button><br><br>
      <button class="button"  name="peacock" onclick="animalInvoke(this.name)" >Peacock</button><br><br><br><br><br>
      <form action="DeviceUI.php">
          <button class="button"  name="logout" onclick="refresh();" type="submit" >LogOut</button>
      </form>
  </div>
  <br>
  </body>
</html>



