@extends('layouts.app_blog')
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/contact-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Contact Me</h1>
                        <span class="subheading">Have questions? I have answers.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                    <div class="my-5">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form action={{url("contact_action")}} method="post"  id="contactForm" data-sb-form-api-token="API_TOKEN">
                            @csrf
                            <div class="form-floating">
                                <input class="form-control" name="name" type="text" placeholder="Enter your name..."  name='name'  />
                                <label for="name">Name</label>
                                {{-- <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div> --}}
                                <div>
                                    @error('name')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" name="email" type="email" placeholder="Enter your email..." data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                {{-- <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div> --}}
                                {{-- <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div> --}}
                                @error('email')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                            </div>
                            <div class="form-floating">
                                <input class="form-control" name="phone" type="text" placeholder="Enter your phone number..."  />
                                <label for="phone">Phone Number</label>
                                {{-- <div class="invalid-feedback">A phone number is required.</div> --}}
                                @error('phone')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" name="message" placeholder="Enter your message here..." style="height: 12rem"></textarea>
                                <label for="message">Message</label>
                                {{-- <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div> --}}
                                @error('message')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                            </div>
                            <br />
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <button class="btn btn-primary text-uppercase " id="submitButton" type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
