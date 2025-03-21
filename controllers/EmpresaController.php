<?php
require_once 'models/Empresa.php';

class EmpresaController {
    private $empresaModel;

    public function __construct($pdo) {
        $this->empresaModel = new Empresa($pdo);
    }

    // Mostrar todas las empresas
    public function index() {
        $empresas = $this->empresaModel->getAll();
        include 'views/frmEmpresa.php'; // Mostrar la vista con las empresas
    }

    // Crear o actualizar empresa
    public function storeOrUpdate() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $empresa = new Empresa($codigo, $nombre);

            // Si tiene ID, actualizar, si no es nueva, creamos una empresa
            if (isset($_GET['id'])) {
                $empresa->save();
                header("Location: index.php?action=empresa_index"); // Redirigir a la lista de empresas
            } else {
                $empresa->save();
                header("Location: index.php?action=empresa_index");
            }
        }
    }

    // Eliminar empresa
    public function delete($id) {
        $this->empresaModel->delete($id);
        header("Location: index.php?action=empresa_index");
    }

    // Editar empresa
    public function edit($id) {
        $empresa = $this->empresaModel->getById($id);
        include 'views/frmEmpresa.php'; // Mostrar la vista para editar
    }
}
?>
