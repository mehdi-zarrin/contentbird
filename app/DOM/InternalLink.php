<?php


namespace App\DOM;


use Symfony\Component\DomCrawler\Crawler;

class InternalLink extends Link implements DomElement
{
    public function getCount(Crawler $crawler): int
    {
        return $this->extract($crawler)
                    ->filter(function($link) {
                        return $this->isInternal($link);
                    })->count();
    }
}