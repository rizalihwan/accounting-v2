@extends('_layouts.auth')
@section('content')
    <div class="content-body">
        <div class="auth-wrapper auth-v2">
            <!-- Login v2 -->
            @livewire('auth.login')
            <!-- /Login v2 -->
        </div>

    </div>
@endsection
