@vite(['resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new article</title>
</head>
<body>
    <div class="container">


        <h1 class="py-3 text-center">Create new Article</h1>

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

        <form action="{{ route('blog.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" placeholder="Title..." name='title' class='form-control'>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Article Content</label>
            <textarea placeholder="Content" name='content' class='form-control' rows="3" ></textarea>
        </div>

        <div class="my-3">
        <select id='category' name='category' class="btn btn-primary dropdown-toggle">
            <option value="" selected>Choose Category</option>
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->category}}</option>
            @endforeach
        </select>
        </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>