<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>
    <h2>Category List</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name Category</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name}}</td>
                <td>{{ $category->created_at->format('Y-m-d')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
