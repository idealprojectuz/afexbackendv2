<?php

require 'vendor/autoload.php';

use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');

$table = new Table(array('borderSize' => 5, 'borderColor' => 'black', 'width' => 9350, 'unit' => TblWidth::TWIP));
$table->addRow();
$table->addCell(250)->addText('Salfetka ishlab chiqarish uskunasi \n ishlab chiqarish quvvati 500 dona 24 soatda kuchlanish 220V ');
$table->addCell(250)->addImage(
    'qrcode.png',
    array(
        'width'         => 100,
        'height'        => 100,
        'marginTop'     => -1,
        'marginLeft'    => -1,
        'wrappingStyle' => 'behind'
    )
);
$table->addCell(250)->addImage(
    'qrcode.png',
    array(
        'width'         => 100,
        'height'        => 100,
        'marginTop'     => -1,
        'marginLeft'    => -1,
        'wrappingStyle' => 'behind'
    )
);


$templateProcessor->setComplexBlock('table', $table);

$pathtoSave = 'order.docx';
$templateProcessor->saveAs($pathtoSave);
