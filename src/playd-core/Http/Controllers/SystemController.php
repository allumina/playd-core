<?php

namespace Allumina\Playd\Core\Http\Controllers;

use Allumina\Playd\Core\Http\Controllers\Base\BaseController;
use Allumina\Playd\Core\Messages\DataResponse;
use Allumina\Playd\Core\Utils\DateUtils;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SystemController extends BaseController
{
    public function time(Request $request)
    {
        $response = new DataResponse();
        $response->data = time();
        $response->status = DataResponse::OK;
        $response->error = null;
        $response->request = $request;
        $this->clearResponse($response);
        return response()->json($response);
    }

    public function uuid(Request $request)
    {
        $response = new DataResponse();
        $response->data = Uuid::uuid4()->toString();
        $response->status = DataResponse::OK;
        $response->error = null;
        $response->request = $request;
        $this->clearResponse($response);
        return response()->json($response);
    }

    public function day(Request $request)
    {
        $response = new DataResponse();
        $response->data = DateUtils::DatePart(time(), DateUtils::DATE_PART_DAY);
        $response->status = DataResponse::OK;
        $response->error = null;
        $response->request = $request;
        $this->clearResponse($response);
        return response()->json($response);
    }

    public function month(Request $request)
    {
        $response = new DataResponse();
        $response->data = DateUtils::DatePart(time(), DateUtils::DATE_PART_MONTH);
        $response->status = DataResponse::OK;
        $response->error = null;
        $response->request = $request;
        $this->clearResponse($response);
        return response()->json($response);
    }

    public function week(Request $request)
    {
        $week = DateUtils::DatePart(time(), DateUtils::DATE_PART_WEEK);
        $year = DateUtils::DatePart(time(), DateUtils::DATE_PART_YEAR);
        print_r(DateUtils::FromDay($year, 6, 4));
        die();

        $response = new DataResponse();
        $response->data = DateUtils::DatePart(time(), DateUtils::DATE_PART_WEEK);
        $response->status = DataResponse::OK;
        $response->error = null;
        $response->request = $request;
        $this->clearResponse($response);
        return response()->json($response);
    }

    public function year(Request $request)
    {
        $response = new DataResponse();
        $response->data = DateUtils::DatePart(time(), DateUtils::DATE_PART_YEAR);
        $response->status = DataResponse::OK;
        $response->error = null;
        $response->request = $request;
        $this->clearResponse($response);
        return response()->json($response);
    }
}
