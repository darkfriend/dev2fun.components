<?php
/**
 * @author dev2fun (darkfriend)
 * @copyright (c) 2018, darkfriend <hi@darkfriend.ru>
 * @version 0.1.0
 */

IncludeModuleLangFile(__FILE__);

if (class_exists("dev2fun_components")) return;

class dev2fun_components extends CModule
{
    var $MODULE_ID = "dev2fun.components";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS = "Y";

    public function dev2fun_components()
    {
        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path . "/version.php");
        if (isset($arModuleVersion) && is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        } else {
            $this->MODULE_VERSION = '0.1.0';
            $this->MODULE_VERSION_DATE = '2020-07-13 10:00:00';
        }
        $this->MODULE_NAME = Loc::getMessage("DEV2FUN_MODULE_NAME_COMPONENTS");
        $this->MODULE_DESCRIPTION = Loc::getMessage("DEV2FUN_MODULE_DESCRIPTION_COMPONENTS");
        $this->PARTNER_NAME = "dev2fun";
        $this->PARTNER_URI = "http://dev2fun.com/";
    }

    public function DoInstall()
    {
        global $APPLICATION;
        if (!check_bitrix_sessid()) return;
        try {
            $this->installComponent();
            \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
            $APPLICATION->IncludeAdminFile(Loc::getMessage("D2F_COMPONENTS_STEP1"), __DIR__ . "/step1.php");
        } catch (Exception $e) {
            $APPLICATION->ThrowException($e->getMessage());
            return false;
        }
        return true;
    }

    public function installComponent()
    {
        if (!CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/{$this->MODULE_ID}/install/components", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components", true, true)) {
            throw new Exception(Loc::getMessage("ERRORS_INSTALL_COMPONENT"));
        }
    }

    public function DoUninstall()
    {
        global $APPLICATION;
        if (!check_bitrix_sessid()) return;
        try {
            $this->unInstallComponent();
            \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
            $APPLICATION->IncludeAdminFile(Loc::getMessage("D2F_COMPONENTS_UNSTEP1"), __DIR__ . "/unstep1.php");
        } catch (Exception $e) {
            $APPLICATION->ThrowException($e->getMessage());
            return false;
        }
        return true;
    }

    public function unInstallComponent()
    {
        DeleteDirFilesEx("/bitrix/components/dev2fun/yandex.zen");
    }
}
