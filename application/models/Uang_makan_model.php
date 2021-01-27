<?php

use GuzzleHttp\Client;

class Uang_makan_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => base_uri(),
            'auth' => auth()
        ]);
    }

    public function getUangMakan($id = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-makan', [
            'query' => [
                $id === null ?: 'id' => $id,
                'limit' => $limit,
                'offset' => $offset,
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function findUangMakan($keyword1 = null, $keyword2 = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-makan', [
            'query' => [
                'keyword1' => $keyword1,
                'keyword2' => $keyword2,
                'limit' => $limit,
                'offset' => $offset,
                'X-API-KEY' => apiKey()
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function deleteUangMakan($id)
    {
        $response = $this->_client->request('DELETE', 'data-makan', [
            'form_params' => [
                'id' => $id,
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function countUangMakan()
    {
        $response = $this->_client->request('GET', 'count-data-makan', [
            'query' => [
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
