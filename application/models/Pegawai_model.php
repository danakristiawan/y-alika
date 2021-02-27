<?php

use GuzzleHttp\Client;

class Pegawai_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => base_uri(),
            'verify' => false,
            'auth' => auth()
        ]);
    }

    public function getPegawai($id = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-pegawai', [
            'query' => [
                $id === null ?: 'id' => $id,
                'limit' => $limit,
                'offset' => $offset,
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function findPegawai($keyword = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-pegawai', [
            'query' => [
                'keyword' => $keyword,
                'limit' => $limit,
                'offset' => $offset,
                'X-API-KEY' => apiKey()
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function deletePegawai($id)
    {
        $response = $this->_client->request('DELETE', 'data-pegawai', [
            'form_params' => [
                'id' => $id,
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function deletePegawaiAll()
    {
        $response = $this->_client->request('DELETE', 'all-data-pegawai', [
            'form_params' => [
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function countPegawai()
    {
        $response = $this->_client->request('GET', 'count-data-pegawai', [
            'query' => [
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
