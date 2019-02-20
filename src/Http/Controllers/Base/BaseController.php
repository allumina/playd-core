<?php

namespace Allumina\Playd\Core\Http\Controllers\Base;

use Illuminate\Routing\Controller as BaseIlluminateController;
use Illuminate\Support\Facades\App;

class BaseController extends BaseIlluminateController
{
    protected function clearResponse(&$response) {
        if (!App::environment(['prod', 'production'])) {
            unset($response->debug);
            unset($response->request);
        }
    }

    /*
    protected function validateRequest(&$request, $required)
    {
        $output = '';
        foreach ($required as $key => $value) {
            if (is_null($request->input($key))) {
                $output .= $value . ',';
            }
        }
        $output = trim($output, ',');
        if (strlen($output) > 0) return $output;
        return true;
    }

    protected function manageRemoteException($exception)
    {
        $temp = new DataResponse();
        $temp->error = $exception->getMessage();
        if ($exception instanceof ConnectException) {
            $temp->status = BaseResponse::BAD_GATEWAY;
        } elseif ($exception instanceof RequestException) {
            $temp->status = BaseResponse::INTERNAL_ERROR;
        } elseif ($exception instanceof ClientException) {
            $temp->status = BaseResponse::BAD_GATEWAY;
        } elseif ($exception instanceof ServerException) {
            $temp->status = BaseResponse::BAD_GATEWAY;
        } elseif ($exception instanceof TooManyRedirectsException) {
            $temp->status = BaseResponse::BAD_GATEWAY;
        } else {
            $temp->status = BaseResponse::INTERNAL_ERROR;
        }
        return $temp;
    }

    protected function manageSyncException($exception)
    {
        $temp = new SyncResponse();
        $temp->error = $exception->getMessage();
        if ($exception instanceof ValidationException) {
            $temp->status = BaseResponse::BAD_REQUEST;
        } else {
            $temp->status = BaseResponse::INTERNAL_ERROR;
        }
        return $temp;
    }
    */
}
