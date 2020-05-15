@if($errors->all())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-ban"></i>
            {{ $error }}
        </div>
    @endforeach
@endif

@if(session()->exists('message'))
    <div class="alert alert-{{ session()->get('color') }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        @if(session()->get('color') === 'success')
            <i class="icon fas fa-check"></i>
        @else
            <i class="icon fas fa-ban"></i>
        @endif
        {!! session()->get('message') !!}
    </div>
@endif