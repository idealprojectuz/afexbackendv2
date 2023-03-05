<?php

function formatNumber($num)
{
    return preg_replace('/\B(?=(\d{3})+(?!\d))/u', ' ', strval($num));
}
