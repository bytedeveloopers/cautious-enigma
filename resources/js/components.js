// Componente para rating de estrellas
export function initStarRating() {
    const ratingContainers = document.querySelectorAll('[data-rating]');
    
    ratingContainers.forEach(container => {
        const stars = container.querySelectorAll('.star');
        const input = container.querySelector('input[name="rating"]');
        
        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                const rating = index + 1;
                input.value = rating;
                updateStars(stars, rating);
            });
            
            star.addEventListener('mouseenter', () => {
                updateStars(stars, index + 1);
            });
        });
        
        container.addEventListener('mouseleave', () => {
            updateStars(stars, input.value || 0);
        });
    });
}

function updateStars(stars, rating) {
    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.add('star-filled');
            star.classList.remove('star-empty');
            star.textContent = '★';
        } else {
            star.classList.remove('star-filled');
            star.classList.add('star-empty');
            star.textContent = '☆';
        }
    });
}

// Notificaciones en tiempo real
export function initNotifications() {
    const notificationBell = document.getElementById('notification-bell');
    if (!notificationBell) return;
    
    // Actualizar contador cada 30 segundos
    setInterval(async () => {
        try {
            const response = await fetch('/notifications/unread-count');
            const data = await response.json();
            
            const badge = notificationBell.querySelector('.notification-badge');
            if (data.count > 0) {
                if (!badge) {
                    const newBadge = document.createElement('span');
                    newBadge.className = 'notification-badge';
                    newBadge.textContent = data.count;
                    notificationBell.appendChild(newBadge);
                } else {
                    badge.textContent = data.count;
                }
            } else if (badge) {
                badge.remove();
            }
        } catch (error) {
            console.error('Error fetching notifications:', error);
        }
    }, 30000);
}

// Filtros y búsqueda
export function initFilters() {
    const filterButtons = document.querySelectorAll('.filter-button');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();
            const menu = button.nextElementSibling;
            menu.classList.toggle('hidden');
        });
    });
    
    // Cerrar menús al hacer clic fuera
    document.addEventListener('click', () => {
        document.querySelectorAll('.filter-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
    });
}

// Animaciones de entrada
export function initAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeIn');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.card, .comment').forEach(el => {
        observer.observe(el);
    });
}

// Toggle comment reply form
export function initComments() {
    const replyButtons = document.querySelectorAll('[data-reply-to]');
    
    replyButtons.forEach(button => {
        button.addEventListener('click', () => {
            const commentId = button.dataset.replyTo;
            const form = document.getElementById(`reply-form-${commentId}`);
            form.classList.toggle('hidden');
        });
    });
}

// Confirmar acciones importantes
export function initConfirmations() {
    const deleteButtons = document.querySelectorAll('[data-confirm]');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const message = button.dataset.confirm;
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
}

// Progress tracking
export function updateProgress(lessonId, percentage) {
    const progressBar = document.querySelector(`[data-lesson="${lessonId}"] .progress-bar-fill`);
    if (progressBar) {
        progressBar.style.width = `${percentage}%`;
    }
}

// Toast notifications
export function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 animate-slideIn ${
        type === 'success' ? 'bg-green-500' :
        type === 'error' ? 'bg-red-500' :
        type === 'warning' ? 'bg-yellow-500' :
        'bg-blue-500'
    }`;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Inicializar todos los componentes
document.addEventListener('DOMContentLoaded', () => {
    initStarRating();
    initNotifications();
    initFilters();
    initAnimations();
    initComments();
    initConfirmations();
});

// Exportar funciones para uso global
window.LMS = {
    showToast,
    updateProgress
};
