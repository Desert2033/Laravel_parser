@extends('layouts.appEmpty')

@section('content')
<div class="container mt-4">
    <h1>Form by add</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                    @endforeach
            </ul>
        </div>
        @endif

    <form id="addForm" action="{{ route('add-form') }}" method="post" enctype="multipart/form-data">
        @csrf
        <p><b>Title:</b></p>
        <input type="text" class="form-control" placeholder="Title"  id="title" name="title">
        <p><b>Authors:</b></p>
        <input type="text" class="form-control" placeholder="Authors" id="authors" name="authors">
        <p><b>Date:</b></p>
        <input type="date" class="form-control" id="date" name="date">
        <p><b>Text:</b></p>
        <p> <textarea rows="8" cols="80" id="text" name="text"></textarea> </p>
        <p><b>Image:</b></p>
        <input type="file" name="image" accept=".jpg, .jpeg, .png">
        <button type="submit" class="btn btn-success" id="add" name="add">Add</button>
        <button class="btn btn-success" id="cancel" name="cancel" form="cancelForm">Cancel</button>
    </form>
    <form id="cancelForm" action="{{ route('home') }}"></form>
</div>
@endsection
