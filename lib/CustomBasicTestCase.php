<?php

/**
 * @file
 * CustomBasicTestCase.php.
 */


$SETTINGS = parse_ini_file("conf/config.ini", true);

$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

define('DRUPAL_ROOT', $SETTINGS['PATHS']['DRUPAL_ROOT']);

use PHPUnit\Framework\TestCase;

require DRUPAL_ROOT . '/includes/bootstrap.inc';

drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

/**
 * CustomBasicTestCase class.
 *
 * Set all custom variables required to start the unit testing.
 */
class CustomBasicTestCase extends TestCase {

  // Path defined in ini file for json files.
  private $path;

  // Primary variables to test.
  protected $variables;
  protected $modules;
  protected $themes;
  protected $roles;
  protected $entities;
  protected $contentTypes;
  protected $users;
  protected $contexts;
  protected $views;
  protected $menus;
  protected $vocabulary;
  protected $formats;
  protected $imageStyles;
  protected $dateFormats;
  protected $exceptionMessages;

  /**
   * Public __construct().
   *
   * Init all variables.
   */
  public function __construct() {
    $SETTINGS = parse_ini_file("conf/config.ini", true);
    $this->path = $SETTINGS['PATHS']['JSON_FILES'];
    $this->modules['system'] = $this->setSystemModules();
    $this->modules['test'] = $this->setTestModules();
    $this->roles['system'] = $this->setSystemRoles(user_roles());
    $this->roles['test'] = $this->setTestRoles();
    $this->contentTypes['system'] = $this->setSytemContentTypes();
    $this->contentTypes['test'] = $this->setTestContentTypes();
    $this->contexts['system'] = $this->setSystemContexts();
    $this->contexts['test'] = $this->setTestContexts();
    $this->entities['system'] = $this->setSystemEntities();
    $this->entities['test'] = $this->setTestEntities();
    $this->themes['system'] = $this->setThemesConfig();
    $this->themes['test'] = $this->setTestThemes();
    $this->views['system'] = $this->setSystemViews();
    $this->views['test'] = $this->setTestViews();
    $this->menus['system'] = $this->setSystemMenus();
    $this->menus['test'] = $this->setTestMenus();
    $this->formats['system'] = $this->setSystemFormats();
    $this->formats['test'] = $this->setTestFormats();
    $this->dateFormats['system'] = $this->setSystemDateFormats();
    $this->dateFormats['test'] = $this->SetTestDateFormats();
    $this->imageStyles['system'] = $this->setSystemImageStyles();
    $this->imageStyles['test'] = $this->setTestImageStyles();
    $this->vocabulary['system'] = $this->setSystemVocabluary();
    $this->vocabulary['test'] = $this->setTestVocabulary();
    $this->variables['test'] = $this->setTestVariables();
    $this->users = $this->setUsers();
    $this->exceptionMessages = array();
  }

  /**
   * Protected function handleAssertException().
   *
   * Store an exception message of a test in progress,
   * and verify if the message is the sting expected.
   *
   * @param object $exception
   *   The current exception caught in a test.
   */
  protected function handleAssertException($exception) {
    array_push(
      $this->exceptionMessages,
      $exception->getMessage()
    );
    $this->assertEquals(
      end($this->exceptionMessages),
      $exception->getMessage(),
      "Failed asserting thatg the exception message is the expected string."
    );
  }

  /**
   * Protected function checkAllAssertionsPassedWholeTest().
   *
   * Verify if the exception messages array is still empty,
   * at the end of a test case.
   */
  protected function checkAllAssertionsPassedWholeTest() {
    $this->assertEmpty(
      $this->exceptionMessages,
      "Failed asserting that no exceptions occured during the current test.\r\n"
      . implode("\r\n", $this->exceptionMessages)
    );
  }

  /**
   * Private function setSystemModules().
   *
   * Group sytem modules in core, contrib, custom, features, and themes.
   */
  private function setSystemModules() {
    $query = db_select('system', 's');
    $query->fields('s', array('filename', 'name', 'status'));
    $query->condition('s.type', array('module', 'theme'), 'IN');
    $result = $query->execute();
    $modules = $result->fetchAll();
    $modules['system']['core'] = $this->setSystemCoreModules($modules);
    $modules['system']['contrib'] = $this->setSystemContribModules($modules);
    $modules['system']['custom'] = $this->setSystemCustomModules($modules);
    $modules['system']['features'] = $this->setSystemFeaturesModules($modules);
    $modules['system']['themes'] = $this->setSystemThemeModules($modules);
    return $modules['system'];
  }

