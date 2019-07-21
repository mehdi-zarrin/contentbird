<?php


namespace App\DataTransferObject;


class PageTransformer implements Transformer
{
    public $id;
    public $result;
    public $url;

    public function transform($data): Transformer
    {
        $page = new self;
        $page->id = $data->id;
        $page->result = json_decode($data->result, true);
        $page->url = $data->url;

        return $page;
    }

}