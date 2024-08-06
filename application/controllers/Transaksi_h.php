<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_h extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_h_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('transaksi_h/transaksi_h_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Transaksi_h_model->json();
    }

    public function read($id) 
    {
        $row = $this->Transaksi_h_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_customer' => $row->id_customer,
		'nomer_transaksi' => $row->nomer_transaksi,
		'tanggal_transaksi' => $row->tanggal_transaksi,
		'total_transaksi' => $row->total_transaksi,
	    );
            $this->load->view('transaksi_h/transaksi_h_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_h'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi_h/create_action'),
	    'id' => set_value('id'),
	    'id_customer' => set_value('id_customer'),
	    'nomer_transaksi' => set_value('nomer_transaksi'),
	    'tanggal_transaksi' => set_value('tanggal_transaksi'),
	    'total_transaksi' => set_value('total_transaksi'),
	);
        $this->load->view('transaksi_h/transaksi_h_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_customer' => $this->input->post('id_customer',TRUE),
		'nomer_transaksi' => $this->input->post('nomer_transaksi',TRUE),
		'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
		'total_transaksi' => $this->input->post('total_transaksi',TRUE),
	    );

            $this->Transaksi_h_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi_h'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Transaksi_h_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi_h/update_action'),
		'id' => set_value('id', $row->id),
		'id_customer' => set_value('id_customer', $row->id_customer),
		'nomer_transaksi' => set_value('nomer_transaksi', $row->nomer_transaksi),
		'tanggal_transaksi' => set_value('tanggal_transaksi', $row->tanggal_transaksi),
		'total_transaksi' => set_value('total_transaksi', $row->total_transaksi),
	    );
            $this->load->view('transaksi_h/transaksi_h_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_h'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_customer' => $this->input->post('id_customer',TRUE),
		'nomer_transaksi' => $this->input->post('nomer_transaksi',TRUE),
		'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
		'total_transaksi' => $this->input->post('total_transaksi',TRUE),
	    );

            $this->Transaksi_h_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi_h'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Transaksi_h_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_h_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi_h'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_h'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_customer', 'id customer', 'trim|required');
	$this->form_validation->set_rules('nomer_transaksi', 'nomer transaksi', 'trim|required');
	$this->form_validation->set_rules('tanggal_transaksi', 'tanggal transaksi', 'trim|required');
	$this->form_validation->set_rules('total_transaksi', 'total transaksi', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "transaksi_h.xls";
        $judul = "transaksi_h";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Customer");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomer Transaksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Transaksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Total Transaksi");

	foreach ($this->Transaksi_h_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_customer);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomer_transaksi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_transaksi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->total_transaksi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=transaksi_h.doc");

        $data = array(
            'transaksi_h_data' => $this->Transaksi_h_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('transaksi_h/transaksi_h_doc',$data);
    }

}

/* End of file Transaksi_h.php */
/* Location: ./application/controllers/Transaksi_h.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-08-05 16:52:11 */
/* http://harviacode.com */