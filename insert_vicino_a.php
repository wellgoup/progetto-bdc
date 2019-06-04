<<?php 

// Distanza in km tra due punti identificati da latitudine e longitudine

function distanza($lat1,$lon1,$lat2,$lon2){

$distance = (3958*3.1415926*sqrt(($lat2-$lat1)*($lat2-$lat1) + cos($lat2/57.29578)*cos($lat1/57.29578)*($lon2-$lon1)*($lon2-$lon1))/180); 

echo"Miglia: ".$distance." Km: ".($distance/0.62137)." Metri: ".(($distance/0.62137)*1000);

}

//per ogni attrattore selezione tutte le fermate nel raggio di 1500m e //classifico le varie fermate con differente priorità:


//   10 - Distanza Attrattore-Fermata >= 1500m
//   9  - Distanza Attrattore-Fermata <= 1350m  e > 1200m	
//   8  - Distanza Attrattore-Fermata <= 1200m  e > 1050m
//   7  - Distanza Attrattore-Fermata <= 1050m  e > 900m
//   6  - Distanza Attrattore-Fermata <= 900m   e > 750m
//   5  - Distanza Attrattore-Fermata <= 750m   e > 600m
// 	 4  - Distanza Attrattore-Fermata <= 600m   e > 450m
//	 3  - Distanza Attrattore-Fermata <= 450m   e > 300m
//	 2  - Distanza Attrattore-Fermata <= 300m   e > 150m
//	 1  - Distanza Attrattore-Fermata <= 150m 

//connessione al db

$servername = "127.0.0.1";
$username = "root";
$password = "isolotto";
$dbname = "Mibac";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM Attrattori";

$result = $conn->query($sql);

$row = $result->fetch_array(MYSQLI_ASSOC);
  echo '<pre>';
  var_dump($row);
  echo '</pre>';

  $latA = $row['latitudine'];
  $lonA = $row['longitudine'];

echo '<pre>';
  var_dump($row['latitudine']);
  echo '</pre>';

echo '<pre>';
  var_dump($row['longitudine']);
  echo '</pre>';













 ?>