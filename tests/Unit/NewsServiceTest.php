<?php

namespace Tests\Unit;

use App\Models\System\News;
use App\Repositories\Api\V1\System\NewsRepository;
use App\Services\Api\V1\Impl\NewsServiceImpl;
use App\Services\Core\FileService;
use Mockery\MockInterface;
use Tests\TestCase;

class NewsServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNewsService()
    {

        $data = [
            'title' => "TEST",
            'description' => "TEST",
            'text' => "TEST",
        ];
        $newsRepo = $this->mock(NewsRepository::class, function (MockInterface $mock) {
            $news = new News();
            $news->id = 2;
            $news->title = 'Nureke';
            $news->description = 'Nureke';
            $news->text = 'Nureke';
            $mock->shouldReceive('store')
                ->andReturn($news);
        });

        $fileService = $this->mock(FileService::class, function (MockInterface $mock) {

        });

        $newsService = new NewsServiceImpl($fileService, $newsRepo);
        $data = $newsService->store($data);
        $num = $newsService->deleteById(2);

        self::assertNotNull($num);
        self::assertNotNull($data);
        self::assertTrue($data->resource instanceof News);
        self::assertNotNull($data->id);
        self::assertArrayHasKey('id', $data);
    }


}
