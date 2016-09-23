<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

// Load the MX_Controller class
require APPPATH . 'third_party/MX/Controller.php';

class MY_Controller extends MX_Controller {

    private $_ci;

    public function __construct()
    {
        parent::__construct();

        $this->_ci =& get_instance();
    }

    /**
     * Load Javascript inside the page's body
     * @access  public
     * @param   string  $script
     */
    public function _load_script($script)
    {
        if (isset($this->_ci->template) && is_object($this->_ci->template))
        {
            // Queue up the script to be executed after the page is completely rendered
            echo <<< JS
<script>
    var CIS = CIS || { Script: { queue: [] } };
    CIS.Script.queue.push(function() { $script });
</script>
JS;
        }
        else
        {
            echo '<script>' . $script . '</script>';
        }
    }


    protected function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    protected function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}

class Ajax_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('response');
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */