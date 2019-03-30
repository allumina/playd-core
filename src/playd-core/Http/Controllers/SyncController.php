<?php

namespace Allumina\Playd\Core\Http\Controllers;

use Allumina\Playd\Core\Http\Controllers\Base\BaseController;
use Allumina\Playd\Core\Messages\DataResponse;
use Allumina\Playd\Core\Models\Filters\SyncFilter;
use Allumina\Playd\Core\Models\Support\ContactType;
use Illuminate\Http\Request;
use Allumina\Playd\Core\Models\CountryModel;
use Allumina\Playd\Core\Models\LocaleModel;

class SyncController extends BaseController
{
    protected const COUNTRY_MODEL = 'Allumina\Playd\Core\Models\CountryModel';
    protected const LOCALE_MODEL = 'Allumina\Playd\Core\Models\LocaleModel';

    public function countries(Request $request)
    {
        $response = new DataResponse();

        $filter = new SyncFilter();
        $filter->parse($request);
        $query = $filter->apply(self::COUNTRY_MODEL, false);
        $response->data = $query->get();

        $response->status = DataResponse::OK;
        $response->error = null;
        $response->request = $request;
        $response->page = ($filter->page != null) ? intval($filter->page) : 0;
        $response->count = count($response->data);
        $this->clearResponse($response);
        return response()->json($response);
    }

    public function locales(Request $request)
    {
        $response = new DataResponse();

        $filter = new SyncFilter();
        $filter->parse($request);
        $query = $filter->apply(self::LOCALE_MODEL, false);
        $response->data = $query->get();

        $response->status = DataResponse::OK;
        $response->error = null;
        $response->request = $request;
        $response->page = ($filter->page != null) ? intval($filter->page) : 0;
        $response->count = count($response->data);
        $this->clearResponse($response);
        return response()->json($response);
    }
}
