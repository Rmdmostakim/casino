@extends('Installer.Installerlayouts')
@section('title','Installer')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-4 bg-light rounded text-center env-container">
            <div class="hr-line"></div>
            <div class="installer-menu text-center">
                <span class="bg-primary p-1"><i class="bi bi-house-fill"></i></span>
                <span class="bg-primary p-1"><i class="bi bi-hdd-rack-fill"></i></span>
                <span class="bg-primary p-1"><i class="bi bi-key-fill"></i></span>
                <span class="bg-secondary p-1"><i class="bi bi-server"></i></span>
                <span class="bg-secondary p-1"><i class="bi bi-gear-wide-connected"></i></span>
            </div>
            <p class="card-title fw-bold text-center">Environment Setup</p>
            <div class="card-body">
              @if (session('error'))
                  <div class="alert text-center bg-danger">
                      {{ session('error') }}
                  </div>
              @endif
              <form class="text-left" method="post" action="{{ route('installer.envsetup') }}">
                @csrf
                <div class="form-group mb-1">
                  <label class="mb-1 fw-bold text-black-50">App Name</label>
                  <input type="text" name="app_name" class="form-control" value="{{ old('app_name') }}" required placeholder="App name">
                  @error('app_name')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group mb-1">
                  <label class="mb-1 fw-bold text-black-50">App Url</label>
                  <input type="text" name="app_url" class="form-control" value="{{ old('app_url') }}" required placeholder="App url">
                  @error('app_url')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group mb-1">
                  <label class="mb-1 fw-bold text-black-50">Database Name</label>
                  <input type="text" name="database_name" class="form-control" value="{{ old('database_name') }}" required placeholder="Database name">
                  @error('database_name')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group mb-1">
                  <label class="mb-1 fw-bold text-black-50">Database Username</label>
                  <input type="text" name="database_username" class="form-control" value="{{ old('database_username') }}" required placeholder="Database username">
                  @error('database_username')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label class="mb-1 fw-bold text-black-50">Database Password</label>
                  <input type="password" name="database_password" class="form-control" value="{{ old('database_password') }}" required placeholder="Database password">
                  @error('database_password')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Confirm for Next Steps</button>
              </form>  
            </div>
        </div>
    </div>
</div>