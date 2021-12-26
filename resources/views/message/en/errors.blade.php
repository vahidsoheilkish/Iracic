@if($errors->any())
    <div class="alert alert-danger" style="direction: ltr;text-align: left; width:100%;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif