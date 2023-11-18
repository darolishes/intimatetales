# Story-API Dokumentation

## Einführung

Die Story-API des "IntimateTales" WordPress-Plugins ermöglicht es Nutzern, interaktive und personalisierte Geschichten zu erleben. Diese API ist hauptsächlich für das Abrufen von Geschichten und das Erfassen von Nutzerinteraktionen zuständig. Da das Erstellen und Ändern von Geschichten direkt im WordPress-Admin-Bereich erfolgt, fokussiert sich diese API auf die Frontend-Interaktion.

## Endpunkte der Story-API

### 1\. Abrufen einer Liste von Geschichten

- **Zweck**: Gibt eine Liste aller verfügbaren Geschichten aus, die auf den Präferenzen und bisherigen Interaktionen des Nutzers basieren.
- **Methode**: `GET`
- **URL**: `/wp-json/intimatetales/v1/stories`
- **Parameter**: Keine
- **Rückgabe**: Eine Liste von Geschichten, inklusive Titel, Autor, Kurzbeschreibung.

### 2\. Abrufen einer spezifischen Geschichte

- **Zweck**: Liefert die Details einer spezifischen Geschichte, einschließlich des gesamten Inhalts und verfügbarer Entscheidungspfade.
- **Methode**: `GET`
- **URL**: `/wp-json/intimatetales/v1/stories/{story_id}`
- **Parameter**:
    - `story_id` (Pflicht): Die eindeutige ID der Geschichte.
- **Rückgabe**: Alle Details der angeforderten Geschichte, einschließlich Inhalt und Entscheidungspfade.

### 3\. Erfassen einer Nutzerentscheidung in einer Geschichte

- **Zweck**: Speichert die Auswahl, die ein Nutzer in einer interaktiven Geschichte getroffen hat.
- **Methode**: `POST`
- **URL**: `/wp-json/intimatetales/v1/stories/{story_id}/decision`
- **Parameter**:
    - `story_id` (Pflicht): Die ID der Geschichte.
    - `decision_path` (Pflicht): Der ausgewählte Pfad oder die getroffene Entscheidung des Nutzers.
- **Rückgabe**: Bestätigung der gespeicherten Entscheidung.

## Sicherheit und Authentifizierung

Da die Story-API sensible Nutzerdaten verarbeitet, wird jede Anfrage über gesicherte Methoden authentifiziert. Die Authentifizierung erfolgt über JWT (JSON Web Tokens) oder ähnliche Mechanismen, die in das WordPress-System integriert sind.

## Fehlerbehandlung

Die API gibt standardisierte Fehlercodes und Nachrichten zurück, falls Anfragen fehlschlagen oder nicht verarbeitet werden können. Dies umfasst Fehler wie unbekannte Story-ID, ungültige Entscheidungen oder Authentifizierungsprobleme.

## Versionierung

Die API wird versioniert, um Kompatibilität bei zukünftigen Erweiterungen und Änderungen zu gewährleisten. Die aktuelle Version ist `v1`.

---

Diese Dokumentation bietet einen umfassenden Überblick über die Funktionsweise und Nutzung der Story-API im Rahmen des "IntimateTales" WordPress-Plugins. Sie dient als Leitfaden für Entwickler und Administratoren, die mit der API arbeiten.