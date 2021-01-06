<?php

use GuzzleHttp\Client;

class T_keluarga_model extends CI_Model
{
    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => base_uri(),
            'auth' => auth()
        ]);
    }

    public function getKeluarga()
    {
        return $this->db->query("SELECT a.kdsatker,b.kdanak, LEFT(b.kdgol,1) AS kdgol, COUNT(a.nip) AS jml FROM t_keluarga a LEFT JOIN t_pegawai b ON a.nip=b.nip GROUP BY a.kdsatker,b.kdanak, LEFT(b.kdgol,1)")->result_array();
    }

    public function getDetailKeluarga($kdsatker = null, $kdanak = null, $kdgol = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.* ,b.nmpeg,b.kdanak, LEFT(b.kdgol,1) AS kdgol FROM t_keluarga a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE a.kdsatker='$kdsatker' AND b.kdanak='$kdanak' AND LEFT(b.kdgol,1)='$kdgol' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function findDetailKeluarga($kdsatker = null, $kdanak = null, $kdgol = null, $keyword = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.* ,b.nmpeg,b.kdanak, LEFT(b.kdgol,1) AS kdgol FROM t_keluarga a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE a.kdsatker='$kdsatker' AND b.kdanak='$kdanak' AND LEFT(b.kdgol,1)='$kdgol' AND b.nmpeg LIKE '%$keyword%' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function countKeluarga($kdsatker = null, $kdanak = null, $kdgol = null)
    {
        return $this->db->query("SELECT a.* FROM t_keluarga a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE a.kdsatker='$kdsatker' AND b.kdanak='$kdanak' AND LEFT(b.kdgol,1)='$kdgol'")->num_rows();
    }
    public function upload($kdsatker = null, $kdanak = null, $kdgol = null)
    {
        $rows = $this->db->query("SELECT a.*,b.kdanak,b.kdgol FROM t_keluarga a LEFT JOIN t_pegawai b ON a.nip=b.nip WHERE a.kdsatker='$kdsatker' AND b.kdanak='$kdanak' AND LEFT(b.kdgol,1)='$kdgol'")->result_array();
        foreach ($rows as $r) {
            $response = $this->_client->request('POST', 'data-keluarga', [
                'form_params' => [
                    'kdsatker' => $r['kdsatker'],
                    'nip' => $r['nip'],
                    'nama' => $r['nama'],
                    'kdkeluarga' => $r['kdkeluarga'],
                    'tgllhr' => $r['tgllhr'],
                    'kddapat' => $r['kddapat'],
                    'X-API-KEY' => 'admin-alika'
                ]
            ]);
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    public function uploadDetail($nip, $kdsatker, $tgllhr)
    {
        $r = $this->db->get_where('t_keluarga', ['nip' => $nip, 'kdsatker' => $kdsatker, 'tgllhr' => $tgllhr])->row_array();
        $response = $this->_client->request('POST', 'data-keluarga', [
            'form_params' => [
                'kdsatker' => $r['kdsatker'],
                'nip' => $r['nip'],
                'nama' => $r['nama'],
                'kdkeluarga' => $r['kdkeluarga'],
                'tgllhr' => $r['tgllhr'],
                'kddapat' => $r['kddapat'],
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
