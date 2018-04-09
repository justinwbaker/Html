<?php

	require_once 'config.php';

	function createUser($username, $UUID, $name, $lastname, $age, $gender) {
		$file_path = "../../users/template.json";
		$file = "../../users/2018/" . $username . "-" . $UUID . ".json";
		
		$template = file_get_contents($file_path);
		$user = json_decode($template);

		$user->UUID = $UUID;
		$user->gamerTag = $username;
		$user->name = $name;
		$user->lastname = $lastname;
		$user->age = (int)$age;
		$user->gender = $gender;

		$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, json_encode($user, JSON_PRETTY_PRINT));
		fclose($fh);
	}

	function addGameToUser($username, $UUID, $game) {
		$game_path = "../../games/". $game.".json";
		$user_path = "../../users/2018/" . $username . "-" . $UUID . ".json";

		$game_string = file_get_contents($game_path);
		$game_json = json_decode($game_string);

		$user_string = file_get_contents($user_path);
		$user = json_decode($user_string);
		if(!isset($user->games->$game)){
			$user->games->$game = $game_json;
		}else {
			echo "user already has Game";
		}

		$fh = fopen($user_path, 'w') or die("can't open file");
		fwrite($fh, json_encode($user, JSON_PRETTY_PRINT));
		fclose($fh);
	}

	function getValue($username, $UUID, $game, $variable) {
		$file_path = "../../users/2018/" . $username . "-" . $UUID . ".json";

		$return = "null";

		if(file_get_contents($file_path)) {
			$user_string = file_get_contents($file_path);
			$user_json = json_decode($user_string);

			$return = $user_json->games->$game->$variable;
		} else {
			$return = "player not found";
		}
		return $return;
	}

	function getTimeValue($username, $UUID, $game, $time, $variable) {
		$file_path = "../../users/2018/" . $username . "-" . $UUID . ".json";

		$user_string = file_get_contents($file_path);
		$user_json = json_decode($user_string);

		echo "Hello";
		return $user_json->games->$game->$time->$variable;
	}

	function setValue($username, $UUID, $game, $variable, $value) {
		$file_path = "../../users/2018/" . $username . "-" . $UUID . ".json";

		$user_string = file_get_contents($file_path);
		$user_json = json_decode($user_string);

		if(isset($user_json->games->$game)){
			$user_json->games->$game->$variable = $value;
		}else {
			echo "game does not exist";
		}

		$fh = fopen($file_path, 'w') or die("can't open file");
		fwrite($fh, json_encode($user_json, JSON_PRETTY_PRINT));
		fclose($fh);
	}

	function setTimeValue($username, $UUID, $game, $time, $variable, $value) {
		$file_path = "../../users/2018/" . $username . "-" . $UUID . ".json";

		$user_string = file_get_contents($file_path);
		$user_json = json_decode($user_string);

		if(isset($user_json->games->$game)){
			$user_json->games->$game->$time->$variable = $value;
		}else {
			echo "game does not exist";
		}

		$fh = fopen($file_path, 'w') or die("can't open file");
		fwrite($fh, json_encode($user_json, JSON_PRETTY_PRINT));
		fclose($fh);
	}

?>