<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Post;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function category($slug)
    {
    	$category = Category::where('category_status' , '1')
    		->where('category_slug' , $slug)
    		->first();
    	$posts = Post::leftJoin('users' , 'posts.user_id' , 'users.id')
    			->select('posts.*' , 'users.name')
    			->where('post_status' , '1')
    			->where('category_id' , $category->id)
    			->orderBy('created_at' , 'DESC')
                ->orderByViews()
    			->paginate(12);
    	return view('frontend.category' , compact('category' , 'posts'));
    }
    public function sub_category($cate_slug,$sub_slug)
    {
    	$category = SubCategory::join('categories' , 'sub_categories.category_id' , 'categories.id')
    		->select('sub_categories.*' , 'categories.category_name','categories.category_slug')
    		->where('sub_category_status' , '1')
    		->where('sub_category_slug' , $sub_slug)
    		->first();
    	$posts = Post::leftJoin('users' , 'posts.user_id' , 'users.id')
    			->select('posts.*' , 'users.name')
    			->where('post_status' , '1')
    			->where('sub_category_id' , $category->id)
    			->orderBy('created_at' , 'DESC')
    			->paginate(12);
    	return view('frontend.sub_category' , compact('category' , 'posts'));
    	return 'sub category';
    }
}
