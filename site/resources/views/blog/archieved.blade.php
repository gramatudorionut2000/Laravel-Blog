@include('blog.navbar')

@foreach ($articles as $article)
@if($article->is_archieved==true)

@if(!Auth::user() )
<!-- Button trigger modal -->
<a href="#" data-bs-toggle="modal" data-bs-target="#Modal">
    <h2>{{$article->title}}</h2>
  </a>
  @else
<h2><a href="{{route('blog.show', $article->id)}}">{{$article->title}}</a></h2>
@endif
    @if((Auth::user() && Auth::user()->role == '3') || !Auth::user())
    <p>{{ substr($article->content,0, 30)}}</p>
    @else
    <p>{{$article->content}}</p>
    @endif
    
<p>Created by: {{$article->user->name}} at date: {{$article->date}}</p>
<p>Article theme:{{DB::table('categories')->where('id','=',$article->category)->value('category')}}</p>
@endif
@endforeach

</div>

<div>

    {{$articles->links("pagination::bootstrap-5")}}
</div>

<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">You cannot access this article</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          To access the content of the articles of this website you need to have a Reader account.
          Create a reader account using the <b>"Register"</b> Button below:
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="{{route('register')}}" type="button" class="btn btn-primary">Register</a>
        </div>
      </div>
    </div>
  </div>

    

</body>
</html>