<?php


namespace App\Service;
use App\DOM\ExternalLink;
use App\DOM\Image;
use App\DOM\InternalLink;

class Analyzer
{
    /**
     * @var UrlConverter
     */
    private $converter;

    public $elements = [
        'externalLinks' => ExternalLink::class,
        'internalLinks' => InternalLink::class,
        'images' => Image::class,
    ];

    public function __construct(UrlConverter $converter)
    {
        $this->converter = $converter;
    }

    public function handle(string $url)
    {
        $crawler = $this->converter->get($url);

        $result = [];
        foreach($this->elements as $key => $element) {
            $result[$key] = resolve($element)->getCount($crawler);
        }
        $result['title'] = $this->getTitle($crawler);

        return $result;
    }

    private function getTitle($crawler)
    {
        return $crawler->filter('title')->text() ?: '';
    }

}