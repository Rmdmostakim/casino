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
                <span class="bg-secondary p-1"><i class="bi bi-gear-wide-connected"></i></span>
            </div>
            <p class="card-title fw-bold text-center">Database Setup</p>
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
                            <td><i class="bi bi-clipboard-check-fill text-primary"></i></td>
                            <td class="fw-bold"><a href="{{ route('installer.migrate')}}">Run Database Migrate</a></td>
                        </tr>
                        <tr>
                            <td><i class="bi bi-clipboard-check-fill text-primary"></i></td>
                            <td class="fw-bold"><a href="{{ route('installer.initialdataset')}}">Initializing Database Value</a></td>
                        </tr>
                    </tbody>
                </table>
                @if(session()->has('migrate') && session()->has('dbInitial'))
                <a href="{{ route('installer.systemSetup') }}" class="btn btn-primary rounded">System Setup<i class="bi bi-caret-right-fill"></i></a>
                @else
                <button class="btn btn-danger btn-lg" disabled>System Setup <i class="bi bi-caret-right-fill"></i></button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection