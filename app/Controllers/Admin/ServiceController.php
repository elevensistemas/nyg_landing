<?php

namespace App\Controllers\Admin;

use App\Helpers\DB;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController extends AdminController
{
    public function index()
    {
        $q = $_GET['q'] ?? '';
        $sql = "SELECT s.*, sc.name as category_name FROM services s LEFT JOIN service_categories sc ON s.service_category_id = sc.id WHERE s.deleted_at IS NULL";
        $params = [];

        if (!empty($q)) {
            $sql .= " AND s.name LIKE :q";
            $params['q'] = '%' . $q . '%';
        }

        $sql .= " ORDER BY s.order ASC, s.name ASC";
        $services = DB::select($sql, $params);

        $this->renderAdmin('admin/services/index', compact('services'), 'Servicios');
    }

    public function create()
    {
        $service = [
            'id' => null,
            'service_category_id' => null,
            'name' => '',
            'slug' => '',
            'problem' => '',
            'short_description' => '',
            'description' => '',
            'benefits' => '',
            'icon' => '',
            'cover_image' => '',
            'order' => 0,
            'is_featured_on_home' => 0,
            'is_published' => 1
        ];
        $categories = ServiceCategory::all();

        $this->renderAdmin('admin/services/form', compact('service', 'categories'), 'Nuevo Servicio');
    }

    public function store()
    {
        $data = \Flight::request()->data;
        $errors = [];

        $name = trim($data->name ?? '');
        $slug = trim($data->slug ?? '');
        if (empty($slug)) {
            $slug = slugify($name);
        }
        $short_description = trim($data->short_description ?? '');
        $description = trim($data->description ?? '');

        if (empty($name)) $errors[] = 'El nombre es obligatorio.';
        if (empty($short_description)) $errors[] = 'La descripción corta es obligatoria.';
        if (empty($description)) $errors[] = 'La descripción es obligatoria.';

        // Check unique slug
        $existing = DB::selectOne("SELECT id FROM services WHERE slug = :slug AND deleted_at IS NULL", ['slug' => $slug]);
        if ($existing) {
            $errors[] = 'El slug ingresado ya existe.';
        }

        $cover_image = null;
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['cover_image'];
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $errors[] = 'Error al subir la imagen de portada.';
            } else {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp'];
                if (!in_array($ext, $allowed)) {
                    $errors[] = 'El formato de imagen debe ser JPG, JPEG, PNG o WEBP.';
                } else {
                    $destDir = __DIR__ . '/../../public/storage/services';
                    if (!is_dir($destDir)) {
                        mkdir($destDir, 0755, true);
                    }
                    $cleanName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file['name']);
                    if (move_uploaded_file($file['tmp_name'], $destDir . '/' . $cleanName)) {
                        $cover_image = 'services/' . $cleanName;
                    }
                }
            }
        }

        if (!empty($errors)) {
            $_SESSION['_errors'] = $errors;
            $_SESSION['_old'] = (array)$data;
            \Flight::redirect(route('admin.services.create'));
            return;
        }

        Service::create([
            'service_category_id' => !empty($data->service_category_id) ? (int)$data->service_category_id : null,
            'name' => $name,
            'slug' => $slug,
            'problem' => !empty($data->problem) ? trim($data->problem) : null,
            'short_description' => $short_description,
            'description' => $description,
            'benefits' => !empty($data->benefits) ? trim($data->benefits) : null,
            'icon' => !empty($data->icon) ? trim($data->icon) : null,
            'cover_image' => $cover_image,
            'order' => !empty($data->order) ? (int)$data->order : 0,
            'is_featured_on_home' => !empty($data->is_featured_on_home) ? 1 : 0,
            'is_published' => !empty($data->is_published) ? 1 : 0
        ]);

        $_SESSION['success'] = 'Servicio creado correctamente.';
        \Flight::redirect(route('admin.services.index'));
    }

    public function edit(int $id)
    {
        $service = Service::find($id);
        if (!$service) {
            \Flight::notFound();
            return;
        }
        $categories = ServiceCategory::all();

        $this->renderAdmin('admin/services/form', compact('service', 'categories'), 'Editar Servicio');
    }

    public function update(int $id)
    {
        $service = Service::find($id);
        if (!$service) {
            \Flight::notFound();
            return;
        }

        $data = \Flight::request()->data;
        $errors = [];

        $name = trim($data->name ?? '');
        $slug = trim($data->slug ?? '');
        if (empty($slug)) {
            $slug = slugify($name);
        }
        $short_description = trim($data->short_description ?? '');
        $description = trim($data->description ?? '');

        if (empty($name)) $errors[] = 'El nombre es obligatorio.';
        if (empty($short_description)) $errors[] = 'La descripción corta es obligatoria.';
        if (empty($description)) $errors[] = 'La descripción es obligatoria.';

        // Check unique slug
        $existing = DB::selectOne("SELECT id FROM services WHERE slug = :slug AND id != :id AND deleted_at IS NULL", ['slug' => $slug, 'id' => $id]);
        if ($existing) {
            $errors[] = 'El slug ingresado ya existe en otro servicio.';
        }

        $cover_image = $service['cover_image'];
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['cover_image'];
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $errors[] = 'Error al subir la imagen de portada.';
            } else {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp'];
                if (!in_array($ext, $allowed)) {
                    $errors[] = 'El formato de imagen debe ser JPG, JPEG, PNG o WEBP.';
                } else {
                    $destDir = __DIR__ . '/../../public/storage/services';
                    if (!is_dir($destDir)) {
                        mkdir($destDir, 0755, true);
                    }
                    $cleanName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file['name']);
                    if (move_uploaded_file($file['tmp_name'], $destDir . '/' . $cleanName)) {
                        // Delete old cover image
                        if ($service['cover_image']) {
                            $oldFile = __DIR__ . '/../../public/storage/' . $service['cover_image'];
                            if (file_exists($oldFile)) {
                                @unlink($oldFile);
                            }
                        }
                        $cover_image = 'services/' . $cleanName;
                    }
                }
            }
        }

        if (!empty($errors)) {
            $_SESSION['_errors'] = $errors;
            $_SESSION['_old'] = (array)$data;
            \Flight::redirect(route('admin.services.edit', ['id' => $id]));
            return;
        }

        Service::update($id, [
            'service_category_id' => !empty($data->service_category_id) ? (int)$data->service_category_id : null,
            'name' => $name,
            'slug' => $slug,
            'problem' => !empty($data->problem) ? trim($data->problem) : null,
            'short_description' => $short_description,
            'description' => $description,
            'benefits' => !empty($data->benefits) ? trim($data->benefits) : null,
            'icon' => !empty($data->icon) ? trim($data->icon) : null,
            'cover_image' => $cover_image,
            'order' => !empty($data->order) ? (int)$data->order : 0,
            'is_featured_on_home' => !empty($data->is_featured_on_home) ? 1 : 0,
            'is_published' => !empty($data->is_published) ? 1 : 0
        ]);

        $_SESSION['success'] = 'Servicio actualizado correctamente.';
        \Flight::redirect(route('admin.services.index'));
    }

    public function destroy(int $id)
    {
        Service::delete($id);
        $_SESSION['success'] = 'Servicio eliminado.';
        \Flight::redirect(route('admin.services.index'));
    }
}
