<?php

class Uang_lembur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['pagination', 'form_validation']);
        $this->load->model('Uang_lembur_model', 'uang_lembur');
    }

    public function index()
    {
        $id = null;
        $keyword1 = $this->input->post('keyword1');
        $keyword2 = $this->input->post('keyword2');
        $config['base_url'] = base_url('uang-lembur/index');
        $config['total_rows'] = $this->uang_lembur->countUangLembur();
        $config['per_page'] = 20;
        $config["num_links"] = 3;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $data['keyword'] = $keyword1;
        $limit = $config["per_page"];
        $offset = $data['page'];

        if ($keyword1) {
            $data['page'] = 0;
            $offset = 0;
            $data['uang_lembur'] = $this->uang_lembur->findUangLembur($keyword1, $keyword2, $limit, $offset);
        } else {
            $data['uang_lembur'] = $this->uang_lembur->getUangLembur($id, $limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('uang_lembur/index', $data);
        $this->load->view('template/footer');
    }

    public function delete($id = null)
    {
        if (!isset($id)) show_404();
        $this->uang_lembur->deleteUangLembur($id);
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        redirect('uang_lembur');
    }
}
