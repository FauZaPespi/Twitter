<?php
namespace Fauza\Template\Controllers;

use Fauza\Template\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class AuthController
{
    private function view(): PhpRenderer
    {
        $view = new PhpRenderer("../view");
        $view->setLayout("layout.php");
        return $view;
    }

    public function showLogin(Request $req, Response $resp, array $args): Response
    {
        if (!empty($_SESSION['user_id'])) {
            return $resp->withHeader('Location', '/profile')->withStatus(302);
        }
        return $this->view()->render($resp, 'auth/login.php', ['title' => 'Login']);
    }

    public function login(Request $req, Response $resp, array $args): Response
    {
        $data     = $req->getParsedBody();
        $username = trim($data['username'] ?? '');
        $password = $data['password'] ?? '';

        if (empty($username) || empty($password)) {
            return $this->view()->render($resp, 'auth/login.php', [
                'title' => 'Login',
                'error' => 'Please fill in all fields.',
            ]);
        }

        $pdo  = Database::getInstance();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->view()->render($resp, 'auth/login.php', [
                'title' => 'Login',
                'error' => 'Invalid username or password.',
            ]);
        }

        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];

        return $resp->withHeader('Location', '/profile')->withStatus(302);
    }

    public function showRegister(Request $req, Response $resp, array $args): Response
    {
        if (!empty($_SESSION['user_id'])) {
            return $resp->withHeader('Location', '/profile')->withStatus(302);
        }
        return $this->view()->render($resp, 'auth/register.php', ['title' => 'Register']);
    }

    public function register(Request $req, Response $resp, array $args): Response
    {
        $data     = $req->getParsedBody();
        $username = trim($data['username'] ?? '');
        $email    = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $confirm  = $data['confirm_password'] ?? '';

        if (empty($username) || empty($password) || empty($confirm)) {
            return $this->view()->render($resp, 'auth/register.php', [
                'title' => 'Register',
                'error' => 'Username and password are required.',
                'old'   => $data,
            ]);
        }

        if ($password !== $confirm) {
            return $this->view()->render($resp, 'auth/register.php', [
                'title' => 'Register',
                'error' => 'Passwords do not match.',
                'old'   => $data,
            ]);
        }

        if (strlen($password) < 6) {
            return $this->view()->render($resp, 'auth/register.php', [
                'title' => 'Register',
                'error' => 'Password must be at least 6 characters.',
                'old'   => $data,
            ]);
        }

        $pdo = Database::getInstance();

        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            return $this->view()->render($resp, 'auth/register.php', [
                'title' => 'Register',
                'error' => 'Username already taken.',
                'old'   => $data,
            ]);
        }

        if (!empty($email)) {
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                return $this->view()->render($resp, 'auth/register.php', [
                    'title' => 'Register',
                    'error' => 'Email already in use.',
                    'old'   => $data,
                ]);
            }
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt   = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$username, $email ?: null, $hashed]);

        $_SESSION['user_id']  = (int) $pdo->lastInsertId();
        $_SESSION['username'] = $username;

        return $resp->withHeader('Location', '/profile')->withStatus(302);
    }

    public function profile(Request $req, Response $resp, array $args): Response
    {
        if (empty($_SESSION['user_id'])) {
            return $resp->withHeader('Location', '/login')->withStatus(302);
        }

        $pdo  = Database::getInstance();
        $stmt = $pdo->prepare('SELECT id, username, email, created_at FROM users WHERE id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();

        if (!$user) {
            session_destroy();
            return $resp->withHeader('Location', '/login')->withStatus(302);
        }

        return $this->view()->render($resp, 'auth/profile.php', [
            'title' => 'My Profile',
            'user'  => $user,
        ]);
    }

    public function logout(Request $req, Response $resp, array $args): Response
    {
        session_destroy();
        return $resp->withHeader('Location', '/login')->withStatus(302);
    }
}
