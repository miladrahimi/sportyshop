@extends('admin._html')

@section('title', 'ورود')

@section('body')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-header">ورود</div>
                    <div class="card-body">
                        @include('_alerts')
                        <form action="{{ route('admin.auth.sign-in.do') }}" method="post">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" title=""
                                       placeholder="شناسه">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" title=""
                                       placeholder="گذرواژه">
                            </div>
                            <div class="form-group">
                                @csrf
                                <button class="btn btn-block btn-primary">ورود</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
