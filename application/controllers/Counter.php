<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Counter extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Counter_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('counter/counter_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Counter_model->json();
    }

    public function read($id) 
    {
        $row = $this->Counter_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'bulan' => $row->bulan,
		'tahun' => $row->tahun,
		'counter' => $row->counter,
	    );
            $this->load->view('counter/counter_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('counter'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('counter/create_action'),
	    'id' => set_value('id'),
	    'bulan' => set_value('bulan'),
	    'tahun' => set_value('tahun'),
	    'counter' => set_value('counter'),
	);
        $this->load->view('counter/counter_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'bulan' => $this->input->post('bulan',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'counter' => $this->input->post('counter',TRUE),
	    );

            $this->Counter_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('counter'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Counter_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('counter/update_action'),
		'id' => set_value('id', $row->id),
		'bulan' => set_value('bulan', $row->bulan),
		'tahun' => set_value('tahun', $row->tahun),
		'counter' => set_value('counter', $row->counter),
	    );
            $this->load->view('counter/counter_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('counter'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'bulan' => $this->input->post('bulan',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'counter' => $this->input->post('counter',TRUE),
	    );

            $this->Counter_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('counter'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Counter_model->get_by_id($id);

        if ($row) {
            $this->Counter_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('counter'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('counter'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
	$this->form_validation->set_rules('counter', 'counter', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "counter.xls";
        $judul = "counter";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Bulan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun");
	xlsWriteLabel($tablehead, $kolomhead++, "Counter");

	foreach ($this->Counter_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->bulan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tahun);
	    xlsWriteLabel($tablebody, $kolombody++, $data->counter);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=counter.doc");

        $data = array(
            'counter_data' => $this->Counter_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('counter/counter_doc',$data);
    }

}

/* End of file Counter.php */
/* Location: ./application/controllers/Counter.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-08-05 16:52:11 */
/* http://harviacode.com */