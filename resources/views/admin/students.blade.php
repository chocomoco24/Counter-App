<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Students</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:sans-serif; background:#f3f4f6; min-height:100vh; }
        nav { background:#1f2937; padding:16px 32px; display:flex;
              justify-content:space-between; align-items:center; }
        nav .brand { color:white; font-size:18px; font-weight:700; }
        nav .links a { color:#d1d5db; text-decoration:none;
                       margin-left:24px; font-size:14px; }
        nav .links a:hover { color:white; }
        .logout-btn { background:#ef4444; color:white; border:none;
                      padding:8px 16px; border-radius:6px; cursor:pointer;
                      font-size:13px; margin-left:24px; }
        .container { max-width:900px; margin:40px auto; padding:0 20px; }
        h1 { font-size:24px; font-weight:700; color:#1f2937; margin-bottom:8px; }
        p.sub { color:#6b7280; font-size:14px; margin-bottom:28px; }
        .create-btn { display:inline-block; background:#6366f1; color:white;
                      padding:10px 20px; border-radius:8px; text-decoration:none;
                      font-size:14px; margin-bottom:24px; }
        table { width:100%; background:white; border-radius:12px;
                overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.06);
                border-collapse:collapse; }
        th { background:#f9fafb; text-align:left; padding:14px 20px;
             font-size:12px; font-weight:600; color:#6b7280;
             text-transform:uppercase; border-bottom:1px solid #e5e7eb; }
        td { padding:14px 20px; font-size:14px; color:#374151;
             border-bottom:1px solid #f3f4f6; }
        tr:last-child td { border-bottom:none; }
        .empty { text-align:center; padding:40px; color:#9ca3af; }
    </style>
</head>
<body>

<nav>
    <span class="brand">⚙️ Admin Panel</span>
    <div class="links">
        <a href="/admin/dashboard">All Counters</a>
        <a href="/admin/students">Students</a>
        <a href="/admin/students/create">+ New Student</a>
        <form method="POST" action="/logout" style="display:inline">
            @csrf
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>
</nav>

<div class="container">
    <h1>All Students</h1>
    <p class="sub">Accounts created by admin.</p>
    <a href="/admin/students/create" class="create-btn">+ Create New Student</a>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Counters</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->counters->count() }}</td>
                <td>{{ $student->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="empty">No students yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>