@include('blog.navbar')
<h2>{{$article->title}}</h2>
<p>{{$article->content}}</p>
<p>Created by: {{$article->user->name}} at date: {{$article->date}}</p>
<p>Article theme:{{DB::table('categories')->where('id','=',$article->category)->value('category')}}</p>