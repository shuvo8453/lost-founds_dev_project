<?php

namespace App\Services\Api\v1\Item;

use App\Enums\ItemStatusEnum;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Joy2362\ServiceGenerator\Helper\ApiHelper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\{Collection, Facades\DB};

class ItemService
{
    /**
     * @var Collection
     */
    private Collection $collection;
    /**
     * @var string
     */
    private string $resource = "Item";

    /**
     * @inheritDoc
     */
    public function index(Request $request): Collection
    {
        $query = Item::query();
       // $query->whereStatus(ItemStatusEnum::Active->value);
        $query->whereUserId($request->user()->id);
        $query->orderBy('id', 'desc');
        return ApiHelper::success([
            'data' => $request->all ? $query->get() : $query->paginate($request->input('per_page', 9))
        ]);
    }

     /**
     * @inheritDoc
     */
    public function store(Request $request): Collection
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = ApiHelper::upload(
                    $request->validated('image'),
                    'image'
                );
            }

            $item = $request->user()->items()->create($data);
            $this->collection = ApiHelper::success([
                'message' => __('ApiHelper::crud.create', ['resource' => $this->resource]),
                'item' => new ItemResource($item)
            ]);
        } catch (Exception $ex) {
            $this->collection = ApiHelper::failed(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }


     /**
     * @inheritDoc
     */
    public function itemToggleStatus($id): Collection
    {
        $item = Item::find($id);
        $item->update([
            'status' => $item->status == ItemStatusEnum::Inactive->value ?  ItemStatusEnum::Active->value :  ItemStatusEnum::Inactive->value
        ]);
        return ApiHelper::success([
            'message' => "Item status update successfully"
        ]);
    }


    public function getItemList(Request $request){
        $query = Item::query();
        $query->whereStatus(ItemStatusEnum::Active->value);
        $query->orderBy('id', 'desc');
        return ApiHelper::success([
            'data' => $request->all ? $query->get() : $query->paginate($request->input('per_page', 9))
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | class internal methods
    |--------------------------------------------------------------------------
    |
    */
}
