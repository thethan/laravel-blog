@extends('voyager::master')

@section('css')
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height: 100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
        .items.has-items {
            width: 100%;
            display: inline-flex;
            border:2px grey;
        }
        .items.has-items .item {
           flex: auto;
            border: 1px solid #00acee;
            -webkit-border-radius:3px 3px 3px 3px;
            -moz-border-radius:3px 3px 3px 3px;
            border-radius:3px 3px 3px 3px;
        }
        .selectize-dropdown {
            display: block;
            width: 100%;
            border: 1px solid #333333;
        }
    </style>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'New' }}@endif {{ $dataType->display_name_singular }}
    </h1>
@stop

@section('content')

    <div class="page-content container-fluid">
        <form role="form"
              action="@if(isset($dataTypeContent->id)){{ route('voyager.posts.update', $dataTypeContent->id) }}@else{{ route('voyager.posts.store') }}@endif"
              method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="voyager-character"></i> Post Title
                                <span class="panel-desc"> The title for your post</span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" name="title" placeholder="Title"
                                   value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif">
                        </div>
                    </div>



                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-book"></i> Post Content</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <textarea class="richTextBox" name="body" style="border:0px;">
                            @if(isset($dataTypeContent->body)){{ $dataTypeContent->body }}@endif
                        </textarea>
                    </div><!-- .panel -->

                    <!-- ### EXCERPT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Excerpt
                                <small>Small description of this post</small>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                          <textarea class="form-control" name="excerpt">
                              @if (isset($dataTypeContent->excerpt)){{ $dataTypeContent->excerpt }}@endif
                          </textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- ### DETAILS ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> Post Details</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">URL slug</label>
                                <input type="text" class="form-control" name="slug" placeholder="slug"
                                       value="@if(isset($dataTypeContent->slug)){{ $dataTypeContent->slug }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="name">Where you met</label>
                                <input type="text" class="form-control" name="where" placeholder="where"
                                       value="@if(isset($dataTypeContent->where)){{ $dataTypeContent->where }}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">Rating</label>
                                <select  class="form-control" name="rating_id" placeholder="rating">
                                    @foreach(App\Rating::all() as $rating)
                                        <option value="{{ (int)$rating->id }}" @if(isset($dataTypeContent->rating_id) && $dataTypeContent->rating_id == $rating->id){{ 'selected="selected"' }}@endif>{{ $rating->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Post Status</label>
                                <select class="form-control" name="status">
                                    <option value="PUBLISHED" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PUBLISHED'){{ 'selected="selected"' }}@endif>
                                        published
                                    </option>
                                    <option value="DRAFT" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'DRAFT'){{ 'selected="selected"' }}@endif>
                                        draft
                                    </option>
                                    <option value="PENDING" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PENDING'){{ 'selected="selected"' }}@endif>
                                        pending
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Post Category</label>
                                <select class="form-control" name="category_id">
                                    @foreach(TCG\Voyager\Models\Category::all() as $category)
                                        <option value="{{ (int)$category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Post Tags</label>
                                <select id="select-tag" name="tags[]" multiple class="demo-default"
                                        placeholder="Select Tags...">
                                    @php
                                        if(isset($dataTypeContent->tags)){
                                       $tag_ids = $dataTypeContent->tags->map(function ($value){
                                           return $value->id;
                                       });
                                       } else{
                                        $tag_ids = new \Illuminate\Database\Eloquent\Collection();
                                       }
                                    @endphp
                                    @foreach(App\Tag::all() as $tag)
                                        <option value="{{ $tag->name}}" @if(in_array($tag->id, $tag_ids->all())){{ 'selected' }}@endif>{{ $tag->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="name">Featured</label>
                                <input type="checkbox"
                                       name="featured" @if(isset($dataTypeContent->featured) && $dataTypeContent->featured){{ 'checked="checked"' }}@endif>
                            </div>
                        </div>
                    </div>

                    <!-- ### IMAGE ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-image"></i> Post Image</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(isset($dataTypeContent->image))
                                <img src="{{ Voyager::image( $dataTypeContent->image ) }}" style="width:100%"/>
                            @endif
                            <input type="file" name="image">
                        </div>
                    </div>

                    <!-- ### SEO CONTENT ### -->
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-search"></i> SEO Content</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                   aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Meta Description</label>
                                <textarea class="form-control" name="meta_description">
                                    @if(isset($dataTypeContent->meta_description)){{ $dataTypeContent->meta_description }}@endif
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Meta Keywords</label>
                                <textarea class="form-control" name="meta_keywords">
                                    @if(isset($dataTypeContent->meta_keywords)){{ $dataTypeContent->meta_keywords }}@endif
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">SEO Title</label>
                                <input type="text" class="form-control" name="seo_title" placeholder="SEO Title"
                                       value="@if(isset($dataTypeContent->seo_title)){{ $dataTypeContent->seo_title }}@endif">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                @if(isset($dataTypeContent->id)){{ 'Update Post' }}@else<?= '<i class="icon wb-plus-circle"></i> Create New Post'; ?>@endif
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
              enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>
@stop

@section('javascript')
    <script src="{{ config('voyager.assets_path') }}/lib/js/tinymce/tinymce.min.js"></script>
    <script src="{{ config('voyager.assets_path') }}/js/voyager_tinymce.js"></script>
    <script src="/js/selectize.js"></script>
    <script>
        $('#tags_select').selectize();

    </script>
    <script>
        $('#select-tag').selectize({
            create: true
        });
    </script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/selectize/normaize.css">
    <link rel="stylesheet" href="/css/selectize/stylesheet.css">
@stop