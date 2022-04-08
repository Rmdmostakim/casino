@extends('Installer.Installerlayouts')
@section('title','Installer')
@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-4 bg-light rounded text-center installer-container">
            <div class="hr-line"></div>
            <div class="installer-menu">
                <span class="bg-primary p-1"><i class="bi bi-house-fill"></i></span>
                <span class="bg-secondary p-1"><i class="bi bi-hdd-rack-fill"></i></span>
                <span class="bg-secondary p-1"><i class="bi bi-key-fill"></i></span>
                <span class="bg-secondary p-1"><i class="bi bi-server"></i></span>
                <span class="bg-secondary p-1"><i class="bi bi-gear-wide-connected"></i></span>
            </div>
            <p class="card-title fw-bold">Laravel Installer</p>
            <div class="card-body">
                <p class="fw-bold text-black-50">Easy way to installation and setup</p>
                <a href="{{ route('installer.requirements') }}" class="btn btn-primary rounded">Check Requirements<i class="bi bi-caret-right-fill"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection