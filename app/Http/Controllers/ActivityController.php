<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Request\RequestHelper;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\Response;
use App\Http\Repositories\Activity\ActivityRepository;
use App\Models\Project;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    /** @var ActivityRepository */
    private $repository;


   /** @var Response */
    private $apiResponse;

    const POST_PROCESS_VALIDATION_DATA_RULES = [
        'id' => '/[1-9][0-9]*/',
        'name' => '/[A-Za-z]+\s?[A-Za-z]+/',
        'rol' => '/participante|responsable/'
    ];
    

    public function __construct(ActivityRepository $repository, Response $apiResponse)
    {
        $this->repository = $repository;
        $this->apiResoponse = $apiResponse;
    }

    /**
     * Store a new activity.
     *
     * @param  Request  $request
     * 
     * @return string, the JSON response with the result
     */
    public function postActivity(Request $request)
    {
        
        try {
            $name = RequestHelper::validateDataFromRequest($request->input('name',''), self::POST_PROCESS_VALIDATION_DATA_RULES['name']);
            $projectId = RequestHelper::validateDataFromRequest($request->input('projectId',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            

            $this->repository->createActivity($name, $projectId);
            
            $userCreatedMsg = "Activity created successfully";
            
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
     * get all activities
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getActivities(Request $request) {
        return $this->repository->getActivities();
    }

    /**
     * get all activity users
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getActivityUsers(Request $request) {
        try {
            $id = RequestHelper::validateDataFromRequest($request->input('id',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            return $this->repository->getActivityUsers($id);       
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
     * get all activity incidences
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getActivityIncidences(Request $request) {
        try {
            $id = RequestHelper::validateDataFromRequest($request->input('id',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            return $this->repository->getActivityIncidences($id);       
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
     * add an user to the activity
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function addUser(Request $request) {
        try {
            $activityId = RequestHelper::validateDataFromRequest($request->input('activityId',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            $userId = RequestHelper::validateDataFromRequest($request->input('userId',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            $rol = RequestHelper::validateDataFromRequest($request->input('rol',''), self::POST_PROCESS_VALIDATION_DATA_RULES['rol']);
            $this->repository->checkUserCanBeAdded($userId, $activityId);
            $this->repository->addUser($activityId, $userId, $rol);
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