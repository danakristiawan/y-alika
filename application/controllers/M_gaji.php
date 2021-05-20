<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

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

    public function ekspor($thn = null, $bln = null, $kdjns = null, $kdsatker = null, $kdanak = null, $kdgapok = null)
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'no');
        $sheet->setCellValue('B1', 'nip');
        $sheet->setCellValue('C1', 'nmpeg');
        $sheet->setCellValue('D1', 'kdjns');
        $sheet->setCellValue('E1', 'kdsatker');
        $sheet->setCellValue('F1', 'kdanak');
        $sheet->setCellValue('G1', 'kdsubanak');
        $sheet->setCellValue('H1', 'kdkawin');
        $sheet->setCellValue('I1', 'kdgapok');
        $sheet->setCellValue('J1', 'kdjab');
        $sheet->setCellValue('K1', 'bulan');
        $sheet->setCellValue('L1', 'tahun');
        $sheet->setCellValue('M1', 'gapok');
        $sheet->setCellValue('N1', 'tistri');
        $sheet->setCellValue('O1', 'tanak');
        $sheet->setCellValue('P1', 'tumum');
        $sheet->setCellValue('Q1', 'ttambumum');
        $sheet->setCellValue('R1', 'tstruktur');
        $sheet->setCellValue('S1', 'tfungsi');
        $sheet->setCellValue('T1', 'bulat');
        $sheet->setCellValue('U1', 'tberas');
        $sheet->setCellValue('V1', 'tpajak');
        $sheet->setCellValue('W1', 'pberas');
        $sheet->setCellValue('X1', 'tpapua');
        $sheet->setCellValue('Y1', 'tpencil');
        $sheet->setCellValue('Z1', 'tlain');
        $sheet->setCellValue('AA1', 'iwp');
        $sheet->setCellValue('AB1', 'pph');
        $sheet->setCellValue('AC1', 'sewarmh');
        $sheet->setCellValue('AD1', 'tunggakan');
        $sheet->setCellValue('AE1', 'utanglebih');
        $sheet->setCellValue('AF1', 'potlain');
        $sheet->setCellValue('AG1', 'taperum');
        $sheet->setCellValue('AH1', 'bpjs');

        $total_rows = $this->m_gaji->countGaji($thn, $bln, $kdjns, $kdsatker, $kdanak, $kdgapok);
        $gaji = $this->m_gaji->getDetailGaji($bln, $thn, $kdjns, $kdsatker, $kdanak, $kdgapok, $total_rows, 0);
        $no = 1;
        $i = 2;
        foreach ($gaji as $r) {
            $sheet->setCellValue('A' . $i, $no++);
            $sheet->setCellValue('B' . $i, ' ' . $r['nip']);
            $sheet->setCellValue('C' . $i, $r['nmpeg']);
            $sheet->setCellValue('D' . $i, $r['kdjns']);
            $sheet->setCellValue('E' . $i, $r['kdsatker']);
            $sheet->setCellValue('F' . $i, $r['kdanak']);
            $sheet->setCellValue('G' . $i, $r['kdsubanak']);
            $sheet->setCellValue('H' . $i, $r['kdkawin']);
            $sheet->setCellValue('I' . $i, $r['kdgapok']);
            $sheet->setCellValue('J' . $i, $r['kdjab']);
            $sheet->setCellValue('K' . $i, $r['bulan']);
            $sheet->setCellValue('L' . $i, $r['tahun']);
            $sheet->setCellValue('M' . $i, $r['gapok']);
            $sheet->setCellValue('N' . $i, $r['tistri']);
            $sheet->setCellValue('O' . $i, $r['tanak']);
            $sheet->setCellValue('P' . $i, $r['tumum']);
            $sheet->setCellValue('Q' . $i, $r['ttambumum']);
            $sheet->setCellValue('R' . $i, $r['tstruktur']);
            $sheet->setCellValue('S' . $i, $r['tfungsi']);
            $sheet->setCellValue('T' . $i, $r['bulat']);
            $sheet->setCellValue('U' . $i, $r['tberas']);
            $sheet->setCellValue('V' . $i, $r['tpajak']);
            $sheet->setCellValue('W' . $i, $r['pberas']);
            $sheet->setCellValue('X' . $i, $r['tpapua']);
            $sheet->setCellValue('Y' . $i, $r['tpencil']);
            $sheet->setCellValue('Z' . $i, $r['tlain']);
            $sheet->setCellValue('AA' . $i, $r['iwp']);
            $sheet->setCellValue('AB' . $i, $r['pph']);
            $sheet->setCellValue('AC' . $i, $r['sewarmh']);
            $sheet->setCellValue('AD' . $i, $r['tunggakan']);
            $sheet->setCellValue('AE' . $i, $r['utanglebih']);
            $sheet->setCellValue('AF' . $i, $r['potlain']);
            $sheet->setCellValue('AG' . $i, $r['taperum']);
            $sheet->setCellValue('AH' . $i, $r['bpjs']);
            $i++;
        }

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $i = $i - 1;
        $sheet->getStyle('A1:AH' . $i)->applyFromArray($styleArray);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('Data Gaji.xlsx');

        $this->session->set_flashdata('pesan', 'Data berhasil diekspor.');
        redirect('m-gaji/index/' . $thn . '/' . $bln . '/' . $kdjns . '');
    }
}
