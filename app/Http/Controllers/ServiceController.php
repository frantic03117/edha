<?php

namespace App\Http\Controllers;

use App\Http\AllTraits\MyTrait;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use MyTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res['title'] = 'List of Servies';
        $res['items'] = Service::all();
        // return response()->json($res['items']);
        // die;
        return view('admin.services.index', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res['title'] = 'Create Serivce';
        $res['categories'] = Category::all();
        return view('admin.services.create', $res);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id'
        ]);
        $sid = $request->sub_category_id;

        $findSubcategory = SubCategory::where(['id' => $sid])->first();


        $url = $this->make_url($request->title);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('assets/img/'), $filename);
        } else {
            $filename = null;
        }
        $data = [
            'title' => $findSubcategory->sub_category,
            'url' => $findSubcategory->url,
            'sub_category_id' => $request->sub_category_id,
            'meta_description' => $request->meta_description,
            'meta_title' => $request->meta_title,
            'description' => $request->description,
            'key_points' => $request->key_points,
            'image' => $filename,
            'category_id' => $request->category_id,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $fdta = [
            'sub_category_id' => $request->sub_category_id,
            'url' => $findSubcategory->url,
        ];
        $isExists = Service::where($fdta)->first();
        if (!$isExists) {
            if (Service::insert($data)) {
                return redirect()->back()->with('success', 'Service Added');
            }
        } else {
            return redirect()->back()->with('error', 'Duplicate data');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {

        $title = 'Edit Service';
        $res = compact('service', 'title');
        $res['categories'] = Category::all();
        $res['sub_categories'] = SubCategory::all();
        return view('admin.services.edit', $res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'sub_category_id' => 'required|exists:sub_categories,id',
            'category_id' => 'required'
        ]);
        $sid = $request->sub_category_id;
        $findSubcategory = SubCategory::where(['id' => $sid])->first();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('assets/img/'), $filename);
        } else {
            $filename = $request->hfile;
        }
        $data = [
            'title' => $findSubcategory->sub_category,
            'url' => $findSubcategory->url,
            'sub_category_id' => $request->sub_category_id,
            'meta_description' => $request->meta_description,
            'meta_title' => $request->meta_title,
            'description' => $request->description,
            'key_points' => $request->key_points,
            'image' => $filename,
            'category_id' => $request->category_id,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $fdta = [
            'sub_category_id' => $request->sub_category_id,
            'url' => $findSubcategory->url,
        ];
        $isExists = Service::where($fdta)->where('id', '!=', $service['id'])->first();
        if ($isExists) {
            return redirect()->back()->with('error', 'Duplicate data');
        }
        if (Service::where(['id' => $service['id']])->update($data)) {
            return redirect()->back()->with('success', 'Service Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
