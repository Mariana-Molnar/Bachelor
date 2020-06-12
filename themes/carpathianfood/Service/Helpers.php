<?php

namespace Service;

class Helpers
{

	/**
	 * Show debug info
	 *
	 * @param string $var
	 * @param bool   $comments
	 */
	public static function show($var = '', $comments = false)
	{
		print ($comments ? '<!-- <pre>' : '<pre>');
		var_dump($var);
		print ($comments ? '</pre> -->' : '</pre>');
	}

	/**
	 * Show debug info and stop
	 *
	 * @param string $var
	 * @param bool   $comments
	 */
	public static function showx($var = '', $comments = false)
	{
		self::show($var, $comments);
		exit;
	}

	/**
	 * Get data from cache
	 *
	 * @param $transient_id
	 *
	 * @return bool|mixed
	 */
	public static function getFromCache($transient_id)
	{

		$cached = get_transient($transient_id);

		if ($cached === false) {
			return false;
		}

		return $cached;
	}

	/**
	 * Add data to cache
	 *
	 * @param $transient_id
	 * @param $data
	 */
	public static function addToCache($transient_id, $data, $expiration = DAY_IN_SECONDS)
	{

		set_transient($transient_id, $data, $expiration);
	}

	/**
	 * Remove data from cache
	 *
	 * @param $transient_id
	 */
	public static function clearCache($transient_id)
	{

		delete_transient($transient_id);
	}

	/**
	 * Clean title
	 *
	 * @param $title
	 *
	 * @return mixed
	 */
	public static function cleanTitle($title)
	{

		return preg_replace(
			['/\s*\(.*\)/', '/[*]+/'],
			'',
			$title
		);
	}

	/**
	 * Check if tab is active
	 *
	 * @param $active
	 * @param $current
	 * @param $class
	 *
	 * @return string
	 */
	public static function isActiveTab($active, $current, $class)
	{
		return $active === $current ? $class : '';
	}

	/**
	 * Convert image to base64
	 *
	 * @param $image
	 *
	 * @return string
	 */
	public static function imageToBase64($image)
	{
		$type = pathinfo($image, PATHINFO_EXTENSION);
		$data = file_get_contents($image);

		return 'data:image/'.$type.';base64,'.base64_encode($data);
	}

	/**
	 * Format date
	 *
	 * @param        $date
	 * @param string $format
	 *
	 * @return string
	 */

	public static function formatDate($date, $format = 'F j, Y')
	{
		$date = new \DateTime($date);

		return $date->format($format);
	}

	/**
	 * Parse string like 1w 2d 10h 10m 30s and return the number of seconds
	 * @param string    $time
	 * @param array     $time_settings
	 * @return bool|int
	 */
	public static function parseTimeText($time='', $time_settings = [])
	{
		$default_settings = [
			'w' => 7*24*60*60, // week (7d*24h*60m*60s)
			'd' => 24*60*60, // day (24h*60m*60s)
			'h' => 60*60, // hour (24h*60m*60s)
			'm' => 60, // minute (60s)
			's' => 1, // second
		];

		$settings = array_merge($default_settings, $time_settings);

		$stringtime = trim(strtolower($time));

		if (preg_match('/^(?:\d+[wdhms](?: +|$))+$/', $stringtime )) {
			$arr_time = explode(' ', $stringtime);
			$time = 0;
			foreach ($arr_time as $time_fragment) {
				$time_code = substr($time_fragment,-1);
				$time_value = intval($time_fragment);

				if (array_key_exists($time_code,$settings)) {
					$time += $time_value * $settings[$time_code];
				}
			}

			return $time;
		}
		return false;
	}


	/**
	 * Function camelcase convert text to camelcase word: 'some-teXt_for funcTionName' => 'SomeTextForFunctionname'
	 *
	 * @param       string $text
	 * @return      string
	 */
	public static function camelcase($text)
	{
		return str_replace(' ', '', ucwords(preg_replace('/[\-\_]/', ' ', strtolower($text))));
	}

	/**
	 * Function issetor return $var if is set or $default in other case
	 *
	 * @param   mixed $var
	 * @param   mixed $default (false for default)
	 * @return  mixed
	 */
	public static function issetor(&$var, $default = false)
	{
		return isset($var) ? $var : $default;
	}

	/**
	 * Function getPreviousUrl return the REFERER url for some page
	 *
	 * @param       string $default_url
	 * @return      string
	 */
	public static function getPreviousUrl($default_url = '')
	{
		if (isset($_SERVER["HTTP_REFERER"])) {
			return $_SERVER["HTTP_REFERER"];
		}

		return $default_url;
	}

