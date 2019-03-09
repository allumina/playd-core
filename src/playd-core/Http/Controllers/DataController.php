<?php

namespace Allumina\Playd\Core\Http\Controllers;

use Allumina\Playd\Core\Http\Controllers\Base\BaseController;
use Allumina\Playd\Core\Messages\DataResponse;
use Allumina\Playd\Core\Models\CountryModel;
use Allumina\Playd\Core\Models\LocaleModel;
use Illuminate\Http\Request;

class DataController extends BaseController
{
    public function countries(Request $request)
    {
        $response = new DataResponse();

        $response->data = CountryModel::all();
        $response->status = DataResponse::OK;
        $response->error = null;
        $response->request = $request;
        $response->count = count($response->data);

        $this->clearResponse($response);

        return response()->json($response);
    }

    public function locales(Request $request)
    {
        $response = new DataResponse();

        $response->data = LocaleModel::all();
        $response->status = DataResponse::OK;
        $response->error = null;
        $response->request = $request;
        $response->count = count($response->data);

        $this->clearResponse($response);

        return response()->json($response);
    }
}
