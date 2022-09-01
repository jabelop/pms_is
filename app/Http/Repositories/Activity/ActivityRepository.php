<?php

namespace App\Http\Repositories\Activity;

interface ActivityRepository {
    /**
     * get all the activity
     * 
     * @return Activity array
     */
    public function getActivities();


    /**
     * get an activity by it's id
     * 
     * @param int $id the activity's id
     * 
     * @return Activity
     */
    public function getActivityById(int $id);

    /**
     * get all the activity's users
     * 
     * @param int $id the activity's id 
     * 
     * @return Activity array
     */
    public function getActivityUsers(int $id);

    /**
     * get all the activity's incidences
     * 
     * @param int $id the activity's id 
     * 
     * @return Incidences array
     */
    public function getActivityIncidences(int $id);

    /**
     * create an activity
     * 
     * @param string $name the activity's name
     * @param int $projectId the project's id 
     * 
     */
    public function createActivity(string $name, int $projectId);

    /**
     * add an user to an activity
     * 
     * @param int $activityId the activity's id
     * @param int $userId the user's id 
     * @param string $rol the user rol
     * 
     * @return Response
     */
    public function addUser(int $activityId, int $userId, string $rol);

    /**
     * add an incidence to an activity
     * 
     * @param int $activityId the activity's id
     * @param int $incidenceId the activity's id 
     * 
     * @return Response
     */
    public function addIncidence(int $activityId, int $incidenceId);

    /**
     * check if an user can be added to an activity
     * 
     * @param int $activityId the activity's id
     * @param int $userId the user's id 
     * 
     * @throws Exception if can't be added
     */
    public function checkUserCanBeAdded(int $userId, int $activityId);
}