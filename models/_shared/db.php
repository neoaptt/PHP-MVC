<?php

class db {

    public static function getPDO() {
        $pdo = new PDO("mysql:host=127.0.0.1;dbname=php", 'test', 'test');
        /* Uses actual mysql prepared statement instead of emulating them. */
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        /* If PDO errors out, throw an exception so we can see it */
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    /**
     * Makes string html safe
     * @param type $var
     * @return string
     */
    public static function sanatize($var, $length = 0) {
        if (is_string($var) && !empty($var)) {
            $l1 = 0;
            $l2 = 1;
            while ($l1 != $l2) {
                $l1 = strlen($var);
                $var = trim(htmlspecialchars_decode($var, ENT_QUOTES));
                $l2 = strlen($var);
            }
            $var = str_replace('&nbsp;', ' ', $var);
            $var = strip_tags($var);
            $var = htmlspecialchars($var, ENT_COMPAT, 'utf-8');
        } else {
            $var = '';
        }
        if ($length > 0 && strlen($var) > $length) {
            $var = substr($var, 0, $length) . '...';
        }
        return $var;
    }

    public static function nl2p($string) {
        $paragraphs = '';

        foreach (explode("\n", $string) as $line) {
            if (trim($line)) {
                $paragraphs .= '<p>' . $line . '</p>';
            }
        }

        return $paragraphs;
    }
    
    public static function commaInt($string) {
        $numComOnly = preg_replace('/[^0-9,]/', '', $string);
        $noStartEndCom =  preg_replace('/^,+|,+$/', '', $numComOnly);
        $noRepeatCom = preg_replace('/,+/', ',',$noStartEndCom);
        return $noRepeatCom;
    }

}
