# HISinOne TYPO3 Connector Frontend Theme
## Frontend der HIO-Publisher Demoseite

Diese TYPO3-Extension stellt das Frontend-Theme für die HIO-Publisher Demoseite bereit. Es enthält grundlegende Layouts und Stile, die für die Präsentation von Forschungsdaten aus HISinOne optimiert sind.

Das Theme ist so konzipiert, dass es nahtlos mit der TYPO3-Extension `hio-typo3-connector` zusammenarbeitet, um eine ansprechende Benutzeroberfläche für die Anzeige von Forschungsdaten zu bieten.

Für die Darstellung kommt das CSS-Framework Tailwind CSS in Version 3 zum Einsatz, das eine flexible und anpassbare Gestaltung ermöglicht.

Dieses Theme ist als Beispielimplementierung gedacht und kann an die spezifischen Bedürfnisse Ihrer TYPO3-Installation angepasst werden.

## Hinweise zu Container-Elementen

Die Content-Elemente `featuredProjects` / `featuredProject` sowie `featuredPublications` / `featuredPublication` sind als Container- bzw. Child-Elemente auf Basis von `b13/container` umgesetzt.

Die fachliche Einschränkung der erlaubten Child-Elemente wird in der Container-Konfiguration definiert. Damit diese Einschränkung auch im Backend-Formular konsequent für die `CType`-Auswahl berücksichtigt wird, wird die optionale Extension `ichhabrecht/content-defender` empfohlen.

Ohne `content-defender` funktionieren die Container weiterhin, die Einschränkung der auswählbaren Child-Elemente im Bearbeitungsformular ist dann jedoch unter Umständen nicht vollständig.

➡️ **[Changelog](CHANGELOG.md)** – Alle Änderungen, neue Features und Breaking Changes
