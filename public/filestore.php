<?php

class Filestore {

    public $filename = '';

    private $is_csv = FALSE;

    public function __construct($filename = '') 
    {
        $this->filename = $filename;
        if (substr($filename, -3) == 'csv') {
            $this->is_csv = TRUE;
        }
        else {
            $this->is_csv = FALSE;
        }
    }

    public function read()
    {
        if ($this->is_csv == TRUE) {
            return $this->read_csv();
        }
        else {
            return $this->read_lines();
        }
    }

    public function write($array)
    {
        if ($this->is_csv == TRUE) {
            return $this->write_csv($array);
        }
        else {
            return $this->write_lines($array);
        }
    }

    /**
     * Returns array of lines in $this->filename
     */
    private function read_lines()
    {
        $handle = fopen($this->filename, 'r');
        $string = fread($handle, filesize($this->filename));
        fclose($handle);
        return explode("\n", $string);
    }

    /**
     * Writes each element in $array to a new line in $this->filename
     */
    private function write_lines($array)
    {
        $handle = fopen($this->filename, 'w');
        $item_string = implode("\n", $array);
        fwrite($handle, $item_string);
        fclose($handle);
    }

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    private function read_csv()
    {
        $array = [];
        $handle = fopen($this->filename, 'r');
        while (($data = fgetcsv($handle)) !== false) {
            $array[] = $data;
        }
        fclose($handle);
        return $array;
    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    private function write_csv($array)
    {
        $handle = fopen($this->filename, 'w');
        foreach ($array as $fields) {
            fputcsv($handle, $fields);
        }
        fclose($handle);
    }

}