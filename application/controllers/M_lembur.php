<?php

class M_lembur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('M_lembur_model', 'm_lembur');
    }

    public function index($thn = null, $bln = null)
    {
        if (!isset($thn)) $thn = date('Y');
        if (!isset($bln)) $bln = date('m');
        $data['tahun'] = $this->m_lembur->getTahun();
        $data['bulan'] = $this->m_lembur->getBulan($thn);
        $data['thn'] = $thn;
        $data['bln'] = $bln;
        $data['lembur'] = $this->m_lembur->getLembur($thn, $bln);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('m_lembur/index', $data);
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
        $config['base_url'] = base_url('m-lembur/detail/' . $thn . '/' . $bln . '/' . $kdsatker . '/' . $kdanak . '/' . $kdgol . '');
        $config['total_rows'] = $this->m_lembur->countLembur($thn, $bln, $kdsatker, $kdanak, $kdgol);
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
            $data['lembur'] = $this->m_lembur->findDetailLembur($bln, $thn, $kdsatker, $kdanak, $kdgol, $keyword, $limit, $offset);
        } else {
            $data['lembur'] = $this->m_lembur->getDetailLembur($bln, $thn, $kdsatker, $kdanak, $kdgol, $limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('m_lembur/detail', $data);
        $this->load->view('template/footer');
    }

    public function upload($thn = null, $bln = null, $kdsatker = null, $kdanak = null, $kdgol = null)
    {
        if (!isset($bln)) show_404();
        if (!isset($thn)) show_404();
        $this->m_lembur->upload($bln, $thn, $kdsatker, $kdanak, $kdgol);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('m-lembur/index/' . $thn . '/' . $bln . '');
    }

    public function upload_detail($nip = null, $bln = null, $thn = null, $kdsatker = null, $kdanak = null, $kdgol = null)
    {
        if (!isset($nip)) show_404();
        if (!isset($bln)) show_404();
        if (!isset($thn)) show_404();
        $this->m_lembur->uploadDetail($nip, $bln, $thn, $kdsatker);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('m-lembur/detail/' . $thn . '/' . $bln . '/' . $kdsatker . '/' . $kdanak . '/' . $kdgol . '');
    }
}
