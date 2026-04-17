<?php

// Controller del registro.
// Se encarga de validar la informacion del formulario
// y coordinar la creacion de persona + cuenta.
class C_Register extends Controller {

    private $registerModel;

    public function __construct() {
        parent::__construct();
        $this->registerModel = $this->load_model('Register');
    }

    // Carga la vista principal del registro.
    public function index() {
        $this->view->set_view('index');
    }

    // Orquesta el registro completo:
    // 1. valida datos
    // 2. revisa duplicados
    // 3. crea person
    // 4. crea account
    // 5. confirma transaccion
    public function store() {
        try {
            $payload = $this->build_payload();
            $defaultRoleId = $this->registerModel->find_default_role_id();

            if (!$defaultRoleId) {
                throw new Exception('No se encontro un rol base para nuevos usuarios.');
            }

            if ($this->registerModel->email_exists($payload['email'])) {
                throw new Exception('El correo ya existe en el sistema.');
            }

            if ($this->registerModel->username_exists($payload['username'])) {
                throw new Exception('El nombre de usuario ya esta en uso.');
            }

            if ($this->registerModel->document_exists($payload['document_number'])) {
                throw new Exception('El numero de documento ya existe.');
            }

            if (!$this->registerModel->document_type_exists($payload['document_type_id'])) {
                throw new Exception('Selecciona un tipo de documento valido.');
            }

            // El registro usa transaccion porque se insertan dos tablas.
            // Si una falla, ninguna debe quedar a medias.
            $this->registerModel->begin_transaction();

            $personId = $this->registerModel->create_person([
                'name' => $payload['name'],
                'document_type_id' => $payload['document_type_id'],
                'document_number' => $payload['document_number'],
                'address' => $payload['address'],
                'phone' => $payload['phone'],
                'email' => $payload['email'],
                'role_person_id' => $defaultRoleId
            ]);

            $this->registerModel->create_account([
                'id_person' => $personId,
                'username' => $payload['username'],
                'password' => password_hash($payload['password'], PASSWORD_DEFAULT),
                'email' => $payload['email']
            ]);

            $this->registerModel->commit_transaction();

            Response::json([
                'success' => true,
                'message' => 'Registro completado correctamente.'
            ]);
        } catch (Exception $e) {
            $this->registerModel->rollback_transaction();

            Response::json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    // Construye un arreglo limpio con lo que llega por POST.
    // Aqui tambien se concentra la validacion basica del formulario.
    private function build_payload() {
        $name = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $email = trim($_POST['email'] ?? '');
        $documentNumber = trim($_POST['document_number'] ?? '');
        $documentTypeId = (int) ($_POST['document_type_id'] ?? 0);
        $address = trim($_POST['address'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        if (
            $name === '' ||
            $username === '' ||
            $password === '' ||
            $email === '' ||
            $documentNumber === '' ||
            $documentTypeId <= 0
        ) {
            throw new Exception('Completa todos los campos obligatorios.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Ingresa un correo valido.');
        }

        if (strlen($password) < 8) {
            throw new Exception('La contrasena debe tener al menos 8 caracteres.');
        }

        return [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'document_number' => $documentNumber,
            'document_type_id' => $documentTypeId,
            'address' => $address,
            'phone' => $phone
        ];
    }
}
