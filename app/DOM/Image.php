<?php


namespace App\DOM;
use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;

class Image implements DomElement
{
    public function getCount(Crawler $crawler): int
    {
        return $this->extract($crawler)->count();
    }

    public function extract(Crawler $crawler): Collection
    {
        return collect(
            $crawler->filter('img')
        );
    }

}