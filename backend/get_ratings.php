<?php 

$json = file_get_contents("php://input");

if (isset($json)) {

    $fetched = json_decode($json);

    $profId = $fetched->profId;
    $expertId = $fetched->expertId;

    $json = json_encode(array("profession_id"=> $profId,"expert_id"=> $expertId));

    echo $json;

} else {
    echo json_encode(array("error"=> "Проблемы с получением данных"));
}