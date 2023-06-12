const search = document.querySelector('input[placeholder="Search flashcards"]');
const projectContainer = document.querySelector('.flashcards');

search.addEventListener("keyup", function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (flashcards) {
            projectContainer.innerHTML = "";
            loadFlashcards(flashcards);
        });
    }
});

function loadFlashcards(flashcards) {
    flashcards.forEach(flashcard => {
        console.log(flashcard);
        createFlashcard(flashcard);
    })
}

function createFlashcard(flashcard) {
    const template = document.querySelector("#template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = `/frontend/images/upload/${flashcard.icon}`;
    const title = clone.querySelector("h2");
    title.innerHTML = flashcard.name;
    const description = clone.querySelector("p");
    description.innerHTML = flashcard.description;
    const pages = clone.querySelector("a");
    pages.innerText = 'flashcards ' + flashcard.pages_count;

    projectContainer.appendChild(clone);
}

function redirect(item) {
    window.location.href = "http://localhost:8080/resolve?id=" + item;
}