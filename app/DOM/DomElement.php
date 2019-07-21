<?php


namespace App\DOM;


use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;

interface DomElement
{
    public function getCount(Crawler $crawler): int;

    public function extract(Crawler $crawler): Collection;
}