<?php 
function konversiNilaiKePoin($nilaiHuruf) {
    $konversi = [
        'A' => 4.00,
        'A-' => 3.70,
        'B+' => 3.50,
        'B' => 3.00,
        'B-' => 2.70,
        'C+' => 2.30,
        'C' => 2.00,
        'C-' => 1.70,
        'D' => 1.00,
        'E' => 0.00
    ];

    return isset($konversi[$nilaiHuruf]) ? $konversi[$nilaiHuruf] : 0.00;
}




?>