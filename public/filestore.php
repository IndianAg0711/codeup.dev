<?php

class Filestore {

    public $filename = '';

    function __construct($filename = '') 
    {
        $this->filename = $filename;
    }

    /**
     * Returns array of lines in $this->filename
     */
    function read_lines()
    {
        $handle = fopen($this->filename, 'r');
        $string = fread($handle, filesize($this->filename));
        fclose($handle);
        return explode("\n", $string);
    }

    /**
     * Writes each element in $array to a new line in $this->filename
     */
    function write_lines($array)
    {
        $handle = fopen($this->filename, 'w');
        $item_string = implode("\n", $array);
        fwrite($handle, $item_string);
        fclose($handle);
    }

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    function read_csv()
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
    function write_csv($array)
    {
        $handle = fopen($this->filename, 'w');
        foreach ($array as $fields) {
            fputcsv($handle, $fields);
        }
        fclose($handle);
    }

}