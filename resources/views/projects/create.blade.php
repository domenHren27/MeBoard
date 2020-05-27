<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Create a Project</h1>  
    
    <form method="POST" class="container" action="/projects" style="padding-top: 40px">
        @csrf

        <div>
            <label for="title">
                Title
            </label>

            <div>
                <input type="text" name="title">
            </div>
        </div>

        <div>
            <label for="description">
                Description
            </label>

            <div>
                <textarea  name="description"></textarea>
            </div>
        </div>

        <div>
            <div>
                <button type="submit">Create Project</button>
            </div>
        </div>

    </form>
</body>
</html>