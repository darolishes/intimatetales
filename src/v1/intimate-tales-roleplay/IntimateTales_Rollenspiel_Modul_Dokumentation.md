
# IntimateTales Rollenspiel-Modul Dokumentation

## Überblick
Das IntimateTales Rollenspiel-Modul bietet erweiterte Funktionen für die Generierung von diversen und verzweigten Storylines basierend auf Benutzerentscheidungen mithilfe von KI, Charakteranpassung, Echtzeit-Interaktion für Paare und weitere Features.

## Hauptkomponenten und Funktionen

### Klasse: `Achievements_Manager`

- **Methoden**:
  - `add_achievement_to_user()`: Fügt eine Errungenschaft zu einem Benutzer hinzu.
  - `get_user_achievements()`: Holt alle Errungenschaften eines Benutzers.
  - `user_has_achievement()`: Überprüft, ob ein Benutzer eine bestimmte Errungenschaft hat.

### Klasse: `API_Integration_Manager`

- **Methoden**:
  - `send_get_request()`: Sendet eine GET-Anfrage an eine API.
  - `send_post_request()`: Sendet eine POST-Anfrage an eine API.
  - `process_api_data()`: Verarbeitet die von einer API empfangenen Daten.

### Klasse: `Story_Manager`

- **Methoden**:
  - `get_story_by_id()`: Holt eine Geschichte anhand ihrer ID.
  - `get_next_story()`: Holt die nächste Geschichte basierend auf dem Fortschritt des Benutzers.
  - `get_branches_for_story()`: Holt alle Verzweigungen für eine bestimmte Geschichte.
  - `save_user_progress()`: Speichert den Fortschritt eines Benutzers in einer Geschichte.

### Klasse: `Game_Settings_Manager`

- **Methoden**:
  - `set_setting()`: Legt eine bestimmte Spieleinstellung fest.
  - `get_setting()`: Holt eine bestimmte Spieleinstellung.
  - `delete_setting()`: Löscht eine bestimmte Spieleinstellung.

### Klasse: `User_Progress_Manager`

- **Methoden**:
  - `get_user_progress()`: Holt den Fortschritt eines Benutzers.
  - `update_user_progress()`: Aktualisiert den Fortschritt eines Benutzers.
  - `reset_user_progress()`: Setzt den Fortschritt eines Benutzers zurück.
  - `get_user_path()`: Holt den aktuellen Pfad oder die Route eines Benutzers in der Geschichte.

### Klasse: `Game_Logic_Manager`

- **Methoden**:
  - `start_new_game()`: Startet ein neues Spiel.
  - `process_user_decision()`: Verarbeitet eine Entscheidung des Benutzers.
  - `get_next_decision()`: Holt die nächste Entscheidung oder Aktion für den Benutzer.

### Klasse: `Feedback_Manager`

- **Methoden**:
  - `save_user_feedback()`: Speichert das Feedback eines Benutzers.
  - `get_all_feedback()`: Holt alle Feedback-Einträge.
  - `get_feedback_for_story()`: Holt das Feedback für eine bestimmte Geschichte.

## Sicherheit und Datenschutz
Das Modul stellt sicher, dass alle Datenübertragungen verschlüsselt sind und dass Benutzerdaten sicher gespeichert werden. Es gibt auch Mechanismen zur Fehlerbehandlung, um eine reibungslose Benutzererfahrung zu gewährleisten.

## Feedback-Mechanismus
Benutzer können Feedback geben, das direkt an die Entwickler gesendet wird, um das Modul weiter zu verbessern.
