<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Filters\V1\SettingsTodosFilter;
use App\Http\Requests\StoreSettingsTodosRequest;
use App\Models\SettingsTodos;
use App\Http\Resources\V1\SettingsTodosCollection;

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
        $todosModel = new SettingsTodos();
        $todosModel->create($request->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
        // Find the item by ID
        $item = SettingsTodos::findOrFail($id);

        // Update the specific field
        $item->status = $request->input('status');
        $item->save();
        return response()->json(['success' => true]);
    }
}
