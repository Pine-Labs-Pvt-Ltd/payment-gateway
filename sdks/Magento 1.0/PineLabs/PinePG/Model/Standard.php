<?php

/**
 * Description of ExtensionsStatusManager
 * @package   PineLabs_PinePG
 * @company   PineLabs - http://www.pinelabs.com/
 * @author    Naveen Goyal <naveen.goyal@pinelabs.com>
 */

class PineLabs_PinePG_Model_Standard extends Mage_Payment_Model_Method_Abstract {
	
        protected $_code = 'PinePG';
    	protected $_formBlockType = 'PinePG/form';
        protected $_infoBlockType = 'PinePG/info';
    	protected $_isInitializeNeeded      = true;
    	protected $_canUseInternal          = true;
    	protected $_canUseForMultishipping  = false;
    	
    	public function getOrderPlaceRedirectUrl() {
    		return Mage::getUrl('PinePG/payment/redirect', array('_secure' => true));
    	}
        
        /*
        *Assign payment method data to info object
        */

        public function assignData($data)
        {
           
            if (!($data instanceof Varien_Object)) {
                $data = new Varien_Object($data);
            }
            // $info = $this->getInfoInstance();
           
            // $payment_method = $data->getPinePGPaymentMethod();
            
            // $info->setPinePGPaymentMethod($payment_method);
           
            // if($payment_method == 'NET' || $payment_method == 'EMI') {
            //     $info->setPinePGBankName($data->getPinePGBankName());
            // }
            
            // if($payment_method == 'EMI') {
            //     $info->setPinePGEmiMonths($data->getPinePGEmiMonths());
            // }
            
            return $this;
        }

		public function getPinePGUrl()
		{	   
			switch( $this->getConfigData( 'trans_mode' ) )
			{
				case 'test':
					$url = 'https://uat.pinepg.in/PinePGRedirect/index';
					break;
				case 'live':
				default :
					$url = 'https://uat.pinepg.in/PinePGRedirect/index';
					break;
			}
			return( $url );
		}
        /*
        *Validate payment method's form fields
        */

 
        // public function validate()
        // {
        //     parent::validate();
            
        //     $errorMsg = "";
            
        //     $info = $this->getInfoInstance();

        //     $payment_method = $info->getPinePGPaymentMethod();
           
        //     if(empty($payment_method)){
        //         $errorCode = 'invalid_data';
        //         $errorMsg = $this->_getHelper()->__('Payment Method is required field');
        //     }

        //     if($errorMsg){
        //         Mage::throwException($errorMsg);
        //     }
        //     return $this;
        // }
}
?>
