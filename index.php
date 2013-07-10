<?php
	function listProjects($dbFile){
		$db	  = file($dbFile);
		foreach($db as $lineNum => $line){
			echo $lineNum." - ".$line."<br />";
		}
	}

	function delProject($conf, $dbFile, $projectUrl){
		exec($conf['path'].$conf['del'].' '.$dbFile.' '.$projectUrl);
	}

	function addProject($conf, $dbFile, $projectUrl){
		exec($conf['path'].$conf['add'].' '.$dbFile.' '.$projectUrl);
	}

	function createConfig($conf, $newUser){
		exec('cd '.$conf['path'].'; ./'.$conf['create'].' '.$newUser);
	}

	function getInfos($conf, $rss, $userFile){
		//generates rss file
		exec('cd '.$conf['path'].'; ./'.$conf['file'].' '.$userFile);
		//creates tmp/ if doesn't exist
		exec('if [[ ! -d tmp ]]; then mkdir tmp; fi');
		//copies rss file
		exec('cp '.$conf['path'].$rss.' tmp/');
		echo "<a href=\"".$rss."\">url</a>";
	}

	$user="shryver";
	$fileExt=".sh";
	$configFile="config/config.ini";

	$conf 	  = parse_ini_file($configFile);
	$userFile = $conf['path'].$conf['configPath'].$user.$fileExt;
	$userConf = parse_ini_file($userFile);
	$dbFile	  = $conf['path'].$userConf['BASEDB'].$userConf['SEP'].$userConf['USER'];
	$rss	  = $userConf['BASERSS'].$userConf['SEP'].$user.$userConf['ENDRSS'];

//	addProject($conf, $dbFile, 'testUrl');
//	delProject($conf, $dbFile, 'testUrl');
//	createConfig($conf, 'newUserTest');
	listProjects($dbFile);
	getInfos($conf, $rss, $userFile);
?>
