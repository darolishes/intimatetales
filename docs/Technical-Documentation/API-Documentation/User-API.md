# User-API-Dokumentation für "IntimateTales"
## Einleitung

Die User-API für das "IntimateTales" WordPress-Plugin ermöglicht die Verwaltung von Nutzerprofilen sowie das Pairing von Nutzern. Diese Dokumentation beschreibt die Endpunkte für Nutzerregistrierung, -management und das Pairing-System.

## API-Endpunkte

### Nutzerregistrierung

- **Endpunkt**: `/wp-json/intimatetales/v1/register`
- **Methode**: `POST`
- **Beschreibung**: Registrierung neuer Nutzer im System.
- **Parameter**: `username`, `email`, `password`
- **Rückgabewerte**: Bestätigung oder Fehlermeldung.

### Nutzerprofil abrufen

- **Endpunkt**: `/wp-json/intimatetales/v1/user/{userID}`
- **Methode**: `GET`
- **Beschreibung**: Abrufen der Nutzerprofilinformationen.
- **Parameter**: `userID`
- **Rückgabewerte**: Nutzerdaten oder Fehlermeldung.

### Nutzerprofil aktualisieren

- **Endpunkt**: `/wp-json/intimatetales/v1/user/{userID}`
- **Methode**: `PUT`
- **Beschreibung**: Aktualisierung von Nutzerprofilen.
- **Parameter**: `userID`, `userdata`
- **Rückgabewerte**: Bestätigung oder Fehlermeldung.

### Nutzerkonto löschen

- **Endpunkt**: `/wp-json/intimatetales/v1/user/{userID}`
- **Methode**: `DELETE`
- **Beschreibung**: Löschen eines Nutzerkontos.
- **Parameter**: `userID`
- **Rückgabewerte**: Bestätigung oder Fehlermeldung.

### Pairing von Nutzern

- **Endpunkt**: `/wp-json/intimatetales/v1/pairing`
- **Methode**: `POST`
- **Beschreibung**: Erstellt ein neues Pairing zwischen zwei Nutzern.
- **Parameter**: `user1ID`, `user2ID`
- **Rückgabewerte**: Pairing-Details oder Fehlermeldung.

### Pairing-Informationen abrufen

- **Endpunkt**: `/wp-json/intimatetales/v1/pairing/{pairingID}`
- **Methode**: `GET`
- **Beschreibung**: Abrufen der Details eines bestehenden Pairings.
- **Parameter**: `pairingID`
- **Rückgabewerte**: Pairing-Details oder Fehlermeldung.

## Sicherheit und Authentifizierung

- Authentifizierung mittels Bearer Token erforderlich.
- Sicherheitschecks für alle API-Anfragen.

## Fehlerbehandlung

- Einsatz von HTTP-Statuscodes zur Fehlerkennzeichnung.
- Klare Fehlermeldungen für Entwickler.

## Best Practices

- Verwendung von WordPress-Core-Funktionen für Nutzerverwaltung und -authentifizierung.
- Beachtung von Datenschutzstandards und Best Practices für die API-Sicherheit.

---

Diese Dokumentation bietet eine vollständige Übersicht über die User-API des "IntimateTales" Plugins, einschließlich der neuen Pairing-Funktionalität. Sie dient als Leitfaden für Entwickler, die mit der API arbeiten und das Pairing-System in ihre Anwendungen integrieren möchten.