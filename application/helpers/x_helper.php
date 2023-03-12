<?php

function alive($data) {
    echo '<pre class="-debug">';
    print_r($data);
    echo '</pre>' . "\n";
}

if ( ! function_exists('tgl_indo'))
{
    function tgl_indo($tgl=null)
    {   
        $tgl    = date('Y-m-d', strtotime(substr($tgl, 0, 10)));
        $bulan  = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split = explode('-', $tgl);
        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }
}

if (!function_exists('nomor')) {
    function nomor($angka) {
        $rupiah =  number_format($angka,0,',','.');
        return $rupiah;
    }
}