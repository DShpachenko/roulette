<?php

namespace Actions;

class Writer
{
    public static function init()
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . 'Output.html', '');
    }

    public static function write($row)
    {
        $dir = $_SERVER['DOCUMENT_ROOT'] . 'Output.html';
        $file = fopen($dir, 'a');

        flock($file, LOCK_EX);
        fwrite($file, ($row . PHP_EOL));
        flock($file, LOCK_UN);
        fclose ($file);
    }
}