<?php

use GuzzleHttp\Client;

class Kekurangan_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => base_uri(),
            'auth' => auth()
        ]);
    }

    public function getKekurangan($id = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-kurang', [
            'query' => [
                $id === null ?: 'id' => $id,
                'limit' => $limit,
                'offset' => $offset,
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function findKekurangan($keyword1 = null, $keyword2 = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-kurang', [
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

    public function deleteKekurangan($id)
    {
        $response = $this->_client->request('DELETE', 'data-kurang', [
            'form_params' => [
                'id' => $id,
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function countKekurangan()
    {
        $response = $this->_client->request('GET', 'count-data-kurang', [
            'query' => [
                'X-API-KEY' => 'admin-alika'
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
