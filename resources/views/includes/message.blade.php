    @if(count($errors)>0)
    <div class="row col-md-offset-4 error">
        <div class="col-md-6">
            <ul>
                @foreach($errors->all() as $error)
                    <li class="">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @if(Session::has('message'))
    <div class="row col-md-offset-4 success">
        <div class="col-md-6">
            {{Session::get('message')}}
        </div>
    </div>
    @endif