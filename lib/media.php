<?php

function get_files ($dir, $ext) {

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
			$files = array_merge($files, get_files($item, $ext));
	}
	
	foreach (glob($dir.'*', GLOB_MARK | GLOB_ONLYDIR) as $item) 
		$files = array_merge($files, get_files($item, $ext));
	
	return $files;
}

function display_files () {
	
	foreach (get_files("/Users/sam/Downloads/complete", "avi,mkv,mp4") as $key => $path) {
		
		$filename = basename($path);
		
		echo '<div class="col-xs-12 col-md-6">';
			echo '<form class="form-horizontal well" role="form" id="fileform-'.$key.'">';
				echo '<div class="form-group">';
					echo '<div class="col-xs-12" style="text-align:center">';
						echo '<label class="lead">'.$filename.'</label>';
						echo '<input type="hidden" name="filename" value="'.$filename.'" />';
					echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
					echo '<div class="col-xs-12">';
						echo '<div class="input-group input-group-multiple">';
							echo '<input type="text" name="mTitle" class="form-control form-control-8" placeholder="Movie Title" />';
							echo '<input type="text" name="mYear" class="form-control form-control-2" placeholder="Year" />';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="form-group hidden">';
					echo '<div class="col-xs-12">';
						echo '<div class="input-group input-group-multiple">';
							echo '<input type="text" name="sTitle" class="form-control form-control-7" placeholder="Series Title" />';
							echo '<input type="text" name="sSeason" class="form-control form-control-1-5" placeholder="Season" />';
							echo '<input type="text" name="sEpisode" class="form-control form-control-1-5" placeholder="Episode" />';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
					echo '<div class="col-xs-12" style="text-align:center">';
						echo '<div class="btn-group btn-group-justified" data-toggle="buttons">';
							echo '<label class="btn btn-default active" onclick="setMediaType(this, false);">';
								echo '<input type="radio" name="type" value="movie" id="type1" checked> Movie';
							echo '</label>';
							echo '<label class="btn btn-default" onclick="setMediaType(this, true);">';
								echo '<input type="radio" name="type" value="series" id="type2"> Series';
							echo '</label>';
							echo '<div class="btn-group" data-toggle="button">';
								echo '<input type="submit" value="Add Media File" class="btn btn-warning" />';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</form>';
		echo '</div>';
	}
}

display_files();

?>