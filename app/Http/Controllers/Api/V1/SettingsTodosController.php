<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Filters\V1\SettingsTodosFilter;
use App\Http\Requests\StoreSettingsTodosRequest;
use App\Models\SettingsTodos;
use App\Http\Resources\V1\SettingsTodosCollection;
use App\Http\Resources\V1\SettingsTodosResource;
use Exception;

class SettingsTodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new SettingsTodosFilter();
        $filterItems = $filter->transform($request);
        $filterItems += ['status' => 1];
        $settingsTodos = SettingsTodos::where($filterItems);

        return new SettingsTodosCollection($settingsTodos->paginate()->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingsTodosRequest $request)
    {
        return new SettingsTodosResource(SettingsTodos::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SettingsTodos::find($id);
        return new SettingsTodosResource($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSettingsTodosRequest $request)
    {
        $todos = SettingsTodos::findOrFail($request->get("id"));
        $todos->update($request->all());
        $result = $todos->save();
        return response()->json(["success" => $result ? true : false]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status(Request $request, $id)
    {
        $success = false;
        try {
            // Find the item by ID
            $item = SettingsTodos::findOrFail($id);

            // Update the specific field
            $item->status = $request->input('status');
            $item->save();
            $success = true;
        } catch (Exception $e) {
            $success = false;
        }

        return response()->json(['success' => $success]);
    }
}
