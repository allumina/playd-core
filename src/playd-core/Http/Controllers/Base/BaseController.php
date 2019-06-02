<?php

namespace Allumina\Playd\Core\Http\Controllers\Base;

use Illuminate\Routing\Controller as BaseIlluminateController;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class BaseController extends BaseIlluminateController
{
    protected function clearResponse(&$response)
    {
        if (!App::environment(['prod', 'production'])) {
            unset($response->debug);
            unset($response->request);
        }
    }

    protected function translateUserIdentifier(&$data, Request &$request)
    {
        $user = $request->user();
        foreach ($data as $data_item) {
            $data_item->owner_id = $user->identifier;
        }
    }

    protected function filter(string $class, Request &$request, &$query, string $category = '', string $type = '', string $orderBy = 'update_time', string $orderMode = 'ASC', bool $includeTemplates = true, bool $includeDeleted = true)
    {
        $user = $request->user();

        if ($user && strlen($user->identifier) > 0) {
            $query = $query->where(function ($query) use ($class, $user, $includeTemplates, $category, $type) {
                if ($includeTemplates)
                    $query->where('owner_id', '=', '');
                else
                    $query->where('owner_id', '<>', '');
                $keys = $class::keysSeed();
                foreach ($keys as $key) {
                    $query->orWhere('owner_id', '=', $user->getKey($class::CONTEXT, $category, $type));
                }
            });
        }

        if (!$includeDeleted) {
            $query = $query->where('is_deleted', '=', false);
        }

        if (strlen($category) > 0) {
            $query = $query->where('category', '=', $category);
        }

        if (strlen($type) > 0) {
            $query = $query->where('type', '=', $type);
        }

        if ($request->has('locale') && strlen($request->get('locale')) > 0) {
            $query = $query->where('locale', '=', $request->get('locale'));
        }

        if ($request->has('lastUpdateTime') && intval($request->get('lastUpdateTime')) > 0) {
            $query = $query->where('update_time', '>', date('c', intval($request->get('lastUpdateTime'))));
        }

        if ($request->has('order') && strlen($request->get('order')) > 0) {
            $orders = explode(',', $request->get('order'));
            foreach ($orders as $order) {
                $temp = explode(':', $order);
                $query = $query->orderBy($temp[0], (count($temp) > 1) ? $temp[1] : 'ASC');
            }
        } else {
            $query = $query->orderBy($orderBy, $orderMode);
        }

        // dd($query->toSql());
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
