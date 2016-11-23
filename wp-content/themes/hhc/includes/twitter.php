<?php

	ini_set('display_errors', 1);
	require_once('TwitterAPIExchange.php');
	$settings = array(
	    'oauth_access_token' => "22145796-WE2UfcveVgZS4Q0GJR0rg98QSIgGLGPONV7XLQBql",
	    'oauth_access_token_secret' => "BxhBLxU8lZ8CSLsppY1UhhSpFzDjoHrBKcGMejAf41A",
	    'consumer_key' => "YJoxSOm0UH8Jnj9EtJdS3g",
	    'consumer_secret' => "bF1x4WQv0VXcP9KT4FfojC5hlaCWEr7tq5xe4t8xA"
	);

	// perform GET request
	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?username=hopeandhomes';
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	$results = $twitter->setGetfield($getfield)
	             ->buildOauth($url, $requestMethod)
	             ->performRequest();
	$tweets = json_decode($results,true);
	//var_dump($tweets);

	echo '<ul class="post-grid tweets">';

	// for each tweet...
	$counter = 0;
	foreach ($tweets as $post) {

		if ($counter++ < 3) {

			// get tweet data
			$entities = $post['entities'];
			$date = new DateTime($post['created_at']);
			$formatted_date = $date->format('H:i, d M Y');

			echo '<li class="tweet">';

				// tweet image
				if (ISSET($entities['media'])) {
					$media = $entities['media'];
					$first_media = $media[0];
					$media_url = $first_media['media_url'];
					echo '<div class="img-holder"><img src="' . $media_url . '"></div>';
				} else echo '<div class="img-holder no-image"></div>';

				// tweet text
				echo '<div class="tweet-inner">';
					echo '<div class="post-content">';
						echo '<div class="twitter-screen-name">' . $post['user']['name'] . '</div>';
						echo '<a target="_blank" href="http://www.twitter.com/' . $post['user']['screen_name'] . '" class="twitter-username">@' . $post['user']['screen_name'] . '</a>';
						echo '<div class="twitter-text">' . $post['text'] . '</div>';
						echo '<div class="twitter-time">' . $formatted_date . '</div>';
						echo '<a target="_blank" class="twitter-cta" href="http://www.twitter.com/' . $post['user']['screen_name'] . '/status/' . $post['id_str'] . '/" class="twitter-username">View Tweet</a>';
					echo '</div>';
				echo '</div>';
			echo '</li>';
		}
	}

	// follow us box
	echo '<li class="tweet">';
		echo '<div class="img-holder no-image"></div>';
		echo '<div class="tweet-inner">';
			echo '<div class="post-content">';
				echo '<div class="twitter-screen-name">' . $post['user']['name'] . '</div>';
				echo '<a target="_blank" href="http://www.twitter.com/' . $post['user']['screen_name'] . '" class="twitter-username">@' . $post['user']['screen_name'] . '</a>';
				echo '<div class="twitter-text"></div>';
				echo '<div class="twitter-time">&nbsp;</div>';
				echo '<a target="_blank" class="twitter-cta" href="http://www.twitter.com/' . $post['user']['screen_name'] . '" class="twitter-username">Follow Us</a>';
			echo '</div>';
		echo '</div>';
	echo '</li>';

	echo "</ul>";

?>