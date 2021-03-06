<?php
/**
 * Created by PhpStorm.
 * User: Awalin Yudhana
 * Date: 21/04/2015
 * Time: 18:53
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->acl->auth('credit');
        $this->id_staff = $this->session->userdata('uid');
    }

    public function index()
    {
        $po = $this->db
            ->from('purchase_order po')
            ->join('principal p', 'p.id_principal = po.id_principal')
            ->where('po.status_paid', true)
            ->order_by('date_created','desc')
            ->get()
            ->result();
        $data['po'] = $po;
        $this->parser->parse("history.tpl", $data);
    }
}