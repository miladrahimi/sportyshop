@if($errors->any())
    <div class="alert alert-danger rtl">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger rtl">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div class="alert alert-success rtl">{{ session('success') }}</div>
@endif
