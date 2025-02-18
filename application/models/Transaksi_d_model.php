<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_d_model extends CI_Model
{

    public $table = 'transaksi_d';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,id_transaksi_h,kd_barang,nama_barang,qty,subtotal');
        $this->datatables->from('transaksi_d');
        //add this line for join
        //$this->datatables->join('table2', 'transaksi_d.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('transaksi_d/read/$1'),'Read')." | ".anchor(site_url('transaksi_d/update/$1'),'Update')." | ".anchor(site_url('transaksi_d/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('id_transaksi_h', $q);
	$this->db->or_like('kd_barang', $q);
	$this->db->or_like('nama_barang', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('subtotal', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('id_transaksi_h', $q);
	$this->db->or_like('kd_barang', $q);
	$this->db->or_like('nama_barang', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('subtotal', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Transaksi_d_model.php */
/* Location: ./application/models/Transaksi_d_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-08-05 16:52:11 */
/* http://harviacode.com */