<?php

namespace Backend\Processes\Things;

use Backend\DataObjects\ThingData;
use Backend\Models\Thing;
use Backend\Responses\ThingResource;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ReadThingAction
{
    use AsAction;

    // protected Service $service;

    public function __construct(/* Service $service */)
    {
        // $this->service = $service;
    }

    public function authorize(ActionRequest $request): bool
    {
        // return $request->user()->can('view things');
        return true;
    }

    public function handle($id)
    {
        $thing = Thing::find($id);

        $data = ThingData::from($thing);

        return new ThingResource($data);
    }
}
