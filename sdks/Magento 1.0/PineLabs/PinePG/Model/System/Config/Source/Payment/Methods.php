<?php

/**
 * Description of ExtensionsStatusManager
 * @package   PineLabs_PinePG
 * @company   PineLabs - http://www.pinelabs.com/
 * @author    Naveen Goyal <naveen.goyal@pinelabs.com>
 */

class PineLabs_PinePG_Model_System_Config_Source_Payment_Methods
{
    
    /*
    *Return available payment methods for PinePG
    */

    public function toOptionArray()
    {
        $methods = array();
		$methods[] = array('value' => 'PINEPG' ,'label' => 'PinePG');
        $methods[] = array('value' => 'CREDIT' ,'label' => 'Credit Card');
        $methods[] = array('value' => 'DEBIT' ,'label' => 'Debit Card');
        $methods[] = array('value' => 'EMI' ,'label' => 'Credit Card EMI');
        $methods[] = array('value' => 'NET' ,'label' => 'Net Banking');
        return $methods;
    }
}
