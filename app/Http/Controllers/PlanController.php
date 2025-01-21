<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "List of Plans";
        $plans = Plan::all();
        $res = compact('plans', 'title');
        return view('admin.subscription.index', $res);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $title = "Create New Subscription Plans";
        
        $res = compact('title');
        return view('admin.subscription.create', $res);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'title' => 'required|unique:plans,title',
            'description' => 'required',
            'convenience_fee' => 'required' 
            ]);
        $data = $request->except('_token');
        Plan::insert($data);
        return redirect()->back()->with('success', 'created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
           $title = "Edit Subscription Plans";
        $plan = Plan::where('id', $id)->first();
        $res = compact('title', 'plan');
        // return response()->json($res);
        // die;
        return view('admin.subscription.edit', $res);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'title' => 'required|unique:plans,title,'.$id,
            'description' => 'required',
            'convenience_fee' => 'required'
            ]);
        $data = $request->except(['_token', '_method']);
        Plan::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Plan::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
