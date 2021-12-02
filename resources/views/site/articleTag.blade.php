@extends('layouts.site')
@section('title')
    Medium
@endsection
@section('content')
    <main>

        <section class="articles container pt-5">
            <h2><i class="fa fa-tag  fa-rotate-90 tag_icon"></i> {{$tag->name}} </h2>
            @isset($articles)
                @foreach($articles as $article)
                    <div class="row article" style="padding-left: 63px">
                        <div class="w-50 my-2">
                            <div class="d-flex justify-content-start">
                            </div>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-8">
                                    <a class="text-decoration-none" href="{{route('articleDetails', $article->slug)}}">
                                        <h3 class="bold text-dark">{{$article->title}}</h3>
                                        <p class="description" style="color: black">
                                            {{$article->short_description}}
                                        </p>
                                    </a>
                                    <div class="article-footer">
{{--                                        @isset($article->tags)--}}
{{--                                            @foreach($article->tags as $tag)--}}
{{--                                                    <a class="tag m2-2 mt-sm-2 mr-1" href="#"> {{$tag->name}}</a>--}}
{{--                                            @endforeach--}}
{{--                                        @endisset--}}

                                        <small class="text-secondary mx-2 pt-2">Popular in Meduim</small>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <a href="{{route('articleDetails', $article->slug)}}">
                                        @isset($article->images[0])
                                            <img src="{{$article->getPhoto($article->images[0]->photo)}}" class="article-img" alt="">
                                        @endisset
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset




        </section>
    </main>
@endsection
