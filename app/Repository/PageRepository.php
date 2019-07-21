<?php


namespace App\Repository;


use App\Page;

class PageRepository
{
    public function create($url, $result)
    {
        $page = Page::create([
           'url' => $url,
           'result' => json_encode($result),
        ]);
        return $page;
    }

    public function getPageByUrl($url)
    {
        return Page::where('url', $url)->first();
    }

    public function findById($id)
    {
        return Page::find($id);
    }

}