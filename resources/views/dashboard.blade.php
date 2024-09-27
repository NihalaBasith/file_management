@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="mt-4 card card-body shadow">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center">
            <h4>Welcome to your Dashboard!</h4>
            <!-- Logout button -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
            <p>Your Name: {{ $user->name }}</p>
            <p>Your Email: {{ $user->email }}</p>

           
        </div>
    </div>
@endsection
