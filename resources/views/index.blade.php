<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @auth
    
    @foreach ( $posts as $post )
    
    <p>{{$post->user->name}}</p>
    @endforeach
    <form action="/logout" method="POST">
        @csrf
        <button>Logout</button>
    </form>
    
    <div style="border: 2px solid black; padding: 1rem;" >
        <h2>Create posts</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="post title" id="">
            <textarea name="body" placeholder="type here..." id=""></textarea>
            <button>Save Post</button>
        </form>
    </div>

    <div style="border: 2px solid black; padding: 1rem;" >
        <h2>My Posts</h2>
        @foreach ($posts as $post)
        <div style="background: gray; padding: .4rem; margin: .4rem;" >
            <h3>{{$post['title']}}</h3>
            <p>{{$post['body']}}</p>
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>
    @else
    <div style="border: 2px solid black; padding: 1rem;" >
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf 

            <input type="text" name="name" placeholder="name" id="">
            <input type="text" name="email" placeholder="email" id="">
            <input type="password" name="password" placeholder="password" id="">
            <button>Register</button>
        </form>
    </div>
    
    <div style="border: 2px solid black; padding: 1rem;" >
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf 

            <input type="text" name="logname" placeholder="name" id="">
            <input type="password" name="logpassword" placeholder="password" id="">
            <button>Login</button>
        </form>
    </div>

    @endauth
</body>
</html>