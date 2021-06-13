@extends('_layouts.auth')
@section('content')
    <div class="content-body">
        <div class="auth-wrapper auth-v1 px-2">
            <div class="auth-inner py-2">
                <!-- Login v1 -->
                @livewire('auth.login')
                <!-- /Login v1 -->
            </div>
        </div>

    </div>
@endsection
