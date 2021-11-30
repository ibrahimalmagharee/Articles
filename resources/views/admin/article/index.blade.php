@extends('layouts.admin')
@section('title')
    Articles
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Articles </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">The Main </a></li>
                                <li class="breadcrumb-item active"> Articles</li>
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
                                    <a class="btn btn-outline-success float-left" href="{{route('create.article')}}"
                                       id="addNewArticle"><i class="la la-plus"></i> Add New Article</a>
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

                                <div class="card-content collapse show" id="viewAboutUs">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table article-table">
                                            <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Slug</th>
                                                <th>Short Description</th>
                                                <th>Status</th>
{{--                                                <th>Image</th>--}}
                                                <th>Process</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="justify-content-center d-flex"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


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
                        <h5>Are you sure to delete this article !!</h5>
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
            var articleTable = $('.article-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.articles")}}",
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'slug', name: 'slug'},
                    {data: 'short_description', name: 'short_description'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

            });


            $(document).on('click', '.changeStatus', function (e) {
                e.preventDefault();

                var status = $(this).data('status');
                var article_id = $(this).data('id');

                $.ajax({
                    type: 'post',
                    url: "{{ route('changeStatus.article') }}",
                    data: {'article_id': article_id, 'status': status},
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true){
                            toastr.success(data.msg);
                            if (data.article_status == 1) {
                                $('#published_'+article_id).addClass('display');
                                $('#published_'+article_id).removeClass('hidden');
                                $('#published_'+article_id).attr('data-status', data.article_status);
                                $('#un_published_'+article_id).attr('data-status', data.article_status);
                                $('#un_published_'+article_id).addClass('hidden');



                            } else if(data.article_status == 0) {
                                $('#published_'+article_id).addClass('hidden');
                                $('#un_published_'+article_id).addClass('display');
                                $('#un_published_'+article_id).removeClass('hidden');
                                $('#published_'+article_id).attr('data-status', data.article_status);
                                $('#un_published_'+article_id).attr('data-status', data.article_status);




                            }
                        }



                    },


                });
            });



            //Delete

            $('body').on('click', '.deleteArticle', function () {
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
                                articleTable.draw();
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
