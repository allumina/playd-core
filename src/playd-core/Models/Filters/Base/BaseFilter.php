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
    public $friendly;
    public $locale;
    public $category;
    public $type;
    public $is_visible;
    public $is_enabled;
    public $is_deleted;
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
        $this->friendly = null;
        $this->locale = null;
        $this->category = null;
        $this->type = null;
        $this->is_visible = null;
        $this->is_enabled = null;
        $this->is_deleted = null;
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
        $this->friendly = $request->input('friendly', null);
        $this->locale = $request->input('locale', env('APP_DEFAULT_LOCALE'));
        $this->category = $request->input('category', null);
        $this->type = $request->input('type', null);
        $this->is_visible = $request->input('is_visible', null);
        $this->is_enabled = $request->input('is_enabled', null);
        $this->is_deleted = $request->input('is_deleted', null);
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
            if ($this->friendly != null) {
                $q->where('friendly', $this->friendly);
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
            if ($this->is_visible != null) {
                $q->where('is_visible', $this->is_visible);
            }
            if ($this->is_enabled != null) {
                $q->where('is_enabled', $this->is_enabled);
            }
            if ($this->is_deleted != null) {
                $q->where('is_deleted', $this->is_deleted);
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
