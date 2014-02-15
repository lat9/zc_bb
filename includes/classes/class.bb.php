<?php
/**
 * bb Class
 *
 * This class is used to provide a common interface to the non-bulletin-board elements of
 * Zen Cart, providing notify points for other bulletin-board (e.g. phpBB) code to 'hook'.
 *
 * @package classes
 * @copyright Copyright 2012-2013, Vinos de Frutas Tropicales (lat9): Bulletin Board Integration via Notifier-Hook Integration
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: class.bb.php $
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

define('ZEN_BB_VERSION_MAJOR', '1');
define('ZEN_BB_VERSION_MINOR', '2.0');  /* v1.2.0-c-lat9 */

  class bb extends base {
    protected $version;
    protected $installed;
    protected $bb_url;
    protected $bb_name;
    protected $bb_message;  /*v1.2.0-a-lat9*/
    const STATUS_OK = 'ok';
    const STATUS_NOT_INSTALLED = 'not_installed';
    const STATUS_ERROR = 'error';
    var $return_status;
    var $error_status;  // If a bulletin-board handler returns STATUS_ERROR, additional information can be set here.

    function bb() {
      $this->installed = false;
      $this->bb_url = FILENAME_PAGE_NOT_FOUND;
      $this->bb_name = '';
      $this->version = array ('major' => ZEN_BB_VERSION_MAJOR, 'minor' => ZEN_BB_VERSION_MINOR); /* v1.1.0-c-lat9 */
 
      $this->return_status = self::STATUS_NOT_INSTALLED; 
      $this->notify('ZEN_BB_INSTANTIATE');

//-bof-d-v1.1.0 (lat9)      
//      if ($this->return_status == self::STATUS_OK) {
//        $this->installed = true;
//      }
//-eof-d-v1.1.0 (lat9)
    }

    function get_version() {
      return $this->version['major'] . '.' . $this->version['minor'];
    }

//-bof-a-v1.1.0 (lat9)    
    function set_enabled() {
      $this->installed = true;
    }
//-eof-a-v1.1.0 (lat9)
    
    function is_enabled() {
      return $this->installed;
    }
    
    function get_bb_url() {
      return $this->bb_url;
    }
    
    function set_bb_url($url) {
      $this->bb_url = $url;
    }
    
    function get_bb_name() {
      return $this->bb_name;
    }
    
    function set_bb_name($name) {
      $this->bb_name = $name;
    } 
//-bof-v1.2.0-a    
    function set_bb_message($message) {
      $this->bb_message = $message;
    }
    
    function get_bb_message() {
      return $this->bb_message;
    }
//-eof-v1.2.0-a
    function create_account($nick, $password, $email_address) {
      $this->return_status = self::STATUS_OK;
      $this->notify('ZEN_BB_CREATE_ACCOUNT', array('nick' => $nick, 'pwd' => $password, 'email' => $email_address));
      return $this->return_status;
    }
    
    function check_nick_not_used ($nick) {
      $this->return_status = self::STATUS_OK;
      $this->bb_message = '';  /*v1.2.0-a-lat9*/
      $this->notify('ZEN_BB_CHECK_NICK_NOT_USED', array('nick' => $nick));
      return $this->return_status;
    }

    function check_email_not_used($email_address, $nick='') {
      $this->return_status = self::STATUS_OK;
      $this->bb_message = '';  /*v1.2.0-a-lat9*/
      $this->notify('ZEN_BB_CHECK_EMAIL_NOT_USED', array('email' => $email_address, 'nick' => $nick));
      return $this->return_status;
    }

    function change_password($nick, $newpassword) {
      $this->return_status = self::STATUS_OK;
      $this->notify('ZEN_BB_CHANGE_PASSWORD', array('nick' => $nick, 'pwd' => $newpassword));
      return $this->return_status;
    }

    function change_email($nick, $email_address) {
      $this->return_status = self::STATUS_OK;
      $this->notify('ZEN_BB_CHANGE_EMAIL', array('nick' => $nick, 'email' => $email_address));
      return $this->return_status;
    }

  }