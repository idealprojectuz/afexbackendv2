<?php

function create_personalcontract($firstname, $lastname, $parrentname, $contractnumber, $shorttext, $currentdate, $first_payment, $price_mumber, $price_strings, $district, $birthday, $passportdata, $kimtomonidanberilgan, $berilgansana, $phone, $jshshr, $contract_expire, $addition_notes = null)
{
    include_once('lib/numberToWord.php');
    require 'vendor/autoload.php';
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
    $templateProcessor->setValues(
        [
            'contract_number' => $contractnumber,
            'first_name' => $firstname,
            'last_name' => $lastname,
            'parrent_name' => $parrentname,
            'product_shorttitle' => $shorttext,
            'currentdate' => $currentdate,
            'initial_payment_fixedvalue' => $first_payment,
            'price_numbers' => $price_mumber,
            'price_strings' => $price_strings,
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
            'yetqazish_kuni_soz' => raqamdanSozga($yetqazishkuni),
        ]
    );
    $pathtoSave = 'order.docx';
    $templateProcessor->saveAs($pathtoSave);
}
// create_personalcontract('Hayotbek', 'Samandarov', 'testing0011', "bu uskun juda zor lekin", "2- mart 2023-yil", '50', "Samandar o'g'li");
// create_personalcontract('Hayotbek', 'Samandarov', "Samandar o'g'li", "AFX-002233", "Salfetka ishlab chiqarish uskunasi", "3-mart 2023-yil", "50", "102 502 642", "bir yuz ikki mln besh yuz ikki ming olti yuz qirq ikki", "Xatirchi", "27.04.2003", "AB 022 11 22", "Xatirchi tumani iib", "30.01.2022", "+998900860011", "123123123123", "31.12.2023", "Bu php orqali yaratilmoqda");
