<?php

namespace App\Traits;

trait Responses{
    protected function success(array $data, string $msg=null, int $code = 200)
    {
        return response()->json([
            'status'  => 'Success',
            'msg'     => $msg,
            'data' => $data
        ], $code);
    }

    protected function error(array $data, string $msg=null, int $code)
    {
        return response()->json([
            'status'  => 'Error',
            'msg'     => $msg,
            'data' => $data
        ], $code);
    }
}



?>