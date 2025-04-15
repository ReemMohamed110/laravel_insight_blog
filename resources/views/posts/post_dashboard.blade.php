@extends('layouts.app_blog')
@section('content')
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p> -->
                    <div class="my-5">
                        <!-- * * * * * * * * * * * * * * *-->

                        <div class="col-12">
                            @can('create_post')
                                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase"
                                        href={{ url('create_post') }}>Add New Post</a></div>
                            @endcan

                            @isset($posts)
                                <table class="table table-bordered">
                                    <thead>
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if (session('deleted'))
                                            <div class="alert alert-danger">
                                                {{ session('deleted') }}
                                            </div>
                                        @endif
                                        <tr>
                                            <th>user_name</th>
                                            <th>tittle</th>
                                            <th>content</th>
                                            <th>image</th>
                                            <th>created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($posts as $post)
                                            <tr>
                                                <td>{{ $post->user->name }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->content }}</td>
                                                @if ($post->image)
                                                    <td><img width="100" height="100"
                                                            src="{{ asset('storage/' . $post->image) }}"></td>
                                                @else
                                                    <td> </td>
                                                @endif

                                                <td> {{ $post->created_at }}</td>
                                                <td>
                                                    <a href="{{ url('single_post/' . $post->id) }}" class="btn btn-success my-3">view</a>
                                                    @can('delete_post')
                                                        <form action={{ url('delete_post/' . $post->id) }} method='post'>
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fa-solid fa-trash-can"></i></button>
                                                            </a>
                                                        </form>
                                                    @endcan
                                                    @can('edit_post',$post)
                                                        <a href="{{ url('edit_post/' . $post->id) }}" class="btn btn-info"><i
                                                                class="fa-solid fa-edit"></i> </a>
                                                    @endcan


                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>
                                                    no posts
                                                </td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div>
            {{ $posts->links() }}
        @endisset

    </div>
@endsection
