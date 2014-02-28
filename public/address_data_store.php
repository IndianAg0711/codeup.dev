<?php
require_once('filestore.php');

class AddressDataStore extends Filestore {

	function __construct($filename) 
	{
		$new_filename = strtolower($filename);
		parent::__construct($new_filename);
	}

    public function read_address_book()
    {
        $array = $this->read_csv();
        return $array;
    }

    public function write_address_book($addresses_array) 
    {
      	$this->write_csv($addresses_array);
    }
}
?>