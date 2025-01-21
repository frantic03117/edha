<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res['title'] = 'List of Postnames';
        $items = Post::with('category')->orderBy('id', 'DESC');
        $category = $_GET['category'] ?? null;
        $postname = $_GET['postname'] ?? null;
        if($category){
            $items->where('category_id', $category);
        }
        if($postname){
            $items->where('post', 'LIKE', "%{$postname}%");
        }
        $res['categories'] = Category::all();
        $res['catg'] = $category;
        $res['key'] = $postname;
        $res['items'] = $items->get();
        //  return response()->json($res['items']);
        // die;
        return view('admin.experts.postnames', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res['title'] = 'Manage Postname';
        $res['items'] = Post::with('category')->orderBy('id', 'DESC')->get();
       
        return view('admin.experts.postnames', $res);
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
            'category_id' => 'required',
            'title' => 'required'
        ]);
        $catid = $request->category_id;
        if($catid != "all"){
            $data = [
                'category_id' => $request->category_id,
                'post' => $request->title
            ];
            $check = Post::where($data)->first();
            if(!$check){
                Post::insert($data);
            }
        }
       if($catid == "all"){
           $cats = Category::all();
           foreach($cats as $cat){
            $data = [
                'category_id' => $cat->id,
                'post' => $request->title
            ];
            $check = Post::where($data)->first();
            if(!$check){
                Post::insert($data);
            }
           }
       }
        return redirect()->back()->with('success', 'Faq saved');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $res['faq'] = $faq;
        $res['title'] = $faq['faq'] . ' Edit';
        $res['url'] = route('faq.update', $faq['id']);
        $res['method'] = 'PUT';
        return view('admin.faq.create', $res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required'
        ]);
        $data = [
            'category_id' => $request->category_id,
            'post' => $request->title,
        ];
        $check = Post::where($data)->first();
        if(!$check){
            Post::where('id', $id)->update($data);
        }
        
        return redirect()->back()->with('success', 'Faq saved');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
