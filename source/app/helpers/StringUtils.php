<?php

/**
 * Created by PhpStorm.
 * User: svaidya
 * Date: 7/30/15
 * Time: 2:02 PM
 */
class StringUtils
{
    /**
     * Returns true only if the $search is found in the $str
     *
     * @param $haystack
     * @param $needle
     *
     * @return bool
     *
     * Taken from
     * http://stackoverflow.com/questions/4366730/check-if-string-contains-specific-words (Thank you!)
     */
    public static function contains($haystack, $needle)
    {
        if (strpos($haystack, $needle) !== false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     *
     * Taken from
     * http://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php (Thank you!)
     */
    static function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     *
     * Taken from
     * http://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php (Thank you!)
     */
    static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

}