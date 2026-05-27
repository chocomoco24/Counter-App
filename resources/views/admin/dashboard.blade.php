<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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
        table { width:100%; background:white; border-radius:12px;
                overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.06);
                border-collapse:collapse; }
        th { background:#f9fafb; text-align:left; padding:14px 20px;
             font-size:12px; font-weight:600; color:#6b7280;
             text-transform:uppercase; letter-spacing:.5px;
             border-bottom:1px solid #e5e7eb; }
        td { padding:14px 20px; font-size:14px; color:#374151;
             border-bottom:1px solid #f3f4f6; }
        tr:last-child td { border-bottom:none; }
        .badge { padding:4px 10px; border-radius:20px; font-size:12px; font-weight:600; }
        .positive { background:#dcfce7; color:#16a34a; }
        .negative { background:#fee2e2; color:#dc2626; }
        .zero     { background:#f3f4f6; color:#6b7280; }
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
    <h1>All Counters</h1>
    <p class="sub">Every counter created by every student.</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Email</th>
                <th>Counter Value</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @forelse($counters as $counter)
            <tr>
                <td>{{ $counter->id }}</td>
                <td>{{ $counter->user->name ?? '—' }}</td>
                <td>{{ $counter->user->email ?? '—' }}</td>
                <td>
                    <span class="badge {{ $counter->value > 0 ? 'positive' : ($counter->value < 0 ? 'negative' : 'zero') }}">
                        {{ $counter->value }}
                    </span>
                </td>
                <td>{{ $counter->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="empty">No counters yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>