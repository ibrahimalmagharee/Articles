@extends('layouts.admin')
@section('title')
    Add New Article
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
                                    Add New Article
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
                                              action="{{route('save.article')}}"
                                              id="vendorForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i>Add New Article
                                            </h4>
                                            <div class="form-body">
                                                <div class="row mt-2">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Title</label>
                                                            <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control">
                                                            @error('title')
                                                            <span id="title_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Slug</label>
                                                            <input type="text" name="slug" value="{{old('slug')}}" id="slug" class="form-control">
                                                            @error('slug')
                                                            <span id="slug_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="switcheryColor4" class="card-title ml-1">Status</label>
                                                            <input type="checkbox" name="status" value="1" id="switcheryColor4"
                                                                   class="switchery active" data-color="success" checked/>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Short Description</label>
                                                            <textarea name="short_description" id="short_description_ar" cols="15"
                                                                      rows="15" class="form-control">{{old('short_description')}}</textarea>
                                                            @error('short_description')
                                                            <span id="short_description_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> Tags </label>
                                                            <select name="tags[]" id="parent_id"
                                                                    class="select2 form-control"
                                                                    multiple>
                                                                <optgroup label="Please Choose The Appropriate Tag">

                                                                    @isset($tags)
                                                                        @foreach($tags as $tag)
                                                                            <option
                                                                                value="{{$tag->id}}">{{$tag->name}}</option>

                                                                        @endforeach
                                                                    @endisset


                                                                </optgroup>
                                                            </select>
                                                            @error('tags')
                                                            <span id="parent_id_error"
                                                                  class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Description</label>
                                                            <textarea name="description" id="description" cols="15"
                                                                      rows="15" class="ckeditor">{{old('description')}}</textarea>
                                                            @error('description')
                                                            <span id="description_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                                <div class="dz-message" style="position: absolute; top: 20%">You can upload more than one picture here </div>
                                                            </div>
                                                            <br>
                                                            @error('images')
                                                            <span id="images_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>



                                            <div class="form-actions">
                                                <a href="{{route('index.articles')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="la la-undo"></i> Retreat
                                                </a>
                                                <button class="btn btn-primary" id="updateBlog"><i
                                                        class="la la-edit"></i> Save
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

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

        var uploadedDocumentMap = {}

        Dropzone.options.dpzMultipleFiles = {
            paramName: "dzfile", // The name that will be used to transfer the file
            //autoProcessQueue: false,
            maxFilesize: 5, // MB
            clickable: true,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            dictFallbackMessage: "Your browser does not support the image count feature, clouds, and buses ",
            dictInvalidFileType: "You cannot upload this type of file ",
            dictCancelUpload: "cancel upload",
            dictCancelUploadConfirmation: " Are you sure to cancel the upload files? ",
            dictRemoveFile: " delete",
            dictMaxFilesExceeded: "You cannot upload more than this ",
            headers: {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}"
            }
            ,
            url: "{{ route('save.images.inFolder') }}", // Set the url
            success:
                function (file, response) {
                    $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                }
            ,

            removedfile: function(file)
            {
                var name = file.upload.filename;

                $.ajax({
                    type: 'POST',
                    url: '{{ route('delete.image.fromFolder') }}',
                    data: {filename:name},

                    success: function(file, name)
                    {
                        console.log(name);
                        file.upload.filename=name;
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },

            // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
            init: function () {
                    @if(isset($event) && $event->images)
                var files;
                {!! json_encode($event->images) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    console.log(file)
                    $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
                }
                @endif
            }
        }
    </script>
@endsection


