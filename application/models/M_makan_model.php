<?php

use GuzzleHttp\Client;

class M_makan_model extends CI_Model
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
        return $this->db->query("SELECT DISTINCT thn AS tahun FROM m_makan ORDER BY thn DESC")->result_array();
    }

    public function getBulan($thn = null)
    {
        return $this->db->query("SELECT DISTINCT bln AS bulan FROM m_makan WHERE thn='$thn' ORDER BY bln DESC")->result_array();
    }

    public function getMakan($thn = null, $bln = null)
    {
        return $this->db->query("SELECT kdsatker,kdanak, LEFT(kdgol,1) AS kdgol, COUNT(nip) AS jml FROM m_makan WHERE thn='$thn' AND bln='$bln' GROUP BY kdsatker,kdanak, LEFT(kdgol,1)")->result_array();
    }

    public function getDetailMakan($bln = null, $thn = null, $kdsatker = null, $kdanak = null, $kdgol = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.kdanak,LEFT(a.kdgol,1) AS kdgol,a.bln,a.thn,a.nip,b.nmpeg,a.jmlhari,a.tarif,a.pph,a.kdsatker FROM m_makan a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE a.bln='$bln' AND a.thn='$thn' AND a.kdsatker='$kdsatker' AND a.kdanak='$kdanak' AND LEFT(a.kdgol,1)='$kdgol' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function findDetailMakan($bln = null, $thn = null, $kdsatker = null, $kdanak = null, $kdgol = null, $keyword = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.kdanak,LEFT(a.kdgol,1) AS kdgol,a.bln,a.thn,a.nip,b.nmpeg,a.kdgol,a.jmlhari,a.tarif,a.pph,a.kdsatker FROM m_makan a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE a.bln='$bln' AND a.thn='$thn' AND a.kdsatker='$kdsatker' AND a.kdanak='$kdanak' AND LEFT(a.kdgol,1)='$kdgol' AND b.nmpeg LIKE '%$keyword%' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function countMakan($thn = null, $bln = null, $kdsatker = null, $kdanak = null, $kdgol = null)
    {
        return $this->db->query("SELECT * FROM m_makan WHERE thn='$thn' AND bln='$bln' AND kdsatker='$kdsatker' AND kdanak='$kdanak' AND LEFT(kdgol,1)='$kdgol'")->num_rows();
    }
    public function upload($bln = null, $thn = null, $kdsatker = null, $kdanak = null, $kdgol = null)
    {
        $rows = $this->db->query("SELECT * FROM m_makan WHERE bln='$bln' AND thn='$thn' AND kdsatker='$kdsatker' AND kdanak='$kdanak' AND LEFT(kdgol,1)='$kdgol'")->result_array();
        foreach ($rows as $r) {
            $response = $this->_client->request('POST', 'data-makan', [
                'form_params' => [
                    'nip' => $r['nip'],
                    'bulan' => $r['bln'],
                    'tahun' => $r['thn'],
                    'kdsatker' => $r['kdsatker'],
                    'kdanak' => $r['kdanak'],
                    'kdsubanak' => $r['kdsubanak'],
                    'kdgol' => $r['kdgol'],
                    'jmlhari' => $r['jmlhari'],
                    'tarif' => $r['tarif'],
                    'pph' => $r['pph'],
                    'bruto' => ($r['jmlhari'] * $r['tarif']),
                    'netto' => (($r['jmlhari'] * $r['tarif']) - $r['pph']),
                    'X-API-KEY' => 'admin-alika'
                ]
            ]);
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    public function uploadDetail($nip, $bln, $thn, $kdsatker)
    {
        $row = $this->db->get_where('m_makan', ['nip' => $nip, 'bln' => $bln, 'thn' => $thn, 'kdsatker' => $kdsatker])->row_array();
        $response = $this->_client->request('POST', 'data-makan', [
            'form_params' => [
                'nip' => $row['nip'],
                'bulan' => $row['bln'],
                'tahun' => $row['thn'],
                'kdsatker' => $row['kdsatker'],
                'kdanak' => $row['kdanak'],
                'kdsubanak' => $row['kdsubanak'],
                'kdgol' => $row['kdgol'],
                'jmlhari' => $row['jmlhari'],
                'tarif' => $row['tarif'],
                'pph' => $row['pph'],
                'bruto' => ($row['jmlhari'] * $row['tarif']),
                'netto' => (($row['jmlhari'] * $row['tarif']) - $row['pph']),
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
