<?php

namespace App\Http\Helpers;

use App\Category;
use App\Models\School;
use App\Post;
use App\SubCategory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HelperCore
{
    public function getCategoryMenu()
    {
        $categories = Category::where('category_status', '1')->orderBy('category_ranking', 'asc')
            ->select([
                "id",
                "uid",
                "category_name",
                "category_slug",
                "category_ranking",
            ])
            ->get();

        $sub_categories = SubCategory::where('sub_category_status', '1')
//            ->where('category_id' , $maim_menu->id)
            ->orderBy('sub_category_ranking', 'asc')
            ->select([
                "id",
                "uid",
                "category_id",
                "sub_category_name",
                "sub_category_slug",
                "sub_category_ranking",
            ])
            ->get();
        $category_menu = collect($categories);
        $sub_categories = collect($sub_categories);
        $category_menu = $category_menu->map(function ($category) use ($sub_categories) {
            $sub_category = $sub_categories->where('category_id', $category->id);
            $category['sub_categories'] = $sub_category;
            return $category;
        });
        return $category_menu;
    }

    public function getCategories()
    {
        $categories = Category::where('category_status', '1')->orderBy('category_ranking', 'asc')
            ->select([
                "id",
                "category_name",
                "category_slug",
                "category_ranking",
            ])
            ->get();
        return $categories;
    }

    public function getSubCategories()
    {
        $sub_categories = SubCategory::where('sub_category_status', '1')
            ->join('categories', 'sub_categories.category_id', 'categories.id')
//            ->where('category_id' , $maim_menu->id)
//            ->orderBy('sub_category_ranking', 'asc')
            ->select([
                "sub_categories.id",
                "sub_categories.category_id",
                "sub_categories.sub_category_name",
                "sub_categories.sub_category_slug",
                'categories.category_slug'
            ])
            ->get();
        return $sub_categories;
    }


    public function recentPosts($limit = 8)
    {
        return Post::where('post_status', '1')
            ->select([
                'posts.id', 'posts.user_id', 'posts.category_id', 'posts.sub_category_id','posts.post_title','posts.post_slug','posts.post_image','posts.post_detail','posts.post_status',
            ])
            ->orderBy('created_at', 'DESC')
//            ->orderByViews()
            ->limit($limit)
            ->get();
    }

    public function popularPosts($limit = 8)
    {
        return Post::where('post_status', '1')
            ->select('posts.*')
            ->orderByViews()
            ->limit($limit)
            ->get();
    }
}
