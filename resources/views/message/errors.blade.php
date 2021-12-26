@if($errors->any())
    <div class="alert alert-danger" style="direction: rtl;text-align: right; width:100%;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif