@extends('layouts.admin')

@section('title', 'Páginas legales')

@section('content')
<div class="table-responsive">
    <table class="table admin-table">
        <thead><tr><th>Título</th><th>Última revisión</th><th>Publicada</th><th></th></tr></thead>
        <tbody>
            @foreach($pages as $page)
                <tr>
                    <td>{{ $page->title }}</td>
                    <td>{{ optional($page->last_reviewed_at)->format('d/m/Y') ?? 'Sin revisar' }}</td>
                    <td>{{ $page->is_published ? 'Sí' : 'No' }}</td>
                    <td><a href="{{ route('admin.legal-pages.edit', $page) }}">Editar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<p class="text-muted">Recordá que estos textos deben ser validados por un profesional legal antes de su publicación definitiva.</p>
@endsection
