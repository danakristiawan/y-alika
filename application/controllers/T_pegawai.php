<?php

class T_pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('T_pegawai_model', 't_pegawai');
    }

    public function index()
    {
        $data['pegawai'] = $this->t_pegawai->getPegawai();

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('t_pegawai/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($kdsatker = null, $kdanak = null, $kdgol = null)
    {
        if (!isset($kdsatker)) show_404();
        if (!isset($kdanak)) show_404();
        if (!isset($kdgol)) show_404();
        $keyword = $this->input->post('keyword');
        $config['base_url'] = base_url('t-pegawai/detail/' . $kdsatker . '/' . $kdanak . '/' . $kdgol . '');
        $config['total_rows'] = $this->t_pegawai->countPegawai($kdsatker, $kdanak, $kdgol);
        $config['per_page'] = 20;
        $config["num_links"] = 3;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
        $data['keyword'] = $keyword;
        $limit = $config["per_page"];
        $offset = $data['page'];

        if ($keyword) {
            $data['page'] = 0;
            $data['pegawai'] = $this->t_pegawai->findDetailPegawai($kdsatker, $kdanak, $kdgol, $keyword, $limit, $offset);
        } else {
            $data['pegawai'] = $this->t_pegawai->getDetailPegawai($kdsatker, $kdanak, $kdgol, $limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('t_pegawai/detail', $data);
        $this->load->view('template/footer');
    }

    public function upload($kdsatker = null, $kdanak = null, $kdgol = null)
    {
        $this->t_pegawai->upload($kdsatker, $kdanak, $kdgol);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('t-pegawai/index/');
    }

    public function upload_detail($nip = null, $kdsatker = null, $kdanak = null, $kdgol = null)
    {
        if (!isset($nip)) show_404();
        $this->t_pegawai->uploadDetail($nip, $kdsatker);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('t-pegawai/detail/' . $kdsatker . '/' . $kdanak . '/' . $kdgol . '');
    }
}
