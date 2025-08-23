@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-dark text-white">
                <h4>Confirm Password</h4>
            </div>

            <div class="card-body">
                <p class="text-muted">This is a secure area of the application. Please confirm your password before continuing.</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">Confirm</button>
                    </div>
                </form>
            </div>

            <div class="card-footer text-center">
                <a href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
        </div>
    </div>
</div>
@endsection
