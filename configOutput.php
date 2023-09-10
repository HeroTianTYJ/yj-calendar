<?php

use yjrj\Solar;

bcscale(12);
include __DIR__ . '/extend/Lunar.php';
include __DIR__ . '/extend/Solar.php';

function year($year)
{
    $output = '<?php

return [';
    foreach ($year as $value) {
        $output .= '
    ' . $value . ' => [';
        for ($i = 1; $i <= 12; $i++) {
            for ($j = 1; $j <= date('t', strtotime($value . '-' . $i . '-01')); $j++) {
                $lunar = (new Solar($value, $i, $j))->getLunar();
                $shuJiu = $lunar->getShuJiu();
                $fu = $lunar->getFu();
                if ($shuJiu) {
                    $output .= "
        '" . $i . "-" . $j . "' => 9" . ['入九' => 0, '二九' => 1, '三九' => 2, '四九' => 3, '五九' => 4, '六九' => 5, '七九' => 6,
                            '八九' => 7, '九九' => 8][$shuJiu] . ',';
                }
                if ($fu) {
                    $output .= "
        '" . $i . "-" . $j . "' => 3" . ['入伏' => 0, '中伏' => 1, '末伏' => 2][$fu] . ',';
                }
            }
        }
        $output = substr($output, 0, -1) . '
    ],';
    }
    $output = substr($output, 0, -1) . '
];
';
    file_put_contents(__DIR__ . '/config.php', $output);
}

set_time_limit(0);
year(range(1892, 2100));
