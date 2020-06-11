<?php

require_once 'mpdf/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('

<h1>Ficha Cadastral</h1>

<img style="max-height: 600px;
max-width: 800px;
width: 480px;
height: 480px;" src="face_ficha_clinica.jpg" alt="">

');



$mpdf->Output();
