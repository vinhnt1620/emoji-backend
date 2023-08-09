<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TitleModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TitleController extends Controller
{
    public function index()
    {
        $titles = TitleModel::first();

        logger()->error('ERROR', ['titles' => $titles]);

        return $titles;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $title = TitleModel::create($data);
            DB::commit();

            return $title;
        } catch(Exception $e) {
            DB::rollBack();

            return $e;
        }
    }

    public function edit(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $title = TitleModel::findOrFail($id);
            $data = $request->all();
            $title->update($data);
            DB::commit();

            return $title;
        } catch(Exception $e) {
            DB::rollBack();

            return $e;
        }
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $title = TitleModel::findOrFail($id);
            $title->delete();
            DB::commit();

            return [
                'message' => 'success'
            ];
        } catch(Exception $e) {
            DB::rollBack();

            return $e;
        }
    }
}
