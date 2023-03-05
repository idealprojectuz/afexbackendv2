<?php

include('lib/phpqrcode/qrlib.php');
include('lib/numberToWord.php');
include('lib/numberFormat.php');
require 'vendor/autoload.php';

function create_personalcontract($firstname, $lastname, $parrentname, $contractnumber, $shorttext, $currentdate, $first_payment, $price_mumber, $region, $district, $birthday, $passportdata, $kimtomonidanberilgan, $berilgansana, $phone, $jshshr, $contract_expire, $addition_notes, $kafolat, $yetqazishkuni)
{

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
    $templateProcessor->setValues(
        [
            'contract_number' => $contractnumber,
            'first_name' => ucfirst($firstname),
            'last_name' => ucfirst($lastname),
            'parrent_name' => $parrentname,
            'product_shorttitle' => $shorttext,
            'currentdate' => $currentdate,
            'initial_payment_fixedvalue' => $first_payment,
            'price_numbers' => formatNumber($price_mumber),
            'price_strings' => convertNumberToWord($price_mumber),
            'region' => $region,
            'district' => $district,
            'birthday' => $birthday,
            'passportdata' => $passportdata,
            'kimtomonidanberilgan' => $kimtomonidanberilgan,
            'berilgansana' => $berilgansana,
            'phone' => $phone,
            'jshshr' => $jshshr,
            'xaridor' => $firstname[1] == "'" || $firstname[1] == "`" ? strtoupper(substr($firstname, 0, 2)) . '.' . ucfirst($lastname) : strtoupper($firstname[0]) . '.' . ucfirst($lastname),
            'contracts_expire' => $contract_expire,
            'addition_notes' => $addition_notes != null ? $addition_notes : '___________________________________________________________',
            'yetqazish_kuni_sonda' => $yetqazishkuni,
            'yetqazish_kuni_soz' => convertNumberToWord($yetqazishkuni),
            'kafolat' => $kafolat,

        ]
    );
    $templateProcessor->setImageValue('qrcode', function () {
        QRcode::png('Afex.uz', 'qrcode.png');
        return 'qrcode.png';
    });
    $pathtoSave = 'order.pdf';
    $templateProcessor->saveAs($pathtoSave);
}
create_personalcontract("Hayotbek", 'Samandarov', "Samandar o'g'li", "AFX-10/20", "Salfetka ishlab chiqarish uskunasi", "5-mart 2022-yil", "50", "120000000", "navoiy", "xatirchi", "27.04.2003", "27.04.2003", "Xatirchi tumani iib", "31.01.2021", "+998900860011", "1233456123465123", "31.12.2023", "barcha to'lovlar qilinganidan kegin olib ketilishi kerak", "1 (bir) yil", "90");
