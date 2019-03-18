<?php

/**
 * Description of ExtensionsStatusManager
 * @package   PineLabs_PinePG
 * @company   PineLabs - http://www.pinelabs.com/
 * @author    Naveen Goyal <naveen.goyal@pinelabs.com>
 */

class PineLabs_PinePG_PaymentController extends Mage_Core_Controller_Front_Action
{
    
    /*
    *Triggered when place order button is clicked
    */
   
    public function redirectAction()
    {
		
		$session = Mage::getSingleton('checkout/session');
		$order = Mage::getModel('sales/order');
          $order->loadByIncrementId($session->getLastRealOrderId());
            if (!$order->getId()) {
                Mage::throwException('No order for processing found');
            }
			//set order status
			$order_status=Mage_Sales_Model_Order::STATE_PENDING_PAYMENT;
			$comment= 'Customer has been redirected to PinePG';
             $order->setState($order_status, true, $comment);
			 $order->save();
	
	
	
        $this->getResponse()->setBody($this->getLayout()->createBlock('PinePG/redirect', 'PinePG', array(
            'template' => 'PinePG/redirect.phtml'
        ))->toHtml());
		//$order_status = Mage_Sales_Model_Order::STATE_PROCESSING;
		
				
        
		
		//echo "hello";
    }
	//}
   
    /*
    *Handle response from API
    */
   
    public function responseAction()
    {   
			
			// Your gateway's code to make sure the reponse you
			// just got is from the gatway and not from some weirdo.
			// This generally has some checksum or other checks,
			// and is provided by the gateway.
			// For now, we assume that the gateway's response is valid
			
		
	
	
      $response = $this->getRequest()->getParams();
	  
    
        if(Mage::helper('PinePG')->getConfigData('debug')) {
            Mage::log("Response:- ".print_r($response, true), Zend_Log::DEBUG, 'PinePG.log', true);
        }
		
        if (isset($response)) {
            $validated        = htmlentities($response['ppc_TxnResponseCode']);
            $hash_recievd     = $response['ppc_DIA_SECRET'];
            $PinePG_transid = $response['ppc_PinePGTransactionID'];
            $payment_method   = 'Credit Debit Card';
            $payment_instrument   = 'Online';
            $bank_name        = $response['ppc_AcquirerName'];
           // $emi_months       = $response['emi_months'];
           // if($emi_months == '')
           //     $emi_months       = 'N/A';
            $trans_status     = htmlentities($response['ppc_PinePGTxnStatus']);
            $orderId          = $response['ppc_UniqueMerchantTxnID'];
            $message          = htmlentities($response['ppc_TxnResponseMessage']);
            //$is_international = '0';$response['is_international'];
            //$fraud_action     = 'NA';$response['fraud_action'];
            //$fraud_detials    = 'NA';$response['fraud_details'];
            //if($fraud_details == '')
             //   $fraud_details = 'Accept';
            $allow            = array('1','INITIATED','PENDING');
            $configured_order_status     = Mage::helper('PinePG')->getConfigData('order_status');
            $comment          = 'PinePG Transaction Id : '.$PinePG_transid.'<br/>'.'Payment Method : '.$payment_method.'<br/>'.'Payment Instrument : '.$payment_instrument.'<br/>'.'Bank Name : '.$bank_name.'<br/>'.'Transaction Status : '.$trans_status.'<br/>'.'Transaction Response Code : '.$validated.'<br/>'.'Transaction Response Message : '.$message;  //'<br/>'.'Is_International : '.$is_international.'<br/>'.'Fraud Action : '.$fraud_action.'<br/>'.'Fraud Details : '.$fraud_details;
            
			unset($response['ppc_DIA_SECRET']);
			unset($response['ppc_DIA_SECRET_TYPE']);
			
			
			$secret_key     = Mage::helper('PinePG')->getConfigData('secret_key');
			$secret_key     = Mage::helper('PinePG')->Hex2String($secret_key);
			
			$hash_generated           = Mage::helper('PinePG')->getHash($response,$secret_key);

          //  $hash_generated   = Mage::helper('PinePG')->getHash($response,Mage::helper('PinePG')->getConfigData('secret_key'));
        
            if (in_array($validated, $allow) && $hash_recievd == $hash_generated) {
                // Payment was successful, so update the order's state, send order email and move to the success page
                $order = Mage::getSingleton('sales/order');
                $order->loadByIncrementId($orderId);
                $order_status = Mage_Sales_Model_Order::STATE_PROCESSING;
                if($configured_order_status == 'pending') {
					$order_status = Mage_Sales_Model_Order::STATE_PROCESSING;
                    //$order_status = Mage_Sales_Model_Order::STATE_PENDING_PAYMENT;
                }
				
                $order->setState($order_status, true, $comment);
                
                $order->sendNewOrderEmail();
                $order->setEmailSent(true);
                
                $order->save();
                
                Mage::getSingleton('checkout/session')->unsQuoteId();
                
                Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/success', array(
                    '_secure' => true
                ));
            } else {
                // There is a problem in the response we got
                Mage::getSingleton('core/session')->addError(htmlentities($message));
                $this->cancelAction($comment);
                Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/failure', array(
                    '_secure' => true
                ));
            }
		}
		
         else {
            Mage_Core_Controller_Varien_Action::_redirect('');
        } 
    }
    
    
    
    //Triggered to cancel the order
    

    public function cancelAction($reason)
    {
        if (Mage::getSingleton('checkout/session')->getLastRealOrderId()) {
            $order = Mage::getSingleton('sales/order')->loadByIncrementId(Mage::getSingleton('checkout/session')->getLastRealOrderId());
            if ($order->getId()) {
                // Flag the order as 'cancelled' and save it
                $order->cancel()->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, $reason)->save();
            }
        }
    }
}
?>