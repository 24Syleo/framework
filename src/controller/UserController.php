<?php

namespace Syleo24\Framework\controller;

use Exception;
use Syleo24\Framework\entity\User;
use Syleo24\Framework\core\Controller;
use Syleo24\Framework\model\UserModel;
use Syleo24\Framework\util\FlashMessage;
use Syleo24\Framework\serializer\UserSerializer;

class UserController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        try {
            $users = $this->model->getByRole('user');

            $this->render('users', ['title' => 'Utilisateurs', 'users' => $users, 'csrf_token' => $_SESSION['csrf_token']]);
        } catch (Exception $e) {
            FlashMessage::set('Erreur : ' . $e->getMessage(), 'error');
            $this->render('users', ['title' => 'Utilisateurs', 'users' => []]);
        }
    }

    public function add()
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (!isset($data['username'], $data['email'], $data['password'], $data['role'])) {
                throw new Exception('Champs manquants');
            }

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $userEntity = UserSerializer::fromArray($data);
            if (!($userEntity instanceof User)) {
                throw new Exception('Invalid user entity');
            }

            $insertedUser = $this->model->insert($userEntity);

            FlashMessage::set('Utilisateur ajouté avec succès !', 'success');

            echo json_encode([
                'success' => true,
                'user' => UserSerializer::toArray($insertedUser)
            ]);
        } catch (Exception $e) {
            FlashMessage::set('Erreur : ' . $e->getMessage(), 'error');

            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $admin = $_SESSION['user'];
            $user = $this->model->getById($id);
            if (!$user instanceof User || !$user) {
                throw new Exception('Utilisateur introuvable');
            }
            $this->render('user', ['admin' => $admin, 'user' => $user, 'csrf_token' => $_SESSION['csrf_token'], 'title' => 'Modifier un utilisateur']);
        } catch (Exception $e) {
            FlashMessage::set('Erreur : ' . $e->getMessage(), 'error');
            $this->render('error', ['title' => 'Erreur']);
        }
    }


    public function update($id)
    {
        try {
            $user = $this->model->getById($id);

            if (!$user instanceof User || !$user) {
                throw new Exception('Utilisateur introuvable');
            }
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);


            if (!isset($data['username'], $data['email'], $data['phone'])) {
                throw new Exception('Champs manquants');
            }

            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setPhone($data['phone']);

            if (!($user instanceof User)) {
                throw new Exception('Invalid user entity');
            }
            $updatedUser = $this->model->update($user);

            if (!($updatedUser instanceof User)) {
                throw new Exception('Invalid update user entity');
            }

            FlashMessage::set('Utilisateur ' . $updatedUser->getUsername() .  ' mis à jour avec succès !', 'success');

            http_response_code(200);
            echo json_encode([
                'success' => true,
                'user' => UserSerializer::toArray($updatedUser)
            ]);
        } catch (Exception $e) {
            FlashMessage::set('Erreur : ' . $e->getMessage(), 'error');

            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