  /**
   * Private function setSystemCoreModules().
   *
   * Set system core modules in the proper array.
   *
   * @param array $modules
   *   The primary propety for the class 'modules'.
   */
  private function setSystemCoreModules(&$modules) {
    $core_modules = array(
      'enabled' => array(),
      'disabled' => array(),
    );
    foreach ($modules as $key => $module) {
      if (substr($module->filename, 0, 8) == 'modules/') {
        $module->status
        ? array_push($core_modules['enabled'], $module->name)
        : array_push($core_modules['disabled'], $module->name);
        unset($modules[$key]);
      }
    }
    return $core_modules;
  }

  /**
   * Private function setSystemContribModules().
   *
   * Set system contrib modules in the proper array.
   *
   * @param array $modules
   *   The primary propety for the class 'modules'.
   */
  private function setSystemContribModules(&$modules) {
    $contrib_modules = array(
      'enabled' => array(),
      'disabled' => array(),
    );
    foreach ($modules as $key => $module) {
      if (substr($module->filename, 0, 26) == 'sites/all/modules/contrib/') {
        $module->status
        ? array_push($contrib_modules['enabled'], $module->name)
        : array_push($contrib_modules['disabled'], $module->name);
        unset($modules[$key]);
      }
    }
    return $contrib_modules;
  }

  /**
   * Private function setSystemCustomModules().
   *
   * Set system contrib modules in the proper array.
   *
   * @param array $modules
   *   The primary propety for the class 'modules'.
   */
  private function setSystemCustomModules(&$modules) {
    $custom_modules = array(
      'enabled' => array(),
      'disabled' => array(),
    );
    foreach ($modules as $key => $module) {
      if (substr($module->filename, 0, 25) == 'sites/all/modules/custom/') {
        $module->status
        ? array_push($custom_modules['enabled'], $module->name)
        : array_push($custom_modules['disabled'], $module->name);
        unset($modules[$key]);
      }
    }
    return $custom_modules;
  }

  /**
   * Private function setSystemFeaturesModules().
   *
   * Set system features modules in the proper array.
   *
   * @param array $modules
   *   The primary propety for the class 'modules'.
   */
  private function setSystemFeaturesModules(&$modules) {
    $features_modules = array(
      'enabled' => array(),
      'disabled' => array(),
    );
    foreach ($modules as $key => $module) {
      if (substr($module->filename, 0, 27) == 'sites/all/modules/features/') {
        $module->status
        ? array_push($features_modules['enabled'], $module->name)
        : array_push($features_modules['disabled'], $module->name);
        unset($modules[$key]);
      }
    }
    return $features_modules;
  }

  /**
   * Private function setSystemThemeModules().
   *
   * Set system themes modules in the proper array.
   *
   * @param array $modules
   *   The primary propety for the class 'modules'.
   */
  private function setSystemThemeModules(&$modules) {
    $theme_modules = array(
      'enabled' => array(),
      'disabled' => array(),
    );
    foreach ($modules as $key => $module) {
      if (substr($module->filename, 0, 17) == 'sites/all/themes/' ||
          substr($module->filename, 0, 7) == 'themes/') {
        $module->status
        ? array_push($theme_modules['enabled'], $module->name)
        : array_push($theme_modules['disabled'], $module->name);
        unset($modules[$key]);
      }
    }
    return $theme_modules;
  }

  /**
   * Private function setSystemEntities().
   *
   * Set system config for entities in the proper array.
   */
  private function setSystemEntities() {
    return entity_get_info();
  }

  /**
   * Private function setThemesConfig().
   *
   * Set system config for themes in the proper array.
   */
  private function setThemesConfig() {
    return list_themes();
  }

  /**
   * Private function setSystemContexts().
   *
   * Set system config for contexts in the proper array.
   */
  private function setSystemContexts() {
    return context_active_contexts();
  }

  /**
   * Private function setSystemViews().
   *
   * Set system config for views in the proper array.
   */
  private function setSystemViews() {
    return views_get_all_views();
  }

  /**
   * Private function setSystemVocabluary().
   *
   * Set system config for vocabulary in the proper array.
   */
  private function setSystemVocabluary() {
    $taxonomy = taxonomy_get_vocabularies();
    $vocabulary = array();
    foreach ($taxonomy as $item) {
      $vocabulary[$item->machine_name] = $item;
    }
    return $vocabulary;
  }

  /**
   * Private function setSystemMenus().
   *
   * Set system config for menus in the proper array.
   */
  private function setSystemMenus() {
    $menuNames = menu_get_menus();
    $menus = array();
    foreach ($menuNames as $menu => $name) {
      $data = menu_load($menu);
      $menus[$menu] = $data;
    }
    return $menus;
  }

  /**
   * Private function setSytemContentTypes().
   *
   * Set system config for content types to test in the proper array.
   */
  private function setSytemContentTypes() {
    $node_types = node_type_get_types();
    foreach ($node_types as $key => $type) {
      $node_types[$key] = get_object_vars($type);
      $node_types[$key]['fields'] = field_info_instances('node', $key);
    }
    return $node_types;
  }

