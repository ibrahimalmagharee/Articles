@extends('layouts.admin')
@section('title')
    Tags
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> Tags </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">The Main  </a></li>
                                <li class="breadcrumb-item active">Tags</li>
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
                                    <a class="btn btn-outline-success float-left" href="javascript:void(0)"
                                       id="addNewTag"><i class="la la-plus"></i> Add New Tag  </a>
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

                                <div class="card-content collapse show" id="viewCategory">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table tag-table">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Status</th>
                                                <th>Process</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Begin Form Add Main Category -->

    <div class="modal fade modal-open" id="tag-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-500">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i>Add New Tag
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="tagForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">Name</label>
                                                <input type="text" id="name" class="form-control"
                                                       name="name" value="{{old('name')}}">
                                                <span id="name_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1"> Slug</label>
                                                <input type="text" id="slug" class="form-control"
                                                       name="slug" value="{{old('slug')}}">
                                                <span id="slug_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                    <div class="row">

                                        <div class="form-group mt-1">
                                            <label for="switcheryColor4" class="card-title ml-1">Status</label>
                                            <input type="checkbox" name="status" value="1" id="switcheryColor4"
                                                   class="switchery active" data-color="success" checked/>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i>Retreat
                                    </button>
                                    <button class="btn btn-primary" id="addTag"> <i class="la la-save"></i> Save</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Form Add Main Category -->



    <!-- // Basic form layout section end -->



    {{-- Confirmation Modal --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Confirm The Deletion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="delete_modal_form">
                    @csrf
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input type="hidden" id="delete_language">
                        <h5>Are you sure to delete this tag !!</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
                        <button type="submit" class="btn btn-danger" id="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Confirmation Modal --}}


@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Show Table
            var tagTable = $('.tag-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.tags")}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

            });


            //Show Form
            $('#addNewTag').click(function () {
                $('#tagForm').trigger('reset');
                $('#tag-modal').modal('show');
                $('#addTag').html('Save');
                $('#action').val('Add');
                $('#modal_header').html('Add New Tag');

            });


            //Add Or Update
            $(document).on('click', '#addTag', function (e) {
                e.preventDefault();
                var formData = new FormData($('#tagForm')[0]);
                $('#name_error').text('');
                $('#slug_error').text('');
                 $.ajax({
                        type: 'post',
                        url: "{{ route('save.tag') }}",
                        enctype: 'multipart/form-data',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: 'json',

                        success: function (data) {
                            if (data.status == true) {
                                toastr.success(data.msg);
                                $('#tagForm').trigger('reset');
                                $('#tag-modal').modal('hide');
                                tagTable.draw();
                            } else {
                                toastr.error(data.msg);
                                $('#tagForm').trigger('reset');
                                $('#tag-modal').modal('hide');
                                tagTable.draw();
                            }

                        },

                        error: function (reject) {
                            console.log('Error: not added', reject);
                            var response = $.parseJSON(reject.responseText);
                            $.each(response.errors, function (key, val) {
                                $("#" + key + "_error").text(val[0]);


                            });

                        }

                 });


            });

            //Delete

            $('body').on('click', '.deleteTag', function () {
                var id = $(this).data('id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({

                        url: "delete/" + id,

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status == true) {
                                $('#delete-modal').modal('hide');
                                toastr.warning(data.msg);
                                tagTable.draw();
                            }

                        }

                    });
                });

                $('#cancel').click(function () {
                    $('#delete-modal').modal('hide');
                });
            });


        });
    </script>
@endsection
