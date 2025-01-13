<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users Table</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 20px;
        }
        .search-input {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">All Users Table</h2>
        <input type="text" id="searchInput" class="form-control search-input" placeholder="Search...">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach($users as $key=>$post)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{ $post->email }}</td>
                    <td>{{ $post->password }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#searchInput').on('keyup', function () {
                var value = $(this).val().toLowerCase();
                $('#tableBody tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</body>
</html>
