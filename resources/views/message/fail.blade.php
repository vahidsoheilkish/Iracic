@if($message = session('fail'))
    <p class="alert alert-danger">{{ $message }}</p>
@endif