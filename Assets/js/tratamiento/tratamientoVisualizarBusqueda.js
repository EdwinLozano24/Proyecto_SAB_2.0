document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('treatmentSearch');
    const treatmentCards = document.querySelectorAll('.tratamiento-card');
    const noResultsMessage = document.getElementById('noResultsMessage');
    
    function filterTreatments() {
        const searchTerm = searchInput.value.toLowerCase();
        let hasResults = false;
        
        treatmentCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const desc = card.querySelector('.card-desc').textContent.toLowerCase();
            
            if (searchTerm === '' || title.includes(searchTerm) || desc.includes(searchTerm)) {
                card.style.display = 'flex';
                hasResults = true;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Mostrar u ocultar mensaje de no resultados
        if (!hasResults && searchTerm !== '') {
            noResultsMessage.classList.add('show');
            noResultsMessage.classList.remove('hidden');
        } else {
            noResultsMessage.classList.remove('show');
            noResultsMessage.classList.add('hidden');
        }
    }
    
    searchInput.addEventListener('input', filterTreatments);
    
    // Inicializar mostrando todas las tarjetas
    filterTreatments();
});