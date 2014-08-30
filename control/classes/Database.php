<?php

class Database extends mysqli {

    public $db_connection;
    
    public function __construct() {
        
	    parent::__construct('localhost', 'bbddev', '1stank-mofo', 'syzygy');

	    if (mysqli_connect_error()) {
    	    throw new Exception('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	    }

    }

    
    public function dbDisconnect() {
	
	    $this->close();
	
    }
    
    public function getData($query) {
        $result = $this->query($query, MYSQLI_USE_RESULT);
        return $result->fetch_object;
        
    }
    


}



?>