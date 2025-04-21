<?php

namespace Syleo24\Framework\controller;

use Exception;
use Syleo24\Framework\entity\User;
use Syleo24\Framework\core\Controller;
use Syleo24\Framework\model\UserModel;
use Syleo24\Framework\security\LoginRateLimiter;
use Syleo24\Framework\util\FlashMessage;
use Syleo24\Framework\serializer\UserSerializer;

class AuthController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function login()
    {
        try {
            // Tu peux générer un token ici aussi pour afficher dans le formulaire
            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }

            $this->render('login', [
                'title' => 'Connexion',
                'csrf_token' => $_SESSION['csrf_token'] // pour l'ajouter au HTML
            ]);
        } catch (Exception $e) {
            FlashMessage::set('Erreur : ' . $e->getMessage(), 'error');
            $this->render('login', ['title' => 'Connexion']);
        }
    }

    public function handleLogin()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'];
        if (LoginRateLimiter::isBlocked($email)) {
            FlashMessage::set('Trop de tentatives de connexion. Veuillez patienter 5 minutes avant de réessayer.', 'error');
            // Bloquer la connexion pour 5 minutes
            http_response_code(429);
            echo json_encode(['success' => false, 'message' => 'Trop de tentatives de connexion. Veuillez patienter 5 minutes avant de réessayer.']);
            return;
        }
        try {

            $user = $this->model->getByEmail($data['email']);

            if (!$user || !password_verify($data['password'], $user->getPassword())) {
                LoginRateLimiter::registerAttempt($email);
                throw new Exception('Email ou mot de passe incorrect');
            }

            // 3. Connexion réussie
            $_SESSION['user'] = $user;
            LoginRateLimiter::resetAttempts($email); // Reset les tentatives de connexion
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Nouveau token après login
            FlashMessage::set('Connexion réussie', 'success');
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            FlashMessage::set('Erreur : ' . $e->getMessage(), 'error');
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Erreur serveur']);
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
}
