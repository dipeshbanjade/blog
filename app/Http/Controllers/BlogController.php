<?php

namespace App\Http\Controllers;

use App\blog;
use App\Http\Requests\blogValidation;
use Illuminate\Http\Request;
use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['page_title'] = 'blog';
        $page['page_description'] = 'blog description';
        $blog = blog::where('status', '1')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc');
        $myBlog = $blog ? $blog : '';
        return view('blog', compact(['page', 'myBlog']));
    }


    public function getAllBlog(){
        $page['page_title'] = 'blog';
        $page['page_description'] = 'blog description';
        $blog = blog::where('status', '1')->orderBy('created_at', 'desc');
        $myBlog = $blog ? $blog : '';
        return view('blog', compact(['page', 'myBlog']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(blogValidation $request)
    {
        $date = date('Y-m-d h:i:s');
        $save = new save();
        $save->title = $request->title;
        $save->desc  = $request->desc;
        $save->user_id = Auth::user()->id;
        $save->status = 1;

        if ($request->hasFile('featured_image')) {
            $blogImage = $request->file('img_path');
            $blogImageName = str_replace(' ', '', $request->title).$date. '.' . $blogImage->getClientOriginalExtension();
           $save->featured_image = 'blog/'.$blogImageName;
        }

        $mySave = $save->save();

        if ($mySave) {
            /*return response()->json([
              'success' => true,
              'message' => 'successfully inserted'
            ], 200);*/
            return view()->withMessage('successfully inserted');
        }else{
            /*return response()->json([
                 'success' => false,
                 'message' => 'sorry blog is not save'
                ], 203);*/
                return view('home')->withMessage('oops try it again');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = findOrFail($id);
        if ($blog) {
            $page['page_title'] = $blog->title;
            $page['page_description'] = $blog->desc;
            return view('single-blog', compact(['blog']));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = blog::findOrFail($id);
       if($blog) {
           return response()->json([
               'success'       => true,
               'id'            => $blog->id,
               'name'          => $blog->title,
               'desc'          => $blog->desc,
               'blog_logo'     => $blog->featured_image,
               'user_id'       => $blog->user_id,
           ], 200);

       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog = blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->desc = $request->desc;

        if ($request->hasFile('featured_image')) {
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = findOrFail($id);
        if ($blog) {
             if (file_exists($blog->featured_image)) {
                 File::delete($blog->featured_image);
             }
            $blog->delete();
            return response()->json([
              'success' => true,
              'message' => 'product delete'
             ], 200);
        }else{
            return response()->json([
                 'success' => false,
                 'message' => 'sorry blog not found'
                ], 200);
        }
    }
}
