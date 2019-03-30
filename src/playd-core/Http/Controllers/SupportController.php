<?php

namespace Allumina\Playd\Core\Http\Controllers;

use Allumina\Playd\Core\Http\Controllers\Base\BaseController;
use Allumina\Playd\Core\Messages\DataResponse;
use Allumina\Playd\Core\Models\Support\ContactType;
use Illuminate\Http\Request;

class SupportController extends BaseController
{
    public function contactTypes(Request $request)
    {
        $response = new DataResponse();
        $response->data = ContactType::all();
        $response->status = DataResponse::OK;
        $response->error = null;
        $response->request = $request;
        $response->page = 0;
        $response->count = count($response->data);
        $this->clearResponse($response);
        return response()->json($response);
    }
}
