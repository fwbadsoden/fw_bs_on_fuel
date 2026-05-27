# Lokale Laufzeitumgebung

Diese Konfiguration stellt die bestehende Anwendung lokal mit denselben Grundkomponenten wie online bereit:

- MariaDB 10.4
- PHP 7.2 als Altstand
- PHP 8.4 als Zielstand
- Apache mit aktiviertem mod_rewrite

Die bestehende Development-Konfiguration bleibt unberührt. Die Container setzen stattdessen `CI_ENV=docker` und verwenden damit die Datei `fuel/application/config/docker/database.php`.

## Voraussetzungen auf dem Mac

1. OrbStack oder Docker Desktop
2. Docker Compose (`docker compose`)
3. Optional ein SQL-Client wie Sequel Ace

Pruefe die Docker-Installation vor dem Start einmal mit:

```bash
docker compose version
```

Wenn der Befehl nicht existiert, ist das Compose-Plugin auf dem Mac noch nicht installiert oder nicht korrekt mit Docker verbunden.

## Dienste und Ports

- Webseite auf PHP 7.2: `http://localhost:8072`
- Webseite auf PHP 8.4: `http://localhost:8084`
- phpMyAdmin: `http://localhost:8081`
- MariaDB 10.4: `127.0.0.1:33067`

## Erststart

Im Projektverzeichnis ausfuehren:

```bash
docker compose build web72 web84
docker compose up -d db phpmyadmin web72
```

Danach ist der Altstand unter PHP 7.2 erreichbar.

## Datenbank importieren

Die Compose-Konfiguration legt automatisch an:

- Datenbank: `db403895_3`
- Benutzer: `fuel`
- Passwort: `fuel`
- Root-Passwort: `root`

Empfohlener Erstimport mit dem vorhandenen Komplettdump:

```bash
docker compose exec -T db mariadb -uroot -proot db403895_3 < dev_stuff/sql/2019-11-03_db403895_3_with_content.sql
```

Wenn du stattdessen einen anderen Dump verwenden willst, nimm denselben Befehl mit der passenden SQL-Datei.

## Zwischen PHP 7.2 und 8.4 wechseln

PHP 7.2 starten:

```bash
docker compose up -d db phpmyadmin web72
docker compose stop web84
```

PHP 8.4 starten:

```bash
docker compose up -d db phpmyadmin web84
docker compose stop web72
```

Wenn du beide Laufzeiten parallel vergleichen willst, koennen beide Webcontainer gleichzeitig laufen. Dann erreichst du sie ueber die unterschiedlichen Ports 8072 und 8084.

## Nützliche Kommandos

Containerstatus pruefen:

```bash
docker compose ps
```

Logs eines Webcontainers ansehen:

```bash
docker compose logs -f web72
docker compose logs -f web84
```

Alle Dienste stoppen:

```bash
docker compose down
```

Mit Zuruecksetzen der Datenbank:

```bash
docker compose down -v
```

## Hinweise zum Projekt

- Die Root-Datei `.htaccess` wird durch Apache im Container ausgewertet, weil `AllowOverride All` gesetzt ist.
- `BASE_URL` wird im Projekt dynamisch aus Hostname und Port gebildet. `http://localhost:8072` und `http://localhost:8084` funktionieren daher ohne zusaetzliche Base-URL-Anpassung.
- Das Projekt nutzt bereits `mysqli`; die Docker-DB-Konfiguration spiegelt das.
- Auf Apple-Silicon-Macs wird der PHP-7.2-Container bewusst als `linux/amd64` gestartet, weil Legacy-PHP-Images haeufig keine stabile ARM-Unterstuetzung mehr mitbringen.

## Typische Stolperstellen

Falls Cache- oder Log-Verzeichnisse lokal nicht beschreibbar sind:

```bash
chmod -R 0777 fuel/application/cache fuel/application/logs assets/cache
```

Falls der Build des PHP-7.2-Images bei alten Debian-Paketquellen scheitert, baue das Image erneut ohne Cache:

```bash
docker compose build --no-cache web72
```

Der eigentliche Migrationspfad bleibt:

1. Altstand mit PHP 7.2 und MariaDB 10.4 lokal stabilisieren
2. Danach Fuel CMS aktualisieren
3. Anschliessend unter PHP 8.4 lauffaehig machen
