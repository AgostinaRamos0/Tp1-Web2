<?php 
require_once './app/views/auth.view.php'; 
require_once './app/model/user.model.php';

class AuthController {
    private $model;
    private $view; 

    public function __construct(){
        session_start(); // Iniciar sesión al crear el controlador
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin(){
        // Muestra el formulario de login
        return $this->view->showLogin(); 
    }

    public function login(){
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            return $this->view->showLogin('Falta completar nombre de usuario'); 
        }
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falta completar contraseña');
        }
        
        $email = $_POST['email']; 
        $password = $_POST['password'];

        // Verificar que el usuario está en la base de datos 
        $userFormDB = $this->model->getUserByEmail($email);

        if ($userFormDB && password_verify($password, $userFormDB->password)) {
            // Guardar en la sesión el ID del usuario 
            $_SESSION['ID_USER'] = $userFormDB->id; 
            $_SESSION['EMAIL_USER'] = $userFormDB->email; 
            $_SESSION['LAST_ACTIVITY'] = time(); 

            // Redirigir al home
            header('Location: ' . BASE_URL);
    
        } else {
            return $this->view->showLogin('Credencial incorrecta'); 
        }
    }

    public function logout(){
        session_start(); // Asegura que la sesión esté iniciada
        session_destroy(); // Elimina la sesión
        header('Location: ' . BASE_URL);  
        
    }
}
