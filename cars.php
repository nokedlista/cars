[8:33] Király Gábor
<?php
//require_once('csv-tools.php');
ini_set('memory_limit','560M');
$FileName  = "car-db.csv";
$csvData = getCsvData($FileName);
$result = [];
$maker = [];
$makers = [];
$header = $csvData[0];
$idxMaker = array_search ('make', $header);
$idxModel = array_search ('model', $header);
 
 
function getCsvData($FileName)
{
 
    if (!file_exists($FileName)) {
        echo "$FileName nem található. ";
        return false;
    }
    $csvFile = fopen($FileName, 'r');
    $lines = [];
    while (! feof($csvFile)) {
        $line = fgetcsv($csvFile);
        $lines[] = $line;
    }
    fclose($csvFile);
    return $lines;
}
 
function getMakers($csvData)
{
    if (empty($csvData)) {
        echo "Nincs adat.";
        return false;
    }
    $maker = '';
    $header = $csvData[0];
    $idxMaker = array_search ('make', $header);
    foreach ($csvData as $idx => $line) {
        if(!is_array($line)){
            continue;
        }
        if ($idx == 0) {
            continue;
        }
        if ($maker != $line[$idxMaker]){
            $maker = $line[$idxMaker];
            $makers[] = $maker;
        }
    }
    return $makers;
}
 
function insertMakers($mysqli, $makers, $truncate = false)
{
    $mysqli = new mysqli("localhost","root",null,"cars");
 
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
    $mysqli->query("TRUNCATE TABLE makers;");
    foreach ($makers as $maker){
        $mysqli->query("INSERT INTO makers (name) VALUES ('$maker')");
        echo "$maker\n";
    }
    return $result;
}
 
if (empty($csvData)) {
    echo "Nincs adat.";
    return false;
}
$maker = '';
$model = '';
foreach ($csvData as $idx => $line) {
    if(!is_array($line)){
        continue;
    }
    if ($idx == 0) {
        continue;
    }
    if ($maker != $line[$idxMaker]){
        $maker = $line[$idxMaker];
    }
    if ($model != $line[$idxModel]){
        $model = $line[$idxModel];
        $result[$maker][] = $model;
    }
}
 
//print_r($result);
$makers = getMakers($csvData);
$result = insertMakers($mysqli, $makers, true);
//print_r($makers);
 
/*
$result = $mysqli-> query("SELECT COUNT(id) as cnt FROM makers;");
$row = $result->fetch_assoc();
echo "{$row['cnt']} sor van;\n";
$mysqli -> close();
*/
?>