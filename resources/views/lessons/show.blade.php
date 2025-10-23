<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lesson->title }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #000; }
        .container { max-width: 1200px; margin: 0 auto; background: white; }
        .header { background: #007bff; color: white; padding: 20px; }
        .video-container { position: relative; width: 100%; height: 60vh; background: #000; }
        .video-player { width: 100%; height: 100%; }
        .content { padding: 20px; }
        .lesson-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .back-btn { background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 20px; }
        .back-btn:hover { background: #5a6268; }
        .error-message { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin: 20px; }
        .video-controls { background: #f8f9fa; padding: 15px; border-top: 1px solid #dee2e6; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ route('lessons.index') }}" class="back-btn">← Volver a las lecciones</a>
            <h1>{{ $lesson->title }}</h1>
        </div>

        <div class="video-container">
            <video id="videoPlayer" class="video-player" controls>
                <source src="{{ $lesson->video_url }}" type="video/mp4">
                Su navegador no soporta el elemento de video.
            </video>
        </div>

        <div class="content">
            <div class="lesson-info">
                <h3>📋 Descripción de la lección</h3>
                <p>{{ $lesson->description ?? 'Sin descripción disponible.' }}</p>
                
                @if($lesson->duration)
                    <p><strong>⏱️ Duración:</strong> {{ gmdate('H:i:s', $lesson->duration) }}</p>
                @endif
                
                <p><strong>📊 Orden:</strong> {{ $lesson->order }}</p>
            </div>

            <div class="video-controls">
                <h4>🎥 Información del Video</h4>
                <p><strong>URL:</strong> <code>{{ $lesson->video_url }}</code></p>
                <p><strong>Tipo detectado:</strong> <span id="videoType">Detectando...</span></p>
            </div>

            @if($lesson->quiz)
                <div class="quiz-section" style="margin-top: 30px; padding: 20px; background: #e3f2fd; border-radius: 8px;">
                    <h3 style="color: #1976d2; margin-bottom: 15px;">📝 Quiz de Evaluación</h3>
                    <p style="margin-bottom: 20px;">Esta lección tiene un quiz disponible. ¡Pon a prueba tus conocimientos!</p>
                    
                    @php
                        $userAttempts = $lesson->quiz->attempts->count();
                        $maxAttempts = 3;
                        $canAttempt = $userAttempts < $maxAttempts;
                        $bestScore = $lesson->quiz->attempts->max('score');
                    @endphp

                    <div style="background: white; padding: 15px; border-radius: 6px; margin-bottom: 15px;">
                        <p><strong>📊 Estadísticas:</strong></p>
                        <p>• Intentos realizados: {{ $userAttempts }} / {{ $maxAttempts }}</p>
                        @if($bestScore !== null)
                            <p>• Mejor puntuación: {{ $bestScore }}%</p>
                        @endif
                        <p>• Preguntas: {{ $lesson->quiz->questions->count() }}</p>
                        <p>• Nota mínima para aprobar: 75%</p>
                    </div>

                    @if($canAttempt)
                        <a href="{{ route('quizzes.show', ['lesson' => $lesson->id]) }}" 
                           style="background: #1976d2; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold;">
                            🎯 Realizar Quiz
                        </a>
                    @else
                        <div style="background: #fff3cd; border: 1px solid #ffc107; padding: 15px; border-radius: 6px;">
                            <p style="margin: 0; color: #856404;">
                                ⚠️ Has alcanzado el máximo de intentos permitidos ({{ $maxAttempts }}).
                                @if($bestScore >= 75)
                                    ¡Felicidades! Has aprobado con {{ $bestScore }}%.
                                @else
                                    Tu mejor puntuación fue {{ $bestScore }}%.
                                @endif
                            </p>
                        </div>
                    @endif

                    @if($userAttempts > 0)
                        <div style="margin-top: 15px;">
                            <a href="{{ route('quizzes.show', ['lesson' => $lesson->id]) }}" 
                               style="color: #1976d2; text-decoration: underline;">
                                Ver historial de intentos
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <div style="margin-top: 30px; padding: 20px; background: #f5f5f5; border-radius: 8px; text-align: center;">
                    <p style="color: #666; margin: 0;">📚 Esta lección aún no tiene un quiz disponible.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('videoPlayer');
            const videoUrl = '{{ $lesson->video_url }}';
            const videoTypeSpan = document.getElementById('videoType');

            // Detectar tipo de video
            function detectVideoType(url) {
                if (url.includes('youtube.com') || url.includes('youtu.be')) {
                    return 'YouTube';
                } else if (url.includes('vimeo.com')) {
                    return 'Vimeo';
                } else if (url.includes('.m3u8')) {
                    return 'HLS Stream';
                } else if (url.includes('.mp4') || url.includes('.webm') || url.includes('.ogg')) {
                    return 'Video directo';
                } else {
                    return 'Desconocido';
                }
            }

            const videoType = detectVideoType(videoUrl);
            videoTypeSpan.textContent = videoType;

            // Manejar videos HLS
            if (videoUrl.includes('.m3u8')) {
                if (Hls.isSupported()) {
                    const hls = new Hls();
                    hls.loadSource(videoUrl);
                    hls.attachMedia(video);
                    videoTypeSpan.textContent = 'HLS Stream (HLS.js)';
                } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                    video.src = videoUrl;
                    videoTypeSpan.textContent = 'HLS Stream (Nativo)';
                }
            }

            // Manejar videos de YouTube
            if (videoType === 'YouTube') {
                const container = video.parentElement;
                const youtubeId = extractYouTubeId(videoUrl);
                if (youtubeId) {
                    container.innerHTML = `
                        <iframe 
                            width="100%" 
                            height="100%" 
                            src="https://www.youtube.com/embed/${youtubeId}" 
                            frameborder="0" 
                            allowfullscreen>
                        </iframe>
                    `;
                }
            }

            // Manejar videos de Vimeo
            if (videoType === 'Vimeo') {
                const container = video.parentElement;
                const vimeoId = extractVimeoId(videoUrl);
                if (vimeoId) {
                    container.innerHTML = `
                        <iframe 
                            width="100%" 
                            height="100%" 
                            src="https://player.vimeo.com/video/${vimeoId}" 
                            frameborder="0" 
                            allowfullscreen>
                        </iframe>
                    `;
                }
            }

            function extractYouTubeId(url) {
                const regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
                const match = url.match(regExp);
                return (match && match[7].length === 11) ? match[7] : false;
            }

            function extractVimeoId(url) {
                const regExp = /^.*vimeo.com\/(?:video\/)?(\d+)/;
                const match = url.match(regExp);
                return match ? match[1] : false;
            }

            // Añadir controles adicionales
            video.addEventListener('loadeddata', function() {
                console.log('Video cargado correctamente');
            });

            video.addEventListener('error', function() {
                console.log('Error al cargar el video');
                videoTypeSpan.textContent = 'Error al cargar';
            });
        });
    </script>
</body>
</html>