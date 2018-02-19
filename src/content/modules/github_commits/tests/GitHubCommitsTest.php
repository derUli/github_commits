<?php
class GitHubCommitsTest extends PHPUnit_Framework_TestCase {
	public function testGetCommits1() {
		$commits = new GitHubCommits ( "derUli", "ulicms", 10 );
		$commits = $commits->getCommits ();
		$this->assertCount ( 10, $commits );
		$commits = new GitHubCommits ( "derUli", "ulicms", 5 );
		$commits = $commits->getCommits ();
		$this->assertCount ( 5, $commits );
		$this->assertEquals ( 40, strlen ( $commits [0]->sha ) );
		$this->assertGreaterThan ( 1, strlen ( $commits [1]->message ) );
		$this->assertGreaterThan ( 1, strlen ( $commits [1]->author ) );
		$this->assertEquals ( "http://github.com/derUli/ulicms/commit/" . $commits [0]->sha, $commits [0]->url );
		$this->assertGreaterThan ( mktime ( 0, 0, 0, 1, 1, 2000 ), strtotime ( $commits [0]->date ) );
	}
	public function testGetCommits2() {
		$commits = new GitHubCommits ( "curl", "curl", 5 );
		$commits = $commits->getCommits ();
		$this->assertCount ( 5, $commits );
		$this->assertEquals ( 40, strlen ( $commits [0]->sha ) );
		$this->assertGreaterThan ( 1, strlen ( $commits [1]->message ) );
		$this->assertGreaterThan ( 1, strlen ( $commits [1]->author ) );
		$this->assertEquals ( "http://github.com/curl/curl/commit/" . $commits [0]->sha, $commits [0]->url );
		$this->assertGreaterThan ( mktime ( 0, 0, 0, 1, 1, 2000 ), strtotime ( $commits [0]->date ) );
	}
	public function testGetCommitsNotExistant() {
		try {
			$commits = new GitHubCommits ( "not", "here", 5 );
			$this->fail ( "Expected Exception has not been raised." );
		} catch ( GitHubException $e ) {
			$this->assertEquals ( "github_commits_query_failed", $e->getMessage () );
		}
	}
}