<?php

class M_kekurangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('M_kekurangan_model', 'm_kekurangan');
    }

    public function index($thn = null, $bln = null)
    {
        if (!isset($thn)) $thn = date('Y');
        if (!isset($bln)) $bln = date('m');
        $data['tahun'] = $this->m_kekurangan->getTahun();
        $data['bulan'] = $this->m_kekurangan->getBulan($thn);
        $data['thn'] = $thn;
        $data['bln'] = $bln;
        $data['kekurangan'] = $this->m_kekurangan->getGaji($thn, $bln);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('m_kekurangan/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($thn = null, $bln = null, $kdsatker = null, $kdanak = null, $kdgapok = null)
    {
        if (!isset($thn)) show_404();
        if (!isset($bln)) show_404();
        if (!isset($kdsatker)) show_404();
        if (!isset($kdanak)) show_404();
        if (!isset($kdgapok)) show_404();
        $keyword = $this->input->post('keyword');
        $config['base_url'] = base_url('m-kekurangan/detail/' . $thn . '/' . $bln . '/' . $kdsatker . '/' . $kdanak . '/' . $kdgapok . '');
        $config['total_rows'] = $this->m_kekurangan->countGaji($thn, $bln, $kdsatker, $kdanak, $kdgapok);
        $config['per_page'] = 20;
        $config["num_links"] = 3;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
        $data['keyword'] = $keyword;
        $limit = $config["per_page"];
        $offset = $data['page'];

        if ($keyword) {
            $data['page'] = 0;
            $offset = 0;
            $data['kekurangan'] = $this->m_kekurangan->findDetailGaji($bln, $thn, $kdsatker, $kdanak, $kdgapok, $keyword, $limit, $offset);
        } else {
            $data['kekurangan'] = $this->m_kekurangan->getDetailGaji($bln, $thn, $kdsatker, $kdanak, $kdgapok, $limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('m_kekurangan/detail', $data);
        $this->load->view('template/footer');
    }

    public function upload($thn = null, $bln = null, $kdsatker = null, $kdanak = null, $kdgapok = null)
    {
        if (!isset($bln)) show_404();
        if (!isset($thn)) show_404();
        if (!isset($kdsatker)) show_404();
        $this->m_kekurangan->upload($bln, $thn, $kdsatker, $kdanak, $kdgapok);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('m-kekurangan/index/' . $thn . '/' . $bln . '');
    }

    public function upload_detail($nip = null, $bln = null, $thn = null, $kdsatker = null, $kdanak = null, $kdgapok = null)
    {
        if (!isset($nip)) show_404();
        if (!isset($bln)) show_404();
        if (!isset($thn)) show_404();
        if (!isset($kdsatker)) show_404();
        $this->m_kekurangan->uploadDetail($nip, $bln, $thn, $kdsatker);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('m-kekurangan/detail/' . $thn . '/' . $bln . '/' . $kdsatker . '/' . $kdanak . '/' . $kdgapok . '');
    }
}
