@include('blog.navbar')

@foreach ($articles as $article)

<h2><a href="{{route('blog.show', $article->id)}}"> 
    {{$article->title}}</a></h2>
    <p>{{$article->content}}</p>
<p>Created by: {{$article->user->name}} at date: {{$article->date}}</p>
<p>Article theme:{{DB::table('categories')->where('id','=',$article->category)->value('category')}}</p>

<a href="{{ route('blog.edit', $article->id) }}" class="text-green">Edit Article</a>



<form action="{{route('blog.destroy', $article->id)}}" method="POST">
@csrf
@method('DELETE')
<button type='submit' class="btn btn-danger btn-sm py-3">Delete</button>
</form>

@endforeach

</div>

<div >

    {{$articles->links("pagination::bootstrap-5")}}
</div>

    

</body>
</html>