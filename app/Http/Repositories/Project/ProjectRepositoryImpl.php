<?php

namespace App\Http\Repositories\Project;

use App\Models\Project;
use App\Http\Repositories\Project\ProjectRepository;

class ProjectRepositoryImpl implements ProjectRepository {

     /** @var Project */
    protected $model;

    public function __construct(Project $model)
    {
        $this->model = $model;
       
    }

    public function getProjects() {
        return $this->model::with('activities', 'users')->get();
    }


    public function getProjectById(int $id) {
        return $this->model->find($id);
    }

    
    public function getProjectUsers(int $id) {
        return $this->model->find($id)->users();
    }

    
    public function getProjectActivities(int $id) {
        return $this->model->find($id)->activities();
    }


    public function createProject(string $name) {
        return $this->model->create(['name' => $name]);
    }

    public function addUser(int $projectId, int $userId, $rol)
    {
     return $this->model->find($projectId)->users()->attach($userId, ['rol' => $rol]);   
    }
}