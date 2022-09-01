<?php

namespace App\Http\Repositories\Activity;

use Exception;

use App\Models\Activity;
use App\Models\Project;
use App\Http\Repositories\Activity\ActivityRepository;
use Nette\Schema\Expect;

class ActivityRepositoryImpl implements ActivityRepository
{

    /** @var Activity */
    protected $model;

    public function __construct(Activity $model)
    {
        $this->model = $model;
    }

    public function getActivities()
    {
        return $this->model::with('incidences', 'users')->get();
    }


    public function getActivityById(int $id)
    {
        return $this->model->find($id);
    }


    public function getActivityUsers(int $id)
    {
        return $this->model->find($id)->users();
    }


    public function getActivityIncidences(int $id)
    {
        return $this->model->find($id)->activities();
    }


    public function createActivity(string $name, int $projectId)
    {
        return $this->model->create(['name' => $name, 'project_id' => $projectId]);
    }

    public function addUser(int $activityId, int $userId, string $rol)
    {
       
        return $this->model->find($activityId)->users()->attach($userId, ['rol' => $rol]);
    }

    public function addIncidence(int $activityId, int $incidenceId)
    {
        return $this->model->find($activityId)->incidences()->attach([$incidenceId]);
    }

    public function checkUserCanBeAdded(int $userId, int $activityId)
    {
        $projectId = $this->model->find($activityId)->projectId;
        if ($projectId != null) {
            $users = Project::find($projectId)->users();
            $isUserInProject = false;
            foreach ($users as $index => $user) {
                if ($user->id == $userId) {
                   
                    $isUserInProject = true;
                }
            }
            if (!$isUserInProject) throw new Exception("The user can not be assigned");
        }
        
    }
}
