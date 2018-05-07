
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Location Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
    <link rel="stylesheet" href="../DevReg/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../DevReg/assets/css/style.css">

    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>


</head>

<body>

<div class="header">
    <div class="container">
        <div class="row">
            <div class="logo span4">
                <h1><a href="">Location Report<span class="green">.</span></a></h1>
            </div>
            <div class="links span8">
                <a class="home" href="index1.php" rel="tooltip" data-placement="bottom" data-original-title="Home"></a>
                <a class="logout" href="../Login/login.php" rel="tooltip" data-placement="bottom" data-original-title="Logout"></a>
            </div>
        </div>
    </div>
</div>

<div class="register-container container">
    <div class="row">
        <div class="iphone span5">
            <img src="../DevReg/assets/img/iphone.png" alt="">
        </div>
        <div class="register span6">
            <form action="history.php" method="POST">
                <h3><strong>Animal Location History</strong><span class="green"></span></h3>
                <label for="animalName">Select Animal Type:</label>
                <select name="animal" id="animal">
                    <option value="elephant">Elephants</option>
                    <option value="tiger">Tigers</option>
                    <option value="wolf">Wolf</option>
                    <option value="bear">Bears</option>
                    <option value="lion">Lions</option>
                    <option value="wolf">Wolf</option>
                    <option value="fox">Fox</option>
                    <option value="deer">Deer</option>
                    <option value="crocodile">Crocodile</option>
                    <option value="peacock">Peacock</option>
                    <option value="all">All Animals</option>

                </select>
                <label for="parkname">Select park:</label>
                <?php
                $conn1 = new PDO('mysql:host = localhost;dbname=animaltracer1','root','');
                $sql = "SELECT parkName FROM park" ;
                $stmt = $conn1->prepare($sql);
                $stmt->execute();
                $users = $stmt -> fetchAll();
                ?>
                <select name="park" id="park">
                    <?php foreach($users as $row):
                        ?>
                        <option value="<?=$row['parkName'];?>"><?=$row['parkName'];?></option>
                    <?php endforeach; ?>
                </select>
                <label for="duration">Select Duration:</label>
                <select name="duration" id="duration">
                    <option value="prevoius day">Previous Day</option>
                    <option value="last week">Last Week</option>
                    <option value="last month">Last Month</option>
                    <option value="three months">Last three months</option>


                </select>
                <button type="submit">Get Report</button>
            </form>
        </div>
    </div>
</div>

<!-- Javascript -->
<script src="../DevReg/assets/js/jquery-1.8.2.min.js"></script>
<script src="../DevReg/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../DevReg/assets/js/jquery.backstretch.min.js"></script>
<script src="../DevReg/assets/js/scripts.js"></script>

</body>
</html>
