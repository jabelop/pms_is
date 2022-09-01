<?php

namespace App\Http\Repositories\Project;

interface ProjectRepository {
    /**
     * get all the projects
     * 
     * @return Project array
     */
    public function getProjects();


    /**
     * get an project by it's id
     * 
     * @param int $id the project's id
     * 
     * @return Project
     */
    public function getProjectById(int $id);

    /**
     * get all the project's users
     * 
     * @param int $id the project's id 
     * 
     * @return Project array
     */
    public function getProjectUsers(int $id);

    /**
     * get all the project's activities
     * 
     * @param int $id the project's id 
     * 
     * @return Activity array
     */
    public function getProjectActivities(int $id);

    /**
     * add an user to the project
     * 
     * @param $projectId the project id
     * @param $userId the user id
     * @param $rol the user rol
     */
    public function addUser(int $projectId, int $userId, $rol);

    public function createProject(string $name);
}