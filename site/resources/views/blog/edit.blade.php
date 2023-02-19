@vite(['resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit your article article</title>
</head>
<body>
    <div class="container">

@if(Auth::user()->role== '1')
<h1 class="py-3 text-center">Edit Article</h1>
@elseif(Auth::user()->role== '2')
<h1 class="py-3 text-center">Publish&edit Article</h1>
@endif
        @if($errors->any())
        <div class="py-3 alert alert-danger">
            Some of your data is invalid:
            
        </div>
        <ul>
            @foreach ($errors->all() as $error)
            <li class="alert alert-danger">
                {{$error}}
            </li>

            @endforeach
        </ul>
        @endif

        <form action="{{ route('blog.update', $article->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" value="{{$article->title}}" name='title' class='form-control'>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Article Content</label>
            <textarea name='content' class='form-control' rows="3" >{{$article->content}}</textarea>
        </div>
        <div class="my-3">
        <select id='category' name='category' class="btn btn-primary dropdown-toggle">
            <option value="">Choose Category</option>
            @foreach ($categories as $category)
            @if ( $article->category == $category->id )
            <option value="{{$category->id}}" selected>{{$category->category}}</option>
            @else
            <option value="{{$category->id}}">{{$category->category}}</option>
            @endif
            @endforeach
        </select>
        </div>
        <div class="mb-3">
            @if(Auth::user()->role== '2')
            <label for="is_approved" class="form-check-label">Is Approved</label>
            <input type='hidden' value={{0}} name='is_approved'>
            <input type="checkbox" {{$article->is_approved== true ? 'checked' : ''}} value={{true}} name='is_approved' class='form-check-input'>
            @endif
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>