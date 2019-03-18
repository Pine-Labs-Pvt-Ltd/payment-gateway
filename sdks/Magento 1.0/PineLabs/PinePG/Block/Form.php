<?php

/**
 * Description of ExtensionsStatusManager
 * @package   PineLabs_PinePG
 * @company   PineLabs - http://www.pinelabs.com/
 * @author    Naveen Goyal <naveen.goyal@pinelabs.com>
 */

class PineLabs_PinePG_Block_Form extends Mage_Payment_Block_Form {
    
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('PinePG/form.phtml')->setRedirectMessage(
                Mage::helper('PinePG')->__('You will be redirected to the Pinelabs Payment Gateway when you place an order.')
            );
    }

    /*
    *Return all allowed payment methods for PinePG like EMI,Debit Card etc
    */

    // public function getAllowedMethods() {
    // 	$available_methods = array();
    // 	$methods  = Mage::getStoreConfig('payment/PinePG/payment_methods');
    // 	$methods = explode(',',$methods);
    // 	$label_codes = Mage::getSingleton('PinePG/system_config_source_payment_methods')->toOptionArray();
    //     $availables = array();
    //     foreach($methods as $method) {
    //         foreach($label_codes as $label) {
    //             if($label['value'] == $method) {
    //                 $availables[] = $label;
    //             }
    //         }
    //     }
    //     return $availables;	
    // }
    
    
    // *Return allowed bank names for either payment method Net banking or EMI 
    

    // public function getBankNames($paymentMethod) {        
    //     $bankCodes = Mage::getStoreConfig('payment/PinePG/'.$paymentMethod);
    //     $bankCodes =  explode(',', $bankCodes);
    //     $bankLabels = Mage::getSingleton('PinePG/system_config_source_payment_bank_names')->toOptionArray();
    //     $availables = "";
    //     foreach($bankCodes as $code) {
    //         foreach($bankLabels as $label) {
    //             if($label['value'] == $code) {
    //                 $availables.= '<option value="'.$label["value"].'">'.$label["label"].'</option>';
    //             }
    //         }
    //     }
    //     return $availables;
    // }
}
?>
