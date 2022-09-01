<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Request\RequestHelper;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\Response;
use App\Http\Helpers\Utilities\Utilities;
use App\Http\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /** @var UserRepositoryImpl */
    private $repository;


   /** @var Response */
    private $apiResponse;

    const POST_PROCESS_VALIDATION_DATA_RULES = [
        'id' => '/[1-9][0-9]*/',
        'name' => '/[A-Za-z]+\s?[A-Za-z]+/',
    ];
    

    public function __construct(UserRepository $repository, Response $apiResponse)
    {
        $this->repository = $repository;
        $this->apiResoponse = $apiResponse;
    }

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * 
     * @return string, the JSON response with the result
     */
    public function postUser(Request $request)
    {
        
        try {
            $name = RequestHelper::validateDataFromRequest($request->input('name',''), self::POST_PROCESS_VALIDATION_DATA_RULES['name']);
            

            $this->repository->createUser($name);
            
            $userCreatedMsg = "User created successfully";
            
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
     * get all users
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getUsers(Request $request) {
        return $this->repository->getUsers();
    }

    /**
     * get all users activities
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getUsersActivities(Request $request) {
        try {
            $id = RequestHelper::validateDataFromRequest($request->input('id',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            return $this->repository->getUserActivities($id);       
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
     * get all users incidences
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getUsersIncidences(Request $request) {
        try {
            $id = RequestHelper::validateDataFromRequest($request->input('id',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            return $this->repository->getUserActivities($id);       
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