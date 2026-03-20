<div class="px-4 py-5 text-center">
    <h1 class="display-5 fw-bold">Welcome to SlimTemplate</h1>
    <p class="col-lg-6 mx-auto lead text-muted">
        A minimal Slim 4 starter with PHP-FPM, Nginx, and MariaDB — running in Docker.
    </p>
    <?php if (empty($_SESSION['user_id'])): ?>
        <div class="d-inline-flex gap-2 mt-3">
            <a href="/register" class="btn btn-primary btn-lg">Get started</a>
            <a href="/login" class="btn btn-outline-secondary btn-lg">Login</a>
        </div>
    <?php else: ?>
        <a href="/profile" class="btn btn-primary btn-lg mt-3">View my profile</a>
    <?php endif; ?>
</div>
