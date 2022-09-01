<?php

namespace App\Http\Helpers;

use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Helpers\Response;

/**
 * response object
 */ 
class ApiResponse implements Response {


    protected $error;
    protected $code;
    protected $msg;

    /**
     * constructor
     * 
     * @param bool $error, if there was an error or not, false by default
     * @param string $code, the response code
     * @param string $msg, the response message
     */
    public function __construct(bool $error=false, string $code="",string $msg="") {
        $this->error = $error;
        $this->code = $code;
        $this->msg = $msg;
    }

    /**
     * error setter
     */
    public function setError(bool $error) {
        $this->error = $error;
    }
    /**
     * code setter
     */
    public function setCode(string $code) {
        $this->code = $code;
    }
    /**
     * msg setter
     */
    public function setMsg(string $msg) {
        $this->msg = $msg;
    }
    /**
     * set all the properties at once by indexed array
     * 
     * @param array $values, the values for the object properties
     * 
     * @return ApiResponse, this object
     */
    public function setArrayValues(array $values) {
        $this->setError($values['error']);
        $this->setCode($values['code']);
        $this->setMsg($values['msg']);
        return $this;
    }

    /**
     * get the response array for JSON end points
     */
    public function getResponseArray() {
        return [
            'error' => $this->error,
            'code' => $this->code,
            'msg' => $this->msg
        ];
    }

    /**
     * send JSON response
     * 
     * @param Response $response, the response object
     */
    public function sendApiResponse(ResponseFactory $response, int $status=200) {
        return $response->json($this->getResponseArray(),$status);
    }
}