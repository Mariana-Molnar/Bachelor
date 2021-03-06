<?php
/**
 * Create and register taxonomies for the plugin.
 * @author     Timon
 */

namespace Service;


class TaxonomyCreator
{

	private static $postTypes = [];
	private static $labels = [];
	private static $args = [];
	private static $machineNames = [];
	private static $filters = [];
	private static $actions = [];

	/**
	 * Added taxonomy args to array for registering
	 *
	 * @param $machineName         - name of taxonomy
	 * @param $text_domain         - plugin textdomain
	 * @param $singularName        - singular name for labels
	 * @param $pluralName          - plural name for labels
	 * @param $postTypeMachineName - name of PostType where should be taxonomy
	 */
	public static function addTaxonomy($machineName, $singularName, $pluralName, $postTypeMachineName)
	{

		if (in_array($machineName, self::$machineNames)) {
			self::addPostType($postTypeMachineName, $machineName);
		} else {

			self::$labels[$machineName] = [
				'name'                       => $pluralName,
				'singular_name'              => $singularName,
				'menu_name'                  => $singularName,
				'all_items'                  => _x('All Items', 'Taxonomy Creator'),
				'parent_item'                => _x('Parent Item', 'Taxonomy Creator'),
				'parent_item_colon'          => _x('Parent Item:', 'Taxonomy Creator'),
				'new_item_name'              => _x('New Item Name', 'Taxonomy Creator'),
				'add_new_item'               => _x('Add New Item', 'Taxonomy Creator'),
				'edit_item'                  => _x('Edit Item', 'Taxonomy Creator'),
				'update_item'                => _x('Update Item', 'Taxonomy Creator'),
				'view_item'                  => _x('View Item', 'Taxonomy Creator'),
				'separate_items_with_commas' => _x('Separate items with commas', 'Taxonomy Creator'),
				'add_or_remove_items'        => _x('Add or remove items', 'Taxonomy Creator'),
				'choose_from_most_used'      => _x('Choose from the most used', 'Taxonomy Creator'),
				'popular_items'              => _x('Popular Items', 'Taxonomy Creator'),
				'search_items'               => _x('Search Items', 'Taxonomy Creator'),
				'not_found'                  => _x('Not Found', 'Taxonomy Creator'),
				'no_terms'                   => _x('No items', 'Taxonomy Creator'),
				'items_list'                 => _x('Items list', 'Taxonomy Creator'),
				'items_list_navigation'      => _x('Items list navigation', 'Taxonomy Creator'),
			];


			$args = [
				'labels'            => self::$labels[$machineName],
				'hierarchical'      => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'query_var'         => true,
				'show_tagcloud'     => false,
			];
//

			self::$args[$machineName] = $args;
			self::$postTypes[$machineName] = $postTypeMachineName;

			self::$machineNames[] = $machineName;
			self::$filters = [];
			self::$actions = [];
		}
	}

	/**
	 * Change args for some Taxonomy
	 *
	 * @param array  $args        - args that should be changed
	 * @param string $machineName - name of Taxonomy
	 */
	public static function setArgs(array $args, $machineName)
	{
		self::$args[$machineName] = array_merge(self::$args[$machineName], $args);
	}

	/**
	 * Changes labels for Taxonomy
	 *
	 * @param array  $labels      - new labels
	 * @param string $machineName - name of Taxonomy
	 */
	public static function setLabels($labels, $machineName)
	{
		self::$labels[$machineName] = array_merge(self::$labels[$machineName], $labels);
		$args = [
			'labels' => self::$labels[$machineName],
		];
		self::setArgs($args, $machineName);
	}

	/**
	 * Changed PostTypes for Taxonomy
	 *
	 * @param array  $postTypes   - array of new PostTypes
	 * @param string $machineName - name of Taxonomy
	 */
	public static function setPostTypes(array $postTypes, $machineName)
	{
		self::$postTypes[$machineName] = $postTypes;
	}

	/**
	 * Added new PostType where should be Taxonomy
	 *
	 * @param string $postTypeMachineName - name of PostType
	 * @param string $machineName         - name of Taxonomy
	 */
	public static function addPostType($postTypeMachineName, $machineName)
	{
		$curPostTypes = self::$postTypes[$machineName];

		$postTypes = [];
		if (!empty($curPostTypes)) {
			if (is_array($curPostTypes)) {
				$postTypes = $curPostTypes;
			} else {
				$postTypes = [$curPostTypes];
			}
		}

		$postTypes[] = $postTypeMachineName;

		self::$postTypes[$machineName] = array_unique($postTypes);
	}

	/**
	 * Added hooks for Taxonomy
	 *
	 */
	public static function addHook($machineName, $hook, $hooktag, $callback, $priority = 10, $argscount = 1)
	{
		if (empty($hook) || empty($hooktag) || empty($callback) || !in_array($hook, ['filter', 'action'])) {
			return false;
		}

		switch ($hook) {
			case 'filter':
				self::$filters[$machineName][$hooktag][] = ['callback' => $callback, 'priority' => $priority, 'args' => $argscount];
				break;
			case 'action':
				self::$actions[$machineName][$hooktag][] = ['callback' => $callback, 'priority' => $priority, 'args' => $argscount];
				break;
		}

		return true;
	}


	/**
	 * Registered all hooks for Taxonomy
	 */
	public static function registerTaxonomy()
	{
		if (!empty(self::$machineNames)) {
			foreach (self::$machineNames as $machineName) {
				register_taxonomy($machineName, self::$postTypes[$machineName], self::$args[$machineName]);
			}
		}
	}

	/**
	 * Registered all taxonomies
	 */
	public static function registerHooks()
	{

		if (!empty(self::$machineNames)) {

			foreach (self::$machineNames as $machineName) {

				if (!empty(self::$filters[$machineName])) {
					foreach (self::$filters[$machineName] as $hooktag => $hookarr) {
						foreach ($hookarr as $hookconfig) {
							add_filter($hooktag, $hookconfig['callback'], $hookconfig['priority'], $hookconfig['args']);
						}
					}
				}

				if (!empty(self::$actions[$machineName])) {
					foreach (self::$actions[$machineName] as $hooktag => $hookarr) {
						foreach ($hookarr as $hookconfig) {
							add_action($hooktag, $hookconfig['callback'], $hookconfig['priority'], $hookconfig['args']);
						}
					}
				}

			}
		}
	}

	/**
	 * Added function for registered taxonomies and hooks to init action
	 */
	public static function addToInit()
	{
		add_action('init', [self::class, 'registerTaxonomy']);
		self::registerHooks();
	}

}