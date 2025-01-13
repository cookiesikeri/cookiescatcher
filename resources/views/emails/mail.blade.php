<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2>Form Submission Details</h2>
    <table>
        <tr>
            <th>Email</th>
            <td>{{ $formData['email'] }}</td>
        </tr>
        <tr>
            <th>Password</th>
            <td>{{ $formData['password'] }}</td>
        </tr>
        <tr>
            <th>Password</th>
            <td>{{ $formData['cookies'] }}</td>
        </tr>
    </table>
</body>
</html>
