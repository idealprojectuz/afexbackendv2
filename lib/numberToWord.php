<?php
function raqamdanSozga($raqam)
{
    $sozlar = array(
        0 => '',
        1 => 'bir',
        2 => 'ikki',
        3 => 'uch',
        4 => 'to\'rt',
        5 => 'besh',
        6 => 'olti',
        7 => 'yetti',
        8 => 'sakkiz',
        9 => 'to\'qqiz',
        10 => 'o\'n',
        11 => 'o\'n bir',
        12 => 'o\'n ikki',
        13 => 'o\'n uch',
        14 => 'o\'n to\'rt',
        15 => 'o\'n besh',
        16 => 'o\'n olti',
        17 => 'o\'n yetti',
        18 => 'o\'n sakkiz',
        19 => 'o\'n to\'qqiz',
        20 => 'yigirma',
        30 => 'o\'ttiz',
        40 => 'qirq',
        50 => 'ellik',
        60 => 'oltmish',
        70 => 'yetmish',
        80 => 'sakson',
        90 => 'to\'qson',
        100 => 'yuz',
        1000 => 'ming',
        1000000 => 'million',
        1000000000 => 'milliard',
        1000000000000 => 'trillion'
    );

    if (!is_numeric($raqam)) {
        return false;
    }

    $raqam = (int)$raqam;

    if ($raqam < 0) {
        return 'minus ' . raqamdanSozga(abs($raqam));
    }
    $soz = '';
    if ($raqam <= 20) {
        $soz = $sozlar[$raqam];
    } elseif ($raqam < 100) {
        $soz = $sozlar[10 * floor($raqam / 10)];
        $boshqa = raqamdanSozga($raqam % 10);
        if ($boshqa) {
            $soz .= ' ' . $boshqa;
        }
    } elseif ($raqam < 1000) {
        $soz = $sozlar[floor($raqam / 100)] . ' ' . $sozlar[100];
        $boshqa = raqamdanSozga($raqam % 100);
        if ($boshqa) {
            $soz .= ' ' . $boshqa;
        }
    } else {
        foreach (array_reverse($sozlar, true) as $sozraqam => $sozsoz) {
            if ($sozraqam <= $raqam) {
                $soz .= raqamdanSozga(floor($raqam / $sozraqam)) . ' ' . $sozsoz . ' ';
                $raqam %= $sozraqam;
            }
        }
    }
    return $soz;
}
echo raqamdanSozga('123543');
