<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use \DomDocument;

// use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\EditPostRequest;
use App\Http\Requests\PostRequest;
use App\Category;
use App\SubCategory;
use App\Post;
use Image;

class PostController extends Controller
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
        $posts = Post::join('categories', 'posts.category_id', '=', 'categories.id')
            ->leftJoin('sub_categories', 'posts.sub_category_id', '=', 'sub_categories.id')
            ->select('posts.id', 'posts.post_title', 'posts.post_status', 'posts.created_at', 'categories.category_name', 'categories.category_ranking', 'sub_categories.sub_category_ranking', 'sub_categories.sub_category_name')
            ->orderBy('posts.created_at', 'DESC')
            ->select([
                'posts.uid', 'posts.id', 'posts.user_id', 'posts.category_id', 'posts.sub_category_id','posts.post_title','posts.post_slug', 'posts.post_status', 'posts.created_at', 'posts.updated_at',
                'categories.category_name', 'categories.category_ranking',
                'sub_categories.sub_category_name', 'sub_categories.sub_category_status',
            ])
//            ->orderBy('categories.category_ranking', 'asc')
//            ->orderBy('sub_categories.sub_category_ranking', 'asc')
            ->get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_ranking', 'asc')->get();
        // $categories = Category::orderBy('category_ranking' , 'asc')->get();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if ($request->file('post_image') != '') {
            $file_image = $request->file('post_image');
            $file_thumbnail = $request->file('post_image');
            $post_image_thumbnail_file_name = $this->uploadAndReSizeImage($file_thumbnail);
            $post_image = md5(rand() * time()) . '.' . $file_image->getClientOriginalExtension();
            $file_image->move(public_path('images/image_post'), $post_image);
        } else {
            $post_image = "";
        }

        $detail = $request->input('summernoteInput');
        $dom = new DomDocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');

        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');

            if (preg_match('/data:image/', $data)) {
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $data, $groups);
                $mimetype = $groups['mime'];
                // Generating a random filename
                $filename = md5(rand() * time()) . $k;
                $filepath = "/images/image_post_content/$filename.$mimetype";
                // @see http://image.intervention.io/api/
                $image = \Intervention\Image\Facades\Image::make($data)
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }


        }
        $post = new Post([
            "uid" => generateId(),
            "user_id" => Auth::user()->id,
            "category_id" => $request->input('category_id'),
            "sub_category_id" => $request->input('sub_category_id'),
            "post_title" => $request->input('post_title'),
            "post_image" => $post_image,
            "post_image_thumbnail_file_name" => $post_image_thumbnail_file_name,
            "post_detail" => $request->input('post_detail'),
            "post_youtube_embed" => $request->input('post_youtube_embed'),
            "post_youtube_link" => $request->input('post_youtube_link'),
            "post_status" => $request->input('post_status'),
            "post_content" => $detail
        ]);
        $post->save();
        return redirect('administrator/post')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::orderBy('category_ranking', 'asc')->get();
        // $categories = Category::orderBy('category_ranking' , 'asc')->get();
        return view('admin.post.edit', compact('post', 'categories', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRequest $request, $id)
    {

        $detail = $request->summernoteInput;
        $dom = new DomDocument();
        @$dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');

        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');

            if (preg_match('/data:image/', $data)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $data, $groups);
                $mimetype = $groups['mime'];
                $filename = md5(rand() * time()) . $k;
                $filepath = "/images/image_post_content/$filename.$mimetype";
                $image = \Intervention\Image\Facades\Image::make($data)
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }

        $post = Post::find($id);
        $post_image_thumbnail_file_name = $post->post_image_thumbnail_file_name;
        if ($request->file('post_image_update') == '') {
            $image_name = $request->get('old_post_image');
        } else {
            $image_post = $request->file('post_image_update');
            $file_thumbnail = $request->file('post_image_update');
            $post_image_thumbnail_file_name = $this->uploadAndReSizeImage($file_thumbnail);
            $image_name = md5(rand() * time()) . '.' . $image_post->getClientOriginalExtension();
            $image_post->move(public_path('images/image_post'), $image_name);
            if ($request->get('old_post_image') != '') {
                @unlink(public_path() . '/images/image_post/' . $request->get('old_post_image'));
                @unlink(public_path() . '/images/image_post/thumbnail/' . $post->post_image_thumbnail_file_name);
            }
        }


        $post = Post::find($id);
        $post->category_id = $request->input('category_id');
        $post->sub_category_id = $request->input('sub_category_id');
        $post->post_title = $request->input('post_title');
        $post->post_image = $image_name;
        $post->post_image_thumbnail_file_name = $post_image_thumbnail_file_name;
        $post->post_detail = $request->input('post_detail');
        $post->post_youtube_embed = $request->input('post_youtube_embed');
        $post->post_youtube_link = $request->input('post_youtube_link');
        $post->post_status = $request->input('post_status');
        $post->post_content = $detail;
        $post->save();
        return redirect('administrator/post')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $image = $post->post_image;
        if ($image != '') {
            @unlink(public_path() . '/images/image_post/' . $image);
            @unlink(public_path() . '/images/image_post/thumbnail/' . $post->post_image_thumbnail_file_name);
        }
        $post->delete();
        return redirect('administrator/post')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }

    public function active($id)
    {
        $post = Post::find($id);
        $post->post_status = '1';
        $post->save();
        return redirect('administrator/post')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function unactive($id)
    {
        $post = Post::find($id);
        $post->post_status = '0';
        $post->save();
        return redirect('administrator/post')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function load_sub_category(Request $request)
    {
        $category_id = $request->get('category_id');
        $sub_category = SubCategory::where('category_id', $category_id)->orderBy('sub_category_ranking', 'asc')->get();
        $output = '';
        if (count($sub_category) > 0) {
            $output .= '<option value="0">เลือกประเภทบทความย่อย</option>';
            foreach ($sub_category as $data) {
                $selected = '';
                if (!empty($request->sub_category_id)) {
                    if ($request->sub_category_id == $data->id) {
                        $selected = 'selected';
                    }
                }
                $output .= '
            <option value="' . $data->id . '" ' . $selected . '>' . $data->sub_category_name . '</option>
            ';
            }
        } else {
            $output .= '<option value="0">ไม่มีประเภทบทความย่อย</option>';
        }

        return $output;
    }

    public function uploadAndReSizeImage($file) {
        $name = md5(rand()*time()).'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('images/image_post/thumbnail');
        $img = Image::make($file->path());
        $img->resize(410, 240, function ($constraint) {
//            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$name);
        return $name;
    }

}

