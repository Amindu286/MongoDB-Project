<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Post</title>
</head>
<body>
    <h1>Create a New Post</h1>

    <!-- Form to create a new post -->
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf <!-- Laravel CSRF protection -->
        
        <!-- Title input field -->
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description input field -->
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status input field (example: 0 = draft, 1 = published) -->
        <div>
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Draft</option>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit button -->
        <div>
            <button type="submit">Create Post</button>
        </div>
    </form>
</body>
</html>
