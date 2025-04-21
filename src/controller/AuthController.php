<?php

namespace Syleo24\Framework\controller;

use Exception;
use Syleo24\Framework\entity\User;
use Syleo24\Framework\core\Controller;
use Syleo24\Framework\model\UserModel;
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
        try {
            $data = json_decode(file_get_contents("php://input"), true);

            $user = $this->model->getByEmail($data['email']);

            if (!$user || !password_verify($data['password'], $user->getPassword())) {
                FlashMessage::set('Erreur : Identifiants incorrects', 'error');
                echo json_encode(['success' => false, 'message' => 'Identifiants incorrects']);
                return;
            }

            // 3. Connexion réussie
            $_SESSION['user'] = $user;
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Nouveau token après login
            FlashMessage::set('Connexion réussie', 'success');
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            FlashMessage::set('Erreur : ' . $e->getMessage(), 'error');
            http_response_code(500);
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
