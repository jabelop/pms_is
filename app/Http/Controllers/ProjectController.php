<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Request\RequestHelper;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\Response;
use App\Http\Helpers\Utilities\Utilities;
use App\Http\Repositories\Project\ProjectRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    /** @var ProjectRepository */
    private $repository;


   /** @var Response */
    private $apiResponse;

    const POST_PROCESS_VALIDATION_DATA_RULES = [
        'id' => '/[1-9][0-9]*/',
        'name' => '/[A-Za-z]+\s?[A-Za-z]+/',
        'rol' => '/pariticipante|responsable|responsable\-participante/'
    ];
    

    public function __construct(ProjectRepository $repository, Response $apiResponse)
    {
        $this->repository = $repository;
        $this->apiResoponse = $apiResponse;
    }

    /**
     * Store a new project.
     *
     * @param  Request  $request
     * 
     * @return string, the JSON response with the result
     */
    public function postProject(Request $request)
    {
        
        try {
            $name = RequestHelper::validateDataFromRequest($request->input('name',''), self::POST_PROCESS_VALIDATION_DATA_RULES['name']);
            

            $this->repository->createProject($name);
            
            $userCreatedMsg = "Project created successfully";
            
            // when testing the value is not injected 
            $this->apiResponse = $this->apiResponse ? $this->apiResponse : new ApiResponse();
            
            return $this->apiResponse
            ->setArrayValues([
                'error'=>false, 
                'code' => "OK", 
                'msg' =>$userCreatedMsg
            ])
            ->sendApiResponse(response(), 201);
            
        
        } catch (\Throwable $e) {

            // when testing the value is not injected 
            $this->apiResponse = $this->apiResponse ? $this->apiResponse : new ApiResponse();
            http_response_code(500);
            
            return $this->apiResponse
            ->setArrayValues([
                'error'=> true, 
                'code' => "500", 
                'msg' => $e->getMessage()
            ])
            ->sendApiResponse(response(), 500);
            
        }
    }
    
    /**
     * get all project
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getProjects(Request $request) {
        return $this->repository->getProjects();
    }

    /**
     * get all project activities
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getProjectActivities(Request $request) {
        try {
            $id = RequestHelper::validateDataFromRequest($request->input('id',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            return $this->repository->getProjectActivities($id);       
        } catch (\Throwable $e) {
            // when testing the value is not injected 
            $this->apiResponse = $this->apiResponse ? $this->apiResponse : new ApiResponse();
            http_response_code(500);
            
            return $this->apiResponse
            ->setArrayValues([
                'error'=> true, 
                'code' => "500", 
                'msg' => $e->getMessage()
            ])
            ->sendApiResponse(response(), 500);

        }
    }

    /**
     * get all project activities
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getProjectUsers(Request $request) {
        try {
            $id = RequestHelper::validateDataFromRequest($request->input('id',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            return $this->repository->getProjectUsers($id);       
        } catch (\Throwable $e) {
            // when testing the value is not injected 
            $this->apiResponse = $this->apiResponse ? $this->apiResponse : new ApiResponse();
            http_response_code(500);
            
            return $this->apiResponse
            ->setArrayValues([
                'error'=> true, 
                'code' => "500", 
                'msg' => $e->getMessage()
            ])
            ->sendApiResponse(response(), 500);

        }
    }

    /**
     * add an user to the project
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function addUser(Request $request) {
        try {
            $projectId = RequestHelper::validateDataFromRequest($request->input('projectId',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            $userId = RequestHelper::validateDataFromRequest($request->input('userId',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            $rol = RequestHelper::validateDataFromRequest($request->input('rol',''), self::POST_PROCESS_VALIDATION_DATA_RULES['rol']);

            $this->repository->addUser($projectId, $userId, $rol);
            $userAddedMsg = "User added successfully";
            
            // when testing the value is not injected 
            $this->apiResponse = $this->apiResponse ? $this->apiResponse : new ApiResponse();
            
            return $this->apiResponse
            ->setArrayValues([
                'error'=>false, 
                'code' => "OK", 
                'msg' =>$userAddedMsg
            ])
            ->sendApiResponse(response(), 201);       
        } catch (\Throwable $e) {
            // when testing the value is not injected 
            $this->apiResponse = $this->apiResponse ? $this->apiResponse : new ApiResponse();
            http_response_code(500);
            
            return $this->apiResponse
            ->setArrayValues([
                'error'=> true, 
                'code' => "500", 
                'msg' => $e->getMessage()
            ])
            ->sendApiResponse(response(), 500);

        }
    }
}