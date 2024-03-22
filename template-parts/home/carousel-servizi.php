<?php
// Chiamata API per i servizi
$response1 = wp_remote_get('https://accessounico.regione.umbria.it/api/servizi/ente/2089?skip=0&take=63');
if (is_wp_error($response1)) {
    $error_message1 = $response1->get_error_message();
    echo "Qualcosa è andato storto con la prima API: $error_message1";
    exit; // Esci se c'è un errore
} else {
    $api_response_body = wp_remote_retrieve_body($response1);
    echo "Risposta dell'API per i servizi: <pre>" . htmlspecialchars($api_response_body) . "</pre>";
    $api_data = json_decode($api_response_body, true);
}

// Chiamata API per i report
$response2 = wp_remote_get('https://accessounico.regione.umbria.it/api/report/export');
if (is_wp_error($response2)) {
    $error_message2 = $response2->get_error_message();
    echo "Qualcosa è andato storto con la seconda API: $error_message2";
    exit; // Esci se c'è un errore
} else {
    $report_response_body = wp_remote_retrieve_body($response2);
    echo "Risposta dell'API per i report: <pre>" . htmlspecialchars($report_response_body) . "</pre>";
    $report_data = json_decode($report_response_body, true);
}

// Recupera tutte le aree tematiche dai report
$allAreas = array_map(function($item) {
    return $item['areaTematica'];
}, $report_data);

// Rimuove elementi vuoti e duplicati dall'array delle aree tematiche
$allAreas = array_filter($allAreas);
$allAreas = array_unique($allAreas);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template con Ricerca e Card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-3">
    <div class="row mb-3">
        <div class="col">
            <input type="text" class="form-control" id="searchInput" placeholder="Cerca per titolo, area tematica o descrizione...">
        </div>
        <div class="col">
            Numero di servizi da caricare:
            <a href="#" class="cards-per-page" data-cards="6">6</a>
            <a href="#" class="cards-per-page" data-cards="12">12</a>
            <a href="#" class="cards-per-page" data-cards="24">24</a>
        </div>
    </div>
    <div id="apiCardsContainer" class="row"></div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center"></ul>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const apiData = <?php echo json_encode($api_data ?? []); ?>;
    const reportUrls = <?php echo json_encode(array_column($report_data ?? [], 'url', 'id')); ?>;
    let currentPage = 1;
    let cardsPerPage = 6;

    const displayCards = (startIndex, endIndex, dataToShow) => {
        const container = document.getElementById('apiCardsContainer');
        container.innerHTML = '';
        for (let i = startIndex; i < endIndex; i++) {
            if (i >= dataToShow.length) break;
            const data = dataToShow[i];
            const cardHtml = `
                <div class="col-12 col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${data.name || 'Titolo del Servizio'}</h5>
                            <p class="card-text">${data.description ? data.description.valoreNomeEsteso : 'Descrizione del servizio.'}</p>
                            <a href="${reportUrls[data.id] || '#'}" class="btn btn-primary">Vai al servizio</a>
                        </div>
                    </div>
                </div>`;
            container.innerHTML += cardHtml;
        }
    };

    const filterAndDisplayCards = () => {
        const searchQuery = document.getElementById('searchInput').value.trim().toLowerCase();
        const filteredData = (apiData || []).filter(data =>
            (data.name && data.name.toLowerCase().includes(searchQuery)) ||
            (data.areaTematica && data.areaTematica.toLowerCase().includes(searchQuery)) ||
            (data.description && data.description.valoreNomeEsteso.toLowerCase().includes(searchQuery))
        );
        currentPage = 1;
        displayCards(0, cardsPerPage, filteredData);
        updatePagination(filteredData.length);
    };

    const changePage = (page) => {
        currentPage = page;
        const startIndex = (currentPage - 1) * cardsPerPage;
        const endIndex = startIndex + cardsPerPage;
        const searchQuery = document.getElementById('searchInput').value.trim().toLowerCase();
        const filteredData = (apiData || []).filter(data =>
            (data.name && data.name.toLowerCase().includes(searchQuery)) ||
            (data.areaTematica && data.areaTematica.toLowerCase().includes(searchQuery)) ||
            (data.description && data.description.valoreNomeEsteso.toLowerCase().includes(searchQuery))
        );
        displayCards(startIndex, endIndex, filteredData);
    };

    const updatePagination = (totalItems) => {
        const pageCount = Math.ceil(totalItems / cardsPerPage);
        const pagination = document.querySelector('.pagination');
        pagination.innerHTML = ''; // Reset pagination
        for (let i = 1; i <= pageCount; i++) {
            pagination.innerHTML += `<li class="page-item"><a class="page-link" href="#">${i}</a></li>`;
        }

        // Add event listener for pagination items
        const pageLinks = pagination.querySelectorAll('.page-link');
        pageLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = parseInt(e.target.innerText);
                changePage(currentPage);

                // Remove 'active' class from all pagination items
                pageLinks.forEach(link => {
                    link.parentElement.classList.remove('active');
                });

                // Add 'active' class only to clicked item
                e.target.parentElement.classList.add('active');
            });
        });
    };

    const cardsPerPageLinks = document.querySelectorAll('.cards-per-page');
    cardsPerPageLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            cardsPerPage = parseInt(e.target.dataset.cards, 10);
            filterAndDisplayCards();
        });
    });

    document.getElementById('searchInput').addEventListener('input', filterAndDisplayCards);

    filterAndDisplayCards(); // Initial card display
});
</script>


</body>
</html>
