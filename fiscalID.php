<html>
<?php

$dbname = "identification";
$vocali=array("A","E","I","O","U");
$alfabetoMesi = array( 'A', 'B', 'C', 'D', 'E',
                       'H', 'L', 'M', 'P', 'R',
                       'S', 'T');
$alfabeto = array( 'A', 'B', 'C', 'D', 'E',
		   'F', 'G', 'H', 'I', 'J',
                    'K', 'L', 'M', 'N', 'O',
		   'P', 'Q', 'R', 'S', 'T',
		   'U', 'V', 'W', 'X', 'Y', 'Z');
$PD['0'] = 1; $PD['B'] = 0; $PD['M'] = 18; $PD['X'] = 25;
$PD['1'] = 0; $PD['C'] = 5; $PD['N'] = 20; $PD['Y'] = 24;
$PD['2'] = 5; $PD['D'] = 7; $PD['O'] = 11; $PD['Z'] = 23;
$PD['3'] = 7; $PD['E'] = 9; $PD['P'] = 3;
$PD['4'] = 9; $PD['F'] = 13; $PD['Q'] = 6;
$PD['5'] = 13; $PD['G'] = 15; $PD['R'] = 8;
$PD['6'] = 15; $PD['H'] = 17; $PD['S'] = 12;
$PD['7'] = 17; $PD['I'] = 19; $PD['T'] = 14;
$PD['8'] = 19; $PD['J'] = 21; $PD['U'] = 16;
$PD['9'] = 21; $PD['K'] = 2; $PD['V'] = 10;
$PD['A'] = 1; $PD['L'] = 4; $PD['W'] = 22;
$month[0] = "Gennaio";
$month[1] = "Febbraio";
$month[2] = "Marzo";
$month[3] = "Aprile";
$month[4] = "Maggio";
$month[5] = "Giugno";
$month[6] = "Luglio";
$month[7] = "Agosto";
$month[8] = "Settembre";
$month[9] = "Ottobre";
$month[10] = "Novembre";
$month[11] = "Dicembre";

$gender[0] = "Maschile";
$gender[1] = "Femminile";

$link = mysqli_connect("localhost","root","","$dbname") or die("Error " . mysqli_error($link));
if (!$link)
   echo "Impossibile connettersi al server";


$query = "SELECT `city_name` FROM `citta` ORDER BY `city_name`";
$result = mysqli_query($link, $query);

?>
<head>
  <title></title>
</head>

<body>
ID: <p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<table>
<tr><td>Surname:</td><td><input name="surname"></td></tr>
<tr><td>Name:</td><td><input name="name"></td></tr>
<tr><td>Born date</td>
<td>
<select name="DDN_day">
<option> - Day - </option>
<?php for($i = 1; $i <= 31; $i++) echo "<option value='$i'>$i</option>"; ?>
</select>
<select name="DDN_month">
	<option> - Month - </option>
	<?php foreach($month as $m) echo "<option value='$m'>$m</option>" ?>
</select>
<select name="DDN_year">
<option> - Year - </option>
<?php for($i = 1900; $i <= 2013; $i++) echo "<option value='$i'>$i</option>"; ?>
</select></td>
<tr>
<td>Sex:</td>
<td><select name="sex">
<?php foreach($gender as $g) echo "<option value='$g'>$g</option>" ?>
</select>
</td>
<tr>
<td>city of birth:</td>
<td><select name="city">
<?php
	while ($row = mysqli_fetch_row($result)) {
	echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
        }
	mysqli_free_result($result);
 ?>
</select></td>
</tr>
<tr> <td><input type="submit"><input type="reset"></td>
</tr>
</table>
</form>

<?php if($_POST)  {
$surname = $_POST['surname'];
$name = $_POST['name'];
$DG = $_POST['DDN_day'];
$DM = $_POST['DDN_month'];
$DA = $_POST['DDN_year'];
$gender = $_POST['sex'];
$city= $_POST['city'];
$parte[0] = "";
$parte[1] = "";
$parte[2] = "";
$parte[3] = "";
$parte[4] = "";
$parte[5] = "";
$parte[6] = "";
$surname = strtoupper($surname);
$nvocali = preg_match_all('/[AEIOU]/i',$surname,$matches1);
$nconsonanti = preg_match_all('/[BCDFGHJKLMNPQRSTVWZXYZ]/i',$surname,$matches2);
if($nconsonanti>=3)  $parte[0] = $matches2[0][0] . $matches2[0][1] . $matches2[0][2];
else
{
  
      for($i = 0; $i < $nconsonanti; $i++)
      {
            $parte[0] = $parte[0] . $matches2[0][$i];
      }
      $n = 3-strlen($parte[0]);
      for($i = 0; $i < $n; $i++)
      {
            $parte[0] = $parte[0] . $matches1[0][$i];
      }
      $n = 3-strlen($parte[0]);
      for($i = 0; $i < $n; $i++)  $parte[0] = $parte[0] . "X";
}
$name = strtoupper($name);
$nvocali = preg_match_all('/[AEIOU]/i',$name,$matches1);
$nconsonanti = preg_match_all('/[BCDFGHJKLMNPQRSTVWZXYZ]/i',$name,$matches2);
if($nconsonanti>=4) $parte[1] = $matches2[0][0] . $matches2[0][2] . $matches2[0][3];
else if($nconsonanti==3)  $parte[1] = $matches2[0][0] . $matches2[0][1] . $matches2[0][2];
else
{
      for($i = 0; $i < $nconsonanti; $i++)
      {
            $parte[1] = $parte[1] . $matches2[0][$i];
      }
      $n = 3-strlen($parte[1]);
      for($i = 0; $i < $n; $i++)
      {
            $parte[1] = $parte[1] . $matches1[0][$i];
      }
      $n = 3-strlen($parte[1]);
      for($i = 0; $i < $n; $i++)  $parte[1] = $parte[1] . "X";
}
$arryear = str_split($DA);
$parte[2] = $arryear[2] . $arryear[3];
$m = array_search($DM, $month);
$parte[3] = $alfabetoMesi[$m];
if($gender == "Maschile") $parte[4] = $DG;
else $parte[4] = $DG +40;
if(strlen($parte[4]) == 1) $parte[4] = "0" . $parte[4];
$query = "SELECT city_code_land FROM citta WHERE city_name = \"$city\"";
$result = mysqli_query($link, $query);
while ($row = mysqli_fetch_row($result))
{
       $parte[5] = $row[0];
}
mysqli_free_result($result);
$arrCOD = $parte[0] . $parte[1] . $parte[2] . $parte[3] . $parte[4] . $parte[5];
$arrCOD = str_split($arrCOD);
$index = count($arrCOD);
$somma1 = 0;
for($i = 0; $i < 15; $i++)
	if(($i+1)%2==0)
        {
              if(!in_array($arrCOD[$i], $alfabeto)) $somma1 += $arrCOD[$i];
              else
              {
                   $n = array_search($arrCOD[$i], $alfabeto);
                   $somma1 += $n;
              }
       }
$somma2 = 0;
for($i = 0; $i < 15; $i++)
	if(($i+1)%2!=0)
        {
         	$somma2 += $PD["$arrCOD[$i]"];
        }
$somma = $somma1+$somma2;
$parte[6] = ($somma % 26);
$parte[6] = $alfabeto[$parte[6]];
echo "ID code: $parte[0] $parte[1] $parte[2] $parte[3] $parte[4] $parte[5] $parte[6]";
mysqli_close($link);
} ?>

</body>

</html>
