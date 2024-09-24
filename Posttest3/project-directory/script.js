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
    cards.forEach((card, index) => {
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


