<?php

namespace App\Http\Repositories\User;

use App\Models\User;
use App\Http\Repositories\User\UserRepository;

class UserRepositoryImpl implements UserRepository{

     /** @var User */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
       
    }

    public function getUsers() {
        return $this->model->all();
    }


    public function getUserById(int $id) {
        return $this->model->find($id);
    }

    
    public function getUserProjects(int $id) {
        return $this->model->find($id)->projects();
    }

    
    public function getUserActivities(int $id) {
        return $this->model->find($id)->activities();
    }

    
    public function getUserIncidences(int $id) {
        return [];
    }

    public function createUser(string $name) {
        return $this->model->create(['name' => $name]);
    }
}