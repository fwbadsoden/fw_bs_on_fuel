<?php

// to simplify updates, we post the helpers in the fuel module
require_once(FUEL_PATH . 'helpers/MY_date_helper.php');

/**
 * time_diff()
 * returns the difference of date2 and date1 objects in seconds
 * 
 * @param mixed $date_begin
 * @param mixed $date_end
 * @return
 */
if (!function_exists('time_diff')) {

    function time_diff($date_begin, $date_end) {
        $datetime1 = new DateTime($date_begin);
        $datetime2 = new DateTime($date_end);

        $dateinterval = $datetime1->diff($datetime2);
        $diff["total_minutes"] = (new DateTime())->setTimestamp(0)->add($dateinterval)->getTimestamp() / 60;
        $diff["total_hours_minutes"] = ($dateinterval->format("%d") * 24 + $dateinterval->format("%H")) . ":" . $dateinterval->format("%i");
        return $diff;
    }

}

/**
 * get_month_name()
 * Returns the month name for given int month
 * 
 * @param mixed $month
 * @return
 */
if (!function_exists('get_month_name')) {

    function get_month_name($month) {
        $months = array("", "Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
        $month = (int) $month;
        return $months[$month];
    }

}

/**
 * get_month_short_name()
 * Returns the month short name for given int month
 * 
 * @param mixed $month
 * @return
 */
if (!function_exists('get_month_short_name')) {

    function get_month_short_name($month) {
        $months = array("", "Jan", "Feb", "Mär", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez");
        $month = (int) $month;
        return $months[$month];
    }

}

/**
 * get_day_name()
 * Returns the day name in german for a given date
 * 
 * @param mixed $date
 * @return void
 */
function get_day_name($date) {
    $timestamp = mktime(0, 0, 0, substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4));
    $wochentag = date('w', $timestamp);

    $tag[0] = "Sonntag";
    $tag[1] = "Montag";
    $tag[2] = "Dienstag";
    $tag[3] = "Mittwoch";
    $tag[4] = "Donnerstag";
    $tag[5] = "Freitag";
    $tag[6] = "Samstag";

    return $tag[$wochentag];
}

/**
 * Validate german date
 * Input must be in german date format to work
 *
 * Input Y-m-d
 * Returns Boolean
 *
 * @access	public
 * @return	boolean
 */
if (!function_exists('is_valid_ger_date')) {

    function is_valid_ger_date($date) {
        $day = (int) substr($date, 0, 2);
        $month = (int) substr($date, 3, 2);
        $year = (int) substr($date, 6, 4);
        return checkdate($month, $day, $year);
    }

}

/**
 * Validate english date
 * Input must be in english date format to work
 *
 * Input Y-m-d
 * Returns Boolean
 *
 * @access	public
 * @return	boolean
 */
if (!function_exists('is_valid_eng_date')) {

    function is_valid_eng_date($date) {
        $day = (int) substr($date, 8, 2);
        $month = (int) substr($date, 5, 2);
        $year = (int) substr($date, 0, 4);
        return checkdate($month, $day, $year);
    }

}

/**
 * Validate time
 *
 * Input H:i:s
 * Returns Boolean
 *
 * @access	public
 * @return	boolean
 */
if (!function_exists('is_valid_time')) {

    function is_valid_time($time) {
        $arr = explode(":", $time);     // splitting the array
        if ($arr[0] >= 0 || $arr[0] < 24 || $arr[1] >= 0 || $arr[1] < 60 || $arr[2] >= 0 || $arr[2] < 60)
            return true;
        else
            return false;
    }

}

/**
 * Transform german to english datetime
 *
 * Input d.m.Y H:i:s
 * Returns Y-m-d H:i:s
 *
 * @access	public
 * @return	datetime
 */
if (!function_exists('get_eng_datetime')) {

    function get_eng_datetime($date) {
        if ($date != null) {
            $var = explode(" ", $date);
            $var2 = explode(".", $var[0]);
            $date = $var2[2] . "-" . $var2[1] . "-" . $var2[0] . " " . $var[1];
            "error";
            return($date);
        } else
            return "";
    }

}

/**
 * Transform german to english date
 *
 * Input d.m.Y
 * Returns Y-m-d
 *
 * @access	public
 * @return	datetime
 */
if (!function_exists('get_eng_date')) {

    function get_eng_date($date) {
        if ($date != null) {
            $var = explode(".", $date);
            $date = $var[2] . "-" . $var[1] . "-" . $var[0];
            return $date;
        } else
            return "";
    }

}

/**
 * Transform english to german datetime
 *
 * Input Y-m-d H:i:s
 * Returns d.m.Y H:i:s
 *
 * @access	public
 * @return	datetime
 */
if (!function_exists('get_ger_datetime')) {

    function get_ger_datetime($date) {
        if ($date != null) {
            $a = explode(" ", $date);
            $date = get_ger_date($a[0]);
            return $date . " " . $a[1];
        } else
            return "";
    }

}

/**
 * Transform english to german date
 *
 * Input Y-m-d 
 * Returns d.m.Y
 *
 * @access	public
 * @return	datetime
 */
function get_ger_date($date) {
    if ($date != null) {
        $a = explode("-", $date);
        return "" . $a[2] . "." . $a[1] . "." . $a[0] . "";
    } else
        return "";
}

function get_year($date) {
    if (strpos($date, '-') == 5)
        return substr($date, 0, 4);
    else
        return substr($date, 6, 4);
}

function get_alter($datum) {
    list($y, $m, $d) = explode('-', $datum);
    $alter = date('Y') - $y;
    $monat = date('m');
    if ($monat < $m or ( $monat == $m and $d > date('d'))) {
        $alter--;
    }
    return $alter;
}

function get_date_as_array($date) {
    return explode('-', $date);
}
