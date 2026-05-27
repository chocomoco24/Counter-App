<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }

        h1 {
            font-size: 22px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }

        p.sub {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 28px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 18px;
            outline: none;
            transition: border 0.2s;
        }

        input:focus {
            border-color: #6366f1;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #6366f1;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        button[type="submit"]:hover {
            background: #4f46e5;
        }

        .error {
            background: #fee2e2;
            color: #dc2626;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        /* ── Role hint cards ── */
        .roles {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
        }

        .role-card {
            flex: 1;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }

        .role-card:hover {
            border-color: #a5b4fc;
            background: #f5f3ff;
        }

        .role-card.active-admin {
            border-color: #6366f1;
            background: #eef2ff;
        }

        .role-card.active-student {
            border-color: #16a34a;
            background: #f0fdf4;
        }

        .role-card .icon {
            font-size: 24px;
            margin-bottom: 4px;
        }

        .role-card .rlabel {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
        }

        .role-card .rdesc {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 2px;
        }

        /* ── Divider ── */
        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0 16px;
        }

        .divider hr {
            flex: 1;
            border: none;
            border-top: 1px solid #e5e7eb;
        }

        .divider span {
            font-size: 12px;
            color: #9ca3af;
        }

        /* ── Admin link at bottom ── */
        .admin-link-row {
            text-align: center;
            margin-top: 16px;
        }

        .admin-link-row a {
            font-size: 13px;
            color: #6366f1;
            text-decoration: none;
            font-weight: 500;
        }

        .admin-link-row a:hover {
            text-decoration: underline;
        }

        .admin-link-row span {
            font-size: 13px;
            color: #9ca3af;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Welcome back</h1>
        <p class="sub">Sign in to your account</p>

        {{-- Role hint cards (just visual, not functional) --}}
        <div class="roles">
            <div class="role-card active-admin" id="card-admin"
                onclick="fillDemo('admin@admin.com','admin123','card-admin','card-student','active-admin')">
                <div class="icon">⚙️</div>
                <div class="rlabel">Admin</div>
                <div class="rdesc">Manage students &amp; counters</div>
            </div>
            <div class="role-card" id="card-student"
                onclick="fillDemo('','','card-student','card-admin','active-student')">
                <div class="icon">🎛️</div>
                <div class="rlabel">Student</div>
                <div class="rdesc">Use your counters</div>
            </div>
        </div>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <label>Email</label>
            <input type="email" name="email" id="email-input" value="admin@admin.com" placeholder="you@example.com"
                required>

            <label>Password</label>
            <input type="password" name="password" id="pass-input" value="admin123" placeholder="••••••••" required>

            <button type="submit">Sign In</button>
        </form>

        <div class="divider">
            <hr><span>accounts</span>
            <hr>
        </div>

        <div class="admin-link-row">
            <span>Admin login: </span>
            <a href="/login">admin@admin.com / admin123</a>
        </div>
        <div class="admin-link-row" style="margin-top:6px">
            <span>Students: </span>
            <a href="/login">use credentials given by admin</a>
        </div>

    </div>

    <script>
        // Clicking a role card pre-fills demo credentials
        function fillDemo(email, pass, activeCard, otherCard, activeClass) {
            document.getElementById('email-input').value = email;
            document.getElementById('pass-input').value = pass;

            // Swap active highlight
            const active = document.getElementById(activeCard);
            const other = document.getElementById(otherCard);

            // Remove both possible active classes first
            active.classList.remove('active-admin', 'active-student');
            other.classList.remove('active-admin', 'active-student');

            active.classList.add(activeClass);
        }
    </script>

</body>

</html>