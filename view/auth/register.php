<div class="row justify-content-center">
    <div class="col-sm-10 col-md-7 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Create an account</h2>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" action="/register">
                    <div class="mb-3">
                        <label for="username" class="form-label">
                            Username <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="<?= htmlspecialchars($old['username'] ?? '') ?>"
                               required autofocus autocomplete="username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email <span class="text-muted fw-normal">(optional)</span>
                        </label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                               autocomplete="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control" id="password" name="password"
                               required autocomplete="new-password">
                        <div class="form-text">Minimum 6 characters.</div>
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label">
                            Confirm Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control" id="confirm_password"
                               name="confirm_password" required autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Create Account</button>
                </form>

                <p class="mt-3 mb-0 text-center text-muted small">
                    Already have an account? <a href="/login">Login</a>
                </p>
            </div>
        </div>
    </div>
</div>
