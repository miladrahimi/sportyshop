@extends('admin._html')

@section('title', 'Sign In')

@section('body')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-header">SportyShop Admin</div>
                    <div class="card-body">
                        @include('admin._alerts')
                        <form action="{{ route('admin.auth.sign-in.do') }}" method="post">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" title=""
                                       placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" title=""
                                       placeholder="Password">
                            </div>
                            <div class="form-group">
                                @csrf
                                <button class="btn btn-block btn-primary">Sign In</button>
                                <a href="{{ route('home') }}" class="btn btn-block btn-outline-secondary">Home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
