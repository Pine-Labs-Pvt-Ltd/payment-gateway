<?php

/**
 * Description of ExtensionsStatusManager
 * @package   PineLabs_PinePG
 * @company   PineLabs - http://www.pinelabs.com/
 * @author    Naveen Goyal <naveen.goyal@pinelabs.com>
 */

class PineLabs_PinePG_Block_Redirect extends Mage_Checkout_Block_Onepage_Abstract
{

    /*
    *Prepare request parameters for API request 
    */
	
    public function getRequestparams() {
        $_order                  = Mage::getSingleton('sales/order');
        $merchant_transaction_id = Mage::getSingleton('checkout/session')->getLastRealOrderId();
    	$_order->loadByIncrementId($merchant_transaction_id);
    	$payment_data            = $_order->getPayment()->getData();
        $shipping_address        = $_order->getShippingAddress();
        $billing_address         = $_order->getBillingAddress();
        $customerid              = $_order->getCustomerId();
    	//$amount                  = $_order->getBaseGrandTotal();
		
		//$sku = $_order->getSku(); 
		
		
		
		
		
		//$amount                  =number_format($_order->getBaseGrandTotal(),0);
		$amount                  = $_order->getBaseGrandTotal();
    	//$from_Currency           = Mage::app()->getStore()->getCurrentCurrencyCode();
        $orderItemDetails        = $this->getItemDetails($_order,$from_Currency);
    	
	//	$sku=$this->getItemDetails()->getsku();
        /* Required Variables*/
        
		
        $params['currency']                = "INR";
       // $params['ppc_UniqueMerchantTxnID'] = $ppc_UniqueMerchantTxnID;
	   
	   
    	$params['buyer_email_address']     = $_order->getBillingAddress()->getEmail();
		
        if($customerid != NULL && !isset($params['buyer_email_address'])) {
            $params['buyer_email_address'] = Mage::getSingleton('customer/session')->getCustomer()->getEmail();
        }
		
				
		$dictionary['ppc_UniqueMerchantTxnID']    = $merchant_transaction_id;
		//$dictionary['ppc_UniqueMerchantTxnID']    = 128;
		$dictionary['ppc_MerchantID']             = Mage::helper('PinePG')->getConfigData('ppc_MerchantID');
		$dictionary['ppc_MerchantAccessCode']     = Mage::helper('PinePG')->getConfigData('ppc_MerchantAccessCode');
		$dictionary['ppc_NavigationMode']         = Mage::helper('PinePG')->getConfigData('ppc_NavigationMode');
		$dictionary['ppc_LPC_SEQ']                = Mage::helper('PinePG')->getConfigData('ppc_LPC_SEQ');
		$dictionary['ppc_PayModeOnLandingPage']   = Mage::helper('PinePG')->getConfigData('ppc_PayModeOnLandingPage');
		$dictionary['ppc_TransactionType']        = 1;
		
		
		$_products= Mage::getSingleton('catalog/product');
		$dictionary['ppc_Product_Code']=$_products->getSku();
		  
		//$dictionary['ppc_Product_Code']   =1;
		
		$dictionary['ppc_Amount']                 = $amount*100;
		//$dictionary['ppc_Amount']                 = 9000000;
    	//$dictionary['ppc_Amount']                 = $this->convertCurrency($from_Currency,$params['currency'],$amount);
	
		
		$dictionary['ppc_MerchantReturnURL']   =   Mage::getUrl('PinePG/payment/response',array('_secure'=>true));
		
		
		
    	$params['ui_mode']                 = "REDIRECT";
    	
    	// $params['payment_method']          = $payment_data['PinePG_payment_method'];
    	// if(!empty ($payment_data['PinePG_bank_name'])):
    	// 	$params['bank_name']           = $payment_data['PinePG_bank_name'];
    	// endif;
    	// if(!empty ($payment_data['PinePG_emi_months'])):
    	// 	$params['emi_months']          = $payment_data['PinePG_emi_months'];
    	// endif;

        /*Optional Variables*/

        $params['buyer_phone_no']          = $billing_address->getData('telephone');
        $params['shipping_address']        = str_replace(array("\r", "\n"), '', $shipping_address->getData('street'));
        $params['is_user_logged_in']       = 'false';
        if($customerid != NULL) {
            $params['buyer_unique_id']     = $customerid;
            $params['is_user_logged_in']   = 'true';
            $params['address_count']       = count(Mage::getSingleton('customer/session')->getCustomer()->getAddresses());
        }
        $params['shipping_city']           = $shipping_address->getData('city');
        $params['shipping_state']          = $shipping_address->getData('region');
        $params['shipping_zip']            = $shipping_address->getData('postcode');
        $params['shipping_country']        = Mage::getSingleton('directory/country')->load($shipping_address->getData('country_id'))->getName();
        $params['billing_address']         = str_replace(array("\r", "\n"), '', $billing_address->getData('street'));
        $params['billing_city']            = $billing_address->getData('city');
        $params['billing_state']           = $billing_address->getData('region');
        $params['billing_zip']             = $billing_address->getData('postcode');
        $params['billing_country']         = Mage::getSingleton('directory/country')->load($billing_address->getData('country_id'))->getName();
        if($this->isMobile()) {
            $params['source']              = 'mobile';    
        } else {
            $params['source']              = 'magento_110';
        }
        $params['billing_name']            = $billing_address->getData('firstname');     
        $params['sales_channel']           = '';
        $params['item_total']              = $orderItemDetails['item_total'];
        $params['item_vertical']           = $orderItemDetails['item_vertical'];
       
        //$params['udf3']                    = Mage::helper('PinePG')->getConfigData('udf3');
        //$params['udf4']                    = Mage::helper('PinePG')->getConfigData('udf4');
        $params['udf5']                    = Mage::helper('PinePG')->getConfigData('udf5');

	  // return $dictionary;
	  return $dictionary;
    }

    /*
    *Return ordered items price and categories
    */
    
    public function getItemDetails($order,$currency) {
        $result = array();
        foreach($order->getAllItems() as $item) {
            $result['item_total'][]    = $this->convertCurrency($currency,'INR',$item->getPrice());
            $categories                = Mage::getSingleton('catalog/product')->load($item->getProductId())->getCategoryCollection()->exportToArray();
            foreach($categories as $category) {
                $category_names[]   = Mage::getSingleton('catalog/category')->load($category['entity_id'])->getName();
            }
	        $appended_category = str_replace(",", "_", $category_names);
            $category_list = implode('|',$appended_category);
            $result['item_vertical'][] =  $category_list;

            unset($category_names);
        }
        $result['item_total']        =  implode(',',$result['item_total']);
        $result['item_vertical']        =  implode(',',$result['item_vertical']);
        return $result;
    }

    /*
    *Convert current currency to INR and finally rupees to paisa
    */

    public function convertCurrency($from_Currency,$to_Currency,$amount) {
       
        $float_result = $amount;
    	return round($float_result,2)*100;
    }

    /*
    *Detect device
    */
    public function isMobile()
    {   
        if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
            return true;
        else
            return false;
    }
}
?>
