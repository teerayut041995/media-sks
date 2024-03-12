<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;
use App\Category;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAuth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('category_ranking' , 'asc')->get();
        return view('admin.category.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if ($request->input('category_ranking') != '') {
            $category_ranking = $request->input('category_ranking');
        } else {
            $category_ranking = 0;
        }
        $category = new Category([
            "uid" => generateId(),
            "category_name" => $request->input('category_name'),
            "category_ranking" => $category_ranking,
        ]);
        $category->save();
        return redirect('administrator/category')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
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
        $category = Category::find($id);
        return view('admin.category.edit' , compact('category','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        if ($request->input('category_ranking') != '') {
            $category_ranking = $request->input('category_ranking');
        } else {
            $category_ranking = 0;
        }
        $category->category_name = $request->input('category_name');
        $category->category_ranking = $category_ranking;
        $category->save();
        return redirect('administrator/category')->with('success','แก้ไขข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('administrator/category')->with('success','ลบข้อมูลเรียบร้อยแล้ว');
    }

    public function active($id)
    {
        $category = Category::find($id);
        $category->category_status = '1';
        $category->save();
        return redirect('administrator/category')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function unactive($id)
    {
        $category = Category::find($id);
        $category->category_status = '0';
        $category->save();
        return redirect('administrator/category')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
}
