# Authentifizierungs-API Dokumentation für IntimateTales
## Überblick

Die Authentifizierung-API des "IntimateTales" WordPress-Plugins ermöglicht es Nutzern, sich sicher im System anzumelden und zu registrieren. Diese API nutzt WordPress-spezifische Funktionen zur Authentifizierung und gewährleistet eine nahtlose Integration mit dem WordPress-User-Management-System.

## Endpunkte der Authentifizierung

### 1\. Nutzerregistrierung

- **URI**: `/wp-json/intimatetales/v1/register`
- **Methode**: POST
- **Beschreibung**: Ermöglicht es neuen Nutzern, ein Konto zu erstellen.
- **Parameter**:
    - `username`: Gewünschter Benutzername
    - `email`: E-Mail-Adresse des Nutzers
    - `password`: Gewähltes Passwort

### 2\. Nutzeranmeldung

- **URI**: `/wp-json/intimatetales/v1/login`
- **Methode**: POST
- **Beschreibung**: Ermöglicht es Nutzern, sich in ihr Konto einzuloggen.
- **Parameter**:
    - `username`: Benutzername
    - `password`: Passwort

### 3\. Passwortzurücksetzung

- **URI**: `/wp-json/intimatetales/v1/reset-password`
- **Methode**: POST
- **Beschreibung**: Sendet einen Link zur Passwortzurücksetzung an die E-Mail-Adresse des Nutzers.
- **Parameter**:
    - `email`: E-Mail-Adresse des Nutzers

## Sicherheit und Authentifizierungsverfahren

- **JWT (JSON Web Tokens)**: Für die Authentifizierung der Nutzer werden JWT verwendet. Nach erfolgreicher Anmeldung erhalten Nutzer einen Token, der für nachfolgende Anfragen genutzt wird.
- **SSL/TLS-Verschlüsselung**: Alle Authentifizierungsanfragen sollten über eine gesicherte Verbindung erfolgen.
- **Passwortsicherheit**: Passwörter werden verschlüsselt gespeichert. WordPress-interne Funktionen zur Passwortverwaltung werden genutzt.

## Fehlerszenarien und Fehlerbehandlung

- **Ungültige Anmeldeinformationen**: Bei der Eingabe falscher Anmeldeinformationen wird ein entsprechender Fehlercode zurückgegeben.
- **Account existiert nicht**: Wenn versucht wird, sich mit einem nicht existierenden Account anzumelden.
- **Serverseitige Fehler**: Bei serverseitigen Problemen wird ein 5xx-Fehlercode zurückgegeben.

## Versionierung

Die API ist unter der URI `/wp-json/intimatetales/v1/` versioniert, um zukünftige Erweiterungen und Änderungen zu unterstützen, ohne bestehende Implementierungen zu beeinträchtigen.