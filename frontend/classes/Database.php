<?php

class Database extends mysqli {

    protected $db_connection;
    
    public function __construct() {
        
        parent::__construct('localhost', 'bbddev', '1stank-mofo', 'syzygy');

        if (mysqli_connect_error()) {
            throw new Exception('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }

    }

    
    
    public function __destruct() {
    
        $this->close();
    
    }
    
    



}



?>
