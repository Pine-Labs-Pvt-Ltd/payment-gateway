<?php

/**
 * Description of ExtensionsStatusManager
 * @package   PineLabs_PinePG
 * @company   PineLabs - http://www.pinelabs.com/
 * @author    Naveen Goyal <naveen.goyal@pinelabs.com>
 */
 
$installer = $this;
$installer->startSetup();
$installer->run("
 
ALTER TABLE `{$installer->getTable('sales/quote_payment')}` ADD `PinePG_payment_method` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE `{$installer->getTable('sales/quote_payment')}` ADD `PinePG_bank_name` VARCHAR( 255 ) ;
ALTER TABLE `{$installer->getTable('sales/quote_payment')}` ADD `PinePG_emi_months` VARCHAR( 255 ) ;
 
ALTER TABLE `{$installer->getTable('sales/order_payment')}` ADD `PinePG_payment_method` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE `{$installer->getTable('sales/order_payment')}` ADD `PinePG_bank_name` VARCHAR( 255 );
ALTER TABLE `{$installer->getTable('sales/order_payment')}` ADD `PinePG_emi_months` VARCHAR( 255 );
 
");
$installer->endSetup();