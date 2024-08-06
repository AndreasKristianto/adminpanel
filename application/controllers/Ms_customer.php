<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ms_customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ms_customer_model');
        $this->load->model('Transaksi_h_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'ms_customer/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'ms_customer/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'ms_customer/index.html';
            $config['first_url'] = base_url() . 'ms_customer/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Ms_customer_model->total_rows($q);
        $ms_customer = $this->Ms_customer_model->get_limit_data($config['per_page'], $start, $q);
        $ms_customerr = $this->Ms_customer_model->get_all();
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'ms_customer_data' => $ms_customer,
            'ms_customer_dataa' => $ms_customerr,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('ms_customer/ms_customer_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Ms_customer_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_customer' => $row->id_customer,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'phone' => $row->phone,
	    );
            $this->load->view('ms_customer/ms_customer_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ms_customer'));
        }
    }

    // function ambil_data()
    // {
    //     $modul = $this->input->post('modul');
    //     $jenis_permintaan = $this->input->post('jenis_permintaan');

    //     if ($modul == "order") {
    //         // echo $this->Select_model->kabupaten($id);
    //         echo $this->Marketing_model->CreateCodeOrder($jenis_permintaan);
    //     } else if ($modul == "sample") {
    //         echo $this->Marketing_model->CreateCodeSample($jenis_permintaan);
    //     }

    // }

    public function CreateCode()
    {
        $this->db->select('RIGHT(transaksi_h.nomer_transaksi,5) as nomer_transaksi', FALSE);
        $this->db->order_by('nomer_transaksi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('transaksi_h');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->no_transaksi) + 1;
        } else {
            $kode = 1;
        }
        $thn = date('y');
        $bln = date('mm');
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);

        $kodetampil = "SO" . $thn . $bln. $batas;
        return $kodetampil;
    }


    public function CreateCodeSample()
    {
        $this->db->select('RIGHT(marketing.no_request,5) as no_request', FALSE);
        $this->db->like('no_request', 'SA', 'after');
        $this->db->order_by('no_request', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('marketing');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->no_request) + 1;
        } else {
            $kode = 1;
        }
        $thn = date('y');
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);

        $kodetampil = "SA" . $thn . $batas;
        return $kodetampil;
    }

    public function create() 
    {
        $nomer_transaksi = $this->Ms_customer_model->CreateCode();
        $customer    = $this->Ms_customer_model->get_allcust();

        $data = array(
            'button' => 'Create',
            'action' => site_url('ms_customer/create_action'),
            'id' =>  set_value('id'),
            'id_customer' =>  set_value('id_customer'),
            'nomer_transaksi' => $nomer_transaksi, 
            'customer' => $customer, 
	    'tanggal_transaksi' => set_value('tanggal_transaksi'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'phone' => set_value('phone'),
        
	);
        $this->load->view('ms_customer/ms_customer_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $datacustomer = array(
               
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'phone' => $this->input->post('phone',TRUE),
	    );

        $this->Ms_customer_model->insert($datacustomer);
        $lastid= $this->db->insert_id(); 

        $datatransaksi = array(
            'id_customer' =>$lastid,
            'nomer_transaksi' => $this->input->post('nomer_transaksi',TRUE),
            'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
   
    );

           

            
            $this->Transaksi_h_model->insert($datatransaksi);

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ms_customer'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Ms_customer_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ms_customer/update_action'),
                'id' => set_value('id', $row->id),
                'id_customer' => set_value('id_customer', $row->id_customer),
		'nomer_transaksi' => set_value('nomer_transaksi', $row->nomer_transaksi),
        'total_transaksi' => set_value('total_transaksi', $row->total_transaksi),
        'tanggal_transaksi' => set_value('tanggal_transaksi', $row->tanggal_transaksi),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'phone' => set_value('phone', $row->phone),
	    );
            $this->load->view('ms_customer/ms_customer_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ms_customer'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_customer', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'phone' => $this->input->post('phone',TRUE),
	    );

            $this->Ms_customer_model->update($this->input->post('id_customer', TRUE), $data);
            $dataupdatetransaksi = array(
                'id' => $this->input->post('id',TRUE),
                'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
              
                );
                $this->Transaksi_h_model->update($this->input->post('id', TRUE), $dataupdatetransaksi);
         

            // $this->db->set('tanggal_transaksi', $tanggal_transaksi, FALSE);
            // $this->db->where('id', $id);
            // $this->db->update('transaksi_h'); 

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ms_customer'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Ms_customer_model->get_by_id($id);

        if ($row) {
            $this->Ms_customer_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ms_customer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ms_customer'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');

	$this->form_validation->set_rules('id_customer', 'id_customer', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "ms_customer.xls";
        $judul = "ms_customer";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Phone");

	foreach ($this->Ms_customer_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->phone);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=ms_customer.doc");

        $data = array(
            'ms_customer_data' => $this->Ms_customer_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('ms_customer/ms_customer_doc',$data);
    }

}

/* End of file Ms_customer.php */
/* Location: ./application/controllers/Ms_customer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-08-05 19:04:03 */
/* http://harviacode.com */