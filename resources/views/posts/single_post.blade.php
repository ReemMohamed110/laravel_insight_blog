@extends('layouts.app_blog')
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('assets/img/home-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>single post</h1>
                        <span class="subheading">A Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Post preview-->

                <div class="post-preview">
                    {{-- <a href={{url('single_post/'.$posts->id)}}> --}}
                    <h2 class="post-title">{{ $posts->title }}</h2>
                    <h3 class="post-subtitle">{{ $posts->content, 50 }}....</h3>
                    @if ($posts->image)
                        <img width="100" height="100" src="{{ asset('storage/' . $posts->image) }}"></td>
                    @endif
                    {{-- </a> --}}
                    <p class="post-meta">
                        Posted by : {{ $posts->user->name }}
                        <a href="#!">Start Bootstrap</a>
                        {{ $posts->created_at }}
                    </p>
                </div>



                <!-- Divider-->
                <hr class="my-4" />
                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase"
                        href={{ url('/') }}>All
                        Posts →</a></div>
            </div>
        </div>
    </div>
@endsection
