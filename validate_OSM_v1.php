<html>
<body>
 
<?php
// FIXME !!! Should sanitize all user inputs! Risk of executing user code.
 
echo "Area id: " . $_GET["a"];
 
$t = microtime(true);
$micro = sprintf("%06d",($t - floor($t)) * 1000000);
$d = new DateTime( date('Y-m-d H:i:s.'.$micro,$t) );
$dateTime = $d->format("Y-m-d H:i:s.u");
 
?>
</br>
 
<img src="./validate_images/test_bing4_1_<?php echo $_GET["a"];?>.png"
alt="Area <?php echo $_GET["a"];?>" width="300" height="300"/>
 
<form action="validate_OSM_v1.php?a=<?php echo $_GET["a"] + 1;?>"
method="post">
 
<input type="hidden" name="a_validated" value="<?php echo $_GET["a"];?>">
<input type="hidden" name="prevDateTime" value="<?php echo $dateTime?>">
 
    <table>  
      <tr>  
         <td align="center"><input type="submit" value="&#13;&#10;Built-up&#13;&#10; "    name= "BU"></td>  
         <td align="center"><input type="submit" value="&#13;&#10;Not Built-up&#13;&#10; " name= "NBU"></td>
      </tr>
      <tr>
         <td align="center"><input type="submit" value="&#13;&#10;&nbsp;&nbsp;&nbsp;&nbsp;Fix Me&nbsp;&nbsp;&nbsp;&nbsp;&#13;&#10; "   name= "FM"></td>  
         <td align="center"><input type="submit" value="&#13;&#10;&nbsp;&nbsp;&nbsp;&nbsp;Skip&nbsp;&nbsp;&nbsp;&nbsp;&#13;&#10; "   name= "S"></td>  
      </tr>  
    <table>   
</br>
User (optional):<input type="text" size="15" maxlength="30" name="user" value="<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['user'])) {
    $user=$_POST['user'];
        echo $user;
    }
    }
?>"><br />
 
</form>
 
<i>
<?php

$ip=$_SERVER["REMOTE_ADDR"]; 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  echo "<A HREF='javascript:javascript:history.go(-1)'>Previous area (" .
    $_POST["a_validated"] . ")</A> saved as: ";
 
if (isset($_POST['BU'])) {
        echo "Built-up";
    $class="BU";
    }   elseif (isset($_POST['NBU'])){
        echo "Not Built-up";
    $class="NBU";
    }   elseif (isset($_POST['FM'])){
        echo "Fix Me";
    $class="FM";
    }   elseif (isset($_POST['S'])){
        echo "Skip";
    $class="S";
    }
 
echo "<br/>by user: " . $user;
 
 
$valFile = "validate_OSM_v1.csv";
$fh = fopen($valFile, 'a');
fwrite($fh, $_POST["a_validated"]. "\t" . "$class" .  "\t" .  $ip . "\t" .$_POST["prevDateTime"]  . "\t" . $dateTime . "\t" . $user  ."\n");
 
 
 }
echo "<br/>IP address: " . $ip;
?>
</i>
 
 
</body>
</html>
