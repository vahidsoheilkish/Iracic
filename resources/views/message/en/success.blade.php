@if($message = session('success'))
    <p class="alert alert-success">{{ $message }}</p>
@endif