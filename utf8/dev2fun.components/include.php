<?php
/**
 * @author dev2fun <darkfriend>
 * @copyright (c) 2020, darkfriend <hi@darkfriend.ru>
 * @version 0.1.0
 */

IncludeModuleLangFile(__FILE__);

\Bitrix\Main\Loader::registerAutoLoadClasses(
    'dev2fun.components',
    array(
        'Dev2funComponents' => 'include.php',
    )
);

if(class_exists('Dev2funComponents')) return;

use \Bitrix\Main\Localization\Loc;

class Dev2funComponents
{
    public static $module_id = 'dev2fun.components';
    private static $instance;

    /**
     * Singleton instance
     * @return self
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}