@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="css/mainPage.css">
    @endsection

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success" style="width: 50%; margin-left: 500px">
            {{ session()->get('success') }}
        </div>
    @elseif(session()->has('no_success'))
        <div class="alert alert-danger" style="width: 50%; margin-left: 500px">
            {{ session()->get('no_success') }}
        </div>
        @endif


    <div class="row">
<div class="col-md-2">
    <div class="aside">
        <ul >
            <li class="nav-item" id="addEl" >
                <button id="add" class="btn btn-success" style="width: auto">
                    Add
                </button>

                <form id="addForm" action="{{ route('add') }}" method="GET" style="display: none;">
                    @csrf
                </form>
            </li>
            <li class="nav-item" id="delEl" >
                <button class="btn btn-danger" id="delete">
                  Delete
                </button>

                <form id="deleteForm" action="{{ route('delete-form') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            <li class="nav-item" id="updateAllEl">
                <button class="btn btn-primary" id="updateAll">
                    Update all news
                </button>

                <form id="updateAllForm" action="{{ route('update-all-news') }}" method="GET" style="display: none;">
                    @csrf
                </form>
            </li>

            <li class="nav-item" id="sendEl" >
                <button class="btn btn-primary" id="send">
                    Send to email
                </button>

                <form id="sendForm" action="{{ route('send-to-email') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

            <li class="nav-item" id="changeEmailEl" >
                <button class="btn btn-primary" id="changeEmail" form="changeEmailForm">
                    Change your email
                </button>

                <form id="changeEmailForm" action="{{ route('change-email') }}" method="get" style="display: none;">
                    @csrf
                </form>
            </li>

            <li class="nav-item" style="display: none" id="cancelEl" >
                <button class="btn btn-primary" id="cancel">Cancel</button>
            </li>
        </ul>
    </div>
</div>
    <div id="news" class="col">
   @foreach($news as $element)

       <div >
           <div class="container">
               <input type="checkbox" form="deleteForm" id="check{{ $element->id }}" name="check{{ $element->id }}" style="display: none" value="{{ $element->id }}">
               <h2 id="title">
                   <font style="vertical-align: inherit; color: blue;">{{ $element->title }}</font>
               </h2>
               <div class="row">
                   <div class="col">
                       <p>
                           <font style="vertical-align: inherit;color: orange;">{{ $element->authors }}</font>
                           <br>
                       </p>
                       <p>
                           <font style="vertical-align: inherit;">{{ $element->date }}</font>
                       </p>
                       <p>
                           <font style="vertical-align: inherit;">{{ $element->text }}</font>
                       </p>
                           <a href="{{ route('edit', $element->id) }}" class="btn btn-primary">Edit</a>
                   </div>
                   <div class="col">
                           <img src="data:image/jpeg;base64, {{ $element->image }}" class="img-responsive" alt="">
                   </div>
               </div>
               <br>
               <hr color="green">
           </div>
       </div>
    @endforeach
        <div class="pagination justify-content-center">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
