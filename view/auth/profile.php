<div class="row justify-content-center">
    <div class="col-sm-10 col-md-7 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">

                <div class="d-flex align-items-center mb-4">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center flex-shrink-0 me-3"
                         style="width:56px;height:56px;font-size:1.5rem;font-weight:700;">
                        <?= strtoupper(substr(htmlspecialchars($user['username']), 0, 1)) ?>
                    </div>
                    <div>
                        <h2 class="mb-0"><?= htmlspecialchars($user['username']) ?></h2>
                        <small class="text-muted">
                            Member since <?= date('F j, Y', strtotime($user['created_at'])) ?>
                        </small>
                    </div>
                </div>

                <table class="table table-borderless mb-4">
                    <tbody>
                        <tr>
                            <th class="text-muted ps-0" style="width:35%">Username</th>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted ps-0">Email</th>
                            <td>
                                <?php if ($user['email']): ?>
                                    <?= htmlspecialchars($user['email']) ?>
                                <?php else: ?>
                                    <span class="text-muted fst-italic">Not set</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted ps-0">Member since</th>
                            <td><?= date('F j, Y', strtotime($user['created_at'])) ?></td>
                        </tr>
                    </tbody>
                </table>

                <form method="POST" action="/logout">
                    <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
                </form>

            </div>
        </div>
    </div>
</div>
