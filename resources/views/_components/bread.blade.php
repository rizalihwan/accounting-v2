@if (!request()->routeIs('home'))
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{config('app.name')}}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            @if(request()->routeIs('home'))
                                Home
                            @else
                                <a href="{{ route('home') }}">Home</a>
                            @endif
                        </li>
                        @stack('breadcrumb')
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        {{-- <div class="form-group breadcrumb-right">
            <div class="dropdown">
                <button type="button" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="grid"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="app-todo.html">
                        <i class="mr-1" data-feather="check-square"></i>
                        <span class="align-middle">Todo</span>
                    </a>
                    <a class="dropdown-item" href="app-chat.html">
                        <i class="mr-1" data-feather="message-square"></i>
                        <span class="align-middle">Chat</span>
                    </a>
                    <a class="dropdown-item" href="app-email.html">
                        <i class="mr-1" data-feather="mail"></i>
                        <span class="align-middle">Email</span>
                    </a>
                    <a class="dropdown-item" href="app-calendar.html">
                        <i class="mr-1" data-feather="calendar"></i>
                        <span class="align-middle">Calendar</span>
                    </a>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endif
