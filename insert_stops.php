<?php

/* Replace the special html characters */
function replace_special_character($text) {
str_replace("à", "&agrave;", $text); // Replace à with &agrave;
str_replace("è", "&egrave;", $text); // Replace è with &egrave;
str_replace("é", "&eacute;", $text); // Replace é with &egrave;
str_replace("ì", "&igrave;", $text); // Replace ì with &igrave;
str_replace("ò", "&ograve;", $text); // Replace ò with &ograve;
str_replace("ù", "&ugrave;", $text); // Replace ù with &ugrave;
return $text;
}

//Reverse geocoding
function getaddress($lat, $lng) {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' .$lat.','.$lng.'&location_type=ROOFTOP&result_type=street_address&key=AIzaSyDJsAOe6dwaE6lOx5od6OizqMijUpENBHU';
        $json = @file_get_contents($url);
        $data = json_decode($json);
        $status = $data->status;
        if ($status == "OK"){
          echo $data->results[0]->formatted_address;
            return $data->results[0]->formatted_address;
        }
        else{
            echo '<pre>';
            var_dump($data);
            echo '</pre>';
          echo "false!";
            return false;
        }
    }

//dati conn db
$servername = "127.0.0.1";
$username = "";
$password = "";
$dbname = "Mibac";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
  
setlocale(LC_ALL, 'it_IT.UTF-8');

$csv = array_map('str_getcsv', file('your directory path'));
$int = 0;

//array multidimensionale

foreach ($csv as $key1 => $value1) {
  foreach ($value1 as $key2 => $value2) {
      
    $value1[$key2] = replace_special_character($value1[$key2]); //special char
    $value1[$key2] = addslashes($value1[$key2]); //escape '
    $value1[$key2] = "'".$value1[$key2]."'";
  }


  $string = implode(",", $value1);
  $string = $string.",'1001','1','1'";
  $string = utf8_decode($string);

  echo '<pre>';
  var_dump($string);
  echo '</pre>';

//salto la prima stringa
  
  if ($int != 0){

        $sql = "INSERT INTO Fermate (id_fermata, nome_fermata, latitudine, longitudine, id_comune, id_provincia, id_regione) VALUES (".$string.")";

         if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
          } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }

  }
  $int++;
}   

$conn->close();
?>

