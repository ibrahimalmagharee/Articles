@extends('layouts.site')
@section('title')

@endsection
@section('content')

{{--      <main>--}}
{{--          <section class="articles container pt-5">--}}
{{--            <div class="row article">--}}
{{--                <div class="w-50 my-2">--}}
{{--                    <h3 class="bold text-dark">{{$article->title}}</h3>--}}
{{--                  </div>--}}
{{--                  <div class="content">--}}
{{--                      <div class="row">--}}
{{--                          <div class="">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                            </div>--}}


{{--                            <div class="article-imgs p-3">--}}
{{--                                <div class="w-lg-75 centering-img">--}}
{{--                                    @isset($article->images[0])--}}
{{--                                        <img src="{{$article->getPhoto($article->images[0]->photo)}}" class="detail-article-img" id="expandedImg"  style="width:100%">--}}
{{--                                    @endisset--}}
{{--                                  </div>--}}

{{--                                  <div class="d-flex w-lg-75 centering-img mt-5">--}}
{{--                                      @isset($article->images)--}}
{{--                                          @foreach($article->images as $article_image)--}}
{{--                                              <div class="col">--}}
{{--                                                  <img src="{{$article_image->getPhoto($article_image->photo)}}" alt="" class="img-small" style="width:100%; padding-right: 15px"  onclick="myFunction(this);">--}}
{{--                                              </div>--}}
{{--                                          @endforeach--}}
{{--                                      @endisset--}}

{{--                                  </div>--}}
{{--                            </div>--}}
{{--                              <p class="mt-4">--}}
{{--                                  {!! $article->description !!}--}}
{{--                              </p>--}}

{{--                              <div class="article-footer">--}}
{{--                                  @isset($article->tags)--}}
{{--                                      @foreach($article->tags as $tag)--}}
{{--                                          <a class="tag m2-2 me-1" href="{{route('articleTags', $tag->slug)}}"> {{$tag->name}}</a>--}}
{{--                                      @endforeach--}}
{{--                                  @endisset--}}




{{--                              </div>--}}
{{--                          </div>--}}
{{--                      </div>--}}
{{--                  </div>--}}
{{--              </div>--}}
{{--          </section>--}}
{{--      </main>--}}

@endsection
