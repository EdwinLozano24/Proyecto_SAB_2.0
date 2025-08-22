document.addEventListener('DOMContentLoaded', function() {
    // Carrusel automático
    const carrusel = document.querySelector('.carrusel');
    const slides = document.querySelectorAll('.slide');
    const dotsContainer = document.querySelector('.carrusel-dots');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    
    let currentIndex = 0;
    const totalSlides = slides.length;
    
    // Crear puntos indicadores
    slides.forEach((_, index) => {
        const dot = document.createElement('span');
        dot.classList.add('dot');
        if (index === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToSlide(index));
        dotsContainer.appendChild(dot);
    });
    
    const dots = document.querySelectorAll('.dot');
    
    // Función para mover el carrusel
    function goToSlide(index) {
        if (index >= totalSlides) {
            currentIndex = 0;
        } else if (index < 0) {
            currentIndex = totalSlides - 1;
        } else {
            currentIndex = index;
        }
        
        carrusel.style.transform = `translateX(-${currentIndex * 100}%)`;
        
        // Actualizar estado activo
        slides.forEach(slide => slide.classList.remove('active'));
        slides[currentIndex].classList.add('active');
        
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentIndex].classList.add('active');
    }
    
    // Botones de navegación
    prevBtn.addEventListener('click', () => goToSlide(currentIndex - 1));
    nextBtn.addEventListener('click', () => goToSlide(currentIndex + 1));
    
    // Carrusel automático
    let interval = setInterval(() => goToSlide(currentIndex + 1), 5000);
    
    // Pausar al pasar el mouse
    carrusel.addEventListener('mouseenter', () => clearInterval(interval));
    carrusel.addEventListener('mouseleave', () => {
        interval = setInterval(() => goToSlide(currentIndex + 1), 5000);
    });
    
    // Botones "Ver más" (para futuros modales)
    document.querySelectorAll('.btn-vermas').forEach(btn => {
        btn.addEventListener('click', function() {
            // Aquí irá la lógica para abrir el modal
            console.log('Mostrar detalles del tratamiento');
        });
    });
});