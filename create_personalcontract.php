<?php

include('lib/phpqrcode/qrlib.php');
include('lib/numberToWord.php');
include('lib/numberFormat.php');
require 'vendor/autoload.php';
$products = [
    [
        'name' => 'Keng formatli banner chop qilish uskunasi',
        'description' => "Ishlab chiqarilgan: Xitoy Ishlab chiqarilgan yil: 2023 Kuchlanish: 220 V 50 Hz Quvvat sarfi: 2,5 kw Chop etish kengligi: 3200 mm Boshchalar soni (golovlka): 2 dona Boshcha: EPSON i3200  Chop etish mumkin: Banner, orakal, natyajnoy potolok va h.k Chop etish tezligi: 20-40 m2 Tiniqlik darajasi: 1440 DPI Uskuna o'lchamlari: U4530*K830*B690mm Uskuna og'irligi: 500 kg",
        'price' => '12 590',
        'image' => 'https://afex.uz/wp-content/uploads/2023/04/vakuuk-2-kamerali.jpg'
    ],
    [
        'name' => 'Keng formatli banner chop qilish uskunasi',
        'description' => "Ishlab chiqarilgan: Xitoy Ishlab chiqarilgan yil: 2023 Kuchlanish: 220 V 50 Hz Quvvat sarfi: 2,5 kw Chop etish kengligi: 3200 mm Boshchalar soni (golovlka): 2 dona Boshcha: EPSON i3200  Chop etish mumkin: Banner, orakal, natyajnoy potolok va h.k Chop etish tezligi: 20-40 m2 Tiniqlik darajasi: 1440 DPI Uskuna o'lchamlari: U4530*K830*B690mm Uskuna og'irligi: 500 kg",
        'price' => '13 590',
        'image' => 'https://afex.uz/wp-content/uploads/2020/03/davomli-qadoqlash-300x300.jpg'
    ]
];

@create_personalcontract("Hayotbek", 'Samandarov', "Samandar o'g'li", "AFX-10/20", "Salfetka ishlab chiqarish uskunasi", "5-mart 2022-yil", "50", "120000000", "navoiy", "xatirchi", "27.04.2003", "AD0102211", "Xatirchi tumani iib", "31.01.2021", "+998900860011", "1233456123465123", "31.12.2023", "barcha to'lovlar qilinganidan kegin olib ketilishi kerak", "1 (bir) yil", "90", $products);

function create_personalcontract($firstname, $lastname, $parrentname, $contractnumber, $shorttext, $currentdate, $first_payment, $price_mumber, $region, $district, $birthday, $passportdata, $kimtomonidanberilgan, $berilgansana, $phone, $jshshr, $contract_expire, $addition_notes = null, $kafolat, $yetqazishkuni, $products)
{

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
    $templateProcessor->setValues(
        [
            'contract_number' => $contractnumber,
            'first_name' => ucfirst($firstname),
            'last_name' => ucfirst($lastname),
            'parent_name' => $parrentname,
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


    $templateProcessor->cloneBlock('product_table', count($products), true, true);
    for ($i = 0; $i < count($products); $i++) {
        $val = $i + 1;
        $templateProcessor->setValues(array(
            "product_title#{$val}" => $products[$i]['name'],
            "product_description#{$val}" => $products[$i]['description'],
        ));
        $templateProcessor->setValue("product_price#{$val}", $products[$i]['price']);
        $templateProcessor->setImageValue(
            "product_image#{$val}",
            array('path' => $products[$i]['image'], 'width' => 250, 'height' => 250,  'ratio' => false)
        );
    };





    $pathtoSave = 'order.docx';
    $templateProcessor->saveAs($pathtoSave);
};
