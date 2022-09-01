<?php

namespace App\Http\Repositories\Incidence;

use App\Models\Incidence;
use App\Http\Repositories\Incidence\IncidenceRepository;

class IncidenceRepositoryImpl implements IncidenceRepository {

     /** @var Incidence */
    protected $model;

    public function __construct(Incidence $model)
    {
        $this->model = $model;
       
    }

    
    public function getIncidences() {
        return $this->model::With('activity')->get();
    }

    public function getIncidenceById(int $id) {
        return Incidence::where('id', $id)->get();
    }

    public function createIncidence(string $name, int $activityId) {
        return $this->model->create(['name' => $name, 'activity_id' => $activityId]);
    }
    
}