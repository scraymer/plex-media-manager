<?php

function get_media ($dir, $ext) {

	$files = Array();
	
	//
	// code to fix bracket issue by excaping them 
	// https://bugs.php.net/bug.php?id=33047
	//
	// First, replace all brackets with an escaped bracket
	$dir = str_replace('[', '\[', $dir);
	$dir = str_replace(']', '\]', $dir);
	// Next, replace all "escaped" brackets with brackets like so
	$dir = str_replace('\[', '[[]', $dir);
	$dir = str_replace('\]', '[]]', $dir);
	
	foreach (glob($dir.'*.{'.$ext.'}', GLOB_MARK | GLOB_BRACE) as $item) {
	
		if (substr($item, -1) != DIRECTORY_SEPARATOR)
			array_push($files, $item);
		else
			$files = array_merge($files, get_media($item, $ext));
	}
	
	foreach (glob($dir.'*', GLOB_MARK | GLOB_ONLYDIR) as $item) 
		$files = array_merge($files, get_media($item, $ext));
	
	return $files;
}

function display_media () {
	
	$media_dir = '/Users/sam/Downloads/uTorrent/complete';
	$media_extensions = 'avi,mkv,mp4,mov';
	
	foreach (get_media($media_dir, $media_extensions) as $key => $path) {
		
		$dirname = dirname($path);
		$filename = basename($path);
		$extension = pathinfo($path)['extension'];
		
		echo '<div class="col-xs-12 col-md-6" id="form-container-'.$key.'">';
			echo '<form class="form-horizontal well" role="form" id="form-'.$key.'" method="POST" action="php/add_media.php" style="min-height:205px">';
				echo '<div class="form-group">';
					echo '<div class="col-xs-12 text-center">';
						echo '<label class="lead">'.$filename.'</label>';
						//echo '<input type="hidden" name="filename" value="'.$filename.'" />';
						//echo '<input type="hidden" name="dirname" value="'.$dirname.'" />';
						echo '<input type="hidden" name="path" value="'.$path.'" />';
					echo '</div>';
				echo '</div>';
				echo '<div class="form-group" id="form-grp-movie-'.$key.'">';
					echo '<div class="col-xs-12">';
						echo '<div class="input-group input-group-multiple">';
							echo '<input type="text" name="mTitle" class="form-control form-control-8" placeholder="Movie Title" />';
							echo '<input type="text" name="mYear" class="form-control form-control-2" placeholder="Year" />';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="form-group hidden" id="form-grp-series-'.$key.'">';
					echo '<div class="col-xs-12">';
						echo '<div class="input-group input-group-multiple">';
							echo '<input type="text" name="sTitle" class="form-control form-control-7" placeholder="Series Title" />';
							echo '<input type="text" name="sSeason" class="form-control form-control-1-5" placeholder="Season" />';
							echo '<input type="text" name="sEpisode" class="form-control form-control-1-5" placeholder="Episode" />';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="form-group" id="form-grp-action-'.$key.'">';
					echo '<div class="col-xs-12 text-center">';
						echo '<div class="btn-group btn-group-justified" data-toggle="buttons">';
							echo '<label class="btn btn-default active" id="form-btn-movie-'.$key.'">';
								echo '<input type="radio" name="type" value="movie" id="type1" checked> Movie';
							echo '</label>';
							echo '<label class="btn btn-default" id="form-btn-series-'.$key.'">';
								echo '<input type="radio" name="type" value="series" id="type2"> Series';
							echo '</label>';
							echo '<div class="btn-group" data-toggle="button" id="form-btn-submit-'.$key.'">';
								echo '<input type="submit" data-loading-text="Loading..." value="Add Media File" class="btn btn-warning" />';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="form-group hidden" id="form-grp-status-'.$key.'">';
					echo '<div class="col-xs-12 text-center">';
						echo '<div class="alert alert-warning" id="form-status-alert-'.$key.'">';
							echo '<p>You should not be seeing this message right now. This is not the message you are looking for, move along.</p>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</form>';
			echo '<script>';
				echo '$("#form-btn-series-'.$key.'").click(function () {';
					echo '$("#form-grp-movie-'.$key.'").addClass("hidden");';
					echo '$("#form-grp-series-'.$key.'").removeClass("hidden")';
				echo '});';
				echo '$("#form-btn-movie-'.$key.'").click(function () {';
					echo '$("#form-grp-series-'.$key.'").addClass("hidden");';
					echo '$("#form-grp-movie-'.$key.'").removeClass("hidden")';
				echo '});';
				echo '$("#form-btn-submit-'.$key.'").click(function () {';
					echo '$("#form-btn-submit-'.$key.' input").button("loading");';
					echo '$("#form-'.$key.'").ajaxSubmit(function(status) {';
						echo '$("#form-grp-movie-'.$key.'").addClass("hidden");';
						echo '$("#form-grp-series-'.$key.'").addClass("hidden");';
						echo '$("#form-grp-action-'.$key.'").addClass("hidden");';
						echo '$("#form-status-alert-'.$key.'").removeClass();';
						echo 'if (status.indexOf("success") != -1) {';
							echo '$("#form-status-alert-'.$key.'").addClass("alert alert-success");';
							echo '$("#form-status-alert-'.$key.' p").text("Media file added successfully!");';
						echo '} else {';
							echo '$("#form-status-alert-'.$key.'").addClass("alert alert-danger");';
							echo '$("#form-status-alert-'.$key.' p").text("Something went terribly wrong... what have we done!!!");';
						echo '}';
						echo '$("#form-grp-status-'.$key.'").removeClass("hidden");';
						echo 'return status;';
					echo '});';
				echo '});';
			echo '</script>';
		echo '</div>';
	}
}

display_media();

?>
