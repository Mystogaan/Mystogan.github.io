const toggle = document.getElementById('darkmodetoggle');
toggle.addEventListener('change', () => {
    if (toggle.checked) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
});

let currentIndex = 0;
const cards = document.querySelectorAll('.card');
const totalCards = cards.length;
const visibleCards = 5; // Jumlah kartu yang ditampilkan sekaligus

function updateCards() {
    // Sembunyikan semua kartu
    cards.forEach((card) => {
        card.style.display = 'none'; // Sembunyikan semua kartu
    });
    
    // Tampilkan kartu yang sesuai dengan indeks saat ini
    for (let i = 0; i < visibleCards; i++) {
        const cardIndex = (currentIndex + i) % totalCards; // Menggunakan modulus untuk loop kembali
        cards[cardIndex].style.display = 'flex'; // Tampilkan kartu yang sesuai
    }
}

document.querySelector('.next').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % (totalCards - visibleCards + 1); // Pastikan tidak melampaui jumlah total kartu
    updateCards();
});

document.querySelector('.prev').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + totalCards - visibleCards + 1) % (totalCards - visibleCards + 1); // Pastikan tidak melampaui jumlah total kartu
    updateCards();
});

// Initial display
updateCards();

document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    const modals = document.querySelectorAll('.modal');
    const closeButtons = document.querySelectorAll('.close');

    // Tampilkan modal saat kartu diklik
    cards.forEach((card, index) => {
        card.addEventListener('click', () => {
            const modal = document.getElementById(`modal${index + 1}`);
            if (modal) {
                modal.style.display = 'block'; // Pastikan modal ditampilkan
            }
        });
    });

    // Menutup modal saat tombol close diklik
    closeButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const modalId = e.target.getAttribute('data-close');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Menutup modal saat mengklik di luar konten modal
    window.addEventListener('click', (e) => {
        modals.forEach(modal => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
});
