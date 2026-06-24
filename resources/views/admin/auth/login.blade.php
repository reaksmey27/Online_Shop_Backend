@extends('admin.layouts.auth')
@section('title', 'Admin Login')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white" style="width: 400px;">
    <div class="card-body p-5">

        {{-- Brand Identity Layout --}}
        @include('admin.auth.partials.brand-header')

        {{-- Status Error Banner Message --}}
        @include('admin.auth.partials.errors')

        {{-- Authentication Intent Post Control --}}
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            {{-- Email Field --}}
            <div class="mb-3">
                <label class="form-label text-muted small fw-medium">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control rounded-3 py-2 text-dark small @error('email') is-invalid @enderror"
                       placeholder="admin@example.com" required autofocus>
            </div>

            {{-- Password Field --}}
            <div class="mb-4">
                <label class="form-label text-muted small fw-medium">Secure Password</label>
                <input type="password" name="password"
                       class="form-control rounded-3 py-2 text-dark small @error('password') is-invalid @enderror"
                       placeholder="••••••••" required>
            </div>

            {{-- Submit Handle Button --}}
            <button type="submit" class="btn btn-dark btn-sm rounded-3 w-100 fw-medium py-2">
                <i class="bi bi-box-arrow-in-right me-1"></i> Sign In to Feed
            </button>
        </form>

    </div>
</div>
@endsection
