@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="upload-section mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <h4>Upload a File</h4>
    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>
    <div class="mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Back To Dashboard</a>
        </div>
        </div>
    </div>
@endsection
