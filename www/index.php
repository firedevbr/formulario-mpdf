<?php

require_once 'vendor/autoload.php';

$baseTemplate = file_get_contents('formulario.html');

$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
$mpdf->WriteHTML($baseTemplate);

$mpdf->Output();
