function searchCategory() {
    var category = document.getElementById('searchInput').value;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_books.php?category=' + encodeURIComponent(category), true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var books = JSON.parse(xhr.responseText);
            displayBooks(books);
        } else {
            console.error('Error fetching data');
        }
    };

    xhr.send();
}

function displayBooks(books) {
    var booksList = document.getElementById('booksList');
    booksList.innerHTML = '';

    books.forEach(function(book) {
        var bookItem = document.createElement('div');
        bookItem.className = 'book-item';
        bookItem.innerHTML = `
            <img src="../ADMIN/pages/Books/uploads/${book.image}" alt="Cover" class="book-cover">
            <div class="book-title">${book.title}</div>
        `;
        booksList.appendChild(bookItem);
    });
}

