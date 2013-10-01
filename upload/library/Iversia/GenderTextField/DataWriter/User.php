<?php

class Iversia_GenderTextField_DataWriter_User extends XFCP_Iversia_GenderTextField_DataWriter_User
{
    protected function _getFields()
    {
        // Get the original fieldset from the parent class (XenForo_DataWriter_User)
        $fields = parent::_getFields();

        // Override
        $fields['xf_user']['gender'] = array(
            'type' => self::TYPE_STRING,
            'maxLength' => 50,
            'verification' => array('$this', '_verifyGender'),
            'default' => '');

        return $fields;
    }

    protected function _verifyGender(&$gender)
    {
        // Standardize white space in gender
        $gender = trim(preg_replace('/\s+/', ' ', $gender));

        // Censor the gender field using the board's censored words
        if ($gender !== XenForo_Helper_String::censorString($gender)) {
            $this->error(new XenForo_Phrase('please_enter_gender_expression_that_does_not_contain_any_censored_words'), 'gender');
            return false;
        }

        return true;
    }
}
