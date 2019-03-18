<?php

/**
 * Description of ExtensionsStatusManager
 * @package   PineLabs_PinePG
 * @company   PineLabs - http://www.pinelabs.com/
 * @author    Naveen Goyal <naveen.goyal@pinelabs.com>
 */

class PineLabs_PinePG_Block_Info extends Mage_Payment_Block_Info
{
    
    /*
    *Function transport selected option of payment method to progress bar on checkout
    */

    protected function _prepareSpecificInformation($transport = null)
    {
        if (null !== $this->_paymentSpecificInformation) {
            return $this->_paymentSpecificInformation;
        }
        $info = $this->getInfo();
        $transport = new Varien_Object();
        $transport = parent::_prepareSpecificInformation($transport);
        $transport->addData(array(
            Mage::helper('payment')->__('Payment Method') => $info->getPinePGPaymentMethod(),
        ));
        
       $bank_code  = $info->getPinePGBankName();
       $bank_name = $this->getBankName($bank_code);
       $emi_months = $info->getPinePGEmiMonths();
       if(! empty($bank_name)) {
            $transport->addData(array(
                Mage::helper('payment')->__('Bank Name') => $bank_name,
            ));    
       }
        
       if(! empty($emi_months)) {
            $transport->addData(array(
                Mage::helper('payment')->__('Emi Months') => $emi_months,
            ));    
       }
        
        return $transport;
    }

    /*
    *Return Bank name from bank code
    */

    public function getBankName($code) {
       $bank_labels = Mage::getSingleton('PinePG/system_config_source_payment_bank_names')->toOptionArray();
       foreach ($bank_labels as $label) {
         if($label['value'] == $code) {
            return $label['label'];
         }
       }

    }
}