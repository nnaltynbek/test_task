<?php

namespace App\Repositories;

use App\Services\Core\FileService;
use Exception;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{

    /**
     * Local application instance.
     *
     * @var $app
     */
    private $app;


    /**
     * @var Model
     */
    public $model;


    public function __construct()
    {
        $this->app = new Container();
        $this->makeModel();
    }

    /**
     * @return mixed
     */
    abstract function model();

    /**
     * @return mixed
     * @throws \Exception
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new Exception(
                "Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)->first()->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function where($attribute, $value)
    {
        return $this->model->where($attribute, '=', $value);
    }

    public function paginate($count = 5)
    {
        return $this->model->paginate($count);
    }

}
