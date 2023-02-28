<?php

require_once(dirname(__DIR__) . '/models/Wines.php');


$model = new Wines();

$sql = $model->list();
//var_dump($sql->fetchAll());
echo json_encode($sql->fetchAll());




?>