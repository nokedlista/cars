<?php

function CreateMaker($mysqli, $maker)
{
    $result = $mysqli->squery("INSERT INTO makers (name) VALUES ('$maker')");
    if (!$result)
    {
        echo "Hiba történt a $maker beszúrása közben.";
    }
    return $result;
}

function updateMaker($mysqli, $data)
{
    $makerName = $data['name'];
    $result = $mysqli->query("UPDATE makers SET name=$makerName");
    if (!$result)
    {
        echo "Hiba történt a $makerName beszúrása közben.";
        return $result;
    }
    $maker = getMakersByName($mysqli, $data['name']);
    return $result;
}

function getMakersByName($mysqli, $name)
{
    $result = $mysqli ->query("SELECT * FROM makers WHERE name = $name");
    $maker = $result->fetch_assoc();
    return $maker;
}

function delMaker($mysqli, $name)
{
    $result = $mysqli->query("DELETE makers WHERE id = $id");
    return $result;
}

function getAllMakers($mysqli)
{
    $result = $mysqli->query("SELECT * FROM makers");
    $makers = $result->fetch_assoc();
    $result = free_result();

    return $makers;
}


?>