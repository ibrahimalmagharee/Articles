@extends('layouts.admin')
@section('title')
    Edit Article
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"></h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">The Main</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{route('index.articles')}}">Articles</a>

                                </li>

                                <li class="breadcrumb-item">
                                    Edit Article
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>


                                <!--  Begin Form Edit -->

                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="post"
                                              action="{{route('update.article',$article->id)}}"
                                              id="vendorForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i>Edit Article
                                            </h4>
                                            <input type="hidden" name="id" value="{{$article->id}}">
                                            <div class="form-body">
                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Title</label>
                                                            <input type="text" name="title" id="title" value="{{$article->title}}" class="form-control">
                                                        </div>
                                                        @error('title')
                                                        <span id="title_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Slug</label>
                                                            <input type="text" name="slug" value="{{$article->slug}}" id="slug" class="form-control">
                                                        </div>
                                                        @error('slug')
                                                        <span id="slug_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Short Description</label>
                                                            <textarea name="short_description" id="short_description_ar" cols="15"
                                                                      rows="15" class="form-control">{{$article->short_description}}</textarea>
                                                        </div>
                                                        <span id="short_description_error" class="text-danger"></span>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="switcheryColor4" class="card-title ml-1">Status</label>
                                                            <input type="checkbox" name="status" value="1" id="switcheryColor4"
                                                                   class="switchery active" data-color="success"  @if($article->status == 1) checked @endif/>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Description</label>
                                                            <textarea name="description" id="description" cols="15"
                                                                      rows="15" class="ckeditor">{{$article->description}}</textarea>
                                                        </div>
                                                        @error('description')
                                                        <span id="description_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.articles')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="la la-undo"></i> Retreat
                                                </a>
                                                <button class="btn btn-primary" id="updateBlog"><i
                                                        class="la la-edit"></i> Update
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection


