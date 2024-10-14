<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <!-- dd($post) -->
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td>{{ $post->status }}</td>
                <td><a href="{{url('posts/'.$post['_id'].'/edit')}}">Edit</a> | <a href="#">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>