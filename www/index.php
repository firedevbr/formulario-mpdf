<?php

use League\Csv\Reader;

require_once 'vendor/autoload.php';

define('RECORDS_PER_COLUMN', 10);
define('MAX_FILES_PER_REQUEST', 50);

$splFile = new \SplFileObject('./doc.csv');
$delimiter = detectDelimiter('./doc.csv');
$csv = Reader::createFromFileObject($splFile);
$csv->setHeaderOffset(0);
$csv->setDelimiter($delimiter);

$total = $csv->count();

if ($total > MAX_FILES_PER_REQUEST) {
    die('envie no máximo 50 linhas por vez');
}

$records = $csv->getRecords(); //returns all the CSV records as an Iterator object
$titulo  = $_GET['titulo'];

$baseTemplate = file_get_contents('formulario.html');
$baseTemplate = str_replace('#TITULO#', $titulo, $baseTemplate);

$filesCreated = [];


$tarName = __DIR__ . '/tmp/' . uniqid('arquivos_') . '.tar';
$tarFile = new \PharData($tarName);

foreach ($records as $record) {
    $totalFields  = count($record);
    $totalColumns = ceil($totalFields / RECORDS_PER_COLUMN);
    $keys = array_keys($record);

    $columns = '';
    for ($i = 0; $i < $totalColumns; $i++) {
        $columns .= "<div id=\"dadosDoCliente\" style=\"float: left; width: 30%; padding-right: 10px\">";
        $currentField = $i * RECORDS_PER_COLUMN;

        for ($j = $currentField; $j < RECORDS_PER_COLUMN * ($i + 1); $j++) {
            if ($j >= $totalFields) {
                break;
            }

            $field = $keys[$j];
            $value = $record[$field];
            $columns .= "<b>{$field}</b>: <i>{$value}</i><br><br>";
        }
        $columns .= "</div>";
    }

    $baseTemplate = str_replace('#DIVSDADOS#', $columns, $baseTemplate);
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
    $mpdf->WriteHTML($baseTemplate);

    $tmpfname = __DIR__ . "/tmp/pdfs/" . uniqid("report") . '.pdf';
    $attachment = $mpdf->Output('', 'S');

    $handle = fopen($tmpfname, "w");
    fwrite($handle, $attachment);
    fclose($handle);

    $filesCreated[] = $tmpfname;
}

$tarFile->buildFromDirectory(__DIR__ . '/tmp/pdfs');
$tarFile->compress(\Phar::GZ);
foreach ($filesCreated as $file) {
    unlink($file);
}
unlink($tarName);

$fullTarName = $tarName . '.gz';
$size   = filesize($fullTarName);

header('Content-Type: application/tar+gzip');
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename=' . sprintf('"%s"', addcslashes(basename($fullTarName), '"\\')));
header('Content-Transfer-Encoding: binary');
header('Connection: Keep-Alive');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . $size);

ob_clean();
flush();
readfile($fullTarName);
unlink($fullTarName);

function detectDelimiter($csvFile): string
{
    $delimiters = [
        ';'  => 0,
        ','  => 0,
        '\t' => 0,
        '|'  => 0
    ];

    $handle = fopen($csvFile, "r");
    $firstLine = fgets($handle);
    fclose($handle);
    foreach ($delimiters as $delimiter => &$count) {
        $count = count(str_getcsv($firstLine, $delimiter));
    }

    return array_search(max($delimiters), $delimiters);
}