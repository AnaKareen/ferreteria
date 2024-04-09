<?php
require __DIR__ . '/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Sistema extends Config
{
    var $conn;
    var $count = 0;

    function connect()
    {
        $this->conn = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }

    function query($sql)
    {
        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $datos = array();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        return $datos;
    }

    function getRol($correo)
    {
        $sql = "SELECT r.rol FROM usuario u
        JOIN usuario_rol ur on u.id_usuario = ur.id_usuario
        JOIN rol r on ur.id_rol = r.id_rol
        WHERE u.correo = '" . $correo . "';";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row)
            array_push($info, $row['rol']);
        return $info;
    }

    function getPrivilegio($correo)
    {
        $sql = "SELECT p.privilegio FROM usuario u
        JOIN usuario_rol ur on u.id_usuario = ur.id_usuario
        JOIN rol_privilegio rp on ur.id_rol = rp.id_rol
        JOIN privilegio p on rp.id_privilegio = p.id_privilegio
        WHERE u.correo = '" . $correo . "';";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row)
            array_push($info, $row['privilegio']);
        return $info;
    }

    function login($correo, $password)
    {
        $password = md5($password);
        $this->connect();
        $sql = "SELECT * FROM usuario
        WHERE correo = :correo AND password = :password;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $datos = array();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $roles = array();
            $roles = $this->getRol($correo);
            $privilegios = array();
            $privilegios = $this->getPrivilegio($correo);
            $_SESSION['validado'] = true;
            $_SESSION['correo'] = $correo;
            $_SESSION['roles'] = $roles;
            $_SESSION['privilegios'] = $privilegios;
            return $datos[0];
        } else {
            $this->logout();
        }
        return false;
    }

    function logout()
    {
        unset($_SESSION);
        session_destroy();
    }

    function checkRol($rol, $kill = false)
    {
        if (isset($_SESSION['roles'])) {
            if ($_SESSION['validado']) {
                if (in_array($rol, $_SESSION['roles'])) {
                    return true;
                }
            }
        }
        if ($kill) {
            $this->logout();
            $this->alert('danger', 'Permiso denegado');
            die;
        }
        return false;
    }

    function checkPrivilegio($privilegio, $kill = false)
    {
        if (isset($_SESSION['privilegios'])) {
            if ($_SESSION['validado']) {
                if (in_array($privilegio, $_SESSION['privilegios'])) {
                    return true;
                }
            }
        }
        if ($kill) {
            $this->logout();
            $this->alert('danger', 'Permiso denegado');
            die;
        }
        return false;
    }

    function alert($type, $message)
    {
        $alert = array();
        $alert['type'] = $type;
        $alert['message'] = $message;
        include __DIR__ . '/views/alert.php';
    }

    public function checkEmail($correo)
    {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function reset($correo)
    {
        if ($this->checkEmail($correo)) {
            $this->connect();
            $sql = "SELECT * FROM usuario WHERE correo = '" . $correo . "';";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $datos = array();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            if (isset($datos[0])) {
                $token1 = md5($correo . "ALeaTori52");
                $token2 = md5($correo . date('Y-m-d H:i:s') . rand(1, 1000000));
                $token = $token1 . $token2;
                $sql = "UPDATE usuario SET token = :token WHERE correo = :correo;";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                $stmt->execute();
                $destinatario = $correo;
                $nombre = 'Juanito Banana';
                $asunto = 'Recuperación de contraseña';
                $mensaje = "
                Hola, se ha solicitado la recuperacion de su cuenta. <br>
                Para recuperar su contraseña, haga click en el siguiente enlace: <br>
                <a href='http://localhost/ferreteria/admin/login.php?action=RECOVERY&token='". $token . "'>Recuperar contraseña</a><br>
                <br>
                Muchas gracias, atentamente: La ferreteria :3
                ";
                if ($this->sendMail($destinatario, $nombre, $asunto, $mensaje)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    function setCount($count)
    {
        $this->count = $count;
    }

    function getCount()
    {
        return $this->count;
    }

    function upload($carpeta)
    {
        if (in_array($_FILES['fotografia']['type'], $this->getImageType())) {
            if ($_FILES['fotografia']['size'] <= $this->getImageSize()) {
                $n = rand(1, 1000000);
                $nombre_archivo = $n . $_FILES['fotografia']['size'] . $_FILES['fotografia']['name'];
                $nombre_archivo = md5($nombre_archivo);
                $extension = pathinfo($_FILES['fotografia']['name'], PATHINFO_EXTENSION);
                $nombre_archivo = $nombre_archivo . "." . $extension;
                $ruta = '..\\uploads\\' . $carpeta . '\\' . $nombre_archivo;
                if (!file_exists($ruta)) {
                    move_uploaded_file($_FILES['fotografia']['tmp_name'], $ruta);
                    return $nombre_archivo;
                }
            }
        }
        return false;
    }

    public function sendMail($destinatario, $nombre, $asunto, $mensaje)
    {
        require '../vendor/autoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = '21030017@itcelaya.edu.mx';
        $mail->Password = 'ltuqkhakkunmzwry';
        $mail->setFrom('21030017@itcelaya.edu.mx', 'GUSTAVO RAMIREZ MIRELES');
        $mail->addAddress($destinatario, $nombre);
        $mail->Subject = $asunto;
        $mail->msgHTML($mensaje);
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
}
