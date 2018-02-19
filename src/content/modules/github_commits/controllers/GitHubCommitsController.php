<?php
class GitHubCommitsController extends MainClass {
	public function render() {
		$data = CustomData::get ();
		$data = isset ( $data ["github_commits"] ) ? $data ["github_commits"] : null;
		if (! $data) {
			return get_translation ( "please_configure_github_commits_module" );
		}
		$username = isset ( $data ["username"] ) ? $data ["username"] : null;
		$repository = isset ( $data ["repository"] ) ? $data ["repository"] : null;
		$count = isset ( $data ["count"] ) ? intval ( $data ["count"] ) : DEFAULT_GITHUB_COMMIT_COUNT;
		try {
			$adapter = new GitHubCommits ( $username, $repository, $count );
			
			$commits = $adapter->getCommits ();
			ViewBag::set ( "commits", $commits );
			return Template::executeModuleTemplate ( GITHUB_COMMITS_FOLDER_NAME, "commits.php" );
		} catch ( GitHubException $e ) {
			return get_translation ( $e->getMessage () );
		}
	}
}
