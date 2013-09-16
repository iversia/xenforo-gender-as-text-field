<?php

class Iversia_GenderTextfield_Installer
{
    private static $instance;

    protected $db;

    public static function getInstance()
    {
        if (!self::$instance) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    public static function install($existingAddOn, $addOnData)
    {
        if (XenForo_Application::$versionId < 1020031) {
            throw new XenForo_Exception('This Add-On requires XenForo version 1.2 or higher.');
        }

        $version = is_array($existingAddOn) ? $existingAddOn['version_id'] : 0;

        $db = XenForo_Application::get('db');

        // This is the very first installation
        if (!$existingAddOn) {

            // Change gender field to varchar(50)
            // This will *break* many add-ons (if not all) that use this field,
            // as well as the male/female gender avatars
            $db->query("ALTER TABLE `xf_user` CHANGE COLUMN `gender` `gender` varchar(50) NOT NULL DEFAULT ''");

        } else {
            // This is an upgrade
        }

        unset($db);

        return true;
    }

    public static function uninstall()
    {
        $db = XenForo_Application::get('db');

        // Clean up and remove all non-binary gender expressions
        $db->query("UPDATE `xf_user` SET `gender` = '' WHERE (`gender` != 'male' OR `gender` != 'female' OR `gender` != '')");

        // Change gender field back to enum('','male','female')
        $db->query("ALTER TABLE `xf_user` CHANGE COLUMN `gender` `gender` enum('','male','female') NOT NULL");

        unset($db);
    }
}
