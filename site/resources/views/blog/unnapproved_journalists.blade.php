@include('blog.navbar')

@foreach ($journalists as $journalist)
@if($journalist->activated == false)

<h3>{{$journalist->name}}  {{$journalist->username}}</h3>
<h4>{{$journalist->email}}</h4>
<div class="btn-group" role="group">
<form action="{{route('jurnalist.destroy', $journalist->id)}}" method="POST">
    @csrf
    @method('DELETE')
    <button type='submit' style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .55rem;" class="btn btn-danger btn-sm py-3">Deny account</button>
    </form>
<form action="{{route('jurnalist.update', $journalist->id)}}" method="POST">
    @csrf
    @method('PATCH')
    <button type='submit' style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .55rem;" class="btn btn-success  ms-2 py-3">Approve account</button>
    </form>
</div>
    @endif
@endforeach

</div>

<div >

</div>

    

</body>
</html>