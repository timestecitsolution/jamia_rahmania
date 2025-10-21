<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';

class Excel {

    public function __construct() {
        // You can set this to initialize the library
        $this->phpExcel = new PHPExcel();
    }

    // Function to load an Excel file
    public function load($filePath) {
        // Check file type and load accordingly
        $objReader = PHPExcel_IOFactory::createReaderForFile($filePath);
        $objPHPExcel = $objReader->load($filePath);
        return $objPHPExcel;
    }

    // You can add other methods for saving files or processing data
}
