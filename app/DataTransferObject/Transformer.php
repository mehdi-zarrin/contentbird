<?php
namespace App\DataTransferObject;
interface Transformer
{
    public function transform($data): Transformer;
}