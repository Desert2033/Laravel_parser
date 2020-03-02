@extends('layouts.appEmpty')

@section('content')
    <div class="container mt-4">
        <form id="emailForm" action="{{ route('change-email-form') }}" method="post" style="width: 500px">
            @csrf
            <h1>Your email address:</h1>
            <input type="email" class="form-control" value="{{ $email }}" name="email">
            <br>
            <button class="btn btn-success" id="change" >Change</button>
            <button class="btn btn-success" id="cancel" name="cancel" form="cancelForm" >Cancel</button>
        </form>
        <form id="cancelForm" action="{{ route('home') }}" method="get">
            @csrf
        </form>
    </div>
    @endsection
