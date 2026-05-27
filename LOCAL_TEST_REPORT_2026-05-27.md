# Lokaler Volltestbericht

Datum: 27.05.2026  
Basis: Docker-Stack lokal, identischer Datenbankstand auf PHP 7.2 und PHP 8.4

## Testumfang

- 66 veroeffentlichte CMS-Seiten aus fw_pages
- zusaetzliche Kernendpunkte:
  - /
  - /fuel/login
  - /robots.txt
- Gesamt pro Laufzeit: 69 URLs

## Ergebnis Uebersicht

- PHP 7.2
  - total: 69
  - status >= 500: 0
  - status 404: 0
  - Seiten mit PHP-Error-Block im HTML: 12

- PHP 8.4
  - total: 69
  - status >= 500: 0
  - status 404: 0
  - Seiten mit PHP-Error-Block im HTML: 12

- Vergleich 7.2 vs 8.4
  - URL-fuer-URL identisch in Status und Error-Flag
  - diff: 0

## Auffaellige Unterseiten (identisch in 7.2 und 8.4)

1. /aktuelles/jubilaeum
   - Message: Undefined variable css_inner_class
2. /aktuelles/jubilaeum/kontakt
   - Message: Array to string conversion
3. /aktuelles/presse
   - Message: Array to string conversion
4. /eintritt
   - Message: Array to string conversion
5. /impressum
   - Message: Array to string conversion
6. /informationen/feuerwache/bauplaene
   - Message: Undefined variable css_inner_class
7. /informationen/feuerwache/bautagebuch
   - Message: Undefined variable css_inner_class
8. /informationen/feuerwache/fakten
   - Message: Undefined variable css_inner_class
9. /informationen/feuerwache/faq
   - Message: Undefined variable css_inner_class
10. /kontakt
    - Message: Array to string conversion
11. /mitmachen
    - Message: Array to string conversion
12. /startseite
    - Message: Undefined variable news

## Fazit fuer den Deploy-Vorbereitungsschritt

- Der Volltest ist in beiden Laufzeiten stabil durchgelaufen.
- Es gibt keine HTTP-Blocker (keine 5xx, keine 404 in der Testmenge).
- Die verbleibenden 12 PHP-Error-Hinweise sind bereits auf 7.2 vorhanden und nicht 8.4-spezifisch.
- Damit ist der Stand fuer den von dir geplanten Online-Test und den anschliessenden Umschalt-Test auf 8.4 konsistent vorbereitet.
