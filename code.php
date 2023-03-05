<?php
require 'vendor/autoload.php';
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');

$replacements = array(
    array('product_title' => 'test product Batman',   'product_description' => 'test product descriptio Gotham City', "product_image", $templateProcessor . setImageValue('product_image', 'qrcode.png')),
    array('product_title' => 'test product Superman', 'product_description' => 'test product descriptio Metropolis', "product_image", $templateProcessor . setImageValue('product_image', 'qrcode.png')),
    array('product_title' => 'test product Superman', 'product_description' => 'test product descriptio Metropolis', "product_image", $templateProcessor . setImageValue('product_image', 'qrcode.png')),
);
$templateProcessor->cloneBlock('afex_table', 0, true, false, $replacements);
$pathtoSave = 'testtable.docx';
$templateProcessor->saveAs($pathtoSave);
