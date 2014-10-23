<?php

class User extends SyzygyControl {
    private $_data = array();
     
    public function __construct() {
        
    }

    public function __get($name) {

        if (array_key_exists($name, $this->data)) {
            return $this->_data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }   
    
    public function __set($name, $value) {
        $this->_data[$name] = $value;
    }
    
    function isAdmin() {
        global $db;

        $this->_data['associate_id'] = $_COOKIE['SYZYGY_USERID'];

        $result = $db->query("SELECT admin FROM associates WHERE associate_id = " . $associate_id);
        $temp = $result->fetch_object();

        return $temp->admin;


    }

    public function userExists($username) {
        
        $username = Utility::sanitizeData($username);
            
        $result = Database::query("SELECT COUNT(`user_id`) AS users FROM `users` WHERE `username` = '$username'");
        
        $count = $result->fetch_object();
        
        return ($count->users >= 1) ? true : false;
        
        
    }

    public static function userLoggedIn() {
        return (isset($_SESSION['user_id'])) ? true : false;
    }

}
    
?>
