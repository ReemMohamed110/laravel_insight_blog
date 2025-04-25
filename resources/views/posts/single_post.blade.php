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
    <!-- Divider-->
    <hr class="my-4" />
    <!-- Pager-->
    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href={{ url('/') }}>All
            Posts →</a></div>
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">

                <!-- Post preview-->

                <div class="post-preview">
                    <h2 class="post-title">{{ $posts->title }}</h2>
                    <h3 class="post-subtitle  fs-5 fw-light" >{{ $posts->content }}</h3>
                    @if ($posts->image)
                        <img width="300" height="200" src="{{ asset('storage/' . $posts->image) }}"></td>
                    @endif
                    
                    <p class="post-meta">
                        Posted by : {{ $posts->user->name }}
                    </p> 
                    <p class="post-meta">
                        created at : {{ $posts->created_at }}
                    </p>  
                </div>
                {{-- {LKE} --}}
                <button id='like-btn' class="btn btn-sm btn-outline-primary">

                    @if ($posts->likes()->where('user_id', Auth::id())->exists())
                        <span id="like-text"> like</span>
                    @else
                        <span id="like-text">unlike </span>
                    @endif

                    
                </button>
                <h6>like num:<span id="like-count" style="color: blue; font-size='4px'" >   {{ $posts->likes->count() }}</span></h6>
                

                <body style="font-family: Arial, sans-serif; padding: 20px; background-color: #fff;">

                 {{-- new comment --}}



                    <form action={{ route('comment_store', ['post' => $posts]) }} method="POST"
                        style="border-top: 1px solid #ddd; padding-top: 20px;">
                        @csrf
                        <h3 style="margin-bottom: 10px; font-size: 20px;">Comments</h3>

                        <textarea placeholder="Write your comment..."
                            style="width: 100%; height: 60px; padding: 10px; border: 1px solid #ccc; 
                                   border-radius: 4px; resize: vertical; font-size: 14px;"
                            name='content'></textarea>
                        <br>
                        @error('content')
                            <div class="alert alert-danger alert-dismissible fade show">
                                {{ $message }}
                            </div>
                        @enderror
                        <button type="submit"
                            style="margin-top: 10px; background-color: #2f855a; color: white; 
                                   border: none; padding: 8px 16px; border-radius: 4px; 
                                   cursor: pointer; font-size: 14px;">
                            Submit
                        </button>
                    </form>

                    <!--  One Comment with Reply -->
                    <div
                        style="margin-top: 30px; padding: 15px; border: 1px solid #ccc; 
                           border-radius: 6px; background-color: #f9f9f9;">
                        @forelse ($comments->where('post_id', $posts->id)->whereNull('parent_id') as $comment)
                            <!-- Comment  -->
                            <div style="font-weight: bold; margin-bottom: 5px; font-size: 15px;">
                                {{ $comment->user->email }}
                            </div>
                            <div style="margin-bottom: 10px; font-size: 14px;">
                                {{ $comment->content }}
                            </div>
                            @forelse ($comment->replies as $reply)
                                <div
                                    style="margin-top: 30px; margin-left: 20px; padding: 10px; 
                                        border-left: 3px solid #ccc; background-color: #f1f1f1; 
                                        border-radius: 4px;">

                                    <div style="font-weight: bold; font-size: 14px; margin-bottom: 3px;">
                                        {{ $reply->user->email }}
                                    </div>
                                    <div style="font-size: 13px;">
                                        {{ $reply->content }}
                                    </div>
                                </div>

                            @empty
                                
                            @endforelse
                            <form action={{ route('comment_store', ['post' => $posts]) }} method="POST"
                                style="margin-top: 10px;">
                                @csrf
                                <!-- Reply input -->
                                <input type="hidden" name='parent_id' value={{ $comment->id }}>
                                <textarea placeholder="Write your reply..."
                                    style="width: 100%; height: 50px; padding: 8px; border: 1px solid #ccc; 
                                           border-radius: 4px; font-size: 13px; margin-top: 10px;"
                                    name='content'></textarea>

                                <br>
                                <button type="submit"
                                    style="margin-top: 5px; background-color: #2f855a; color: white; 
                                           border: none; padding: 6px 12px; border-radius: 4px; 
                                           cursor: pointer; font-size: 13px;">
                                    Submit Reply
                                </button>
                            </form>

                        @empty
                        @endforelse



                        <!-- Reply Form inside comment box -->
                        {{-- <form action="#" method="POST" style="margin-top: 10px;">
                            @csrf --}}

                    </div>

                </body>

            </div>
        </div>
    </div>
    </div>

    <script>
        document.getElementById('like-btn').addEventListener('click', function() {
            fetch("{{ route('like_store', ['post' => $posts->id]) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                }).then(response => response.json())
                .then(data => {
                    if (data.liked == true) {
                        document.getElementById('like-text').innerText = "unlike";
                    }else{
                        document.getElementById('like-text').innerText = "like";
                    }
                    document.getElementById('like-count').innerText = data.likesCount;

                })
                .catch(error => {
                    console.error("Error:", error);
                });
        })
    </script>


@endsection
