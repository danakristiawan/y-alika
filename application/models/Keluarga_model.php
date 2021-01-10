<?php

use GuzzleHttp\Client;

class Keluarga_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => base_uri(),
            'auth' => auth()
        ]);
    }

    public function getKeluarga($id = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-keluarga', [
            'query' => [
                $id === null ?: 'id' => $id,
                'limit' => $limit,
                'offset' => $offset,
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function findKeluarga($keyword = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-keluarga', [
            'query' => [
                'keyword' => $keyword,
                'limit' => $limit,
                'offset' => $offset,
                'X-API-KEY' => 'admin-alika'
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function deleteKeluarga($id)
    {
        $response = $this->_client->request('DELETE', 'data-keluarga', [
            'form_params' => [
                'id' => $id,
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function deleteKeluargaAll()
    {
        $response = $this->_client->request('DELETE', 'all-data-keluarga', [
            'form_params' => [
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function countKeluarga()
    {
        $response = $this->_client->request('GET', 'count-data-keluarga', [
            'query' => [
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
