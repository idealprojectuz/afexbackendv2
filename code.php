<?php

include('lib/phpqrcode/qrlib.php');
header('Content-Type: image/png');


echo QRcode::png('https://idealproject.uz/');
