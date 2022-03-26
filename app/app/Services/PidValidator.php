<?php

namespace App\Services;

// EGN code is taken from here: https://georgi.unixsol.org/programs/egn.php/view/

class PidValidator
{
    protected static $EGN_WEIGHTS = [2, 4, 8, 5, 10, 9, 7, 3, 6];

    public static function isPidValid($pid)
    {
        if (strlen($pid) != 10)
            return false;
        $year = substr($pid, 0, 2);
        $mon = substr($pid, 2, 2);
        $day = substr($pid, 4, 2);
        if ($mon > 40) {
            if (!checkdate($mon - 40, $day, $year + 2000)) return false;
        } else {
            if ($mon > 20) {
                if (!checkdate($mon - 20, $day, $year + 1800)) return false;
            } else {
                if (!checkdate($mon, $day, $year + 1900)) return false;
            }
        }
        $checksum = substr($pid, 9, 1);
        $pidsum = 0;
        for ($i = 0; $i < 9; $i++) {
            $pidsum += substr($pid, $i, 1) * self::$EGN_WEIGHTS[$i];
        }
        $valid_checksum = $pidsum % 11;
        if ($valid_checksum == 10) {
            $valid_checksum = 0;
        }
        if ($checksum == $valid_checksum) {
            return true;
        }

        return false;
    }
}
