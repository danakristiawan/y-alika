<?php

class M_makan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('M_makan_model', 'm_makan');
    }

    public function index($thn = null, $bln = null)
    {
        if (!isset($thn)) $thn = date('Y');
        if (!isset($bln)) $bln = date('m');
        $data['tahun'] = $this->m_makan->getTahun();
        $data['bulan'] = $this->m_makan->getBulan($thn);
        $data['thn'] = $thn;
        $data['bln'] = $bln;
        $data['makan'] = $this->m_makan->getMakan($thn, $bln);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('m_makan/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($thn = null, $bln = null, $kdsatker = null, $kdanak = null, $kdgol = null)
    {
        if (!isset($thn)) show_404();
        if (!isset($bln)) show_404();
        if (!isset($kdsatker)) show_404();
        if (!isset($kdanak)) show_404();
        if (!isset($kdgol)) show_404();
        $keyword = $this->input->post('keyword');
        $config['base_url'] = base_url('m-makan/detail/' . $thn . '/' . $bln . '/' . $kdsatker . '/' . $kdanak . '/' . $kdgol . '');
        $config['total_rows'] = $this->m_makan->countMakan($thn, $bln, $kdsatker, $kdanak, $kdgol);
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
            $data['makan'] = $this->m_makan->findDetailMakan($bln, $thn, $kdsatker, $kdanak, $kdgol, $keyword, $limit, $offset);
        } else {
            $data['makan'] = $this->m_makan->getDetailMakan($bln, $thn, $kdsatker, $kdanak, $kdgol, $limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('m_makan/detail', $data);
        $this->load->view('template/footer');
    }

    public function upload($thn = null, $bln = null, $kdsatker = null, $kdanak = null, $kdgol = null)
    {
        if (!isset($bln)) show_404();
        if (!isset($thn)) show_404();
        $this->m_makan->upload($bln, $thn, $kdsatker, $kdanak, $kdgol);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('m-makan/index/' . $thn . '/' . $bln . '');
    }

    public function upload_detail($nip = null, $bln = null, $thn = null, $kdsatker = null, $kdanak = null, $kdgol = null)
    {
        if (!isset($nip)) show_404();
        if (!isset($bln)) show_404();
        if (!isset($thn)) show_404();
        $this->m_makan->uploadDetail($nip, $bln, $thn, $kdsatker);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('m-makan/detail/' . $thn . '/' . $bln . '/' . $kdsatker . '/' . $kdanak . '/' . $kdgol . '');
    }
}
