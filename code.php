<?php
require_once 'vendor/autoload.php';

// Create new Word document
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');

// Create section and set font style
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$section = $phpWord->addSection();
$fontStyle = ['spaceAfter' => 60, 'size' => 12];

// Add title style
$phpWord->addTitleStyle(1, ['size' => 14, 'color' => '000000', 'bold' => true]);

// Add TOC to section
$toc = $section->addTOC($fontStyle);
$toc->setMinDepth(1);
$toc->setMaxDepth(1);

// Create table with product name, price and image
$table = $section->addTable();
$table->addRow();
$table->addCell(4000)->addText('Product');
$table->addCell(2000)->addText('Price');
$table->addCell(4000)->addText('Image');
$table->addRow();
$table->addCell(4000)->addText('Product 1');
$table->addCell(2000)->addText('$19.99');
$table->addCell(4000)->addImage('http://afex.loc/product1.jpg', ['width' => 200, 'height' => 200]);
$table->addRow();
$table->addCell(4000)->addText('Product 2');
$table->addCell(2000)->addText('$29.99');
$table->addCell(4000)->addImage('http://afex.loc/product1.jpg', ['width' => 200, 'height' => 200]);

// Get table as XML and insert it into document
$xmlWriter = new \PhpOffice\PhpWord\Shared\XMLWriter(\PhpOffice\PhpWord\Shared\XMLWriter::STORAGE_MEMORY, './', \PhpOffice\PhpWord\Settings::hasCompatibility());
$tableWriter = new PhpOffice\PhpWord\Writer\Word2007\Element\Table($xmlWriter, $table);
$tableWriter->write();
$tableXml = $xmlWriter->getData();
\PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(false);
$templateProcessor->setValue('products', $tableXml);
\PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

// Save document as new file
$templateProcessor->saveAs('output.docx');
