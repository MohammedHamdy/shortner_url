<?php

class A extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('main');
        $this->load->library('google_url_api');
        //$this->load->library('form_validation');
        /* $this->load->library('session');
          $this->load->helper('url');
          $this->load->helper('form'); */
    }

    public function index() {
        $this->load->view('main');
    }

    public function shortener() {
        $this->form_validation->set_rules('url', 'Full URL', 'trim|required|max_length[500]|xss_clean|prep_url');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('main');
        } else {
            if ($_POST['type'] == 1) {
                $url = $this->input->post("url", true);
                $this->main->store_url($url, $_POST['type']);
                redirect("/a/get_fullurl/");
            } else {
                //$this->google_url();
                $url = $this->input->post("url", true);
                /* if you want switch debug mode, please replace FALSE with TRUE */
                $this->google_url_api->enable_debug(FALSE);
                $short_url = $this->google_url_api->shorten($url);
                $this->main->store_googleurl($url, $short_url->id, $_POST['type']);
                redirect("/a/get_fullurl/");
            }
        }
    }

    public function get_fullurl() {
        $fullurl = $this->main->all_urls();
        $data = array('fullurl' => $fullurl);
        $this->load->view('fullurl', $data);
    }

    public function update_hits() {
        if (isset($_POST['uid'])) {
            $this->main->updatehits($_POST['uid']);
        }
    }

    function xxxx() {

        $url = 'http://www.google.com';
        /* if you want switch debug mode, please replace FALSE with TRUE */
        $this->google_url_api->enable_debug(FALSE);

        /**
         * shorten example
         */
        echo '<h2>Shorten Example</h2>';
        $short_url = $this->google_url_api->shorten($url);
        echo $url . " => " . $short_url->id . "<br />";
        echo 'Response code: ' . $this->google_url_api->get_http_status();

        /**
         * expand example
         */
        $url = 'http://goo.gl/fbsS';
        echo '<h2>Expand Example</h2>';
        $expand_url = $this->google_url_api->expand($url);
        echo $url . " => " . $expand_url->longUrl . "<br />";
        echo 'Response code: ' . $this->google_url_api->get_http_status() . "<br />";
        echo 'Response status: ' . $expand_url->status;

        /**
         * analytics example
         */
        $url = "http://goo.gl/fbsS";
        echo '<h2>Analytics Example</h2>';
        $analytics_url = $this->google_url_api->analytics($url);
        echo 'Response code: ' . $this->google_url_api->get_http_status() . "<br />";
        echo 'Response status: ' . $analytics_url->status . "<br />";
        echo 'Date Created: ' . date("Y-m-d H:i:s", strtotime($analytics_url->created)) . "<br />";
        $this->_print($analytics_url);
    }

}
