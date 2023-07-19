<?php

namespace Backend\Processes\Things;

use Backend\Models\Thing;
use Backend\Responses\ThingResource;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class AddThingAction
{
    use AsAction;

    // protected Service $service;

    public function __construct(/* Service $service */)
    {
        // $this->service = $service;
    }

    public function authorize(ActionRequest $request): bool
    {
        // return $request->user()->can('add things');
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:8'],
        ];
    }

    public function handle(ActionRequest $request)
    {
        return new ThingResource(Thing::create($request->only(['name'])));
    }
}
