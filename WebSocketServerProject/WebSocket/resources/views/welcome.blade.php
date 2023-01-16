@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome</div>

                <div class="card-body">
                   <h3 class="text-center">This is a Real time application</h1>




                    @if (Route::has('login'))
                    @auth
                         {{ __('You are logged in!') }}
                        <div>
                            <a class="btn btn-info mb-2 mt-2" href="{{route('chat.show')}}">Chat</a> <br>
                            <a class="btn btn-danger" href="{{route('game.show')}}">Gamble</a>
                        </div>
                    @else
                        <div class="text-center">
                            <p>Login or Register to continue</p>
                        </div>
                    @endauth
                </div>
            @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
