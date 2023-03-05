<?php

include('lib/phpqrcode/qrlib.php');
include('lib/numberToWord.php');
include('lib/numberFormat.php');
require 'vendor/autoload.php';

function create_personalcontract($firstname, $lastname, $parrentname, $contractnumber, $shorttext, $currentdate, $first_payment, $price_mumber, $region, $district, $birthday, $passportdata, $kimtomonidanberilgan, $berilgansana, $phone, $jshshr, $contract_expire, $addition_notes = null, $kafolat, $yetqazishkuni, $qrcodeurl)
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
        global $qrcodeurl;
        QRcode::png($qrcodeurl, 'qrcode.png');
        return 'qrcode.png';
    });
    $pathtoSave = 'order.docx';
    $templateProcessor->saveAs($pathtoSave);
}
create_personalcontract('Hayotbek', "samandarov", "Samandar o'g'li", "AFX-10/30", "Salfetka ishlab chiqarish uskunasi", "4- mart 2023-yil", "50", "102452000", "Navoiy", "Xatirchi", "27.04.2003", "AD0102211", "Xatirchi tumani IIB boshqarmasi", "30.01.2021", "+998900860011", "123123123123123", "31.12.2023", $addition_notes = null, "1 (bir) yil", '90', 'https://afex.uz');
