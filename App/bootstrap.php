<?php

require_once 'Core/Autoloader.php';
require_once 'Core/Helpers.php';

use Core\Autoloader;
use Actions\Calculation;
use Actions\Writer;

Writer::init();

echo 'Enter chip count:';
$chipCount = (int) fgets(STDIN, 255);

echo 'Enter fields count:';
$fieldsCount = (int) fgets(STDIN, 255);

$obj = new Calculation($chipCount, $fieldsCount);
$rows = $obj->getCombinations();

$count = count($rows);

if(count($rows) < 10) {
    Writer::write('Less than 10 variants');
} else {
    Writer::write('Total unique options - ' . $count);

    foreach($rows as $row) {
        Writer::write(implode(', ', $row));
    }
}