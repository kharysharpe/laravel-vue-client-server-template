<?php

namespace Backend\Processes\Things;

use Backend\Models\Thing;
use Backend\Responses\ThingResource;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class BrowseThingsAction
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

    public function handle()
    {
        return ThingResource::collection(Thing::all());
    }
}
