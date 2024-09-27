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

            <div class="mt-4">
            <a href="{{ route('fileUpload') }}" class="btn btn-primary">Upload a File</a>
        </div>
        <div class="file-table mt-4">
    <h4>Uploaded Files</h4>
    @if($file_data && $file_data->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>File Name</th>
                    <th>Upload Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($file_data as $index => $file)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $file->file_name }}</td>
                        <td>{{ $file->upload_time->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ asset('storage/uploads/' . $file->file_name) }}" class="btn btn-info" target="_blank">Download</a>
                            <a href="{{ asset('storage/uploads/' . $file->file_name) }}" class="btn btn-secondary" target="_blank">View</a>
                            <form action="{{ route('files.delete', $file->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this file?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No files found for this user.</p>
    @endif
</div>
           
        </div>
    </div>
@endsection