	/**
	 * Set up the database tables which the plugin needs.
	 *
	 * @param       string $schema
	 */
	public static function createTables($schema)
	{
		global $wpdb;

		$wpdb->hide_errors();

		require_once(ABSPATH.'wp-admin/includes/upgrade.php');

		dbDelta($schema);
	}

	/**
	 * Set up the database table.
	 * @param       string $name
	 * @param       string $schema
	 */
	public static function createTable($name, $schema)
	{
		global $wpdb;

		$wpdb->hide_errors();

		require_once(ABSPATH.'wp-admin/includes/upgrade.php');

		maybe_create_table($name, $schema);
	}



	/**
	 *
	 * Added file (url or path) to media Library
	 *
	 * @param     $file
	 * @param int $post_id
	 */
	public static function addFileToMediaLibrary($file, $post_id = 0)
	{
		$filename = basename($file);
		$upload_file = wp_upload_bits($filename, null, file_get_contents($file));
		if (!$upload_file['error']) {
			$wp_filetype = wp_check_filetype($filename, null);
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_parent'    => $post_id,
				'post_title'     => preg_replace('/\.[^.]+$/', '', $filename),
				'post_content'   => '',
				'post_status'    => 'inherit'
			);
			$attachment_id = wp_insert_attachment($attachment, $upload_file['file'], $post_id);
			if (!is_wp_error($attachment_id)) {
				require_once(ABSPATH."wp-admin".'/includes/image.php');
				$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
				wp_update_attachment_metadata($attachment_id, $attachment_data);
			}
		}
	}


	/**
	 * get Id of attachment to post file by src value
	 * @param $post_id
	 * @param $src
	 * @return bool
	 */
	public static function getAttachmentIDOfPostBySrc($post_id, $src)
	{
		$args = array(
			'post_type'      => 'attachment',
			'posts_per_page' => -1,
			'post_status'    => 'any',
			'post_parent'    => $post_id
		);

		$attachments = get_posts($args);

		if (isset($attachments) && is_array($attachments)) {

			foreach ($attachments as $attachment) {
				$image = wp_get_attachment_image_src($attachment->ID, 'full');

				if (strpos($src, $image[0]) !== false) {
					return $attachment->ID;
					break;
				}
			}
		}

		return false;
	}


	/**
	 * updated function  checked(). Added check with array of possible values
	 * @param      $checked
	 * @param bool $current
	 * @param bool $echo
	 * @return string
	 */
	public static function checked($checked, $current = true, $echo = true)
	{
		if (is_array($checked)) {
			if (in_array($current, $checked)) {
				if ($echo) print 'checked="checked"';

				return 'checked="checked"';
			} else {
				return '';
			}
		} else {
			return checked($checked, $current, $echo);
		}
	}

	/**
	 * Updated function selected(). Added check with array of possible values
	 * @param      $selected
	 * @param bool $current
	 * @param bool $echo
	 * @return string
	 */
	public static function selected($selected, $current = true, $echo = true)
	{
		if (is_array($selected)) {
			if (in_array($current, $selected)) {
				if ($echo) print 'selected';

				return 'selected';
			} else {
				return '';
			}
		} else {
			return selected($selected, $current, $echo);
		}
	}

	/**
	 * replace month name to english from other locale language.
	 * @param        $foreignMonthName
	 * @param string $setlocale
	 * @param string $format
	 * @param string $platform
	 * @return mixed
	 */
	public static function getEnglishMonthName($foreignMonthName, $setlocale = 'nl_NL', $format = '%b', $platform = 'unix')
	{
		$locale = setlocale(LC_TIME, '0');

		switch ($platform) {
			case 'win' :
				setlocale(LC_TIME, 'English_Australia'); // windows locale
				break;
			case 'unix':
			default:
				setlocale(LC_TIME, 'en_US.utf8'); // unix locale
				break;
		}

		$month_numbers = range(1, 12);

		foreach ($month_numbers as $month) {
			$m = strftime($format, mktime(0, 0, 0, $month, 1, 2018));
			$english_months[] = $m;
			$english_months[] = strtolower($m);
		}

		setlocale(LC_TIME, $setlocale);

		foreach ($month_numbers as $month) {
			$m = strftime($format, mktime(0, 0, 0, $month, 1, 2018));
			$foreign_months[] = $m;
			$foreign_months[] = strtolower($m);
		}

		setlocale(LC_TIME, $locale); // return locale back

		return str_replace($foreign_months, $english_months, $foreignMonthName);
	}

	/**
	 * Truncate the text to the sentence closest to a certain number of characters
	 * @param        $text
	 * @param        $length           - number of characters. If < 0 truncate will be made from the end of the text.
	 * @param bool   $sentence_closest - if false truncate to the word closest
	 * @param string $tail             - added to the end(beginning) after truncate
	 * @return string
	 */
	public static function truncate($text, $length, $sentence_closest = true, $tail = '...')
	{

		if (empty($length)) return '';

		$text = strip_tags($text);
		if (strlen($text) < abs($length)) return $text;

		$matches = [];
		$delimiter_length = 0;
		if ($sentence_closest) {
			preg_match_all('/\.(\s|\t|\n|\r)/', $text, $matches, PREG_OFFSET_CAPTURE);
			$delimiter_length = 2;
		} else {
			preg_match_all('/(\s|\t|\n|\r)/', $text, $matches, PREG_OFFSET_CAPTURE);
			$delimiter_length = 1;
		}

		if ($length > 0) {

			$left = 0;
			$right = $length;

			if (!empty($matches) && !empty($matches[0])) {
				foreach ($matches[0] as $matches_item) {
					if ($matches_item[1] <= $length) {
						$left = $matches_item[1];
					} else {
						$right = $matches_item[1];
						break;
					}
				}
			}

			if (abs($length - $left) < abs($length - $right)) {
				return substr($text, 0, $left).$tail;
			} else {
				return substr($text, 0, $right).$tail;
			}
		} else {

			$left = abs($length);
			$right = abs($length);

			$text_length = strlen($text);

			if (!empty($matches) && !empty($matches[0])) {

				foreach ($matches[0] as $matches_item) {
					if ($matches[0]) {
						$pre_matches = reset($matches);

					}


					if ($text_length - $matches_item[1] >= abs($length)) {
						$left = $matches_item[1];
					} else {
						$right = $matches_item[1];
						break;
					}
				}
			}

			if (abs($text_length + $length - $left) < abs($text_length + $length - $right)) {
				return $tail.substr($text, $left + $delimiter_length);
			} else {
				return $tail.substr($text, $right + $delimiter_length);
			}
		}

	}

	public static function addTermsToTaxonomyByTitles($titles, $taxonomy)
	{
		if (empty($titles)) return false;

		if (!is_array($titles)) $titles = [$titles];

		$terms = get_terms([
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
		]);

		$existingterms = [];

		if (!empty($terms) && !is_wp_error($terms)) {
			foreach ($terms as $term) {
				$existingterms[strtolower($term->name)] = $term;
			}
		}

		$res = [];
		foreach ($titles as $title) {
			if (array_key_exists(strtolower(trim($title)), $existingterms)) {
				$res[] = [
					'term_id'          => $existingterms[strtolower(trim($title))]->term_id,
					'term_taxonomy_id' => $existingterms[strtolower(trim($title))]->term_taxonomy_id
				];
			} else {
				$res[] = wp_insert_term(trim($title), $taxonomy);
			}
		}

		return $res;
	}

	/**
	 * Get template page link
	 * @param $template
	 * @return null|string
	 */
	public static function getTemplatePageLink($template)
	{

		$page = query_posts(array(
			'post_type'      => 'page',
			'meta_key'       => '_wp_page_template',
			'meta_value'     => $template,
			'posts_per_page' => 1
		));

		if (!empty($page)) {
			return get_page_link($page[0]->ID);
		}

		return '#';
	}

	/**
	 * Create slug
	 * @param $str
	 * @param $delimiter
	 * @return null|string
	 */
	public static function createSlug($str, $delimiter = '_')
	{
		$slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));

		return $slug;
	}

	public static function languageSwitcher() {
        $languages = apply_filters( 'wpml_active_languages', NULL, array( 'skip_missing' => 0 ) );
        $current_lang = '';
        $items = '<ul class="language-switcher">';
        if( !empty( $languages ) ) {
            foreach( $languages as $language ) {
                if ($language['active'] ) {
                    $current_lang = $language['language_code'];
                } else {
                    $items .= '<li class="language-switcher-item"> <a href="' . $language['url'] . '" class="language-switcher-title">' . $language['language_code'] . '</a></li>';
                }
            }
        }
        $items .= '</ul>';
        $items = '<span class="language-switcher-current"><p class="d-block d-sm-block d-md-none">Language: </p>' . $current_lang . ' <i class="icon icon-down-arrow"></i></span>' . $items;
        return $items;
    }

}
