<?php

class Utility
{

    protected static $hive;
    protected static $baseUrl;

    /**
     * Returns Base url of the application.
     * @param string $url
     * @return string
     */
    public static function getBaseUrl($url = null)
    {
        $f3 = Base::instance();

        if (self::$hive == null) {
            $hive = self::$hive = $f3->hive();
            self::$baseUrl = $hive['SCHEME'] . '://' . $hive['HOST'] . ':' . $hive['PORT'] . $hive['BASE'] . '/';
        }
        if ($url !== null) {
            return self::$baseUrl . $url;
        }
        return self::$baseUrl;
    }

    /**
     * Returns real path of the UPLOADS directory.
     * @param type $file
     * @return type
     */
    public static function getRealpath($file = null)
    {
        $f3 = Base::instance();
        $uploadDir = $f3->get('UPLOADS');
        $path = realpath($uploadDir);
        return ($file !== null) ? $path . DIRECTORY_SEPARATOR . $file : $path;
    }

    /**
     * Returns the controllerName if it exists
     * Returns false if the $controllerName is not found
     *
     * @param $controllerName
     * @return bool or string
     */
    public static function checkControllerExists($controllerName)
    {
        $controllers = scandir("app/controllers");
        $filtered = preg_filter("/Controller.php$/", "", $controllers);
        foreach ($filtered as $it) {
            if (strtolower($it) == strtolower($controllerName)) {
                return $it;
            }
        }

        return false;

    }

}
