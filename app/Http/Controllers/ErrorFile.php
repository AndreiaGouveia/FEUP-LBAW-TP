<?php 


namespace App\Http\Controllers;


class ErrorFile {

    const ERRORFILE = "outputError.txt";

    public static function outputToFile($message, $date) {
        $fh = fopen(self::ERRORFILE, (file_exists(self::ERRORFILE)) ? 'a' : 'w');
        fwrite($fh, $date . " - " . $message . "\n");
        fclose($fh);
    }
}
