<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Input extends CI_Input {

    /**
     * Clean Keys
     *
     * This function from parent class is not useful, only leads to errors from unrelated cookies
     *
     * @access  private
     * @param   string $str
     * @return  string
     */
    function _clean_input_keys($str) {
        return $str;
    }

}