<?php

function add_media () {
	if ($_POST['type'] == 'movie')
		return add_movie($_POST['path'], $_POST['mTitle'], $_POST['mYear']);
	elseif ($_POST['type'] == 'series') 
		return add_series($_POST['path'], $_POST['sTitle'], $_POST['sSeason'], $_POST['sEpisode']);
	else 
		return false;
}

function add_movie ($path, $title, $year) {
	
	$media_dir = "/Volumes/Sam-PowerMac/media/movies";
	
	$dirname = dirname($path);
	$filename = basename($path);
	$extension = pathinfo($path)['extension'];
	
	// clean up title variable from illigal characters and whitespace
	$title = str_replace(' ', '_', trim($title));
	$title = str_replace('/', '', $title);
	$title = str_replace('~', '', $title);
	
	// clean up year variable from illigal characters and whitespace
	$year = str_replace(' ', '', trim($year));
	$year = str_replace('/', '', $year);
	$year = str_replace('~', '', $year);
	
	// create folder and file name
	$folder = $title.'_('.$year.')';
	$file = $title.'_('.$year.').'.$extension;
	
	// create movie directory in movie library to store media file 
	// if and only if path is valid and it does not exist already
	if (file_exists($path) && file_exists($media_dir) && !file_exists($media_dir.'/'.$folder)) 
		mkdir($media_dir.'/'.$folder);
	
	// copy media file to movie library in appropriate folder if and only if 
	// path is valid and a file does not exist already with same name
	if (file_exists($path) && file_exists($media_dir) && !file_exists($media_dir.'/'.$folder.'/'.$file)) 
		copy($path, $media_dir.'/'.$folder.'/'.$file);
	else 
		return false;
		
	// delete original media file if and only if copied over
	// assumes program would have existed function already if file was 
	// not copied in previous if statement
	if (file_exists($path) && file_exists($media_dir.'/'.$folder.'/'.$file)) 
		unlink($path);
	else 
		return false;
	
	return true;
}

function add_series ($path, $title, $season, $episode) {
	
	$media_dir = "/Volumes/Sam-PowerMac/media/tv-shows";
	
	$dirname = dirname($path);
	$filename = basename($path);
	$extension = pathinfo($path)['extension'];
	
	// clean up title variable from illigal characters and whitespace
	$title = str_replace(' ', '_', trim($title));
	$title = str_replace('/', '', $title);
	$title = str_replace('~', '', $title);
	
	// clean up season variable from illigal characters and whitespace
	$season = str_replace(' ', '', trim($season));
	$season = str_replace('/', '', $season);
	$season = str_replace('~', '', $season);
	
	// clean up episode variable from illigal characters and whitespace
	$episode = str_replace(' ', '', trim($episode));
	$episode = str_replace('/', '', $episode);
	$episode = str_replace('~', '', $episode);
	
	// create folder and file name
	$folder_series = $title;
	$folder_season = 'Season_'.$season;
	$file = $title.'_-_s'.$season.'e'.$episode.'.'.$extension;
	
	// create series directory in series library to store season folder 
	// if and only if path is valid and it does not exist already
	if (file_exists($path) && file_exists($media_dir) && !file_exists($media_dir.'/'.$folder_series)) 
		mkdir($media_dir.'/'.$folder_series);
		
	// create season directory in series library to store media file 
	// if and only if path is valid and it does not exist already
	if (file_exists($path) && file_exists($media_dir) && !file_exists($media_dir.'/'.$folder_series.'/'.$folder_season)) 
		mkdir($media_dir.'/'.$folder_series.'/'.$folder_season);
	
	// copy media file to series library in appropriate folder if and only if 
	// path is valid and a file does not exist already with same name
	if (file_exists($path) && file_exists($media_dir) && !file_exists($media_dir.'/'.$folder_series.'/'.$folder_season.'/'.$file)) 
		copy($path, $media_dir.'/'.$folder_series.'/'.$folder_season.'/'.$file);
	else 
		return false;
		
	// delete original media file if and only if copied over
	// assumes program would have existed function already if file was 
	// not copied in previous if statement
	if (file_exists($path) && file_exists($media_dir.'/'.$folder_series.'/'.$folder_season.'/'.$file)) 
		unlink($path);
	else 
		return false;
	
	return true;
}

if (add_media())
	echo 'success';
else 
	echo 'error';

?>




