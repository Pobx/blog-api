<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = Items::all();
        return response()->json(['entity' => $entities, 'messages' => [], 'status' => 200], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->RuleValidate($request);
        $entity = Items::create($request->all());

        return response()->json(['entity' => $entity, 'messages' => ['Insert Successfully'], 'status' => 201], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = Items::find($id);

        return response()->json(['entity' => $entity, 'messages' => [], 'status' => 200], 200);

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
        $inputs = $request->all();
        $entity = Items::find($id)->update($inputs);

        return response()->json(['entity' => $inputs, 'messages' => ['Update Successfully'], 'status' => 200], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Items::destroy($id);

        return response()->json(['entity' => null, 'messages' => ['Delete Successfully'], 'status' => 200], 200);
    }

    public function transaction(Request $request)
    {
        $this->RuleValidateTransaction($request);
        $datetime = date("Y-m-d H:i:s");
        // $param = $request->all();
        $param = $request->input('entites');
        // $param = [
        //     ["Title" => "Title 1", "Body" => "Body 1", "created_at" => $datetime, "updated_at" => $datetime],
        //     ["Title" => "Title 2", "Body" => "Body 2", "created_at" => $datetime, "updated_at" => $datetime],
        //     ["Title" => "Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3Title 3", "Body" => "Body 3", "created_at" => $datetime, "updated_at" => $datetime],
        // ];

        DB::transaction(function () use ($param) {
            DB::table('items')->insert($param);
        });

        return response()->json(['entity' => $param, 'messages' => ['Insert Successfully'], 'status' => 201], 201);
    }

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'Title' => 'required|max:20',
            'Body' => 'required',
        ]);
    }

    private function RuleValidateTransaction($request)
    {
        $validator = Validator::make($request->all(), [
            'entites.*.Title' => 'required|max:20',
            'entites.*.Body' => 'required',
        ]);

        if ($validator->fails()) {
          $errors = $validator->errors();
          throw ValidationException::withMessages($errors->all());
        }
    }
}
