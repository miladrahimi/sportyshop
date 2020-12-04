@if($errors->any())
    <div class="alert alert-danger persian text-justify">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger persian text-justify">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div class="alert alert-success persian text-justify">{{ session('success') }}</div>
@endif
