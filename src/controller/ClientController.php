<?php

namespace Syleo24\Framework\controller;

use Exception;
use Syleo24\Framework\entity\User;
use Syleo24\Framework\core\Controller;
use Syleo24\Framework\model\UserModel;
use Syleo24\Framework\util\FlashMessage;
use Syleo24\Framework\serializer\UserSerializer;
use Syleo24\Framework\util\SafeXss;

class ClientController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        try {
            $clients = $this->model->getByRole('client');

            $clientsSafe = [];
            foreach ($clients as $client) {
                $clientsSafe[] = SafeXss::user($client);
            }

            $this->render('clients', ['title' => 'Clients', 'clients' => $clientsSafe]);
        } catch (Exception $e) {
            FlashMessage::set('Erreur : ' . $e->getMessage(), 'error');
            $this->render('clients', ['title' => 'Clients', 'clients' => []]);
        }
    }

    public function add()
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (!isset($data['username'], $data['email'], $data['password'], $data['phone'])) {
                throw new Exception('Champs manquants');
            }
            $data['role'] = 'client';
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $userEntity = UserSerializer::fromArray($data);
            if (!($userEntity instanceof User)) {
                throw new Exception('Invalid user entity');
            }

            $insertedUser = $this->model->insert($userEntity);
            $safeUser = SafeXss::user($insertedUser);

            FlashMessage::set('Client ajouté avec succès !', 'success');
            echo json_encode([
                'success' => true,
                'client' => UserSerializer::toArray($safeUser)
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
            $client = $this->model->getById($id);
            if (!$client instanceof User || !$client) {
                throw new Exception('Client introuvable');
            }
            $safeUser = SafeXss::user($client);
            $this->render('client', ['client' => $safeUser, 'title' => 'Modifier un client']);
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

            $safeUser = SafeXss::user($updatedUser);

            FlashMessage::set('Client ' . $safeUser->getUsername() .  ' mis à jour avec succès !', 'success');
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'user' => UserSerializer::toArray($safeUser)
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
