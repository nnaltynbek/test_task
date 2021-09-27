<?php

namespace App\Http\Controllers\Api\V1\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\System\News\CreateNewsApiRequest;
use App\Http\Requests\Api\v1\System\News\UpdateNewsApiRequest;
use App\Services\Api\V1\NewsService;

class NewsController extends Controller
{
    protected $newsService;

    /**
     * @param $newsService
     */
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function getAll()
    {
        return $this->newsService->getAll();
    }

    public function create(CreateNewsApiRequest $request)
    {
        return $this->newsService->store($request->all());
    }

    public function show($id)
    {
        return $this->newsService->show($id);
    }

    public function delete($id)
    {
        return $this->newsService->deleteById($id);
    }


    public function update($id, UpdateNewsApiRequest $request)
    {
        return $this->newsService->update($request->all(), $id);
    }

}
