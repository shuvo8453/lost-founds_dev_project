<?php

namespace App\Http\Controllers\Api\v1\Item;

use App\Http\Controllers\Controller;
use App\Services\Api\v1\Item\ItemService;
use Joy2362\ServiceGenerator\Helper\ApiHelper;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    public function __construct(public ItemService $service)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return ApiHelper::response($this->service->index($request));
    }

    public function store(ItemRequest $request): JsonResponse
    {
        return ApiHelper::response($this->service->store($request));
    }

    public function itemToggleStatus($id): JsonResponse
    {
        return ApiHelper::response($this->service->itemToggleStatus($id));
    }

    public function getItemList(Request $request){
        return ApiHelper::response($this->service->getItemList($request));
    }
}
