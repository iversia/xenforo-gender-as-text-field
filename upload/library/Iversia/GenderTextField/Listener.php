<?php

class Iversia_GenderTextfield_Listener
{
    // Classes
    public static function loadClassListener($class, &$extend)
    {
        if ($class == 'XenForo_DataWriter_User') {
            $extend[] = 'Iversia_GenderTextfield_DataWriter_User';
        }
    }
}
