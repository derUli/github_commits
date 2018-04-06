# github_comments
UliCMS Modul - GitHub Commits in einer Seite anzeigen.

## Benutzung des Moduls
1. Fügen Sie bitte den Embed Code um das Modul github_commits einzubinden in eine Seite ein.
2. Legen Sie die Repository-Daten im Feld "Benutzerdefinierte Werte (JSON)" fest.
```javascript
{
   "github_commits" : {
          "username" : "derUli",
          "repository" : "ulicms",
          "count" : 10
   }
}
```

Der oben stehenende Code zeigt die 10 letzten Commits vom master Branch des GitHub Repositories derUli/ulicms an.

Andere Branches als den master Branch anzuzeigen wird im moment noch nicht unterstützt.
