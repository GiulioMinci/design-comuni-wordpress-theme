<?php
// Chiamata API per i servizi
$response1 = wp_remote_get('https://accessounico.regione.umbria.it/api/servizi/ente/2089?skip=0&take=63');
if (is_wp_error($response1)) {
    $error_message1 = $response1->get_error_message();
    echo "Qualcosa è andato storto con la prima API: $error_message1";
    exit; // Esci se c'è un errore
} else {
    $api_response_body = wp_remote_retrieve_body($response1);
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
    $report_data = json_decode($report_response_body, true);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template con Ricerca e Card</title>
    <!-- Non è necessario includere i file CSS di Bootstrap -->
</head>
<body>

<div class="container mt-3">
    <div id="apiCardsContainer">
        <?php foreach ($report_data as $data): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['areaTematica'] ?? 'Area Tematica'; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><a href="<?php echo $data['url'] ?? '#'; ?>"><?php echo $data['titolo'] ?? 'Titolo del Servizio'; ?></a></h6>
                    <p class="card-text"><?php echo $data['descrizione'] ?? 'Descrizione del servizio.'; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>