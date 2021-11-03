<?php
class dht11{
 public $link='';
 function __construct($temperature, $humidity, $location){
  $this->connect();
  $this->storeInDB($temperature, $humidity, $location);
 }
 
 function connect(){
  $this->link = mysqli_connect('192.168.0.14','sa','1qazxsw2') or die('Cannot connect to the DB');
  mysqli_select_db($this->link,'arduino') or die('Cannot select the DB');
 }
 
 function storeInDB($temperature, $humidity,$location){
  $query = "insert into node set humidity='".$humidity."', temperature='".$temperature."' , location='".$location."'";
  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
 }
 
}
if($_GET['temperature'] != '' and  $_GET['humidity'] != ''){
 $dht11=new dht11($_GET['temperature'],$_GET['humidity'],$_GET['location']);
}
?>
