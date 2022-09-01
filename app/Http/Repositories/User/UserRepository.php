<?php

namespace App\Http\Repositories\User;

interface UserRepository {
    /**
     * get all the users
     * 
     * @return User array
     */
    public function getUsers();


    /**
     * get an user by it's id
     * 
     * @param int $id the user's id
     * 
     * @return User
     */
    public function getUserById(int $id);

    /**
     * get all the user's projects
     * 
     * @param int $id the user's id 
     * 
     * @return Project array
     */
    public function getUserProjects(int $id);

    /**
     * get all the user's activities
     * 
     * @param int $id the user's id 
     * 
     * @return Activity array
     */
    public function getUserActivities(int $id);

    /**
     * get all the user's incidences
     * 
     * @param int $id the user's id 
     * 
     * @return Incidence array
     */
    public function getUserIncidences(int $id);

    public function createUser(string $name);
}