<?php
/**
 * Additional Header code file for create_account_success
 *
 * @package page
 * @copyright Copyright 2013, Vinos de Frutas Tropicales (lat9): phpBB Notifier-Hook Integration
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_CREATE_ACCOUNT_SUCCESS_BB');

////
// Retrieve the customer's nickname from the database, for display by the template.
$nick_query = "SELECT customers_nick FROM   " . TABLE_CUSTOMERS . " WHERE  customers_id = :customersID";
$nick_query = $db->bindVars($nick_query, ':customersID', $_SESSION['customer_id'], 'integer');
$nick_info  = $db->Execute($nick_query);

$nick = $nick_info->fields['customers_nick'];

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_CREATE_ACCOUNT_SUCCESS_BB');
?>