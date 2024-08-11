<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Created</title>
</head>
<body>
    <h1>Congratulations!</h1>
    <p>The project "{{ $project->name }}" was created successfully.</p>
    <p>Description: {{ $project->description }}</p>
    <p>Deadline: {{ $project->deadline }}</p>
</body>
</html>
