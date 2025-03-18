<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Fetched Data from Firebase</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Birthdate</th>
                    <th>Gender</th>
                    <th>Image</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                @if ($data)
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ ucfirst($row['name'] ?? 'N/A') }}</td>
                            <td>{{ $row['email'] ?? 'N/A' }}</td>
                            <td>{{ $row['address'] ?? 'N/A' }}</td>
                            <td>{{ $row['phone'] ?? 'N/A' }}</td>
                            <td>{{ $row['bdate'] ?? 'N/A' }}</td>
                            <td>{{ ucfirst($row['gender'] ?? 'N/A') }}</td>
                            <td>
                                @if (!empty($row['filename']))
                                    <a href="{{ $row['filename'] }}" target="_blank">View image</a>
                                @else
                                    No image
                                @endif
                            </td>
                            <td>
                                @if (!empty($row['docname']))
                                    <a href="{{ $row['docname'] }}" target="_blank">View File</a>
                                @else
                                    No file
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">No data available</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
