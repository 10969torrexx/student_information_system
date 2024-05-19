@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Class</div>
                <div class="card-body">
                   <h1>Hello {{ Auth::user()->name }}</h1>
                    @if (isset($user))
                        <div class="mb-3">
                            <label for="class_name" class="form-label">Email</label>
                            <h4>{{ $user->email }}</h4>
                        </div>
                        <div class="mb-3">
                            <label for="class_name" class="form-label">Class Name</label>
                            <h4>{{ $user->class_name }} - {{ config('const.year_level.'.$user->year_level) }}</h4>
                        </div>
                        <div class="mb-3">
                            <label for="class_name" class="form-label">Date Assigned</label>
                            <h4>{{ date('M, d, Y', strtotime($user->updated_at)) }}</h4>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            You are not assigned to any class.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
