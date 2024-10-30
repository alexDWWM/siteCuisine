document.addEventListener('DOMContentLoaded', function() {
    const favoriLink = document.querySelector('.favoris a');
    if (favoriLink) {
        favoriLink.addEventListener('click', function(e) {
            e.preventDefault();
            const icon = this.querySelector('i');
            fetch(this.href, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.isFavorite) {
                    icon.className = 'fas fa-star';
                    icon.style.color = 'black';
                } else {
                    icon.className = 'far fa-star';
                    icon.style.color = '';
                }
            })
            .catch(error => console.error('Erreur:', error));
        });
    }
});

       
            
        
    