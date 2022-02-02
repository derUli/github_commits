<?php
$commits = ViewBag::get ( "commits" );
?>
<div class="git-commits">
	<ul>
<?php foreach($commits as $commit){?>
<li>
			<div class="commit">
				<p>
					<a href="<?php esc($commit->url);?>" target="_blank"><?php esc($commit->message);?></a>
					<br /> <small><?php secure_translation("by_x_at_time_x", array("%author%" => $commit->author, "%time%" => PHP81_BC\strftime("%X %x", strtotime($commit->date))));?></small>
				</p>
			</div>
		</li>
<?php }?>
	</ul>
</div>