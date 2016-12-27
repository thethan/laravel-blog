<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Voyager;



class PostsController extends VoyagerBreadController
{
    public function blogindex()
    {
        return Post::all();
    }


    public function get($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('posts.post', ['post' => $post]);
    }


    // POST BRE(A)D
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = DataType::where('slug', '=', $slug)->first();

        // Check permission
        Voyager::can('add_'.$dataType->name);

        if (function_exists('voyager_add_post')) {
            $url = $request->url();
            voyager_add_post($request);
        }

        $data = new $dataType->model_name();
        $this->insertUpdateData($request, $slug, $dataType->addRows, $data);

        return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => "Successfully Added New {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {


        $slug = $this->getSlug($request);

        $dataType = DataType::where('slug', '=', $slug)->first();

        // Check permission
        Voyager::can('edit_'.$dataType->name);

        /**
         * @var \App\Post
         */
        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        if(!empty($request->input('tags'))){
            $data->syncTagsByName($request->input('tags'));
        };
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => "Successfully Updated {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }
}

