<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_d extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_d_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('transaksi_d/transaksi_d_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Transaksi_d_model->json();
    }

    public function read($id) 
    {
        $row = $this->Transaksi_d_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_transaksi_h' => $row->id_transaksi_h,
		'kd_barang' => $row->kd_barang,
		'nama_barang' => $row->nama_barang,
		'qty' => $row->qty,
		'subtotal' => $row->subtotal,
	    );
            $this->load->view('transaksi_d/transaksi_d_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_d'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi_d/create_action'),
	    'id' => set_value('id'),
	    'id_transaksi_h' => set_value('id_transaksi_h'),
	    'kd_barang' => set_value('kd_barang'),
	    'nama_barang' => set_value('nama_barang'),
	    'qty' => set_value('qty'),
	    'subtotal' => set_value('subtotal'),
	);
        $this->load->view('transaksi_d/transaksi_d_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_transaksi_h' => $this->input->post('id_transaksi_h',TRUE),
		'kd_barang' => $this->input->post('kd_barang',TRUE),
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'subtotal' => $this->input->post('subtotal',TRUE),
	    );

            $this->Transaksi_d_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi_d'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Transaksi_d_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi_d/update_action'),
		'id' => set_value('id', $row->id),
		'id_transaksi_h' => set_value('id_transaksi_h', $row->id_transaksi_h),
		'kd_barang' => set_value('kd_barang', $row->kd_barang),
		'nama_barang' => set_value('nama_barang', $row->nama_barang),
		'qty' => set_value('qty', $row->qty),
		'subtotal' => set_value('subtotal', $row->subtotal),
	    );
            $this->load->view('transaksi_d/transaksi_d_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_d'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_transaksi_h' => $this->input->post('id_transaksi_h',TRUE),
		'kd_barang' => $this->input->post('kd_barang',TRUE),
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'subtotal' => $this->input->post('subtotal',TRUE),
	    );

            $this->Transaksi_d_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi_d'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Transaksi_d_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_d_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi_d'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_d'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_transaksi_h', 'id transaksi h', 'trim|required');
	$this->form_validation->set_rules('kd_barang', 'kd barang', 'trim|required');
	$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	$this->form_validation->set_rules('subtotal', 'subtotal', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "transaksi_d.xls";
        $judul = "transaksi_d";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Transaksi H");
	xlsWriteLabel($tablehead, $kolomhead++, "Kd Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty");
	xlsWriteLabel($tablehead, $kolomhead++, "Subtotal");

	foreach ($this->Transaksi_d_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_transaksi_h);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kd_barang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->qty);
	    xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=transaksi_d.doc");

        $data = array(
            'transaksi_d_data' => $this->Transaksi_d_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('transaksi_d/transaksi_d_doc',$data);
    }

}

/* End of file Transaksi_d.php */
/* Location: ./application/controllers/Transaksi_d.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-08-05 16:52:11 */
/* http://harviacode.com */