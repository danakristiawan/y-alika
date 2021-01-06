<?php

class T_keluarga extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('T_keluarga_model', 't_keluarga');
    }

    public function index()
    {
        $data['keluarga'] = $this->t_keluarga->getKeluarga();

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('t_keluarga/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($kdsatker = null, $kdanak = null, $kdgol = null)
    {
        if (!isset($kdsatker)) show_404();
        if (!isset($kdanak)) show_404();
        if (!isset($kdgol)) show_404();
        $keyword = $this->input->post('keyword');
        $config['base_url'] = base_url('t-keluarga/detail/' . $kdsatker . '/' . $kdanak . '/' . $kdgol . '');
        $config['total_rows'] = $this->t_keluarga->countKeluarga($kdsatker, $kdanak, $kdgol);
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
            $data['keluarga'] = $this->t_keluarga->findDetailKeluarga($kdsatker, $kdanak, $kdgol, $keyword, $limit, $offset);
        } else {
            $data['keluarga'] = $this->t_keluarga->getDetailKeluarga($kdsatker, $kdanak, $kdgol, $limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('t_keluarga/detail', $data);
        $this->load->view('template/footer');
    }

    public function upload($kdsatker = null, $kdanak = null, $kdgol = null)
    {
        $this->t_keluarga->upload($kdsatker, $kdanak, $kdgol);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('t-keluarga/index/');
    }

    public function upload_detail($nip = null, $kdsatker = null, $kdanak = null, $kdgol = null, $tgllhr = null)
    {
        if (!isset($nip)) show_404();
        $this->t_keluarga->uploadDetail($nip, $kdsatker, $tgllhr);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('t-keluarga/detail/' . $kdsatker . '/' . $kdanak . '/' . $kdgol . '');
    }
}
