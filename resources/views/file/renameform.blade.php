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

        <form action="{{ route('file.rename', $file->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="new_name" placeholder="Enter new file name" required>
            <button type="submit" class="btn btn-warning">Rename</button>
        </form>
        <div class="mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Back To Dashboard</a>
        </div>
    </div>
</div>
@endsection
