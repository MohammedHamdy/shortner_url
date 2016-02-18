<?php

class Main extends CI_Model {

    function store_url($full_url, $type) {
        $short_url = $this->create_url();
        $data = array(
            'short_url' => $short_url,
            'full_url' => $full_url,
            'type' => $type,
        );
        $this->db->insert('shortener_url', $data);
        return $short_url;
    }

    function store_googleurl($full_url, $short_url, $type) {
        $data = array(
            'short_url' => $short_url,
            'full_url' => $full_url,
            'type' => $type,
        );
        $this->db->insert('shortener_url', $data);
    }

    function create_url() {
        $this->load->helper('string');
        $unique = false;
        do {
            $url_part = random_string('alnum', 4);
            $is_unique = $this->check_unique_url($url_part);
        } while (!$is_unique);
        return $url_part;
    }

    function check_unique_url($url_part) {
        $this->db->select('id');
        $this->db->from('shortener_url');
        $this->db->where('short_url', $url_part);
        $query = $this->db->get();
        // $result = $query->result();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function all_urls() {
        $this->db->select('*');
        $this->db->from('shortener_url');
        $query = $this->db->get();
        return $result = $query->result();
    }

    function updatehits($id) {
        $this->db->where('id', $id);
        $this->db->set('hits', 'hits+1', FALSE);
        $this->db->update('shortener_url');
    }

    function red_fullurl($id) {
        $this->db->select('*');
        $this->db->from('shortener_url');
        $this->db->where('short_url', $id);
        $query = $this->db->get();
        return $result = $query->result();
    }

}
