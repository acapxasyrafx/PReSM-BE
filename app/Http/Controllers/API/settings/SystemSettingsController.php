<?php

namespace App\Http\Controllers\API\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\Storesystem_settingsRequest;
use App\Http\Requests\Updatesystem_settingsRequest;
use App\Models\system_settings;
use Illuminate\Http\JsonResponse;
use validator;

class SystemSettingsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'setting_key' => 'required',
            'setting_value' => 'required',
            'setting_group' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $user = system_settings::create($input);

        return $this->sendResponse(new ProductResource($product),'User register successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storesystem_settingsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(system_settings $system_settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(system_settings $system_settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatesystem_settingsRequest $request, system_settings $system_settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(system_settings $system_settings)
    {
        //
    }
}
