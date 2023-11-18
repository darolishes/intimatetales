# Datenbankdesign für "IntimateTales"

## Einführung

Dieses Dokument beschreibt das Datenbankdesign für das "IntimateTales" WordPress-Plugin. Es legt die Struktur der Datenbank fest, einschließlich der Tabellen, deren Beziehungen, die Schlüssel und die Art der gespeicherten Daten.

## Datenbankarchitektur

Die Datenbankarchitektur von "IntimateTales" basiert auf der Standard-WordPress-Datenbankstruktur und erweitert diese um spezifische Tabellen und Felder, die für die Funktionalitäten des Plugins erforderlich sind.

### Tabellenübersicht

#### 1\. wp\_users

- Standard-WordPress-Tabelle für Benutzerdaten.
- Zusätzliche Felder in `wp_usermeta` für benutzerdefinierte Daten.

#### 2\. wp\_posts

- Standard-WordPress-Tabelle für Inhalte, verwendet für die Speicherung von Geschichten.
- Post-Typ `story` wird für die Geschichten verwendet.

#### 3\. wp\_postmeta

- Speichert zusätzliche Informationen zu Geschichten, wie Genre, Autor, etc.

#### 4\. wp\_comments

- Verwendet für die Speicherung von Bewertungen und Feedback zu Geschichten.

#### 5\. wp\_commentmeta

- Zusätzliche Metadaten zu Kommentaren, einschließlich Bewertungsscores.

#### 6\. pairing\_table (Custom Table)

- Speichert Informationen zu Paarungen zwischen Benutzern.
- Felder: PairingID, User1ID, User2ID, PairingPreferences, MatchScore.

#### 7\. interaction\_table (Custom Table)

- Speichert Daten über Benutzerinteraktionen mit Geschichten.
- Felder: InteractionID, UserID, StoryID, DecisionPath, InteractionTime.

#### 8\. subscription\_table (Custom Table)

- Für die Verwaltung von Abonnements und Premium-Zugängen.
- Felder: SubscriptionID, UserID, SubscriptionType, StartDate, EndDate.

### Beziehungen

- **User zu Story**: Eine Zuordnung über `wp_posts` (`post_author`).
- **User zu Pairing**: Jeder Eintrag in `pairing_table` verweist auf zwei Benutzer in `wp_users`.
- **User zu Interaction**: Verbindung zwischen `wp_users` und `interaction_table` über UserID.
- **User zu Rating**: Nutzung von `wp_comments` und `wp_commentmeta` für User-bezogene Bewertungen.
- **Story zu Interaction**: Jede Interaktion in `interaction_table` ist mit einer Story in `wp_posts` verknüpft.

### Schlüssel und Indizes

- Primärschlüssel und Fremdschlüsselbeziehungen werden verwendet, um die Integrität der Daten zu gewährleisten.
- Indizes werden auf häufig abgefragten Feldern wie UserID und StoryID eingesetzt, um die Leistung zu optimieren.

## Datenschutz und Sicherheit

- Sämtliche Daten werden gemäß der DSGVO und anderen Datenschutzbestimmungen behandelt.
- Regelmäßige Backups und Sicherheitsmaßnahmen zum Schutz der Daten.