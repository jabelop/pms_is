<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Request\RequestHelper;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\Response;
use App\Http\Repositories\Incidence\IncidenceRepository;
use Illuminate\Http\Request;

class IncidenceController extends Controller
{

    /** @var IncidenceRepository */
    private $repository;


   /** @var Response */
    private $apiResponse;

    const POST_PROCESS_VALIDATION_DATA_RULES = [
        'id' => '/[1-9][0-9]*/',
        'name' => '/[A-Za-z]+\s?[A-Za-z]+/',
    ];
    

    public function __construct(IncidenceRepository $repository, Response $apiResponse)
    {
        $this->repository = $repository;
        $this->apiResoponse = $apiResponse;
    }

    /**
     * Store a new incidence.
     *
     * @param  Request  $request
     * 
     * @return string, the JSON response with the result
     */
    public function postIncidence(Request $request)
    {
        
        try {
            $name = RequestHelper::validateDataFromRequest($request->input('name',''), self::POST_PROCESS_VALIDATION_DATA_RULES['name']);
            
            $activityId = RequestHelper::validateDataFromRequest($request->input('activityId',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            

            $this->repository->createIncidence($name, $activityId);
            
            $incidenceCreatedMsg = "Activity created successfully";
            
            // when testing the value is not injected 
            $this->apiResponse = $this->apiResponse ? $this->apiResponse : new ApiResponse();
            
            return $this->apiResponse
            ->setArrayValues([
                'error'=>false, 
                'code' => "OK", 
                'msg' =>$incidenceCreatedMsg
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
     * get all incidences
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getIncidences(Request $request) {
        return $this->repository->getIncidences();
    }

    public function getIncidenceById(Request $request) {
        try {
            $id = RequestHelper::validateDataFromRequest($request->input('id',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            return $this->repository->getIncidenceById($id);

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