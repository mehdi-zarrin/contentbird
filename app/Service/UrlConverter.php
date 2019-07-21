<?php

namespace App\Service;
use PharIo\Manifest\InvalidUrlException;
use Symfony\Component\DomCrawler\Crawler;

class UrlConverter
{
    /**
     * @var Crawler
     */
    private $crawler;

    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    public function get(string $url): Crawler
    {
        try {

            $contents = file_get_contents($url);
            $this->crawler->addContent($contents);
            return $this->crawler;

        } catch (\Exception $e) {
            throw new InvalidUrlException($e->getMessage());
        }
    }

}