  /**
   * Private function setSystemRoles().
   *
   * Set system roles and permissions in the proper array.
   *
   * @param array $roles
   *   The primary propety 'roles' for the class.
   */
  private function setSystemRoles($roles) {
    $roles['system'] = array();
    foreach ($roles as $index => $role) {
      $permissions = user_role_permissions(array($index => $role));
      $roles['system'][$role] = array_keys($permissions[$index]);
    }
    return $roles['system'];
  }

  /**
   * Private function setSystemFormats().
   *
   * Set system config for formats in the proper array.
   */
  private function setSystemFormats() {
    $formats = filter_formats();
    foreach ($formats as $key => $value) {
      $formats[$key]->roles = filter_get_roles_by_format($formats[$key]);
      $formats[$key]->filters = filter_list_format($key);
    }
    return $formats;
  }

  /**
   * Private function setSystemImageStyles().
   *
   * Set system config for image styles in the proper array.
   */
  private function setSystemImageStyles() {
    return image_styles();
  }

  /**
   * Private function setSystemDateFormats().
   *
   * Set system config for date formats in the proper array.
   */
  private function setSystemDateFormats() {
    return system_get_date_formats();
  }

  /**
   * Private function setUsers().
   *
   * Set system users in the proper array.
   */
  private function setUsers() {
    $roles = array_keys($this->roles['system']);
    $users = array();
    foreach ($roles as $role) {
      $query = db_select('users_roles', 'ur');
      $query->fields('ur', array('uid'));
      $query->join('role', 'r', 'r.rid = ur.rid');
      $query->join('users', 'u', 'ur.uid = u.uid');
      $query->condition('u.status', 1, '=');
      $query->condition('r.name', $role, '=');
      $result = $query->execute();
      $uids = $result->fetchCol();
      $users[$role] = user_load_multiple($uids);
    }
    return $users;
  }

  /**
   * Private function setTestRoles().
   *
   * Set test roles config in the proper array.
   */
  private function setTestRoles() {
    return json_decode(file_get_contents($this->path . '/roles.test.json'), true);
  }

  /**
   * Private function setTestModules().
   *
   * Set test modules config in the proper array.
   */
  private function setTestModules() {
    return json_decode(file_get_contents($this->path . '/modules.test.json'), true);
  }

  /**
   * Private function setTestThemes().
   *
   * Set test themes config in the proper array.
   */
  private function setTestThemes() {
    return json_decode(file_get_contents($this->path . '/themes.test.json'), true);
  }

  /**
   * Private function setTestContentTypes().
   *
   * Set test content types config in the proper array.
   */
  private function setTestContentTypes() {
    return json_decode(file_get_contents($this->path . '/content.types.test.json'), true);
  }

  /**
   * Private function setTestContexts().
   *
   * Set test contexts config in the proper array.
   */
  private function setTestContexts() {
    return json_decode(file_get_contents($this->path . '/contexts.test.json'), true);
  }

  /**
   * Private function setTestViews().
   *
   * Set test views config in the proper array.
   */
  private function setTestViews() {
    return json_decode(file_get_contents($this->path . '/views.test.json'), true);
  }

  /**
   * Private function setTestMenus().
   *
   * Set test menus config in the proper array.
   */
  private function setTestMenus() {
    return json_decode(file_get_contents($this->path . '/menus.test.json'), true);
  }

  /**
   * Private function setTestVocabulary().
   *
   * Set test vocabulary config in the proper array.
   */
  private function setTestVocabulary() {
    return json_decode(file_get_contents($this->path . '/vocabulary.test.json'), true);
  }

  /**
   * Private function setTestFormats().
   *
   * Set test formats and filters config in the proper array.
   */
  private function setTestFormats() {
    return json_decode(file_get_contents($this->path . '/formats.test.json'), true);
  }

  /**
   * Private function setTestSiteInformation().
   *
   * Set test variables config in the proper array.
   */
  private function setTestVariables() {
    return json_decode(file_get_contents($this->path . '/variables.test.json'), true);
  }

  /**
   * Private function setTestImageStyles().
   *
   * Set test image-styles config in the proper array.
   */
  private function setTestImageStyles() {
    return json_decode(file_get_contents($this->path . '/image.styles.test.json'), true);
  }

  /**
   * Private function SetTestDateFormats().
   *
   * Set test date formats config in the proper array.
   */
  private function SetTestDateFormats() {
    return json_decode(file_get_contents($this->path . '/date.formats.test.json'), true);
  }

  /**
   * Private function setTestEntities().
   *
   * Set test entities config in the proper array.
   */
  private function setTestEntities() {
    return json_decode(file_get_contents($this->path . '/entities.test.json'), true);
  }
}
