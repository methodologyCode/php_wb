const form = document.getElementById('videoCardForm');

form.addEventListener('submit', async (event) => {
    event.preventDefault();
    await getVideoCards();
});

async function getVideoCards() {
    const brandSelect = document.getElementById('brandSelect');
    const brand = brandSelect.value;
    let url = 'http://localhost:8000/'

    const response = await fetch(`${url}parserWB.php?brand=${brand}`, {
        method: 'GET'
    });

    const data = await response.json();

    const resultContainer = document.getElementById('result');
    resultContainer.innerHTML = '';

    data.forEach(product => {
        const card = document.createElement('div');
        card.className = 'card';

        const title = document.createElement('p');
        title.textContent = product.name;
        card.appendChild(title);

        const price = document.createElement('p');
        price.textContent = `Price: ${product.salePriceU}`;
        card.appendChild(price);

        const brandElement = document.createElement('p');
        brandElement.textContent = `Brand: ${product.brand}`;
        card.appendChild(brandElement);

        const rating = document.createElement('p');
        rating.textContent = `Rating: ${product.rating}`;
        card.appendChild(rating);

        resultContainer.appendChild(card);
    });
}

