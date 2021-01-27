<?php

use GuzzleHttp\Client;

class M_gaji_model extends CI_Model
{
    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => base_uri(),
            'auth' => auth()
        ]);
    }

    public function getTahun()
    {
        return $this->db->query("SELECT DISTINCT tahun FROM m_gaji ORDER BY tahun DESC")->result_array();
    }

    public function getBulan($tahun = null)
    {
        return $this->db->query("SELECT DISTINCT bulan FROM m_gaji WHERE tahun='$tahun' ORDER BY bulan DESC")->result_array();
    }

    public function getKdjns($tahun = null, $bulan = null)
    {
        return $this->db->query("SELECT DISTINCT kdjns FROM m_gaji WHERE tahun='$tahun' AND bulan='$bulan' ORDER BY kdjns ASC")->result_array();
    }

    public function getGaji($tahun = null, $bulan = null, $kdjns = null)
    {
        return $this->db->query("SELECT kdsatker,kdanak, LEFT(kdgapok,1) AS kdgapok, COUNT(nip) AS jml FROM m_gaji WHERE tahun='$tahun' AND bulan='$bulan' AND kdjns='$kdjns' GROUP BY kdsatker,kdanak, LEFT(kdgapok,1)")->result_array();
    }

    public function getDetailGaji($bulan = null, $tahun = null, $kdjns = null, $kdsatker = null, $kdanak = null, $kdgapok = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.*, b.nmpeg FROM m_gaji a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE a.bulan='$bulan' AND a.tahun='$tahun' AND a.kdjns='$kdjns' AND a.kdsatker='$kdsatker' AND a.kdanak='$kdanak' AND LEFT(a.kdgapok,1)='$kdgapok' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function findDetailGaji($bulan = null, $tahun = null, $kdjns = null, $kdsatker = null, $kdanak = null, $kdgapok = null, $keyword = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.*, b.nmpeg FROM m_gaji a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE a.bulan='$bulan' AND a.tahun='$tahun' AND a.kdjns='$kdjns' AND a.kdsatker='$kdsatker' AND a.kdanak='$kdanak' AND LEFT(a.kdgapok,1)='$kdgapok' AND b.nmpeg LIKE '%$keyword%' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function countGaji($tahun = null, $bulan = null, $kdjns = null, $kdsatker = null, $kdanak = null, $kdgapok = null)
    {
        return $this->db->query("SELECT * FROM m_gaji WHERE tahun='$tahun' AND bulan='$bulan' AND kdjns='$kdjns' AND kdsatker='$kdsatker' AND kdanak='$kdanak' AND LEFT(kdgapok,1)='$kdgapok'")->num_rows();
    }
    public function upload($bulan = null, $tahun = null, $kdjns = null, $kdsatker = null, $kdanak = null, $kdgapok = null)
    {
        $rows = $this->db->query("SELECT * FROM m_gaji WHERE bulan='$bulan' AND tahun='$tahun' AND kdjns='$kdjns' AND kdsatker='$kdsatker' AND kdanak='$kdanak' AND LEFT(kdgapok,1)='$kdgapok'")->result_array();
        switch ($kdjns) {
            case '7':
                $bulan = '13';
                break;
            case '9':
                $bulan = '14';
                break;
            default:
                $bulan = $bulan;
                break;
        }
        foreach ($rows as $r) {
            $response = $this->_client->request('POST', 'data-gaji', [
                'form_params' => [
                    'kdjns' => $r['kdjns'],
                    'kdsatker' => $r['kdsatker'],
                    'kdanak' => $r['kdanak'],
                    'kdsubanak' => $r['kdsubanak'],
                    'kdkawin' => $r['kdkawin'],
                    'kdgapok' => $r['kdgapok'],
                    'kdjab' => $r['kdjab'],
                    'bulan' => $bulan,
                    'tahun' => $r['tahun'],
                    'nip' => $r['nip'],
                    'gapok' => $r['gapok'],
                    'tistri' => $r['tistri'],
                    'tanak' => $r['tanak'],
                    'tumum' => $r['tumum'],
                    'ttambumum' => $r['ttambumum'],
                    'tstruktur' => $r['tstruktur'],
                    'tfungsi' => $r['tfungsi'],
                    'bulat' => $r['bulat'],
                    'tberas' => $r['tberas'],
                    'tpajak' => $r['tpajak'],
                    'pberas' => $r['pberas'],
                    'tpapua' => $r['tpapua'],
                    'tpencil' => $r['tpencil'],
                    'tlain' => $r['tlain'],
                    'iwp' => $r['iwp'],
                    'pph' => $r['pph'],
                    'sewarmh' => $r['sewarmh'],
                    'tunggakan' => $r['tunggakan'],
                    'utanglebih' => $r['utanglebih'],
                    'potlain' => $r['potlain'],
                    'taperum' => $r['taperum'],
                    'bpjs' => $r['bpjs'],
                    'X-API-KEY' => apiKey()
                ]
            ]);
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    public function uploadDetail($nip, $bulan, $tahun, $kdjns, $kdsatker)
    {
        $r = $this->db->get_where('m_gaji', ['nip' => $nip, 'bulan' => $bulan, 'tahun' => $tahun, 'kdjns' => $kdjns, 'kdsatker' => $kdsatker])->row_array();
        switch ($kdjns) {
            case '7':
                $bulan = '13';
                break;
            case '9':
                $bulan = '14';
                break;
            default:
                $bulan = $bulan;
                break;
        }
        $response = $this->_client->request('POST', 'data-gaji', [
            'form_params' => [
                'kdjns' => $r['kdjns'],
                'kdsatker' => $r['kdsatker'],
                'kdanak' => $r['kdanak'],
                'kdsubanak' => $r['kdsubanak'],
                'kdkawin' => $r['kdkawin'],
                'kdgapok' => $r['kdgapok'],
                'kdjab' => $r['kdjab'],
                'bulan' => $bulan,
                'tahun' => $r['tahun'],
                'nip' => $r['nip'],
                'gapok' => $r['gapok'],
                'tistri' => $r['tistri'],
                'tanak' => $r['tanak'],
                'tumum' => $r['tumum'],
                'ttambumum' => $r['ttambumum'],
                'tstruktur' => $r['tstruktur'],
                'tfungsi' => $r['tfungsi'],
                'bulat' => $r['bulat'],
                'tberas' => $r['tberas'],
                'tpajak' => $r['tpajak'],
                'pberas' => $r['pberas'],
                'tpapua' => $r['tpapua'],
                'tpencil' => $r['tpencil'],
                'tlain' => $r['tlain'],
                'iwp' => $r['iwp'],
                'pph' => $r['pph'],
                'sewarmh' => $r['sewarmh'],
                'tunggakan' => $r['tunggakan'],
                'utanglebih' => $r['utanglebih'],
                'potlain' => $r['potlain'],
                'taperum' => $r['taperum'],
                'bpjs' => $r['bpjs'],
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
