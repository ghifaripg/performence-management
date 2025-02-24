<?php
$userId = Auth::user()->id;
?>
<style>
body{
    overflow: hidden;
}
</style>
@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
<main class="content">
    <div class="row" style="margin-top: 55px">
        <div class="col-12 col-xl-8">
            <div class="card card-body border-0 shadow mb-4">
                <br>
                <h2 class="h5 mb-4">General Information</h2>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <form action="{{ route('profile.updateUsername') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="first_name">Name</label>
                                <input class="form-control" id="first_name" type="text" placeholder="{{ $name }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="username">Username</label>
                            <input class="form-control @error('username') is-invalid @enderror"
                                   id="username"
                                   name="username"
                                   type="text"
                                   value="{{ old('username', $username) }}"
                                   required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <label for="created_at">Created At</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <input data-datepicker="" class="form-control" id="created_at" type="text" placeholder="{{ $created_at }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="department">Department Name</label>
                                <input class="form-control" id="department" type="text" placeholder="{{ $department }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Save Username</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow border-0 text-center p-0">
                        <div class="profile-cover rounded-top" data-background="../assets/img/profile-cover.jpg"></div>
                        <div class="card-body pb-5">
                            <img src="../../assets/img/team/profile-picture-3.png" class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Profile Picture">
                            <h4 class="h3">{{ $name }}</h4>
                            <h5 class="fw-normal">{{ $username }}</h5>
                        <a class="btn btn-gray-800 mt-2 animate-up-2" href="/dashboard">Back to Dashboard</a>

                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

