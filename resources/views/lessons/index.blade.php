<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Lecciones</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        h1 { color: #333; text-align: center; }
        .lesson-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 30px; }
        .lesson-card { border: 1px solid #ddd; border-radius: 8px; padding: 20px; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .lesson-card h3 { margin-top: 0; color: #007bff; }
        .lesson-card p { color: #666; line-height: 1.5; }
        .lesson-meta { font-size: 0.9em; color: #999; margin-top: 10px; }
        .btn { background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; margin-top: 10px; }
        .btn:hover { background: #0056b3; }
        .empty-state { text-align: center; padding: 40px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 Lecciones del Curso</h1>
        
        @if($lessons->count() > 0)
            <div class="lesson-grid">
                @foreach($lessons as $lesson)
                    <div class="lesson-card">
                        <h3>{{ $lesson->title }}</h3>
                        <p>{{ Str::limit($lesson->description, 100) }}</p>
                        <div class="lesson-meta">
                            @if($lesson->duration)
                                <span>⏱️ {{ gmdate('H:i:s', $lesson->duration) }}</span>
                            @endif
                            <span>📋 Orden: {{ $lesson->order }}</span>
                        </div>
                        <a href="{{ route('lessons.show', $lesson->id) }}" class="btn">Ver Lección</a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h3>No hay lecciones disponibles</h3>
                <p>Aún no se han agregado lecciones al sistema.</p>
            </div>
        @endif
    </div>
</body>
</html>