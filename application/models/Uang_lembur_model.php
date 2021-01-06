<?php

use GuzzleHttp\Client;

class Uang_lembur_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => base_uri(),
            'auth' => auth()
        ]);
    }

    public function getUangLembur($id = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-lembur', [
            'query' => [
                $id === null ?: 'id' => $id,
                'limit' => $limit,
                'offset' => $offset,
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function findUangLembur($keyword1 = null, $keyword2 = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-lembur', [
            'query' => [
                'keyword1' => $keyword1,
                'keyword2' => $keyword2,
                'limit' => $limit,
                'offset' => $offset,
                'X-API-KEY' => 'admin-alika'
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function deleteUangLembur($id)
    {
        $response = $this->_client->request('DELETE', 'data-lembur', [
            'form_params' => [
                'id' => $id,
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function countUangLembur()
    {
        $response = $this->_client->request('GET', 'count-data-lembur', [
            'query' => [
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
