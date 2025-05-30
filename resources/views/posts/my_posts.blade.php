@extends('layouts.app_blog')
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <span class="subheading">A Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @isset($posts)
    @php
        $id=Auth::id();
    @endphp
        @forelse ($posts->where('user_id',$id) as $post)
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <!-- Post preview-->

                        <div class="post-preview">
                            <a href={{ url('single_post/' . $post->id) }}>
                                <h2 class="post-title">{{ $post->title }}</h2>
                                <h3 class="post-subtitle">{{ \Str::limit($post->content, 50) }}....</h3>
                                @if ($post->image)
                                    <img width="100" height="100" src="{{ asset('storage/' . $post->image) }}"></td>
                                @endif
                            </a>
                            <p class="post-meta">
                                Posted by : {{ $post->user->name }}
                                <a href="#!">Start Bootstrap</a>
                                {{ $post->created_at }}
                            </p>
                        </div>
                        <!-- Divider-->
                        <hr class="my-4" />
                        <!-- Pager-->
                        <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase"
                                href=" {{ url('single_post/' . $post->id) }}">post details →</a></div>
                    </div>
                </div>
            </div>

        @empty
            <h1>you aren't have posts </h1>
        @endforelse
        <div>
            {{ $posts->links() }}
        </div>
    @endisset



@endsection
