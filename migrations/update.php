<?php
/**
 * Created by PhpStorm.
 * User: darkfriend <hi@darkfriend.ru>
 * Date: 12.07.2020
 * Time: 20:54
 */
define("NO_KEEP_STATISTIC", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

try {
    \Bitrix\Main\Loader::includeModule('main');
    if(!\Bitrix\Main\Loader::includeModule('dev2fun.components')) {
        throw new Exception('dev2fun.components is not load!');
    }
    if (!CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/{$this->MODULE_ID}/install/components", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components", true, true)) {
        throw new Exception('No components coped!');
    }
    $result = 'Successful!';
} catch (Exception $e) {
    $result = 'Error! '.$e->getMessage();
}

echo $result;
die();