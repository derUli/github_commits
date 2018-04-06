# github_comments
UliCMS Module - Show GitHub Commits in a page

## Use it
1. Insert the github_commits embed code into a page.
2. Set repository data in the "Custom Data (JSON)" textarea.
```javascript
{
   "github_commits" : {
          "username" : "derUli",
          "repository" : "ulicms",
          "count" : 10
   }
}
```

The code above shows the last 10 commits on the master branch of the GitHub repository derUli/ulicms.

Showing other branches than the master branch is not supported yet.
