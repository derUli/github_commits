<?php

use UliCMS\Utils\CacheUtil;

class GitHubCommits {
	private $commits = array ();
	public function __construct($username, $repository, $count) {
		$url = "http://api.github.com/repos/$username/$repository/commits";
		
		$cacheAdapter = CacheUtil::getAdapter ();
		$cached = ($cacheAdapter && $cacheAdapter->get ( md5 ( $url ) ));
		$data = $cached ? $cacheAdapter->get ( md5 ( $url ) ) : @file_get_contents ( $url );
		
		if (! $data) {
			throw new GitHubException ( "github_commits_query_failed" );
		}
		// cache for one hour
		if (! $cached and $cacheAdapter) {
			// Minimum 2 hours cache for commits, even if cache_period is lower
			$cacheTtl = CacheUtil::getCachePeriod () > (60 * 60 * 2) ? CacheUtil::getCachePeriod () : (60 * 60 * 2);
			$cacheAdapter->set ( md5 ( $url ), $data, $cacheTtl );
		}
		$data = json_decode ( $data, true );
		$i = 0;
		foreach ( $data as $commit ) {
			$i ++;
			$cm = new GitHubCommit ();
			$cm->sha = $commit ["sha"];
			$cm->url = "http://github.com/$username/$repository/commit/" . $cm->sha;
			$cm->message = $commit ["commit"] ["message"];
			$cm->message = StringHelper::linesFromString ( $cm->message, true, false, false );
			$cm->message = $cm->message [0];
			$cm->date = $commit ["commit"] ["author"] ["date"];
			$cm->author = $commit ["commit"] ["author"] ["name"];
			$this->commits [] = $cm;
			if ($count > 0 && $i >= $count) {
				break;
			}
		}
	}
	public function getCommits() {
		return $this->commits;
	}
}