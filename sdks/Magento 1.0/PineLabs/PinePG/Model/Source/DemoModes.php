<?php

/**
 * Description of PinePG config
 * @package   PineLabs_PinePG
 * @company   PineLabs - http://www.pinelabs.com/
 * @author    Naveen Goyal <naveen.goyal@pinelabs.com>
 */
 

class PineLabs_PinePG_Model_Source_DemoModes
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'test', 'label' => 'Test'),
            array('value' => 'live', 'label' => 'Live'),
        );
    }
}