@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-7 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-dark text-white">
                <h4>Verify Your Email</h4>
            </div>

            <div class="card-body">
                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success">
                        A new verification link has been sent to the email address you provided during registration.
                    </div>
                @endif

                <p class="mb-3">
                    Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.
                    If you didn’t receive the email, we’ll gladly send you another.
                </p>

                <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-dark">Resend Verification Email</button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="d-inline ms-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
