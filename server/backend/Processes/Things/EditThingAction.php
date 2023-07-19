<?php

namespace Backend\Processes\Things;

use Backend\Models\Thing;
use Backend\Responses\ThingResource;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class EditThingAction
{
    use AsAction;

    // protected Service $service;

    public function __construct(/* Service $service */)
    {
        // $this->service = $service;
    }

    public function authorize(ActionRequest $request): bool
    {
        // return $request->user()->can('edit things');
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:8'],
        ];
    }

    public function handle(ActionRequest $request, $id)
    {
        $thing = Thing::find($id);
        $thing->update($request->only(['name']));

        return new ThingResource($thing);
    }
}
