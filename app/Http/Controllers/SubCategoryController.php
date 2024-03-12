<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SubCategoryRequest;
use App\Category;
use App\SubCategory;

class SubCategoryController extends Controller
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
        $sub_categories = SubCategory::join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->select('sub_categories.*', 'categories.category_name' , 'categories.category_ranking')
            ->orderBy('categories.category_ranking' , 'asc')
            ->orderBy('sub_categories.sub_category_ranking' , 'asc')
            ->get();
        //return $sub_categories;
        return view('admin.sub_category.index' , compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_ranking' , 'asc')->get();
        return view('admin.sub_category.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        if ($request->input('sub_category_ranking') != '') {
            $sub_category_ranking = $request->input('sub_category_ranking');
        } else {
            $sub_category_ranking = 0;
        }
        $sub_category = new SubCategory([
            "uid" => generateId(),
            "category_id" => $request->input("category_id"),
            "sub_category_name" => $request->input("sub_category_name"),
            "sub_category_ranking" => $sub_category_ranking
        ]);
        $sub_category->save();
        return redirect('administrator/sub-category')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
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
        $categories = Category::orderBy('category_ranking' , 'asc')->get();
        $sub_category = SubCategory::find($id);
        return view('admin.sub_category.edit' , compact('categories' , 'sub_category' , 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, $id)
    {
        if ($request->input('sub_category_ranking') != '') {
            $sub_category_ranking = $request->input('sub_category_ranking');
        } else {
            $sub_category_ranking = 0;
        }
        $sub_category = SubCategory::find($id);
        $sub_category->category_id = $request->input("category_id");
        $sub_category->sub_category_name = $request->input("sub_category_name");
        $sub_category->sub_category_ranking = $sub_category_ranking;

        $sub_category->save();
        return redirect('administrator/sub-category')->with('success','แก้ไขข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = SubCategory::find($id);
        $category->delete();
        return redirect('administrator/sub-category')->with('success','ลบข้อมูลเรียบร้อยแล้ว');
    }

    public function active($id)
    {
        $category = SubCategory::find($id);
        $category->sub_category_status = '1';
        $category->save();
        return redirect('administrator/sub-category')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function unactive($id)
    {
        $category = SubCategory::find($id);
        $category->sub_category_status = '0';
        $category->save();
        return redirect('administrator/sub-category')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
}
