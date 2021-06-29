@extends('_layouts.main')
@section('title', 'Setting Akun')
    @push('breadcrumb')
        <li class="breadcrumb-item">
            <a href="{{ route('profile.setting') }}">Account Settings</a>
        </li>
    @endpush
@section('content')
<section id="page-account-settings">
<div class="row">
  <!-- left menu section -->
  <div class="col-md-3 mb-2 mb-md-0">
    <ul class="nav nav-pills flex-column nav-left">
      <!-- general -->
      <li class="nav-item">
        <a
          class="nav-link active"
          id="account-pill-general"
          data-toggle="pill"
          href="#account-vertical-general"
          aria-expanded="true"
        >
          <i data-feather="user" class="font-medium-3 mr-1"></i>
          <span class="font-weight-bold">General</span>
        </a>
      </li>
      <!-- change password -->
      <li class="nav-item">
        <a
          class="nav-link"
          id="account-pill-password"
          data-toggle="pill"
          href="#account-vertical-password"
          aria-expanded="false"
        >
          <i data-feather="lock" class="font-medium-3 mr-1"></i>
          <span class="font-weight-bold">Change Password</span>
        </a>
      </li>
    </ul>
  </div>
  <!--/ left menu section -->

  <!-- right content section -->
  <div class="col-md-9">
    <div class="card">
      <div class="card-body">
        <div class="tab-content">
          <!-- general tab -->
          <div
            role="tabpanel"
            class="tab-pane active"
            id="account-vertical-general"
            aria-labelledby="account-pill-general"
            aria-expanded="true"
          >
            <!-- form -->
            <form class="validate-form mt-2" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <!-- header media -->
                <div class="media">
                    <a href="javascript:void(0);" class="mr-25">
                      @if (empty(auth()->user()->avatar))
                        <img class="round" src="{{ asset('img/avatar.png') }}" alt="avatar" height="40" width="40">
                      @else
                        <img src="{{ asset('storage/avatar/'. auth()->user()->avatar) }}"
                        style="width: 100px; height: 100px; object-fit: cover; object-position: center;"
                        class="mb-2" alt="Img Profile" srcset="">
                      @endif
                    </a>
                    <!-- upload and reset button -->
                    <div class="media-body mt-75 ml-1">
                    {{-- <label for="avatar" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label> --}}
                    <input type="file" id="avatar" name="avatar"/>
                    <p>Hanya bisa png, jpg, jpeg, ico, svg</p>
                    </div>
                    <!--/ upload and reset button -->
                </div>
                <!--/ header media -->

              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="account-username">Username</label>
                    <input type="text" id="username" name="username" value="{{ auth()->user()->username ?? old('username') }}"
                        placeholder="Username" class="form-control @error('username') is-invalid @enderror">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="account-name">Name</label>
                    <input type="text" id="name" name="name" value="{{ auth()->user()->name ?? old('name') }}"
                        placeholder="Nama" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                  <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                </div>
              </div>
            </form>
            <!--/ form -->
          </div>
          <!--/ general tab -->

          <!-- change password -->
          <div
            class="tab-pane fade"
            id="account-vertical-password"
            role="tabpanel"
            aria-labelledby="account-pill-password"
            aria-expanded="false"
          >
            <!-- form -->
            <form class="validate-form" action="{{ route('password.edit') }}" method="post">
                @csrf
                @method('PATCH')
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="account-old-password">Old Password</label>
                    <div class="input-group form-password-toggle input-group-merge">
                        <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror" value="{{ old('old_password') }}" autofocus required>
                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      <div class="input-group-append">
                        <div class="input-group-text cursor-pointer">
                          <i data-feather="eye"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="account-new-password">New Password</label>
                    <div class="input-group form-password-toggle input-group-merge">
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      <div class="input-group-append">
                        <div class="input-group-text cursor-pointer">
                          <i data-feather="eye"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="account-retype-new-password">Retype New Password</label>
                    <div class="input-group form-password-toggle input-group-merge">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                      <div class="input-group-append">
                        <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary mr-1 mt-1">Save changes</button>
                  {{-- <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button> --}}
                </div>
              </div>
            </form>
            <!--/ form -->
          </div>
          <!--/ change password -->
        </div>
        </div>
    </div>
  </div>

@endsection