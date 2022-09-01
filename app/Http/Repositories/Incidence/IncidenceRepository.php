<?php

namespace App\Http\Repositories\Incidence;

interface IncidenceRepository {
    /**
     * get all the incidences
     * 
     * @return Incidence array
     */
    public function getIncidences();


    /**
     * get an incidence by it's id
     * 
     * @param int $id the incidence's id
     * 
     * @return Incidence
     */
    public function getIncidenceById(int $id);


    /**
     *create an incidence
     * 
     * @param string $name the incidence's name
     * @param int $activityId the activity's id 
     * 
     */
    public function createIncidence(string $name, int $activityId);

}