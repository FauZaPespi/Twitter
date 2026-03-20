<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title ?? '') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">Twitter</a>
            <div class="navbar-nav ms-auto d-flex align-items-center gap-2">
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <a class="nav-link" href="/profile">
                        <?= htmlspecialchars($_SESSION['username']) ?>
                    </a>
                    <form method="POST" action="/logout" class="m-0">
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                <?php else: ?>
                    <a class="nav-link" href="/login">Login</a>
                    <a class="btn btn-primary btn-sm" href="/register">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container mt-4 mb-5">
        <?= $content ?>
    </main>

    <footer class="border-top py-3 text-center text-muted small">
        Template &copy; <?= date('Y') ?>, FauZa
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
