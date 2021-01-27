<?php

use GuzzleHttp\Client;

class M_lembur_model extends CI_Model
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
        return $this->db->query("SELECT DISTINCT thn AS tahun FROM m_lembur ORDER BY thn DESC")->result_array();
    }

    public function getBulan($thn = null)
    {
        return $this->db->query("SELECT DISTINCT bln AS bulan FROM m_lembur WHERE thn='$thn' ORDER BY bln DESC")->result_array();
    }

    public function getLembur($thn = null, $bln = null)
    {
        return $this->db->query("SELECT kdsatker,kdanak, gol, COUNT(nip) AS jml FROM m_lembur WHERE thn='$thn' AND bln='$bln' GROUP BY kdsatker,kdanak,gol")->result_array();
    }

    public function getDetailLembur($bln = null, $thn = null, $kdsatker = null, $kdanak = null, $gol = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.*,b.nmpeg FROM m_lembur a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE a.bln='$bln' AND a.thn='$thn' AND a.kdsatker='$kdsatker' AND a.kdanak='$kdanak' AND a.gol='$gol' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function findDetailLembur($bln = null, $thn = null, $kdsatker = null, $kdanak = null, $gol = null, $keyword = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.*,b.nmpeg FROM m_lembur a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE a.bln='$bln' AND a.thn='$thn' AND a.kdsatker='$kdsatker' AND a.kdanak='$kdanak' AND a.gol='$gol' AND b.nmpeg LIKE '%$keyword%' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function countLembur($thn = null, $bln = null, $kdsatker = null, $kdanak = null, $gol = null)
    {
        return $this->db->query("SELECT * FROM m_lembur WHERE thn='$thn' AND bln='$bln' AND kdsatker='$kdsatker' AND kdanak='$kdanak' AND gol='$gol'")->num_rows();
    }
    public function upload($bln = null, $thn = null, $kdsatker = null, $kdanak = null, $gol = null)
    {
        $rows = $this->db->query("SELECT * FROM m_lembur WHERE bln='$bln' AND thn='$thn' AND kdsatker='$kdsatker' AND kdanak='$kdanak' AND gol='$gol'")->result_array();
        foreach ($rows as $r) {
            $response = $this->_client->request('POST', 'data-lembur', [
                'form_params' => [
                    'bulan' => $r['bln'],
                    'tahun' => $r['thn'],
                    'kdsatker' => $r['kdsatker'],
                    'kdanak' => $r['kdanak'],
                    'nip' => $r['nip'],
                    'gol' => $r['gol'],
                    'lembur' => $r['lembur'],
                    'makan' => $r['makan'],
                    'pph' => $r['pph'],
                    'bruto' => $r['lembur'] + $r['makan'],
                    'netto' => $r['lembur'] + $r['makan'] - $r['pph'],
                    'keterangan' => $r['keterangan'],
                    'jhari1' => $r['jhari1'],
                    'jhari2' => $r['jhari2'],
                    'jhari3' => $r['jhari3'],
                    'jhari4' => $r['jhari4'],
                    'jhari5' => $r['jhari5'],
                    'jhari6' => $r['jhari6'],
                    'jhari7' => $r['jhari7'],
                    'jhari8' => $r['jhari8'],
                    'jhari9' => $r['jhari9'],
                    'jhari10' => $r['jhari10'],
                    'jhari11' => $r['jhari11'],
                    'jhari12' => $r['jhari12'],
                    'jhari13' => $r['jhari13'],
                    'jhari14' => $r['jhari14'],
                    'jhari15' => $r['jhari15'],
                    'jhari16' => $r['jhari16'],
                    'jhari17' => $r['jhari17'],
                    'jhari18' => $r['jhari18'],
                    'jhari19' => $r['jhari19'],
                    'jhari20' => $r['jhari20'],
                    'jhari21' => $r['jhari21'],
                    'jhari22' => $r['jhari22'],
                    'jhari23' => $r['jhari23'],
                    'jhari24' => $r['jhari24'],
                    'jhari25' => $r['jhari25'],
                    'jhari26' => $r['jhari26'],
                    'jhari27' => $r['jhari27'],
                    'jhari28' => $r['jhari28'],
                    'jhari29' => $r['jhari29'],
                    'jhari30' => $r['jhari30'],
                    'jhari31' => $r['jhari31'],
                    'jkerja' => $r['jkerja'],
                    'jlibur' => $r['jlibur'],
                    'jmakan' => $r['jmakan'],
                    'X-API-KEY' => apiKey()
                ]
            ]);
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    public function uploadDetail($nip, $bln, $thn, $kdsatker)
    {
        $r = $this->db->get_where('m_lembur', ['nip' => $nip, 'bln' => $bln, 'thn' => $thn, 'kdsatker' => $kdsatker])->row_array();
        $response = $this->_client->request('POST', 'data-lembur', [
            'form_params' => [
                'bulan' => $r['bln'],
                'tahun' => $r['thn'],
                'kdsatker' => $r['kdsatker'],
                'kdanak' => $r['kdanak'],
                'nip' => $r['nip'],
                'gol' => $r['gol'],
                'lembur' => $r['lembur'],
                'makan' => $r['makan'],
                'pph' => $r['pph'],
                'bruto' => $r['lembur'] + $r['makan'],
                'netto' => $r['lembur'] + $r['makan'] - $r['pph'],
                'keterangan' => $r['keterangan'],
                'jhari1' => $r['jhari1'],
                'jhari2' => $r['jhari2'],
                'jhari3' => $r['jhari3'],
                'jhari4' => $r['jhari4'],
                'jhari5' => $r['jhari5'],
                'jhari6' => $r['jhari6'],
                'jhari7' => $r['jhari7'],
                'jhari8' => $r['jhari8'],
                'jhari9' => $r['jhari9'],
                'jhari10' => $r['jhari10'],
                'jhari11' => $r['jhari11'],
                'jhari12' => $r['jhari12'],
                'jhari13' => $r['jhari13'],
                'jhari14' => $r['jhari14'],
                'jhari15' => $r['jhari15'],
                'jhari16' => $r['jhari16'],
                'jhari17' => $r['jhari17'],
                'jhari18' => $r['jhari18'],
                'jhari19' => $r['jhari19'],
                'jhari20' => $r['jhari20'],
                'jhari21' => $r['jhari21'],
                'jhari22' => $r['jhari22'],
                'jhari23' => $r['jhari23'],
                'jhari24' => $r['jhari24'],
                'jhari25' => $r['jhari25'],
                'jhari26' => $r['jhari26'],
                'jhari27' => $r['jhari27'],
                'jhari28' => $r['jhari28'],
                'jhari29' => $r['jhari29'],
                'jhari30' => $r['jhari30'],
                'jhari31' => $r['jhari31'],
                'jkerja' => $r['jkerja'],
                'jlibur' => $r['jlibur'],
                'jmakan' => $r['jmakan'],
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
