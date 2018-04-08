
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Device Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">


            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>


    </head>

    <body>

        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="logo span4">
                        <h1><a href="">Device Register<span class="green">.</span></a></h1>
                    </div>
                    <div class="links span8">
                        <a class="home" href="../Home/index.html" rel="tooltip" data-placement="bottom" data-original-title="Home"></a>
                        <a class="logout" href="../Login/login.php" rel="tooltip" data-placement="bottom" data-original-title="Logout"></a>
                    </div>
                </div>
            </div>
        </div>
		
        <div class="register-container container">
            <div class="row">
                <div class="iphone span5">
                    <img src="assets/img/iphone.png" alt="">
                </div>
                <div class="register span6">
                    <form action="registerDevice.php" method="POST">
                        <h2><strong>REGISTER HERE</strong><span class="green"></span></h2>
                        <label for="deviceid">Device Id</label>
                        <input type="text" id="deviceid" name="deviceid" placeholder="Enter Device Id..." pattern="[0-9]{3}+/[DE]">
                        <label for="parkname">Select park:</label>
                        <?php
                        $conn1 = new PDO('mysql:host = localhost;dbname=animaltracer1','root','');
                        $sql = "SELECT parkName FROM park" ;
                        $stmt = $conn1->prepare($sql);
                        $stmt->execute();
                        $users = $stmt -> fetchAll();
                        ?>
                        <select name="park">
                            <?php foreach($users as $row):
                                ?>
                                <option value="<?=$row['parkName'];?>"><?=$row['parkName'];?></option>
                            <?php endforeach; ?>
                        </select>

                        <button type="button" name="AddPark"  onclick="location.href='../Login/js/addMap.php'"  >ADD NEW PARK</button><br><br>

                        <label for="Ownerid">Owner Id</label>
                        <input type="text" id="ownerid" name="ownerid" placeholder="Enter Owner Id..." pattern="[0-9]{3}+/[DR]">
                        
                        <label for="ownername">Owner Name</label>
                        <input type="text" id="ownername" name="ownername" placeholder="Responsible person...">
                        <label> Telephone Number 1(start with 94 instead of 0):  </label>
						<input type="text" name="tpNum1" placeholder="1st telephone no.."><br>
						<label> Telephone Number 2(start with 94 instead of 0):  </label> 
						<input type="text" name="tpNum2" placeholder="2nd telephone no.."><br><br><br>
                        <button type="submit">REGISTER</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.8.2.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>






    </body>
</html>