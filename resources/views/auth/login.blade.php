@extends('layout')

@section('content')
<div class="container theme-showcase" style="padding-top:80px" role="main">
    <div class="page-hader">
        <div class="panel">
            <form method="POST" action="/auth/login">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="">User</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <div class="checkbox">
                    <label for="">
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>

                <div>
                    <button type="submit" class="btn btn-default">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection