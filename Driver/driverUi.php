
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
  <body onload="broadCast()">


  <h3> Animal Tracer For Safari Drivers</h3>
  <div id="map"></div>

  <div id="animal">
  <button class="button" name="elephant"  onclick="animalInvoke(this.name)" >Elephant</button><br><br>
  <button class="button" name="tiger" onclick="animalInvoke(this.name)" style="float: right">Tiger</button><br><br><br>
  <button class="button" name="lion" onclick="animalInvoke(this.name)" >Lion</button><br><br>
  <button class="button" name="fox" onclick="animalInvoke(this.name)" style="float: right">Fox</button><br><br><br>
  <button class="button" name="bear" onclick="animalInvoke(this.name)" >Bear</button><br><br>
      <button class="button"  name="wolf" onclick="animalInvoke(this.name)" style="float: right">Wolf</button><br><br><br><br></div>
  <a><strong>Coordinates:</strong></a><br><br>
  <input type="text" class= "text-box" name="lat" placeholder="Latitude" id="text-box1" pattern="^[0-9]\d{0,9}(\.\d{1,3})?%?$"><br><br>
  <input type="text"  class= "text-box" name="long" placeholder="Longitude" id="text-box2"><br><br>
  <button class="button" onclick="setCoordinates()" >Set</button><br><br>
  </body>
</html>



