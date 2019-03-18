<?php

/**
 * Description of ExtensionsStatusManager
 * @package   PineLabs_PinePG
 * @company   PineLabs - http://www.pinelabs.com/
 * @author    Naveen Goyal <naveen.goyal@pinelabs.com>
 */

class PineLabs_PinePG_Model_System_Config_Source_Payment_Bank_Names
{
    
    /*
    *Return all possible bank names and thier codes
    */

    public function toOptionArray()
    {
          $names = array();
          $names[] =Array
          (
              'value' => 'ALB',
              'label' => 'Allahabad Bank'

          );
          $names[] =Array
          (
              'value' => 'AMEX',	
              'label' => 'American Express'

          );
          $names[] =Array
          (
              'value' => 'AND',
              'label' => 'Andhra Bank'

          );
          $names[] =Array
          (
              'value' => 'AXIS',	
              'label' => 'Axis Bank'

          );
          $names[] =Array
          (
              'value' => 'BARC',	
              'label' => 'Barclays Bank'

          );
          $names[] =Array
          (
              'value' => 'BOB',	
              'label' => 'Bank of Baroda'

          );
          $names[] =Array
          (
              'value' => 'BOBAH',	
              'label' => 'Bank of Bahrain and Kuwait'

          );
          $names[] =Array
          (
              'value' => 'BOI',	
              'label' => 'Bank of India'

          );
          $names[] =Array
          (
              'value' => 'BOM',	
              'label' => 'Bank of Maharashtra'

          );
          $names[] =Array
          (
              'value' => 'BOP',	
              'label' => 'Bank of Punjab'

          );
          $names[] =Array
          (
              'value' => 'BOR',	
              'label' => 'Bank of Rajasthan'

          );
          $names[] =Array
          (
              'value' => 'CBI',	
              'label' => 'Central Bank'

          );
          $names[] =Array
          (
              'value' => 'CBPL',	
              'label' => 'Centurion Bank of Punjab'

          );
          $names[] =Array
          (
              'value' => 'CITIBANK',	
              'label' => 'Citibank'

          );
          $names[] =Array
          (
              'value' => 'CITIUB',	
              'label' => 'City Union Bank'

          );
          $names[] =Array
          (
              'value' => 'CNB',	
              'label' => 'Canara Bank'

          );
          $names[] =Array
          (
              'value' => 'COP',	
              'label' => 'Corporation Bank'

          );
          $names[] =Array
          (
              'value' => 'COSCB',	
              'label' => 'Cosmos Co-op Bank'

          );
          $names[] =Array
          (
              'value' => 'CSBL',	
              'label' => 'Catholic Syrian Bank'

          );
          $names[] =Array
          (
              'value' => 'CUBL',	
              'label' => 'City Union Bank'

          );
          $names[] =Array
          (
              'value' => 'DBL',	
              'label' => 'Dhanalakshmi Bank'

          );
          $names[] =Array
          (
              'value' => 'DBS',	
              'label' => 'DBS Bank'

          );
          $names[] =Array
          (
              'value' => 'DCB',	
              'label' => 'Development Credit Bank'

          );
          $names[] =Array
          (
              'value' => 'DCBL',	
              'label' => 'Development Credit Bank'

          );
          $names[] =Array
          (
              'value' => 'DEUNB',	
              'label' => 'Deutsche Bank'

          );
          $names[] =Array
          (
              'value' => 'DHNB',	
              'label' => 'Dhanalakshmi Bank'

          );
          $names[] =Array
          (
              'value' => 'DNB',	
              'label' => 'Dena Bank'

          );
          $names[] =Array
          (
              'value' => 'DONEC',	
              'label' => 'Done Card'

          );
          $names[] =Array
          (
              'value' => 'FED',	
              'label' => 'Federal Bank'

          );
          $names[] =Array
          (
              'value' => 'GE',	
              'label' => 'GE Money'

          );
          $names[] =Array
          (
              'value' => 'HDFC',	
              'label' => 'HDFC Bank'

          );
          $names[] =Array
          (
              'value' => 'HIB',	
              'label' => 'Himalayan Bank'

          );
          $names[] =Array
          (
              'value' => 'HSBC',	
              'label' => 'HSBC'

          );
          $names[] =Array
          (
              'value' => 'ICICI',	
              'label' => 'ICICI Bank'

          );
          $names[] =Array
          (
              'value' => 'IDBI',	
              'label' => 'IDBI Bank'

          );
          $names[] =Array
          (
              'value' => 'IIB',	
              'label' => 'IndusInd Bank'

          );
          $names[] =Array
          (
              'value' => 'INB',	
              'label' => 'Indian Bank'

          );
          $names[] =Array
          (
              'value' => 'ING',	
              'label' => 'ING Vysya Bank'

          );
          $names[] =Array
          (
              'value' => 'IOB',	
              'label' => 'Indian Overseas Bank'

          );
          $names[] =Array
          (
              'value' => 'JKB',	
              'label' => 'J&K Bank'

          );
          $names[] =Array
          (
              'value' => 'JPMC',	
              'label' => 'JPMorgan Chase Bank'

          );
          $names[] =Array
          (
              'value' => 'KMB',	
              'label' => 'Kotak Bank'

          );
          $names[] =Array
          (
              'value' => 'KTKB',	
              'label' => 'Karnataka Bank'

          );
          $names[] =Array
          (
              'value' => 'KVB',	
              'label' => 'Karur Vysya Bank'

          );
          $names[] =Array
          (
              'value' => 'LVB',	
              'label' => 'Lakshmi Vilas Bank'

          );
          $names[] =Array
          (
              'value' => 'NBL',	
              'label' => 'Nabil Bank'

          );
          $names[] =Array
          (
              'value' => 'OBC',	
              'label' => 'Oriental Bank of Commerce'

          );
          $names[] =Array
          (
              'value' => 'PMCB',	
              'label' => 'Punjab & Maharashtra Co-op Bank'

          );
          $names[] =Array
          (
              'value' => 'PNB',	
              'label' => 'Punjab National Bank'

          );
          $names[] =Array
          (
              'value' => 'RBL',	
              'label' => 'Ratnakar Bank'

          );
          $names[] =Array
          (
              'value' => 'RBS',	
              'label' => 'RBS'

          );
          $names[] =Array
          (
              'value' => 'SACOB',	
              'label' => 'Saraswat Co-op Bank'

          );
          $names[] =Array
          (
              'value' => 'SBH',	
              'label' => 'State Bank of Hyderabad'

          );
          $names[] =Array
          (
              'value' => 'SBI',	
              'label' => 'State Bank of India'

          );
          $names[] =Array
          (
              'value' => 'SBM',	
              'label' => 'State Bank of Mysore'

          );
          $names[] =Array
          (
              'value' => 'SBT',	
              'label' => 'State Bank of Travancore'

          );
          $names[] =Array
          (
              'value' => 'SIB',	
              'label' => 'The South Indian Bank'

          );
          $names[] =Array
          (
              'value' => 'STDC',	
              'label' => 'Standard Chartered Bank'

          );
          $names[] =Array
          (
              'value' => 'SVCB',	
              'label' => 'Shamrao Vithal Co-op Bank'

          );
          $names[] =Array
          (
              'value' => 'SYNBK',	
              'label' => 'Syndicate Bank'

          );
          $names[] =Array
          (
              'value' => 'TJSB',	
              'label' => 'Thane Janata Sahakari Bank'

          );
          $names[] =Array
          (
              'value' => 'TNMB',	
              'label' => 'Tamil Nadu Merchantile Bank'

          );
          $names[] =Array
          (
              'value' => 'UCO',	
              'label' => 'UCO Bank'

          );
          $names[] =Array
          (
              'value' => 'UNI',	
              'label' => 'Union Bank of India'

          );
          $names[] =Array
          (
              'value' => 'UNITD',	
              'label' => 'United Bank of India',

          );
          $names[] =Array
          (
              'value' => 'VJYA',	
              'label' => 'Vijaya Bank'

          );
          $names[] =Array
          (
              'value' => 'YES',	
              'label' => 'Yes Bank'

          );
        
        return $names;
    }
}