<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 2019-03-14
 * Time: 12:23
 */

namespace Allumina\Playd\Core\Models\Filters\Base;

use Illuminate\Http\Request;

abstract class BaseFilter
{
    public $uid;
    public $identifier;
    public $locale;
    public $category;
    public $type;
    public $isVisible;
    public $isEnabled;
    public $isDeleted;
    public $flags;
    public $localId;
    public $ownerId;
    public $userId;
    public $parentId;
    public $ancestorId;
    public $groupId;
    public $applicationId;
    public $environmentId;
    public $lastUpdateTime;

    public $page;
    public $size;
    public $output;
    public $lastOnly;

    private $localize = false;
    private $mongo = false;

    public function __construct()
    {
        $this->uid = null;
        $this->identifier = null;
        $this->locale = null;
        $this->category = null;
        $this->type = null;
        $this->isVisible = null;
        $this->isEnabled = null;
        $this->isDeleted = null;
        $this->flags = null;
        $this->localId = null;
        $this->ownerId = null;
        $this->userId = null;
        $this->parentId = null;
        $this->ancestorId = null;
        $this->groupId = null;
        $this->applicationId = null;
        $this->environmentId = null;
        $this->lastUpdateTime = null;
        $this->page = null;
        $this->size = null;
        $this->output = true;
        $this->lastOnly = false;
    }

    public function parse(Request &$request)
    {
        $this->uid = $request->input('uid', null);
        $this->identifier = $request->input('identifier', null);
        $this->locale = $request->input('locale', env('APP_DEFAULT_LOCALE'));
        $this->category = $request->input('category', null);
        $this->type = $request->input('type', null);
        $this->isVisible = $request->input('isVisible', null);
        $this->isEnabled = $request->input('isEnabled', null);
        $this->isDeleted = $request->input('isDeleted', null);
        $this->flags = $request->input('flags', null);
        $this->ownerId = $request->input('ownerId', null);
        $this->userId = $request->input('userId', null);
        $this->groupId = $request->input('groupId', null);
        $this->parentId = $request->input('parentId', null);
        $this->ancestorId = $request->input('ancestorId', null);
        $this->applicationId = $request->input('applicationId', null);
        $this->environmentId = $request->input('environmentId', null);
        $this->lastUpdateTime = $request->input('lastUpdateTime', null);
        $this->page = $request->input('page', null);
        $this->size = $request->input('size', null);
        $this->output = $request->input('output', null);
        $this->lastOnly = $request->input('lastOnly', null);
    }

    public function apply($model, bool $localize = true, bool $mongo = false)
    {
        $this->localize = $localize;
        $this->mongo = $mongo;
        $query = $model::where(function ($q) {
            if ($this->uid != null) {
                $q->where('uid', $this->uid);
            }
            if ($this->identifier != null) {
                $q->where('identifier', $this->identifier);
            }
            if ($this->localize && $this->locale != null && strtolower($this->locale) !== Constants::ALL_KEYWORD) {
                $q->where('locale', $this->locale);
            }
            if ($this->category != null) {
                $q->where('category', $this->category);
            }
            if ($this->type != null) {
                $q->where('type', $this->type);
            }
            if ($this->isVisible != null) {
                $q->where('isVisible', $this->isVisible);
            }
            if ($this->isEnabled != null) {
                $q->where('isEnabled', $this->isEnabled);
            }
            if ($this->isDeleted != null) {
                $q->where('isDeleted', $this->isDeleted);
            }
            if ($this->flags != null) {
                $q->where('flags', $this->flags);
            }
            if ($this->localId != null) {
                $q->where('localId', $this->localId);
            }
            if ($this->ownerId != null) {
                $q->where('ownerId', $this->ownerId);
            }
            if ($this->userId != null) {
                $q->where('userId', $this->userId);
            }
            if ($this->parentId != null) {
                $q->where('parentId', $this->parentId);
            }
            if ($this->ancestorId != null) {
                $q->where('ancestorId', $this->ancestorId);
            }
            if ($this->groupId != null) {
                $q->where('groupId', $this->groupId);
            }
            if ($this->applicationId != null) {
                $q->where('applicationId', $this->applicationId);
            }
            if ($this->environmentId != null) {
                $q->where('environmentId', $this->environmentId);
            }
            if ($this->lastUpdateTime != null) {
                if ($this->mongo) {
                    $q->where('updateTime', '>=', Carbon::createFromTimestamp($this->lastUpdateTime));
                } else {
                    $q->where('updateTime', '>=', date('Y-m-d H:i:s', $this->lastUpdateTime));
                }
            }
        });

        if ($this->page != null && $this->size  != null) {
            $query->skip(($this->page - 1) * $this->size);
            $query->take($this->size);
        }

        $query->orderBy('updateTime', 'asc')
            ->orderBy('createTime', 'asc')
            ->orderBy('uid', 'asc');

        return $query;
    }
}
