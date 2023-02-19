@include('blog.navbar')

@foreach ($articles as $article)
@if($article->is_approved!=true)

<h2><a href="{{route('blog.show', $article->id)}}"> 
    {{$article->title}}</a></h2>
<p>Created by: {{$article->user->name}} at date: {{$article->date}}</p>
<p>Article theme:{{DB::table('categories')->where('id','=',$article->category)->value('category')}}</p>
@if((Auth::user()->role == '1' && $article->is_approved == false) || Auth::user()->role == '2')
@if(Auth::user()->role == '1')
<a href="{{ route('blog.edit', $article->id) }}" class="text-green">Edit Article</a>
@else
<a href="{{ route('blog.edit', $article->id) }}" class="text-green">Publish&Edit Article</a>
@endif()


<form action="{{route('blog.destroy', $article->id)}}" method="POST">
@csrf
@method('DELETE')
<button type='submit' class="btn btn-danger btn-sm py-3">Delete</button>
</form>
@endif
@endif
@endforeach

</div>

<div >
    {{$articles->links("pagination::bootstrap-5")}}
</div>

    

</body>
</html>