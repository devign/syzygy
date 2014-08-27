<?php

class Database {

    public $db_connection;
    
    public function __construct() {
        
	    $this->db_connection = new mysqli('localhost', 'bbddev', '1stank-mofo', 'ecomm_sampl');

	    if (!$this->db_connection->real_connect('localhost', 'bbddev', '1stank-mofo', 'ecomm_sample')) {
    	    die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
	    }
        
        var_dump(method_exists($this, 'prepare'));
        
        return $this->db_connection;
	
    }

    
    public function dbDisconnect() {
	
	    $this->close();
	
    }
    
    public function jackass() {
        echo "TEST DB CONNECTION";    
    }

}



?>