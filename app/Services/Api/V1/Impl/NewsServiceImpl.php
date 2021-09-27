<?php

namespace App\Services\Api\V1\Impl;

use App\Http\Resources\NewsResource;
use App\Models\System\News;
use App\Repositories\Api\V1\System\NewsRepository;
use App\Services\Api\V1\NewsService;
use App\Services\Core\FileService;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;

class NewsServiceImpl implements NewsService
{
    protected $fileService;
    protected $newsRepository;

    /**
     * @param $fileService
     * @param $newsRepository
     */
    public function __construct(FileService $fileService, NewsRepository $newsRepository)
    {
        $this->fileService = $fileService;
        $this->newsRepository = $newsRepository;
    }


    public function store($data)
    {
        if (array_key_exists('image', $data) && $data['image']) {
            $image_path = $this->fileService->store($data['image'], News::FILE_STORE);
            $data['image_path'] = $image_path;
            unset($data['image']);
        }
        return NewsResource::make($this->newsRepository->store($data));
    }

    public function getAll()
    {
        return NewsResource::collection($this->newsRepository->all());
    }

    public function show($id)
    {
        return $this->newsRepository->find($id);
    }

    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $news = $this->newsRepository->find($id);
            if ($news->image_path != null) {
                $this->fileService->remove($news->image_path);
            }
            $message = $this->newsRepository->deleteById($id);
        } catch (\Exception $e) {
            throw new InvalidArgumentException('Unable to delete');
        }

        DB::commit();
        return $message;
    }

    public function update($data, $id)
    {
        $news = $this->newsRepository->find($id);
        if (array_key_exists('image', $data) && $data['image']) {
            $image_path = $this->fileService
                ->updateWithRemoveOrStore(
                    $data['image'], News::FILE_STORE, $news->image_path
                );
            $data ['image_path'] = $image_path;
            unset($data['image']);
        }
        return $this->newsRepository->updateById($data, $id);
    }
}
