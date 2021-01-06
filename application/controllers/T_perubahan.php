<?php

class T_perubahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('T_perubahan_model', 't_perubahan');
    }

    public function index($thn = null, $bln = null)
    {
        if (!isset($thn)) $thn = date('Y');
        if (!isset($bln)) $bln = date('m');
        $data['tahun'] = $this->t_perubahan->getTahun();
        $data['bulan'] = $this->t_perubahan->getBulan($thn);
        $data['thn'] = $thn;
        $data['bln'] = $bln;
        $data['perubahan'] = $this->t_perubahan->getPerubahan($thn, $bln);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('t_perubahan/index', $data);
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
        $config['base_url'] = base_url('t-perubahan/detail/' . $thn . '/' . $bln . '/' . $kdsatker . '/' . $kdanak . '/' . $kdgol . '');
        $config['total_rows'] = $this->t_perubahan->countPerubahan($thn, $bln, $kdsatker, $kdanak, $kdgol);
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
            $data['perubahan'] = $this->t_perubahan->findDetailPerubahan($bln, $thn, $kdsatker, $kdanak, $kdgol, $keyword, $limit, $offset);
        } else {
            $data['perubahan'] = $this->t_perubahan->getDetailPerubahan($bln, $thn, $kdsatker, $kdanak, $kdgol, $limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('t_perubahan/detail', $data);
        $this->load->view('template/footer');
    }

    public function upload($thn = null, $bln = null, $kdsatker = null, $kdanak = null, $kdgol = null)
    {
        if (!isset($bln)) show_404();
        if (!isset($thn)) show_404();
        $this->t_perubahan->upload($bln, $thn, $kdsatker, $kdanak, $kdgol);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('t-perubahan/index/' . $thn . '/' . $bln . '');
    }

    public function upload_detail($nip = null, $bln = null, $thn = null, $kdsatker = null, $kdanak = null, $kdgol = null, $tgl = null)
    {
        if (!isset($nip)) show_404();
        if (!isset($bln)) show_404();
        if (!isset($thn)) show_404();
        $this->t_perubahan->uploadDetail($nip, $bln, $thn, $kdsatker, $tgl);
        $this->session->set_flashdata('pesan', 'Data berhasil diupload.');
        redirect('t-perubahan/detail/' . $thn . '/' . $bln . '/' . $kdsatker . '/' . $kdanak . '/' . $kdgol . '');
    }
}
