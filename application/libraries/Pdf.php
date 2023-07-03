<?php
class Pdf {
 
    function __construct() {
        // require base_url('assets/fpdf182/fpdf.php');
         include_once APPPATH . '../assets/fpdf182/fpdf.php';
    }
}
?>