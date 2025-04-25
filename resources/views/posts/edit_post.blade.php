@extends('layouts.app_blog')
@section('content')
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    {{-- <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>  --}}
                    <div class="my-5">
                        <!-- * * * * * * * * * * * * * * *-->
                        
                        <form action={{ url('update_post/' . $posts->id) }} method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-floating">
                                <input class="form-control" id="name" name="title" type="text" value="{{ $posts->title }}" />
                                    
                                <label for="blog tittle">blog title</label>
                                @error('title')
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        {{ $message }}
                                    </div>
                                @enderror


                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="content" name="content" type="text" value="{{ $posts->content }}" />
                                <label for="content">Content</label>
                                @error('content')
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="form-floating">
                                <input class="form-control" name="image" type="file" value="{{ $posts->image }}"/>
                                @if ($posts->image)
                                    <img width="100" height="100" src="{{ asset('storage/' . $posts->image) }}"></td>
                                @endif
                                @error('image')
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <button class="btn btn-primary text-uppercase " id="submitButton" type="submit">update
                                post</button>
                            <br />

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
