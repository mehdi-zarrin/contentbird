<?php


namespace App\Traits;


use App\DataTransferObject\Transformer;

trait ApiResponse
{
    public function createSuccessResponse($data, Transformer $transformer)
    {
        $data = $transformer->transform($data);
        return [
            'data' => $data
        ];
    }
}