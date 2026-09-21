<?php

namespace App\Controllers\Admin;

use App\Helpers\DB;
use App\Models\Client;

class ClientController extends AdminController
{
    public function index()
    {
        $clients = Client::all();

        $this->renderAdmin('admin/clients/index', compact('clients'), 'Clientes');
    }

    public function create()
    {
        $client = [
            'id' => null,
            'name' => '',
            'website_url' => '',
            'logo_path' => '',
            'order' => 0,
            'is_published' => 1
        ];

        $this->renderAdmin('admin/clients/form', compact('client'), 'Nuevo Cliente');
    }

    public function store()
    {
        $data = \Flight::request()->data;
        $errors = [];

        $name = trim($data->name ?? '');
        $website_url = trim($data->website_url ?? '');
        $order = !empty($data->order) ? (int)$data->order : 0;
        $is_published = !empty($data->is_published) ? 1 : 0;

        if (empty($name)) $errors[] = 'El nombre es obligatorio.';
        if (!empty($website_url) && !filter_var($website_url, FILTER_VALIDATE_URL)) {
            $errors[] = 'El formato de sitio web no es válido.';
        }

        $logo_path = null;
        if (!isset($_FILES['logo']) || $_FILES['logo']['error'] === UPLOAD_ERR_NO_FILE) {
            $errors[] = 'El logo del cliente es obligatorio.';
        } else {
            $file = $_FILES['logo'];
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $errors[] = 'Error al subir el logo.';
            } elseif ($file['size'] > 2097152) { // 2MB
                $errors[] = 'El logo no puede superar los 2 MB.';
            } else {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
                if (!in_array($ext, $allowed)) {
                    $errors[] = 'Formato de imagen de logo no permitido (JPG, JPEG, PNG, WEBP, SVG).';
                } else {
                    $destDir = __DIR__ . '/../../public/storage/clients';
                    if (!is_dir($destDir)) {
                        mkdir($destDir, 0755, true);
                    }
                    $cleanName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file['name']);
                    if (move_uploaded_file($file['tmp_name'], $destDir . '/' . $cleanName)) {
                        $logo_path = 'clients/' . $cleanName;
                    }
                }
            }
        }

        if (!empty($errors)) {
            $_SESSION['_errors'] = $errors;
            $_SESSION['_old'] = (array)$data;
            \Flight::redirect(route('admin.clients.create'));
            return;
        }

        Client::create([
            'name' => $name,
            'website_url' => !empty($website_url) ? $website_url : null,
            'logo_path' => $logo_path,
            'order' => $order,
            'is_published' => $is_published
        ]);

        $_SESSION['success'] = 'Cliente agregado.';
        \Flight::redirect(route('admin.clients.index'));
    }

    public function edit(int $id)
    {
        $client = Client::find($id);
        if (!$client) {
            \Flight::notFound();
            return;
        }

        $this->renderAdmin('admin/clients/form', compact('client'), 'Editar Cliente');
    }

    public function update(int $id)
    {
        $client = Client::find($id);
        if (!$client) {
            \Flight::notFound();
            return;
        }

        $data = \Flight::request()->data;
        $errors = [];

        $name = trim($data->name ?? '');
        $website_url = trim($data->website_url ?? '');
        $order = !empty($data->order) ? (int)$data->order : 0;
        $is_published = !empty($data->is_published) ? 1 : 0;

        if (empty($name)) $errors[] = 'El nombre es obligatorio.';
        if (!empty($website_url) && !filter_var($website_url, FILTER_VALIDATE_URL)) {
            $errors[] = 'El formato de sitio web no es válido.';
        }

        $logo_path = $client['logo_path'];
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] !== UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['logo'];
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $errors[] = 'Error al subir el logo.';
            } elseif ($file['size'] > 2097152) {
                $errors[] = 'El logo no puede superar los 2 MB.';
            } else {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
                if (!in_array($ext, $allowed)) {
                    $errors[] = 'Formato de imagen de logo no permitido (JPG, JPEG, PNG, WEBP, SVG).';
                } else {
                    $destDir = __DIR__ . '/../../public/storage/clients';
                    if (!is_dir($destDir)) {
                        mkdir($destDir, 0755, true);
                    }
                    $cleanName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file['name']);
                    if (move_uploaded_file($file['tmp_name'], $destDir . '/' . $cleanName)) {
                        // Delete old file
                        $oldFile = __DIR__ . '/../../public/storage/' . $client['logo_path'];
                        if (file_exists($oldFile)) {
                            @unlink($oldFile);
                        }
                        $logo_path = 'clients/' . $cleanName;
                    }
                }
            }
        }

        if (!empty($errors)) {
            $_SESSION['_errors'] = $errors;
            $_SESSION['_old'] = (array)$data;
            \Flight::redirect(route('admin.clients.edit', ['id' => $id]));
            return;
        }

        Client::update($id, [
            'name' => $name,
            'website_url' => !empty($website_url) ? $website_url : null,
            'logo_path' => $logo_path,
            'order' => $order,
            'is_published' => $is_published
        ]);

        $_SESSION['success'] = 'Cliente actualizado.';
        \Flight::redirect(route('admin.clients.index'));
    }

    public function destroy(int $id)
    {
        $client = Client::find($id);
        if ($client) {
            $oldFile = __DIR__ . '/../../public/storage/' . $client['logo_path'];
            if (file_exists($oldFile)) {
                @unlink($oldFile);
            }
            Client::delete($id);
        }

        $_SESSION['success'] = 'Cliente eliminado.';
        \Flight::redirect(route('admin.clients.index'));
    }
}
