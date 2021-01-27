<?php

use GuzzleHttp\Client;

class T_pegawai_model extends CI_Model
{
    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => base_uri(),
            'auth' => auth()
        ]);
    }

    public function getPegawai()
    {
        return $this->db->query("SELECT kdsatker,kdanak, LEFT(kdgol,1) AS kdgol, COUNT(nip) AS jml FROM t_pegawai GROUP BY kdsatker,kdanak, LEFT(kdgol,1)")->result_array();
    }

    public function getDetailPegawai($kdsatker = null, $kdanak = null, $kdgol = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT * FROM t_pegawai WHERE kdsatker='$kdsatker' AND kdanak='$kdanak' AND LEFT(kdgol,1)='$kdgol' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function findDetailPegawai($kdsatker = null, $kdanak = null, $kdgol = null, $keyword = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT * FROM t_pegawai WHERE kdsatker='$kdsatker' AND kdanak='$kdanak' AND LEFT(kdgol,1)='$kdgol' AND nmpeg LIKE '%$keyword%' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function countPegawai($kdsatker = null, $kdanak = null, $kdgol = null)
    {
        return $this->db->query("SELECT * FROM t_pegawai WHERE kdsatker='$kdsatker' AND kdanak='$kdanak' AND LEFT(kdgol,1)='$kdgol'")->num_rows();
    }
    public function upload($kdsatker = null, $kdanak = null, $kdgol = null)
    {
        $rows = $this->db->query("SELECT * FROM t_pegawai WHERE kdsatker='$kdsatker' AND kdanak='$kdanak' AND LEFT(kdgol,1)='$kdgol'")->result_array();
        foreach ($rows as $r) {
            $response = $this->_client->request('POST', 'data-pegawai', [
                'form_params' => [
                    'kdsatker' => $r['kdsatker'],
                    'kdanak' => $r['kdanak'],
                    'kdsubanak' => $r['kdsubanak'],
                    'nip' => $r['nip'],
                    'nmpeg' => $r['nmpeg'],
                    'kdpeg' => $r['kdpeg'],
                    'kdduduk' => $r['kdduduk'],
                    'tempatlhr' => $r['tempatlhr'],
                    'tgllhr' => $r['tgllhr'],
                    'kdgol' => $r['kdgol'],
                    'kdkawin' => $r['kdkawin'],
                    'kdjab' => $r['kdjab'],
                    'kdgapok' => $r['kdgapok'],
                    'rekening' => $r['rekening'],
                    'kdkelamin' => $r['kdkelamin'],
                    'alamat' => $r['alamat'],
                    'npwp' => $r['npwp'],
                    'nm_bank' => $r['nm_bank'],
                    'nmrek' => $r['nmrek'],
                    'X-API-KEY' => apiKey()
                ]
            ]);
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    public function uploadDetail($nip, $kdsatker)
    {
        $r = $this->db->get_where('t_pegawai', ['nip' => $nip, 'kdsatker' => $kdsatker])->row_array();
        $response = $this->_client->request('POST', 'data-pegawai', [
            'form_params' => [
                'kdsatker' => $r['kdsatker'],
                'kdanak' => $r['kdanak'],
                'kdsubanak' => $r['kdsubanak'],
                'nip' => $r['nip'],
                'nmpeg' => $r['nmpeg'],
                'kdpeg' => $r['kdpeg'],
                'kdduduk' => $r['kdduduk'],
                'tempatlhr' => $r['tempatlhr'],
                'tgllhr' => $r['tgllhr'],
                'kdgol' => $r['kdgol'],
                'kdkawin' => $r['kdkawin'],
                'kdjab' => $r['kdjab'],
                'kdgapok' => $r['kdgapok'],
                'rekening' => $r['rekening'],
                'kdkelamin' => $r['kdkelamin'],
                'alamat' => $r['alamat'],
                'npwp' => $r['npwp'],
                'nm_bank' => $r['nm_bank'],
                'nmrek' => $r['nmrek'],
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
