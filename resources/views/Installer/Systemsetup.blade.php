@extends('Installer.Installerlayouts')
@section('title','Installer')
@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-4 bg-light rounded text-center db-container">
            <div class="hr-line"></div>
            <div class="installer-menu text-center">
                <span class="bg-primary p-1"><i class="bi bi-house-fill"></i></span>
                <span class="bg-primary p-1"><i class="bi bi-hdd-rack-fill"></i></span>
                <span class="bg-primary p-1"><i class="bi bi-key-fill"></i></span>
                <span class="bg-primary p-1"><i class="bi bi-server"></i></span>
                <span class="bg-primary p-1"><i class="bi bi-gear-wide-connected"></i></span>
            </div>
            <p class="card-title fw-bold text-center">System Setup</p>
            <div class="card-body">
                @if (session('success'))
                  <div class="alert text-center bg-success">
                      {{ session('success') }}
                  </div>
                @endif
                @if (session('error'))
                  <div class="alert text-center bg-danger">
                      {{ session('error') }}
                  </div>
                @endif
                <table class="table border">
                    <tbody>
                        <tr>
                            <td><i class="bi bi-eraser-fill"></i></td>
                            <td class="fw-bold"><a href="{{ route('installer.systemClean')}}">System Clear</a></td>
                        </tr>
                        <tr>
                            <td><i class="bi bi-cpu-fill"></i></td>
                            <td class="fw-bold"><a href="{{ route('installer.systemOptimize')}}">System Optimize</a></td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('installer.complete') }}" class="btn btn-primary rounded">Installation Complete<i class="bi bi-caret-right-fill"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection