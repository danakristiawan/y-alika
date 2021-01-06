<?php

class M_gaji extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('M_gaji_model', 'm_gaji');
    }

    public function index($thn = null, $bln = null, $kdjns = null)
    {
        if (!isset($thn)) $thn = date('Y');
        if (!isset($bln)) $bln = date('m');
        if (!isset($kdjns)) $kdjns = '1';
        $data['tahun'] = $this->m_gaji->getTahun();
        $data['bulan'] = $this->m_gaji->getBulan($thn);
        $data['jenis'] = $this->m_gaji->getKdjns($thn, $bln);
        $data['thn'] = $thn;
        $data['bln'] = $bln;
        $data['kdjns'] = $kdjns;
        $data['gaji'] = $this->m_gaji->getGaji($thn, $bln, $kdjns);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('m_gaji/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($thn = null, $bln = null, $kdjns = null, $kdsatker = null, $kdanak = null, $kdgapok = null)
    {
        if (!isset($thn)) show_404();
        if (!isset($bln)) show_404();
        if (!isset($kdjns)) show_404();
        if (!isset($kdsatker)) show_404();
        if (!isset($kdanak)) show_404();
        if (!isset($kdgapok)) show_404();
        $keyword = $this->input->post('keyword');
        $config['base_url'] = base_url('m-gaji/detail/' . $thn . '/' . $bln . '/' . $kdjns . '/' . $kdsatker . '/' . $kdanak . '/' . $kdgapok . '');
        $config['total_rows'] = $this->m_gaji->countGaji($thn, $bln, $kdjns, $kdsatker, $kdanak, $kdgapok);
        $config['per_page'] = 20;
        $config["num_links"] = 3;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;
        $data['keyword'] = $keyword;
        $limit = $config["per_page"];
        $offset = $data['page'];

        if ($keyword) {
            $data['page'] = 0;
            $offset = 0;
            $data['gaji'] = $this->m_gaji->findDetailGaji($bln, $thn, $kdjns, $kdsatker, $kdanak, $kdgapok, $keyword, $limit, $offset);
        } else {
            $data['gaji'] = $this->m_gaji->getDetailGaji($bln, $thn, $kdjns, $kdsatker, $kdanak, $kdgapok, $limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('m_gaji/detail', $data);
        $this->load->view('template/footer');
    }

    public function upload($thn = null, $bln = null, $kdjns = null, $kdsatker = null, $kdanak = null, $kdgapok = null)
    {
        if (!isset($bln)) show_404();
        if (!isset($thn)) show_404();
        if (!isset($kdjns)) show_404();
        if (!isset($kdsatker)) show_404();
        $this->m_gaji->upload($bln, $thn, $kdjns, $kdsatker, $kdanak, $kdgapok);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('m-gaji/index/' . $thn . '/' . $bln . '/' . $kdjns . '');
    }

    public function upload_detail($nip = null, $bln = null, $thn = null, $kdjns = null, $kdsatker = null, $kdanak = null, $kdgapok = null)
    {
        if (!isset($nip)) show_404();
        if (!isset($bln)) show_404();
        if (!isset($thn)) show_404();
        if (!isset($kdjns)) show_404();
        if (!isset($kdsatker)) show_404();
        $this->m_gaji->uploadDetail($nip, $bln, $thn, $kdjns, $kdsatker);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('m-gaji/detail/' . $thn . '/' . $bln . '/' . $kdjns . '/' . $kdsatker . '/' . $kdanak . '/' . $kdgapok . '');
    }
}
