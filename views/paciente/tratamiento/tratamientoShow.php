<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/TratamientoModel.php');

if (isset($_GET['id'])) {
    $model = new TratamientoModel();
    $tratamiento = $model->find($_GET['id']);
    echo json_encode($tratamiento);
}
