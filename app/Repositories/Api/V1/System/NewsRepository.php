<?php

namespace App\Repositories\Api\V1\System;

use App\Models\System\News;
use App\Repositories\Repository;

class NewsRepository extends Repository
{

    function model()
    {
        return News::class;
    }

    public function store($data)
    {
        return $this->create($data);
    }

    public function deleteById($id)
    {
        return $this->model->destroy($id);
    }

    public function updateById($data, $id)
    {
        return $this->update($data, $id);
    }

}
