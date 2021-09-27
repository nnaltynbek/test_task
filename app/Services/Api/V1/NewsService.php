<?php

namespace App\Services\Api\V1;

interface NewsService
{
    public function store($data);

    public function getAll();

    public function show($id);

    public function deleteById($id);

    public function update($data, $id);
}
