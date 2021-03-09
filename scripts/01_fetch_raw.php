<?php
$reportPath = dirname(__DIR__) . '/raw/city';
for($y = 96; $y <= 109; $y++) {
    $fy = $y + 1911;
    $yPath = $reportPath . '/' . $fy;
    if(!file_exists($yPath)) {
        mkdir($yPath, 0777, true);
    }
    for($m = 1; $m <= 12; $m++) {
        $fm = str_pad($m, 2, '0', STR_PAD_LEFT);
        $targetFile = $yPath . '/' . $fm . '.csv';
        if(!file_exists($targetFile)) {
            $ym = str_pad($y, 3, '0', STR_PAD_LEFT) . $fm;
            $c = file_get_contents('https://events.bli.gov.tw/report/attachment_file/Report/month/' . $ym . '/1181101010.csv');
            if(!empty($c)) {
                file_put_contents($targetFile, mb_convert_encoding($c, 'utf-8', 'big5'));
            } else {
                $c = file_get_contents('https://events.bli.gov.tw/report/attachment_file/Report/month/' . $ym . '/11071101010.csv');
                if(!empty($c)) {
                    file_put_contents($targetFile, mb_convert_encoding($c, 'utf-8', 'big5'));
                }
            }
        }
    }
}