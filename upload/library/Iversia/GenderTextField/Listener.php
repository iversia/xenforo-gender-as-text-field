<?php

class Iversia_GenderTextField_Listener
{
    // Classes
    public static function loadClassListener($class, &$extend)
    {
        if ($class == 'XenForo_DataWriter_User') {
            $extend[] = 'Iversia_GenderTextField_DataWriter_User';
        }
    }
}
