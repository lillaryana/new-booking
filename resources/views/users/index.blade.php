<!DOCTYPE html>
<html>
<head>
    <title>Daftar Users</title>
</head>
<body>
    <h1>Daftar Users</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->address }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
