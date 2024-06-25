<?php
header('Content-Type: application/json; charset=utf-8');
$file_path = __DIR__ . '/marca.class.php';

if (file_exists($file_path)) {
    include $file_path;
} else {
    echo json_encode(['error' => 'File marca.class.php not found at ' . $file_path]);
    exit;
}

$action = (isset($_GET['action'])) ? $_GET['action'] : null;

class Api extends Marca {
    public function read() {
        $datos = $this->getAll();
        echo json_encode($datos);
    }

    public function readOne($id_marca) {
        $datos = $this->getOne($id_marca);
        if (isset($datos['id_marca'])) {
            echo json_encode($datos);
        } else {
            echo json_encode(['mensaje' => "No se ha encontrado la marca especificada"]);
        }
    }

    public function deleteOne($id_marca) {
        $filas = $this->Delete($id_marca);
        if ($filas) {
            echo json_encode(['mensaje' => "La marca se ha eliminado"]);
        } else {
            echo json_encode(['mensaje' => "No se pudo eliminar la marca"]);
        }
    }

    public function create($datos) {
        $filas = $this->Insert($datos);
        if ($filas) {
            echo json_encode(['mensaje' => "La marca se ha creado correctamente"]);
        } else {
            echo json_encode(['mensaje' => "No se pudo crear la marca"]);
        }
    }

    public function update($id_marca, $datos) {
        $filas = $this->Update($id_marca, $datos);
        if ($filas) {
            echo json_encode(['mensaje' => "La marca se ha actualizado correctamente"]);
        } else {
            echo json_encode(['mensaje' => "No se pudo actualizar la marca"]);
        }
    }
}

$app = new Api();
$input = json_decode(file_get_contents('php://input'), true);

switch ($action) {
    case 'save':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $app->create($input);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            if (isset($input['id_marca'])) {
                $app->update($input['id_marca'], $input);
            } else {
                echo json_encode(['mensaje' => "ID de marca no especificado para la actualización"]);
            }
        }
        break;
    case 'delete':
        if (isset($_GET['id_marca'])) {
            $app->deleteOne($_GET['id_marca']);
        } else {
            echo json_encode(['mensaje' => "ID de marca no especificado para la eliminación"]);
        }
        break;
    case 'get':
    default:
        if (isset($_GET['id_marca'])) {
            $app->readOne($_GET['id_marca']);
        } else {
            $app->read();
        }
        break;
}
?>
