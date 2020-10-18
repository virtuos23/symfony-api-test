### Test Symfony Backend
#### Aufgabenstellung
Es soll eine Backend-Api erstellt werden mit der die Kundendaten eines Vermittler ausgelesen, aktualisiert sowie neu erstellt und gelöscht werden können. Die Ausgabe soll im JSON(+ld) Format erfolgen.

Die API soll vorrangig mit Hilfe von API-Platform erstellt und mit OpenApi dokumentiert werden.    

Zur Sicherheit soll die API mit einem JWT abgesichert werden. Dafür soll ein JWT nach einem Login via POST erzeugt werden.  Für den JWT kommt das Bundle lexik/jwt-authentication zur Anwendung.

Nur Vermittler mit einem aktiven Zugang (sec.vermittler_user) dürfen sich einloggen und einen JWT erhalten.

Alle Bundles müssen selbst konfiguriert und eingestellt werden.
Bsp. services.yaml, security.yaml, lexik_jwt_authentication.yaml

Jeder Vermittler aus der Tabelle std.vermittler darf n Kunden haben. Ausgegeben werden sollen nur Kunden die dem Vermittler anhand der ID zugeordnet und nicht geloescht sind. Die Vermittlerdaten selbst sollen nicht mit ausgegeben werden.  
Jeder Kunde kann n Adressen haben die wiederum eine 1:1 Beziehung zu std.kunde_adresse haben wo festgelegt wird ob die Adresse geschäftlich genutzt wird und als Rechnungsadresse genutzt werden darf. Zusätzlich besitzt jeder Kunde einen Onlinezugang der in sec.users steht.

WICHTIG:  
- Das Passwort eines Kunden darf nicht mit ausgegeben werden
- Das Passwort darf beim Erstellen eines Users nicht leer sein
- Das Passwort eines Kunden soll mit 8 Zeichen lang sein und Groß/Kleinbuchstaben sowie mind eine Zahl und ein Sonderzeichen enthalten
- Die Email Adresse des Kunden muss valide sein.
- Wird ein Datensatz aus einer Tabelle auf gelöscht gesetzt, darf dieser bei einer Abfrage nicht mit erscheinen

Folgende Resourcen werden erwartet:
- foo/kunden
  - GET Collection (alle Kunden des eingeloggten Vermittlers), POST neuer Kunde für den VP
- foo/kunden/{id}
  - GET/PUT/DELETE
- foo/adressen
  - GET Collection (alle Adressen aller Kunden für den eingeloggten VP), POST neue Adresse für einen Kunden
- foo/adressen/{id}
  - GET/PUT/DELETE
- foo/user
  - GET Collection, POST neuer User für einen Kunden
- foo/user/{id}
  - GET/PUT/DELETE

##### Subresourcen:
- foo/kunden/{id}/adressen
  - GET Collection Adressen eines Kunden
- foo/kunden/{id}/user
  - GET Collection user eines Kunden
- foo/kunden/{id}/adressen/{id}/details
  - GET Collection Details zu einer Adresse eines Kunden

#### Erwartetes JSON Format:

````json
{
    "id": "CF451PQ9",
    "name": "Mustermann",
    "vorname": "Max",
    "geburtsdatum": "1970-01-01",
    "geschlecht": "divers",
    "email": "max.mustermann@example.org",
    "vermittlerId": 1000,
    "adressen": [
        {
            "adresseId": 1,
            "strasse": "Musterstrasse 12",
            "plz": "01234",
            "ort": "Musterort",
            "bundesland": "BE",
            "details": {
                "geschaeftlich": false,
                "rechnungsadresse": true
            }
        }
    ],
    "user": {
        "username": "max.mustermann@example.org",
        "aktiv": 1,
        "lastLogin": "2020-05-01T20:20:20+02:00"
    }
}
````