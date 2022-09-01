<?php 

namespace App\Http\Helpers;

interface Response {

    public function getResponseArray();

    public function setArrayValues(Array $values);
}