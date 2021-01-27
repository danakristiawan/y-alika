<?php

use GuzzleHttp\Client;

class Perubahan_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => base_uri(),
            'auth' => auth()
        ]);
    }

    public function getPerubahan($id = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-perubahan', [
            'query' => [
                $id === null ?: 'id' => $id,
                'limit' => $limit,
                'offset' => $offset,
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function findPerubahan($keyword1 = null, $keyword2 = null, $limit = 0, $offset = 0)
    {
        $response = $this->_client->request('GET', 'data-perubahan', [
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

    public function deletePerubahan($id)
    {
        $response = $this->_client->request('DELETE', 'data-perubahan', [
            'form_params' => [
                'id' => $id,
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function countPerubahan()
    {
        $response = $this->_client->request('GET', 'count-data-perubahan', [
            'query' => [
                'X-API-KEY' => apiKey()
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
