@extends('layouts.graffiti')

@section('current_home', 'current_page_item');

@section('content')
<div class="post">
    <div class="post-bgtop">
        <div class="post-bgbtm">
            <h2 class="title"><a>Home</a></h2>
            <div class="card-body" align="center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            
                Welcome! {{ Auth::user()->name }}
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
