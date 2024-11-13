import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
console.log("app.js загружен и выполняется!");

window.confirmDelete = function(noteId) {
    // Устанавливаем action у формы с ID заметки
    const deleteForm = document.getElementById("deleteForm");
    deleteForm.action = `/notes/${noteId}`;

    // Открываем модальное окно
    document.getElementById("deleteNote").classList.remove("hidden");
}
window.closeModal = function() {
    document.getElementById("deleteNote").classList.add("hidden");
}


document.getElementById('like-btn').addEventListener('click', function() {
    const likeButton = this;
    const likeCount = document.getElementById('like-count');
    const isLiked = likeButton.classList.contains('liked');
    let noteId = this.dataset.noteId;
    const url = isLiked ? `/notes/${noteId}/unlike` : `/notes/${noteId}/like`;
    const method = isLiked ? 'DELETE' : 'POST';
    fetch(url, {
        method : method,
        headers : {
            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response =>
            response.json())
            .then(data => {
                likeCount.textContent = data.likesCount;
                likeButton.classList.toggle('liked');
                console.log(data.message);
            })

});


document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM полностью загружен!");
    // Найти кнопки и блоки
    const selectCategoryButton = document.getElementById('select-category-btn');
    const createCategoryButton = document.getElementById('create-category-btn');
    const categoryInput = document.getElementById('new-category-input');
    const existingCategories = document.getElementById('existing-categories');

    // Показать/скрыть существующие категории
    selectCategoryButton.addEventListener('click', () => {
        categoryInput.style.display = 'none';
        existingCategories.style.display = 'block';
    });

    // Показать поле для новой категории
    createCategoryButton.addEventListener('click', () => {
        existingCategories.style.display = 'none';
        categoryInput.style.display = 'block';
    });
});


