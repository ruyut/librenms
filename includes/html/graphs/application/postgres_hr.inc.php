<?php

$name = 'postgres';
$scale_min = 0;
$colours = 'mixed';
$unit_text = 'Per Second';
$unitlen = 10;
$bigdescrlen = 15;
$smalldescrlen = 15;
$dostack = 0;
$printtotal = 0;
$addarea = 1;
$transparency = 15;

if (isset($vars['database'])) {
    $rrd_name_array = ['app', $name, $app->app_id, $vars['database']];
} else {
    $rrd_name_array = ['app', $name, $app->app_id];
}

$rrd_filename = Rrd::name($device['hostname'], $rrd_name_array);

$rrd_list = [
    [
        'filename' => $rrd_filename,
        'descr' => 'Blocks Read',
        'ds' => 'read',
        'colour' => 'AA5439',
    ],
    [
        'filename' => $rrd_filename,
        'descr' => 'Buffer Hits',
        'ds' => 'hit',
        'colour' => '28774F',
    ],
];

require 'includes/html/graphs/generic_v3_multiline.inc.php';
