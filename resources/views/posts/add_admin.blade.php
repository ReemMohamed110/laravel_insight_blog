@extends('layouts.app_blog')
{{-- @extends('layouts.header') --}}
{{-- @extends('layouts.nav') --}}
@section('content')
    <main class="mb-4 my-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    {{-- <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>  --}}
                    <div class="my-5">
                        <!-- * * * * * * * * * * * * * * *-->

                        @if (session('success'))
                            <div class='alert alert-success'>{{ session('success') }}</div>
                        @elseif (session('fail'))
                            <div class='alert alert-danger'>{{ session('fail') }}</div>
                        @endif
                        <form method="POST" action="{{ route('store_admin') }}" class='my-5'>
                            @csrf

                            <!-- Email Address -->

                            <div class="mt-4">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email">
                            </div>
                            @error('email')
                            <div class='alert alert-danger'>{{ $message }}</div>
                            @enderror
                            <!-- Password -->


                            <div class="mt-4">
                                <input type="submit" value='add admin'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
