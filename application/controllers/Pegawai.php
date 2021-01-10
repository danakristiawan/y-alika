<?php

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['pagination', 'form_validation']);
        $this->load->model('Pegawai_model', 'pegawai');
    }

    public function index()
    {
        $id = null;
        $keyword = $this->input->post('keyword');
        $config['base_url'] = base_url('pegawai/index');
        $config['total_rows'] = $this->pegawai->countPegawai();
        $config['per_page'] = 20;
        $config["num_links"] = 3;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $data['keyword'] = $keyword;
        $limit = $config["per_page"];
        $offset = $data['page'];

        if ($keyword) {
            $data['page'] = 0;
            $offset = 0;
            $data['pegawai'] = $this->pegawai->findPegawai($keyword, $limit, $offset);
        } else {
            $data['pegawai'] = $this->pegawai->getPegawai($id, $limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pegawai/index', $data);
        $this->load->view('template/footer');
    }

    public function delete($id = null)
    {
        if (!isset($id)) show_404();
        $this->pegawai->deletePegawai($id);
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        redirect('pegawai');
    }

    public function delete_all()
    {
        $this->pegawai->deletePegawaiAll();
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        redirect('pegawai');
    }
}
