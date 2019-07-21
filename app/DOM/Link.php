<?php


namespace App\DOM;


use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;

abstract class Link
{
    public function extract(Crawler $crawler): Collection
    {
        return collect(
            $crawler->filter('a')->extract('href')
        );
    }

    public function isInternal(string $link)
    {
        if ($link == '#') return false;
        return null === parse_url($link, PHP_URL_SCHEME);
    }

    public function isExternal(string $link)
    {
        return !$this->isInternal($link);
    }

}