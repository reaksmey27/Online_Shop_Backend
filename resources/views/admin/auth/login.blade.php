@extends('admin.layouts.auth')
@section('title', 'Admin Login')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="width: 400px;">
    <div class="card-body p-5">

        @include('admin.auth.partials.brand-header')
        @include('admin.auth.partials.errors')

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label text-muted small fw-medium">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control rounded-3 py-2 small @error('email') is-invalid @enderror"
                       placeholder="admin@example.com" required autofocus>
            </div>

            <div class="mb-4">
                <label class="form-label text-muted small fw-medium">Password</label>
                <input type="password" name="password"
                       class="form-control rounded-3 py-2 small @error('password') is-invalid @enderror"
                       placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-dark btn-sm rounded-3 w-100 fw-medium py-2">
                <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
            </button>
        </form>

    </div>
</div>
@endsection
