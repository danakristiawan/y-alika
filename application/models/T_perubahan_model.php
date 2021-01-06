<?php

use GuzzleHttp\Client;

class T_perubahan_model extends CI_Model
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
        return $this->db->query("SELECT DISTINCT DATE_FORMAT(tglupdate,'%Y') AS tahun FROM t_perubahan ORDER BY DATE_FORMAT(tglupdate,'%Y') DESC")->result_array();
    }

    public function getBulan($thn = null)
    {
        return $this->db->query("SELECT DISTINCT DATE_FORMAT(tglupdate,'%m') AS bulan FROM t_perubahan WHERE DATE_FORMAT(tglupdate,'%Y')='$thn' ORDER BY DATE_FORMAT(tglupdate,'%m') DESC")->result_array();
    }

    public function getPerubahan($thn = null, $bln = null)
    {
        return $this->db->query("SELECT a.kdsatker,b.kdanak, LEFT(a.kdgol,1) AS kdgol, COUNT(a.nip) AS jml FROM t_perubahan a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE DATE_FORMAT(a.tglupdate,'%Y')='$thn' AND DATE_FORMAT(a.tglupdate,'%m')='$bln' GROUP BY a.kdsatker,b.kdanak, LEFT(a.kdgol,1)")->result_array();
    }

    public function getDetailPerubahan($bln = null, $thn = null, $kdsatker = null, $kdanak = null, $kdgol = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.*,DATE_FORMAT(a.tglupdate,'%Y') AS thn,DATE_FORMAT(a.tglupdate,'%m') AS bln,b.nmpeg,b.kdanak FROM t_perubahan a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE DATE_FORMAT(a.tglupdate,'%m')='$bln' AND DATE_FORMAT(a.tglupdate,'%Y')='$thn' AND a.kdsatker='$kdsatker' AND b.kdanak='$kdanak' AND LEFT(a.kdgol,1)='$kdgol' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function findDetailPerubahan($bln = null, $thn = null, $kdsatker = null, $kdanak = null, $kdgol = null, $keyword = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.*,DATE_FORMAT(a.tglupdate,'%Y') AS thn,DATE_FORMAT(a.tglupdate,'%m') AS bln,b.nmpeg,b.kdanak FROM t_perubahan a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE DATE_FORMAT(a.tglupdate,'%m')='$bln' AND DATE_FORMAT(a.tglupdate,'%Y')='$thn' AND a.kdsatker='$kdsatker' AND b.kdanak='$kdanak' AND LEFT(a.kdgol,1)='$kdgol' AND b.nmpeg LIKE '%$keyword%' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function countPerubahan($thn = null, $bln = null, $kdsatker = null, $kdanak = null, $kdgol = null)
    {
        return $this->db->query("SELECT a.* FROM t_perubahan a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE DATE_FORMAT(a.tglupdate,'%Y')='$thn' AND DATE_FORMAT(a.tglupdate,'%m')='$bln' AND a.kdsatker='$kdsatker' AND b.kdanak='$kdanak' AND LEFT(a.kdgol,1)='$kdgol'")->num_rows();
    }
    public function upload($bln = null, $thn = null, $kdsatker = null, $kdanak = null, $kdgol = null)
    {
        $rows = $this->db->query("SELECT a.kdsatker,a.nip,a.tgl,a.no,a.uraian,a.tmt,a.tglupdate,a.kdgapok,DATE_FORMAT(a.tglupdate,'%m') AS bulan,DATE_FORMAT(a.tglupdate,'%Y') AS tahun FROM t_perubahan a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE DATE_FORMAT(a.tglupdate,'%Y')='$thn' AND DATE_FORMAT(a.tglupdate,'%m')='$bln' AND a.kdsatker='$kdsatker' AND b.kdanak='$kdanak' AND LEFT(a.kdgol,1)='$kdgol'")->result_array();
        foreach ($rows as $r) {
            $response = $this->_client->request('POST', 'data-perubahan', [
                'form_params' => [
                    'kdsatker' => $r['kdsatker'],
                    'nip' => $r['nip'],
                    'tgl' => $r['tgl'],
                    'no' => $r['no'],
                    'uraian' => $r['uraian'],
                    'tmt' => $r['tmt'],
                    'tglupdate' => $r['tglupdate'],
                    'kdgapok' => $r['kdgapok'],
                    'bulan' => $r['bulan'],
                    'tahun' => $r['tahun'],
                    'X-API-KEY' => 'admin-alika'
                ]
            ]);
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    public function uploadDetail($nip, $bln, $thn, $kdsatker, $tgl)
    {
        $r = $this->db->query("SELECT kdsatker,nip,tgl,no,uraian,tmt,tglupdate,kdgapok,DATE_FORMAT(tglupdate,'%m') AS bulan,DATE_FORMAT(tglupdate,'%Y') AS tahun FROM t_perubahan WHERE nip='$nip' AND DATE_FORMAT(tglupdate,'%Y')='$thn' AND DATE_FORMAT(tglupdate,'%m')='$bln' AND kdsatker='$kdsatker' AND tgl='$tgl'")->row_array();
        $response = $this->_client->request('POST', 'data-perubahan', [
            'form_params' => [
                'kdsatker' => $r['kdsatker'],
                'nip' => $r['nip'],
                'tgl' => $r['tgl'],
                'no' => $r['no'],
                'uraian' => $r['uraian'],
                'tmt' => $r['tmt'],
                'tglupdate' => $r['tglupdate'],
                'kdgapok' => $r['kdgapok'],
                'bulan' => $r['bulan'],
                'tahun' => $r['tahun'],
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
