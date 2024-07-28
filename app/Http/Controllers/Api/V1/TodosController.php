<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TodosController extends Controller
{
    public function show($customer_id=0, $type = 'P')
    {
        $todos = DB::table("settings_todos")
            ->where('settings_todos.status', 1)
            ->where('settings_todos.type', $type)
            ->select('settings_todos.id', 'settings_todos.name', DB::raw('(SELECT id FROM customer_todos WHERE customer_todos.todo_id=settings_todos.id AND customer_todos.customer_id="'.$customer_id.'") as todos_id'))
            ->get();
        return response()->json(collect($todos));
    }

    public function complete($id = false, $customerID = false)
    {
        if (is_numeric($id) && is_numeric($customerID)) {
            $todo = DB::table("customer_todos")->insert([
                "todo_id" => $id,
                "customer_id" => $customerID
            ]);
            return response()->json(['success' => $todo ? true : false]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
