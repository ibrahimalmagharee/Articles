@extends('layouts.admin')
@section('title')
    Edit Profile - {{$admin->name}}
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
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">The Main</a></li>
                                <li class="breadcrumb-item active"> Edit Profile - {{$admin->name}}</li>
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
                                        <form class="form" id="categoryFormLocale" method="post"
                                              action="{{route('update.profile')}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <h4 class="form-section"><i class="ft-home"></i> Edit Profile - {{$admin->name}}</h4>
                                            <input type="hidden" name="id" value="{{$admin->id}}">

                                            <div class="form-group">
                                                <label> Photo </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="image" name="image">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Name </label>
                                                            <input type="text" id="name" class="form-control" placeholder="" name="name" value="{{$admin->name}}">

                                                            @error('name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Email</label>
                                                            <input type="email" id="email" class="form-control" placeholder="" name="email" value="{{$admin->email}}">

                                                            @error('email')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Password </label>
                                                            <input type="password" id="password" class="form-control" placeholder="" name="password">

                                                            @error('password')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Confirm Password</label>
                                                            <input type="password" id="password_confirmation" class="form-control" placeholder="" name="password_confirmation">

                                                            @error('password')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="la la-check-square-o"></i> Update
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
