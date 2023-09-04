<?php

namespace IntimateTales;

class API_Integration_Manager {

    private $api_endpoint;

    public function __construct($api_endpoint) {
        $this->api_endpoint = $api_endpoint;
    }

    // Sendet eine GET-Anfrage an die API.
    public function send_get_request($endpoint, $params = []) {
        $url = $this->api_endpoint . $endpoint . '?' . http_build_query($params);
        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            return ['error' => $response->get_error_message()];
        }

        return json_decode(wp_remote_retrieve_body($response), true);
    }

    // Sendet eine POST-Anfrage an die API.
    public function send_post_request($endpoint, $data) {
        $response = wp_remote_post($this->api_endpoint . $endpoint, [
            'body' => $data,
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        if (is_wp_error($response)) {
            return ['error' => $response->get_error_message()];
        }

        return json_decode(wp_remote_retrieve_body($response), true);
    }

    // Verarbeitet die von der API empfangenen Daten.
    public function process_api_data($data) {
        // Je nach Ihren spezifischen Anforderungen können Sie hier eine Logik hinzufügen, um die von der API empfangenen Daten zu verarbeiten.
        // Zum Beispiel könnten Sie die Daten in der WordPress-Datenbank speichern oder sie in einem bestimmten Format für die Frontend-Anzeige aufbereiten.

        return $data; // Dies ist nur ein Platzhalter. Passen Sie diese Methode an Ihre Bedürfnisse an.
    }
}
