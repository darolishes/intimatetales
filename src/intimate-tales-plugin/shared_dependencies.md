# IntimateTales Shared Dependencies

1. WordPress Core Features und Plugin  Integration:
    - ACF (Advanced Custom Fields) Integration: Evident durch den Einsatz von `acf-json` Dateien.
    - Custom Post Types: Wie character_post_type und story_post_type.
    - Custom Taxonomies: Wie taxonomy_format, taxonomy_genre, usw.

2. Configurations:
    - Plugin Konfigurationsdatei: config.php
    - Theme Konfigurationsdatei: functions.php

3. Settings:
    - Nutzereinstellungen: Evident durch user-settings.json
    - Design-Einstellungen: design-settings.json
    - Interaktionseinstellungen: interaction-settings.json
    - Zahlungseinstellungen: payment-settings.json
    - SMTP (E-Mail) Einstellungen: smtp-settings.json

4. ACF Option Pages und Field Groups:
    - Verschiedene Optionseiten und Feldgruppen, die mit ACF erstellt wurden, um verschiedene Einstellungen und benutzerdefinierte Felder zu definieren.

5. Plugin Klassen:
    - Authentifizierung: class-authentication.php
    - Dashboard Interaktion: class-dashboard.php
    - Rollenspiel-Interface: class-roleplay-interface.php
    - Pairing System: class-pairing-system.php
    - AI-Geschichtengenerator: class-ai-story-generator.php
    - Gamification: class-gamification.php
    - Belohnungen: class-rewards.php
    - Onboarding: class-onboarding.php
    - Kategorieliste: class-category-list.php
    - Benachrichtigungen: class-notification.php
    
6. Theme Assets:
    - JavaScript: assets/js/
    - SCSS (CSS Preprocessor): assets/scss/
    - Bilder: assets/images/

7. Theme Templates:
    - Header: templates/header.php
    - Footer: templates/footer.php
    - Sidebar: templates/sidebar.php
    - Dark Mode Toggle: templates/dark-mode-toggle.php

8. Theme Pages und Single Templates:
    - Single Story: single-story.php
    - Dashboard: page-dashboard.php
    - Onboarding: page-onboarding.php
    - Kategorieliste: page-category-list.php

9. Style Definitions:
    - SCSS Datei: style.scss