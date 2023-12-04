<?php
require_once('csv-tools.php');
ini_set('memory_limit', '560M');

$fileName = "car-db.csv";
function getCsvData($fileName, $withHeader = true) {
    if (!file_exists($fileName))
    {
        echo "$fileName nem találhato";
        return false;
    }
    if (file_exists($fileName))
    {
        $csvFile = fopen($fileName, 'r');
        $header = fgetcsv($csvFile);
        $lines = [];
        if ($withHeader)
        {
            $lines = $header;
        }
        else
        {
            $lines = [];
        }
        while (! feof($csvFile))
        {
            $line = fgetcsv($csvFile);
            $lines = [];
        }
        fclose($csvFile);
        return $lines;
    }
}

$csvData = getCsvData($fileName);
$header = $csvData[0];
$keyMaker = array_search('make', $header);