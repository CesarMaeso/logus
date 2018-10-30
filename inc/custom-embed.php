<?php
/**
 * Enable Foundation responsive embeds for WP video embeds
 * Credits:
 * Ole Fredrik Lie, https://github.com/olefredrik/FoundationPress/blob/master/library/foundation.php
 * MIT License. http://opensource.org/licenses/MIT
 */


/**
 * Enable Foundation responsive embeds for WP video embeds
 * 
 */
function logus_responsive_embed( $html, $url, $attr, $post_id ) {

		// Whitelist of oEmbed compatible sites that **ONLY** support video.
		// Cannot determine if embed is a video or not from sites that
		// support multiple embed types such as Facebook.
		// Official list can be found here https://codex.wordpress.org/Embeds
		$video_sites = array(
			'youtube', // first for performance
			'collegehumor',
			'dailymotion',
			'funnyordie',
			'ted',
			'videopress',
			'vimeo',
		);

		$is_video = false;

		// Determine if embed is a video
		foreach ( $video_sites as $site ) {
			// Match on `$html` instead of `$url` because of
			// shortened URLs like `youtu.be` will be missed
			if ( strpos( $html, $site ) ) {
				$is_video = true;
				break;
			}
		}

		// Process video embed
		if ( true == $is_video ) {

			// Find the `<iframe>`
			$doc = new DOMDocument();
			$doc->loadHTML( $html );
			$tags = $doc->getElementsByTagName( 'iframe' );

			// Get width and height attributes
			foreach ( $tags as $tag ) {
				$width  = $tag->getAttribute( 'width' );
				$height = $tag->getAttribute( 'height' );
				break; // should only be one
			}

			$class = 'responsive-embed'; // Foundation class

			// Determine if aspect ratio is 16:9 or wider
			if ( is_numeric( $width ) && is_numeric( $height ) && ( $width / $height >= 1.7 ) ) {
				$class .= ' widescreen'; // space needed
			}

			// Wrap oEmbed markup in Foundation responsive embed
			return '<div class="' . $class . '">' . $html . '</div>';

		} else { // not a supported embed
			return $html;
		}

	}
	add_filter( 'embed_oembed_html', 'logus_responsive_embed', 10, 4 );
