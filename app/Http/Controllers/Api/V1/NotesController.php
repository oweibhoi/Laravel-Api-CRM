<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotesRequest;
use App\Http\Resources\V1\NotesCollection;
use App\Http\Resources\V1\NotesResource;
use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index(Request $request)
    {
        $notes = Notes::where(['customer_id' => $request->query('c')]);
        $notes->orderBy('created_at', 'DESC');
        return new NotesCollection($notes->get());
    }

    public function store(StoreNotesRequest $request)
    {
        return new NotesResource(Notes::create($request->all()));
    }
}
