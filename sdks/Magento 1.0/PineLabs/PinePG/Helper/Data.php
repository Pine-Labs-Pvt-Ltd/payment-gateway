<?php
class PineLabs_PinePG_Helper_Data extends Mage_Core_Helper_Abstract
{

    /*
    *Return system configuration values
    */

    public function getConfigData($value) {
        return Mage::getStoreConfig('payment/PinePG/'.$value,Mage::app()->getStore());
    }
    
	//generate secret_key
	
	public function Hex2String($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
     }
     	
    /*
    *Generate Hash
    */

    public function gethash($dictionary,$secret_key) {
        
	//sort dictionary according to key value
	 ksort($dictionary);
	 $strString="";
	 
	 // convert dictionary key and value to a single string variable
	 foreach ($dictionary as $key => $val) {
	 	 $strString.=$key."=".$val."&";
	 }
	 
	 // trim last character from string
   	$strString = substr("$strString", 0, -1);
//	echo $strString."<br />";
	
	
     $code = strtoupper(hash_hmac('sha256', $strString, $secret_key));
     echo "<br />";
	 return $code;
	 
    }
}
