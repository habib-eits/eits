<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = Branch::all();
           
            return view('branches.index', compact('data'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    // public function create()
    // {
    //     try {
    //         return view('branches.create');
    //     } catch (\Exception $e) {
    //         return back()->with('error', $e->getMessage())->withInput();
    //     }
    // }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255|unique:branches,name',
                'location' => 'nullable|max:255',
                'tel' => 'nullable|max:255'
            ]);
            DB::beginTransaction();
            Branch::create($request->except('_token'));
            DB::commit();
            return redirect('branches')->with('success', 'Branch Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function edit($id)
    {
        try {
            $data = Branch::findOrFail($id);
            return response()->json(['data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function update(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'name' => 'required|max:255|unique:branches,name,' . $request->id . ',id',
                'location' => 'nullable|max:255',
                'tel' => 'nullable|max:255'
            ]);
            DB::beginTransaction();
            Branch::findOrFail($request->id)->update($request->except('_token', 'id'));;
            DB::commit();
            return redirect('branches')->with('error', 'Branch updated successfully')->with('class', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            Branch::findOrFail($id)->delete();
            DB::commit();
            return back()->withSuccess('Branch Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage());
        }
    }
}
