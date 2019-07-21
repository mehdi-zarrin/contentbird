<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\DataTransferObject\PageTransformer;
use App\Http\Requests\PageRequest;
use App\Repository\PageRepository;
use App\Service\Analyzer;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response;

class CrawlerController extends Controller
{
    use ApiResponse;
    /**
     * @var Analyzer
     */
    private $analyzer;
    /**
     * @var PageRepository
     */
    private $pageRepository;
    /**
     * @var PageTransformer
     */
    private $pageTransformer;

    public function __construct(Analyzer $analyzer, PageRepository $pageRepository, PageTransformer $pageTransformer)
    {
        $this->analyzer = $analyzer;
        $this->pageRepository = $pageRepository;
        $this->pageTransformer = $pageTransformer;
    }

    public function fetch(PageRequest $request)
    {
        $url = $request->url;
        if($page = $this->pageRepository->getPageByUrl($url)) {
            return $this->createSuccessResponse($page, $this->pageTransformer);
        }

        try {

            $result = $this->analyzer->handle($url);

        } catch (\Exception $e) {

            return response()->json([
                'message' => Lang::get('api.invalid_url')
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

        }

        $page = $this->pageRepository->create($url, $result);
        return $this->createSuccessResponse($page, $this->pageTransformer);
    }

    public function show($id)
    {
        $page = $this->pageRepository->findById($id);
        if(! $page) {

            return response()->json([
                'message' => Lang::get('api.not_found')
            ], Response::HTTP_NOT_FOUND);

        }

        return $this->createSuccessResponse($page, $this->pageTransformer);
    }


}
