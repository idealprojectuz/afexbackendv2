<?php
require_once 'vendor/autoload.php';

$template = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');

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
$template->cloneBlock('product_table', count($products), true, true);
for ($i = 0; $i < count($products); $i++) {
    $val = $i + 1;
    $template->setValues(array(
        "product_title#{$val}" => $products[$i]['name'],
        "product_description#{$val}" => $products[$i]['description'],
    ));
    $template->setValue("product_price#{$val}", $products[$i]['price']);
    $template->setImageValue(
        "product_image#{$val}",
        array('path' => $products[$i]['image'], 'width' => 250, 'height' => 250,  'ratio' => false)
    );
};
$pathtoSave = 'order.docx';
$template->saveAs($pathtoSave);
