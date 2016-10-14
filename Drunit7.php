<?php

/**
 * @file
 * Drunit7.php.
 */

require 'lib/CustomBasicTestCase.php';

/**
 * Drunit7 class.
 *
 * Executes all test cases for custom config/addition for a Drupal instance.
 */
class Drunit7 extends CustomBasicTestCase {

  /**
   * Public function testSiteInformationIsCorrect().
   *
   * Verify if all site-information listed in the config file,
   * matches with the values registered in the system.
   */
  public function testSiteInformationIsCorrect() {
    $site_info = $this->variables['test']['system']['site-information'];
    foreach ($site_info as $key => $value) {
      try {
        $this->assertEquals(
          $value,
          variable_get($key),
          "Failed asserting that {$value} is correct in {$key}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testSiteInformationIsNotIncorrect().
   *
   * Verify if all site-information listed in the config file,
   * are not wrong in comparison with system values.
   */
  public function testSiteInformationIsNotIncorrect() {
    $site_info = $this->variables['test']['system']['site-information'];
    foreach ($site_info as $key => $value) {
      try {
        $fake = uniqid('value_', TRUE);
        $this->assertNotEquals(
          $fake,
          variable_get($key),
          "Failed asserting that {$fake} is wrong in {$key}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAccountsConfigIsCorrect().
   *
   * Verify if all people/accounts listed in the config file,
   * matches with the values registered in the system.
   */
  public function testAccountsConfigIsCorrect() {
    $accounts = $this->variables['test']['people']['accounts'];
    foreach ($accounts as $key => $value) {
      try {
        $this->assertEquals(
          $value,
          variable_get($key),
          "Failed asserting that {$value} is correct in {$key}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAccountsConfigIsNotIncorrect().
   *
   * Verify if all people/accounts listed in the config file,
   * are not wrong in comparison with system values.
   */
  public function testAccountsConfigIsNotIncorrect() {
    $accounts = $this->variables['test']['people']['accounts'];
    foreach ($accounts as $key => $value) {
      try {
        $fake = uniqid('value_', TRUE);
        $this->assertNotEquals(
          $fake,
          variable_get($key),
          "Failed asserting that {$fake} is wrong in {$key}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testActiveCoreModules().
   *
   * Verify if all the 'enabled' core modules in the config's file,
   * are currently 'enabled' in the system.
   */
  public function testActiveCoreModules() {
    foreach ($this->modules['test']['core']['enabled'] as $module) {
      try {
        $this->assertContains(
          $module,
          $this->modules['system']['core']['enabled'],
          "Failed asserting that core module {$module} is enabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testActiveCoreModulesAreNotDisabled().
   *
   * Verify if all the 'enabled' core modules in the config's file,
   * are not marked as 'disabled' in the system.
   */
  public function testActiveCoreModulesAreNotDisabled() {
    foreach ($this->modules['test']['core']['enabled'] as $module) {
      try {
        $this->assertNotContains(
          $module,
          $this->modules['system']['core']['disabled'],
          "Failed asserting that core module {$module} is not disabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testDisabledCoreModules().
   *
   * Verify if all the 'disabled' core modules in the config's file,
   * are currently 'disabled' in the system.
   */
  public function testDisabledCoreModules() {
    foreach ($this->modules['test']['core']['disabled'] as $module) {
      try {
        $this->assertContains(
          $module,
          $this->modules['system']['core']['disabled'],
          "Failed asserting that core module {$module} is disabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testDisabledCoreModulesAreNotEnabled().
   *
   * Verify if all the 'disabled' core modules in the config's file,
   * are not marked as 'enabled' in the system.
   */
  public function testDisabledCoreModulesAreNotEnabled() {
    foreach ($this->modules['test']['core']['disabled'] as $module) {
      try {
        $this->assertNotContains(
          $module,
          $this->modules['system']['core']['enabled'],
          "Failed asserting that core module {$module} is not enabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testActiveCustomModules().
   *
   * Verify if all the 'enabled' custom modules in the config's file,
   * are marked as 'enabled' in the system.
   */
  public function testActiveCustomModules() {
    foreach ($this->modules['test']['custom']['enabled'] as $module) {
      try {
        $this->assertContains(
          $module,
          $this->modules['system']['custom']['enabled'],
          "Failed asserting that custom module {$module} is enabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testActiveCustomModulesAreNotDisabled().
   *
   * Verify if all the 'enabled' custom modules in the config's file,
   * are not marked as 'disabled' in the system.
   */
  public function testActiveCustomModulesAreNotDisabled() {
    foreach ($this->modules['test']['custom']['enabled'] as $module) {
      try {
        $this->assertNotContains(
          $module,
          $this->modules['system']['custom']['disabled'],
          "Failed asserting that custom module {$module} is not disabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testActiveCustomModulesAreNotDisabled().
   *
   * Verify if all the 'enabled' custom modules in the config's file,
   * are not marked as 'disabled' in the system.
   */
  public function testDisabledCustomModules() {
    foreach ($this->modules['test']['custom']['disabled'] as $module) {
      try {
        $this->assertContains(
          $module,
          $this->modules['system']['custom']['disabled'],
          "Failed asserting that custom module {$module} is disabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testDisabledCustomModulesAreNotEnabled().
   *
   * Verify if all the 'disabled' custom modules in the config's file,
   * are not marked as 'enabled' in the system.
   */
  public function testDisabledCustomModulesAreNotEnabled() {
    foreach ($this->modules['test']['custom']['disabled'] as $module) {
      try {
        $this->assertNotContains(
          $module,
          $this->modules['system']['custom']['enabled'],
          "Failed asserting that custom module {$module} is not enabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testActiveContribModules().
   *
   * Verify if all the 'enabled' contrib modules in the config's file,
   * are marked as 'enabled' in the system.
   */
  public function testActiveContribModules() {
    foreach ($this->modules['test']['contrib']['enabled'] as $module) {
      try {
        $this->assertContains(
          $module,
          $this->modules['system']['contrib']['enabled'],
          "Failed asserting that contrib module {$module} is enabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testActiveContribModulesAreNotDisabled().
   *
   * Verify if all the 'enabled' contrib modules in the config's file,
   * are not marked as 'disabled' in the system.
   */
  public function testActiveContribModulesAreNotDisabled() {
    foreach ($this->modules['test']['contrib']['enabled'] as $module) {
      try {
        $this->assertNotContains(
          $module,
          $this->modules['system']['contrib']['disabled'],
          "Failed asserting that contrib module {$module} is not disabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testDisabledContribModules().
   *
   * Verify if all the 'disabled' contrib modules in the config's file,
   * are currently marked as 'disabled' in the system.
   */
  public function testDisabledContribModules() {
    foreach ($this->modules['test']['contrib']['disabled'] as $module) {
      try {
        $this->assertContains(
          $module,
          $this->modules['system']['contrib']['disabled'],
          "Failed asserting that contrib module {$module} is disabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testDisabledContribModulesAreNotActive().
   *
   * Verify if all the 'disabled' contrib modules in the config's file,
   * are not marked as 'enabled' in the system.
   */
  public function testDisabledContribModulesAreNotActive() {
    foreach ($this->modules['test']['contrib']['disabled'] as $module) {
      try {
        $this->assertNotContains(
          $module,
          $this->modules['system']['contrib']['enabled'],
          "Failed asserting that contrib module {$module} is not enabled."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all modules passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllRolesCorrectlyExists().
   *
   * Verify if all roles in the config file alredy exist in the system.
   */
  public function testAllRolesCorrectlyExists() {
    $roles = array_keys($this->roles['test']);
    foreach ($roles as $role) {
      try {
        $this->assertArrayHasKey(
          $role,
          $this->roles['system'],
          "Failed asserting that {$role} role exists in the system."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all roles passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testFakeUserRoleDoesNotExist().
   *
   * Verify if a wrong role does not exists in the the system.
   */
  public function testFakeUserRoleDoesNotExist() {
    $role = uniqid('role_', TRUE);
    $this->assertArrayNotHasKey(
      $role,
      $this->roles['system'],
      "Failed asserting that {$role} exists."
    );
  }

  /**
   * Public function testAllRolesPermissionsAreCorrect().
   *
   * Verify if all roles permissions in the config file are the same,
   * in the sytem.
   */
  public function testAllRolesPermissionsAreCorrect() {
    $roles = array_keys($this->roles['test']);
    foreach ($roles as $role) {
      foreach ($this->roles['test'][$role] as $permission) {
        try {
          $this->assertContains(
            $permission,
            $this->roles['system'][$role],
            "Failed asserting that {$permission} is granted for {$role} role."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all roles permissions passed the test.
    $this->assertEquals(
      0,
      count($exceptionMessages),
      implode("\r\n", $exceptionMessages)
    );
  }

  /**
   * Public function testAllRolesPermissionsHasNotIncorrectValue().
   *
   * Verify if all roles has no wrong permissions in the system.
   */
  public function testAllRolesPermissionsHasNotIncorrectValue() {
    $roles = array_keys($this->roles['test']);
    foreach ($roles as $role) {
      $permission = uniqid('permission_', TRUE);
      try {
        $this->assertNotContains(
          $permission,
          $this->roles['system'][$role],
          "Failed asserting that {$permission} is not granted for {$role} role."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all roles permissions passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllRolesCanAlterPermissions().
   *
   * Verify if all roles permissions can be updated.
   */
  public function testAllRolesCanAlterPermissions() {
    $roles = array_keys($this->roles['test']);
    $anonymous_permissions = user_role_permissions(
      array(DRUPAL_ANONYMOUS_RID => 'anonymous user')
    );
    $anonymous_permissions = array_keys(
      $anonymous_permissions[DRUPAL_ANONYMOUS_RID]
    );
    foreach ($roles as $role) {
      $config = user_role_load_by_name($role);
      // Revoke permissions to role.
      user_role_revoke_permissions(
        $config->rid,
        $anonymous_permissions
      );
      $auth_permissions = user_role_permissions(
        array($config->rid => $config->name)
      );
      foreach ($anonymous_permissions as $permission) {
        try {
          $this->assertArrayNotHasKey(
            $permission,
            $auth_permissions[$config->rid],
            "Failed asserting that permissions were rovoke for {$role} role."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
      // Grant permissions to role.
      user_role_grant_permissions(
        $config->rid,
        $anonymous_permissions
      );
      $auth_permissions = user_role_permissions(
        array($config->rid => $config->name)
      );
      foreach ($anonymous_permissions as $permission) {
        try {
          $this->assertArrayHasKey(
            $permission,
            $auth_permissions[$config->rid],
            "Failed asserting that permission were granted for {$role} role."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all roles permissions were altered.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testExistAnActiveAdministratorUserAtLeast().
   *
   * Verify if an admin user exist in the system.
   */
  public function testExistAnActiveAdministratorUserAtLeast() {
    $roles = array_keys($this->roles['test']);
    $roles = array_diff($roles,
      array(
        'anonymous user',
        'authenticated user',
      )
    );
    foreach ($roles as $role) {
      $usersCount = count($this->users[$role]);
      try {
        $this->assertGreaterThanOrEqual(
          1,
          $usersCount,
          "Failed asserting that exist an admin user at least."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all roles has an active user at least.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testDefaulThemeIsCorrect().
   *
   * Verify if the default theme marked in the config file is the same,
   * registered in the system as a defult.
   */
  public function testDefaulThemeIsCorrect() {
    $themes = $this->themes['system'];
    foreach ($themes as $theme => $config) {
      if ($this->themes['test'][$theme]['default']) {
        try {
          $this->assertEquals(
            $theme,
            variable_get('theme_default'),
            "Failed asserting that {$theme} is default theme."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all themes passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testOtherThemeIsNotDefaulTheme().
   *
   * Verify if other theme is not marked as default.
   */
  public function testOtherThemeIsNotDefaulTheme() {
    $themes = $this->themes['system'];
    foreach ($themes as $theme => $config) {
      if ($theme != variable_get('theme_default')) {
        try {
          $this->assertNotEquals(
            1,
            $this->themes['test'][$theme]['default'],
            "Failed asserting that {$theme} is not default theme."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Asseert all other themes passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testDefaultThemeNameIsCorrect().
   *
   * Verify if the name of the default theme in the config file,
   * is the same in the system.
   */
  public function testDefaultThemeNameIsCorrect() {
    $default_theme = variable_get('theme_default');
    $this->assertEquals(
      $this->themes['system'][$default_theme]->info['name'],
      $this->themes['test'][$default_theme]['name'],
      "Failed asserting that {$this->themes['test'][$default_theme]['name']} is the correct name of default theme."
    );
  }

  /**
   * Public function testDefaultThemeNameIsNotCorrect().
   *
   * Verify if a wrong theme name is not the default theme name,
   * in the system.
   */
  public function testDefaultThemeNameIsNotCorrect() {
    $theme_name = uniqid('theme_', TRUE);
    $default_theme = variable_get('theme_default');
    $this->assertNotEquals(
      $this->themes['system'][$default_theme]->info['name'],
      $theme_name,
      "Failed asserting that {$theme_name} theme name is wrong."
    );
  }

  /**
   * Public function testThemesHaveItsRegionsCorrect().
   *
   * Verify if all the regions in themes config file,
   * are correctly associated in the system.
   */
  public function testThemesHaveItsRegionsCorrect() {
    foreach ($this->themes['test'] as $machine_name => $theme) {
      foreach ($theme['regions'] as $key => $region) {
        try {
          $this->assertContains(
            $region,
            array_values($this->themes['system'][$machine_name]->info['regions']),
            "Failed asserting that {$region} in {$machine_name} is correct."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all themes regions in each theme passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllThemesHasNotIncorrectRegions().
   *
   * Verify if in the system are not wrong regions associated in every theme.
   */
  public function testAllThemesHasNotIncorrectRegions() {
    foreach ($this->themes['test'] as $machine_name => $theme) {
      $region = uniqid('region_', TRUE);
      try {
        $this->assertNotContains(
          $region,
          array_values($this->themes['system'][$machine_name]->info['regions']),
          "Failed asserting that {$region} is not in {$machine_name} theme."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all themes regions passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllContentTypesExists().
   *
   * Verify if all content types listed in the config file,
   * are currently registered in the system.
   */
  public function testAllContentTypesExists() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      try {
        $this->assertArrayHasKey(
          $type,
          $this->contentTypes['system'],
          "Failed asserting that {$type} exists in the system."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all types passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testFakeNodeTypeDoesNotExist().
   *
   * Verify if a random wrong type does not exist in the system.
   */
  public function testFakeNodeTypeDoesNotExist() {
    $type = uniqid('type_', TRUE);
    $this->assertArrayNotHasKey(
      $type,
      $this->contentTypes['system'],
      "Failed asserting that node type '{$type}' does not exist."
    );
  }

  /**
   * Public function testAllContentTypesNamesAreCorrect().
   *
   * Verify if all node types name listed in the config file,
   * are equal to the name registered in the system.
   */
  public function testAllContentTypesNamesAreCorrect() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      $name = $this->contentTypes['test'][$type]['name'];
      try {
        $this->assertEquals(
          $name,
          $this->contentTypes['system'][$type]['name'],
          "Failed asserting that {$type} name is correct."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all content types name passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllContentTypesNamesAreNotIncorrect().
   *
   * Verify if the node type name strings on the system is not a wrong name.
   */
  public function testAllContentTypesNamesAreNotIncorrect() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      $name = $this->contentTypes['test'][$type]['name'] . uniqid('_', TRUE);
      try {
        $this->assertNotEquals(
          $name,
          $this->contentTypes['system'][$type]['name'],
          "Failed asserting that {$type} name is not wrong."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all content types name passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllContentTypesDisabledValuesAreCorrect().
   *
   * Verify if the disabled flag for each node type listed in the config file,
   * are correct in comparison with the value in the system.
   */
  public function testAllContentTypesDisabledValuesAreCorrect() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      $disabled = $this->contentTypes['test'][$type]['disabled'];
      try {
        $this->assertEquals(
          $disabled,
          $this->contentTypes['system'][$type]['disabled'],
          "Failed asserting that {$type} disabled value is correct."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all content type names passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllContentTypesDisabledValuesAreNotIncorrect().
   *
   * Verify if a wrong value for disabled flag in each node type,
   * in the config file is not currently set in the system.
   */
  public function testAllContentTypesDisabledValuesAreNotIncorrect() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      $disabled = rand();
      try {
        $this->assertNotEquals(
          $disabled,
          $this->contentTypes['system'][$type]['disabled'],
          "Failed asserting that {$type} disabled value is not wrong."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all content type names passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFieldsInContentTypesExists().
   *
   * Verify if all fields listed for ech node type in the config file,
   * already are associeted to the node type in the system.
   */
  public function testAllFieldsInContentTypesExists() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      $fields = array_keys($this->contentTypes['test'][$type]['fields']);
      foreach ($fields as $field) {
        try {
          $this->assertArrayHasKey(
            $field,
            $this->contentTypes['system'][$type]['fields'],
            "Failed asserting that {type}:{field} exists."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all fields in content types passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testFakeFieldsInContentTypesDoesNotExist().
   *
   * Verify if a wrong field is not currently associated in every node type,
   * registered in the system.
   */
  public function testFakeFieldsInContentTypesDoesNotExist() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      $field = uniqid('field_', TRUE);
      try {
        $this->assertArrayNotHasKey(
          $field,
          $this->contentTypes['system'][$type]['fields'],
          "Failed asserting that {$type}:{$field} field does not exist."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all fields in content types passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFieldsLabelsInContentTypesAreCorrect().
   *
   * Verify if all label's value listed for each node type in the config file,
   * are the same in comparison with the system's values.
   */
  public function testAllFieldsLabelsInContentTypesAreCorrect() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      $fields = array_keys($this->contentTypes['test'][$type]['fields']);
      foreach ($fields as $field) {
        $label = $this->contentTypes['test'][$type]['fields'][$field]['label'];
        try {
          $this->assertEquals(
            $label,
            $this->contentTypes['system'][$type]['fields'][$field]['label'],
            "Failed asserting that {$type}:{$field} label is correct."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all field labels in content types passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFieldsLabelsInContentTypesAreNotInorrect().
   *
   * Verify if wrong values for all fields labels in each node type,
   * are not currently set in the system.
   */
  public function testAllFieldsLabelsInContentTypesAreNotInorrect() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      $fields = array_keys($this->contentTypes['test'][$type]['fields']);
      foreach ($fields as $field) {
        $label = uniqid('label_', TRUE);
        try {
          $this->assertNotEquals(
            $label,
            $this->contentTypes['system'][$type]['fields'][$field]['label'],
            "Failed asserting that {$type}:{$field} label value is not wrong."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all field labels in content types passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFieldsRequiredValuesInContentTypesAreCorrect().
   *
   * Verify if the required value listed for each field in the config file,
   * is the same value registered in the system.
   */
  public function testAllFieldsRequiredValuesInContentTypesAreCorrect() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      $fields = array_keys($this->contentTypes['test'][$type]['fields']);
      foreach ($fields as $field) {
        $required = $this->contentTypes['test'][$type]['fields'][$field]['required'];
        try {
          $this->assertEquals(
            $required,
            $this->contentTypes['system'][$type]['fields'][$field]['required'],
            "Failed asserting that {$type}:{$field} required value is correct."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all field requiered in content types passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFieldsRequiredValuesInContentTypesAreNotIncorrect().
   *
   * Verify if wrong values for each required field's value,
   * are not currently set in the system.
   */
  public function testAllFieldsRequiredValuesInContentTypesAreNotIncorrect() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      $fields = array_keys($this->contentTypes['test'][$type]['fields']);
      foreach ($fields as $field) {
        $required = rand();
        try {
          $this->assertNotEquals(
            $required,
            $this->contentTypes['system'][$type]['fields'][$field]['required'],
            "Failed asserting {$type}:{$field} required value is not wrong."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all fields required value in content types passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllContentTypesCrud().
   *
   * Verify if all content types can be created, updated and removed.
   */
  public function testAllContentTypesCrud() {
    $content_types = array_keys($this->contentTypes['test']);
    foreach ($content_types as $type) {
      // CR.
      $node = new stdClass();
      $node->title = "Node type {$type} test.";
      $node->type = $type;
      node_object_prepare($node);
      $node->language = LANGUAGE_NONE;
      $node->uid = 1;
      $node->status = 1;
      $node->promote = 0;
      $node->comment = 0;
      $node = node_submit($node);
      node_save($node);
      // Verify if the node was created.
      try {
        $node = node_load($node->nid);
        $this->assertNotNull(
          $node->nid,
          "Failed asserting that {$node->type} was created."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
      // U.
      $new_title = uniqid('Title_', TRUE);
      $node->title = $new_title;
      $node = node_submit($node);
      node_save($node);
      // Verify if the node was updated.
      try {
        $node = node_load($node->nid);
        $this->assertEquals(
          $node->title,
          $new_title,
          "Failed asserting that {$node->type} was updated."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
      // D.
      node_delete($node->nid);
      $node = node_load($node->nid);
      // Verify if the node was deleted.
      try {
        $this->assertNull(
          $node->nid,
          "Failed asserting that {$node->type} was deleted."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all node types CRUD passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllContextsExists().
   *
   * Verify if all contexts listed in the config file,
   * exists already in the system.
   */
  public function testAllContextsExists() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context => $config) {
      try {
        $this->assertArrayHasKey(
          $context,
          $this->contexts['system'],
          "Failed asserting that {$context} context is in the system."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testFakeContextDoesNotExist().
   *
   * Verify if a wrong context does not exist in the system.
   */
  public function testFakeContextDoesNotExist() {
    $context = uniqid('context_', TRUE);
    $this->assertArrayNotHasKey(
      $context,
      $this->contexts['system'],
      "Failed asserting that context '{$context}' does not exist."
    );
  }

  /**
   * Public function testAllContextNamesAreCorrect().
   *
   * Verify if all contexts names listed in the config file,
   * are the same as in the system.
   */
  public function testAllContextNamesAreCorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context => $config) {
      try {
        $this->assertEquals(
          $config['name'],
          $this->contexts['system'][$context]->name,
          "Failed asserting that {$config['name']} is the correct name for {$context} context."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllContextNamesAreNotIncorrect().
   *
   * Verify if all contexts names listed in the config file,
   * are the same as in the system.
   */
  public function testAllContextNamesAreNotIncorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context) {
      $name = uniqid('context_name_', TRUE);
      try {
        $this->assertNotEquals(
          $name,
          $this->contexts['system'][$context]->name,
          "Failed asserting that {$name} is a wrong name for {$context} context."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllContextDisabledValuesAreCorrect().
   *
   * Verify if all contexts disabled value listed in the config file,
   * are the same as in the system.
   */
  public function testAllContextDisabledValuesAreCorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context => $config) {
      try {
        $this->assertEquals(
          $config['disabled'],
          $this->contexts['system'][$context]->disabled,
          "Failed asserting that disabled value for {$context} context is correct."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllContextDisabledValuesAreNotIncorrect().
   *
   * Verify if a wrong value is not set in each context 'disabled' flag.
   */
  public function testAllContextDisabledValuesAreNotIncorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context) {
      try {
        $disabled = uniqid();
        $this->assertNotEquals(
          $disabled,
          $this->contexts['system'][$context]->disabled,
          "Failed asserting that {$disabled} is a wrong value for {$context} context."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllConditionsInContextsAreCorrect().
   *
   * Verify if all conditions for contexts listed in the config file,
   * are the same as in the system.
   */
  public function testAllConditionsInContextsAreCorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context => $config) {
      foreach ($config['conditions'] as $condition => $values) {
        try {
          $this->assertArrayHasKey(
            $condition,
            $this->contexts['system'][$context]->conditions,
            "Failed asserting that {$condition} condition is correct in {$context} context."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all conditions for contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllConditionsInContextsAreNotIncorrect().
   *
   * Verify if wrong conditions are not currently set in the system.
   */
  public function testAllConditionsInContextsAreNotIncorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context => $config) {
      $condition = uniqid('contition_', TRUE);
      try {
        $this->assertArrayNotHasKey(
          $condition,
          $this->contexts['system'][$context]->conditions,
          "Failed asserting that {$condition} condition is wrong in {$context} context."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all conditions for contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllReactionsInContextsAreCorrect().
   *
   * Verify if all reactions for contexts listed in the config file,
   * are the same as in the system.
   */
  public function testAllReactionsInContextsAreCorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context => $config) {
      foreach ($config['reactions'] as $reaction => $values) {
        try {
          $this->assertArrayHasKey(
            $reaction,
            $this->contexts['system'][$context]->reactions,
            "Failed asserting that {$reaction} reaction is correct in {$context} context."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all reactions for contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllReactionsInContextsAreNotIncorrect().
   *
   * Verify if wrong reactions are not currently set in the system.
   */
  public function testAllReactionsInContextsAreNotIncorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context => $config) {
      $reaction = uniqid('reaction_', TRUE);
      try {
        $this->assertArrayNotHasKey(
          $reaction,
          $this->contexts['system'][$context]->reactions,
          "Failed asserting that {$reaction} reaction is wrong in {$context} context."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all conditions for contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllBlockReactionsInContextsAreCorrect().
   *
   * Verify if all 'block' reactions for contexts listed in the config file,
   * are the same as in the system.
   */
  public function testAllBlockReactionsInContextsAreCorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context => $config) {
      if ($blocks = $config['reactions']['block']['blocks']) {
        foreach ($blocks as $block => $values) {
          try {
            $this->assertArrayHasKey(
              $block,
              $this->contexts['system'][$context]->reactions['block']['blocks'],
              "Failed asserting that {$block} block is correct in {$context} context."
            );
          }
          catch (Exception $e) {
            $this->handleAssertException($e);
          }
        }
      }
    }
    // Verify if all reactions for contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllBlockReactionsInContextsAreNotIncorrect().
   *
   * Verify if wrong 'block' reactions are not currently set in the system.
   */
  public function testAllBlockReactionsInContextsAreNotIncorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context => $config) {
      if ($blocks = $config['reactions']['block']['blocks']) {
        $block = uniqid('block_', TRUE);
        try {
          $this->assertArrayNotHasKey(
            $block,
            $this->contexts['system'][$context]->reactions['block']['blocks'],
            "Failed asserting that {$block} block is wrong for {$context} context."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all reactions for contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllBlockReactionsConfigInContextsAreCorrect().
   *
   * Verify if all associated configuration for 'block' reactions,
   * in contexts listed inside the config file are the same as in the system.
   */
  public function testAllBlockReactionsConfigInContextsAreCorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context => $config) {
      if ($blocks = $config['reactions']['block']['blocks']) {
        foreach ($blocks as $block => $values) {
          foreach ($values as $key => $value) {
            try {
              $this->assertEquals(
                $value,
                $this->contexts['system'][$context]->reactions['block']['blocks'][$block][$key],
                "Failed asserting that {$block}->{$key} is correct in {$context} context."
              );
            }
            catch (Exception $e) {
              $this->handleAssertException($e);
            }
          }
        }
      }
    }
    // Verify if all reactions for contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllBlockReactionsConfigInContextsAreNotIncorrect().
   *
   * Verify if wrong values for each config in 'block' reaction are not,
   * currently set in the system.
   */
  public function testAllBlockReactionsConfigInContextsAreNotIncorrect() {
    $contexts = $this->contexts['test'];
    foreach ($contexts as $context => $config) {
      if ($blocks = $config['reactions']['block']['blocks']) {
        foreach ($blocks as $block => $values) {
          foreach ($values as $key => $value) {
            $wrongValue = uniqid(rand(), TRUE);
            try {
              $this->assertNotEquals(
                $wrongValue,
                $this->contexts['system'][$context]->reactions['block']['blocks'][$block][$key],
                "Failed asserting that {$block}->{$key} is wrong in {$context} context."
              );
            }
            catch (Exception $e) {
              $this->handleAssertException($e);
            }
          }
        }
      }
    }
    // Verify if all reactions for contexts passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllViewsExists().
   *
   * Verify if all views listed in the config file,
   * exists already in the system.
   */
  public function testAllViewsExists() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      try {
        $this->assertArrayHasKey(
          $view,
          $this->views['system'],
          "Failed asserting that {$view} view is in the system."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all views passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testFakeViewDoesNotExist().
   *
   * Verify if a wrong view does not exist in the system.
   */
  public function testFakeViewDoesNotExist() {
    $view = uniqid('view_', TRUE);
    $this->assertArrayNotHasKey(
      $view,
      $this->views['system'],
      "Failed asserting that view '{$view}' does not exist."
    );
  }

  /**
   * Public function testAllViewsHumanNamesAreCorrect().
   *
   * Verify if all views human_name values listed in the config file,
   * are the same as in the system.
   */
  public function testAllViewsHumanNamesAreCorrect() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      try {
        $this->assertEquals(
          $config['human_name'],
          $this->views['system'][$view]->human_name,
          "Failed asserting that {$config['human_name']} is the correct name for {$view} view."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all display names passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllViewsHumanNamesAreNotIncorrect().
   *
   * Verify if all views human_name values listed in the config file,
   * are the same as in the system.
   */
  public function testAllViewsHumanNamesAreNotIncorrect() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      $view_name = uniqid('view_name_', TRUE);
      try {
        $this->assertNotEquals(
          $view_name,
          $this->views['system'][$view]->human_name,
          "Failed asserting that {$view_name} is a wrong name for {$view} view."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all display names passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllDisplaysInViewsAreCorrect().
   *
   * Verify if all displays for views listed in the config file,
   * are the same as in the system.
   */
  public function testAllDisplaysInViewsAreCorrect() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      foreach ($config['display'] as $display => $values) {
        try {
          $this->assertArrayHasKey(
            $display,
            $this->views['system'][$view]->display,
            "Failed asserting that {$display} display is correct in {$view} view."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all displays passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllDisplaysInViewsAreNotIncorrect().
   *
   * Verify if wrong displays are not currently set in the system.
   */
  public function testAllDisplaysInViewsAreNotIncorrect() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      $display = uniqid('display_', TRUE);
      try {
        $this->assertArrayNotHasKey(
          $display,
          $this->views['system'][$view]->display,
          "Failed asserting that {$display} display is wrong in {$view} view."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all displays passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllViewsDisplayTitlesAreCorrect().
   *
   * Verify if all display titles in views listed in the config file,
   * are the same as in the system.
   */
  public function testAllViewsDisplayTitlesAreCorrect() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      foreach ($config['display'] as $display => $options) {
        try {
          $this->assertEquals(
            $options['display_title'],
            $this->views['system'][$view]->display[$display]->display_title,
            "Failed asserting that {$options['display_title']} is the correct title for {$view}:{$display} display."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all display titles passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllDisplaysTitlesAreNotIncorrect().
   *
   * Verify if wrong displays titles are not currently set in the system.
   */
  public function testAllDisplaysTitlesAreNotIncorrect() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      foreach ($config['display'] as $display => $options) {
        $display_title = uniqid('display_title_', TRUE);
        try {
          $this->assertNotEquals(
            $display_title,
            $this->views['system'][$view]->display[$display]->display_title,
            "Failed asserting that {$display_title} is a wrong title in {$view}:{$display} display."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all display titles passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllDisplaysPagesPathInViewsAreCorrect().
   *
   * Verify if all displays of type page has a correct path value.
   */
  public function testAllDisplaysPagesPathInViewsAreCorrect() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      foreach ($config['display'] as $display => $values) {
        if ($values['display_plugin'] == 'page') {
          try {
            $this->assertEquals(
              $values['path'],
              $this->views['system'][$view]->display[$display]->display_options['path'],
              "Failed asserting that '{$values['path']}' is a correct path in {$view}:{$display} display."
            );
          }
          catch (Exception $e) {
            $this->handleAssertException($e);
          }
        }
      }
    }
    // Verify if all paths passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllDisplaysPagesPathInViewsAreNotIncorrect().
   *
   * Verify if all displays of type page has no a wrong path value.
   */
  public function testAllDisplaysPagesPathInViewsAreNotIncorrect() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      foreach ($config['display'] as $display => $values) {
        if ($values['display_plugin'] == 'page') {
          $fake_path = uniqid('path_', TRUE);
          try {
            $this->assertNotEquals(
              $fake_path,
              $this->views['system'][$view]->display[$display]->display_options['path'],
              "Failed asserting that '{$fake_path}' is a wrong path in {$view}:{$display} display."
            );
          }
          catch (Exception $e) {
            $this->handleAssertException($e);
          }
        }
      }
    }
    // Verify if paths passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllDisplaysOptionsInViewsAreCorrect().
   *
   * Verify if all displays of type page has a correct path value.
   */
  public function testAllDisplaysOptionsInViewsAreCorrect() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      foreach ($config['display'] as $display => $values) {
        foreach ($values['display_options'] as $key => $options) {
          try {
            $this->assertArrayHasKey(
              $key,
              $this->views['system'][$view]->display[$display]->display_options,
              "Failed asserting that '{$key}' option exists in {$view}:{$display} display."
            );
          }
          catch (Exception $e) {
            $this->handleAssertException($e);
          }
        }
      }
    }
    // Verify if all display options passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllDisplaysOptionsConfigInViewsAreCorrect().
   *
   * Verify if all displays of type page has a correct config,
   * for display_options.
   */
  public function testAllDisplaysOptionsConfigInViewsAreCorrect() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      foreach ($config['display'] as $display => $values) {
        foreach ($values['display_options'] as $key => $options) {
          try {
            $this->assertEquals(
              $options,
              $this->views['system'][$view]->display[$display]->display_options[$key],
              "Failed asserting that '{$key}' option config is correct {$view}:{$display} display."
            );
          }
          catch (Exception $e) {
            $this->handleAssertException($e);
          }
        }
      }
    }
    // Verify if all display options passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllDisplaysOptionsConfigInViewsAreNotIncorrect().
   *
   * Verify if all displays of type page has not incorrect config,
   * for all display_options.
   */
  public function testAllDisplaysOptionsConfigInViewsAreNotIncorrect() {
    $views = $this->views['test'];
    foreach ($views as $view => $config) {
      foreach ($config['display'] as $display => $values) {
        foreach ($values['display_options'] as $key => $options) {
          $fake_option = uniqid('option_', TRUE);
          try {
            $this->assertNotEquals(
              $fake_option,
              $this->views['system'][$view]->display[$display]->display_options[$key],
              "Failed asserting that '{$fake_option}' option config is WRONG {$view}:{$display} display."
            );
          }
          catch (Exception $e) {
            $this->handleAssertException($e);
          }
        }
      }
    }
    // Verify if all display options passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllMenusExists().
   *
   * Verify if all menus listed in the config file,
   * exists already in the system.
   */
  public function testAllMenusExists() {
    $menus = $this->menus['test'];
    foreach ($menus as $menu => $config) {
      try {
        $this->assertArrayHasKey(
          $menu,
          $this->menus['system'],
          "Failed asserting that {$menu} menu is in the system."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all menus passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testFakeMenuDoesNotExist().
   *
   * Verify if a wrong menu does not exist in the system.
   */
  public function testFakeMenuDoesNotExist() {
    $menu = uniqid('menu_', TRUE);
    $this->assertArrayNotHasKey(
      $menu,
      $this->menus['system'],
      "Failed asserting that menu '{$menu}' does not exist."
    );
  }

  /**
   * Public function testAllMenuTitlesAreCorrect().
   *
   * Verify if all menu titles listed in the config file,
   * are the same as in the system.
   */
  public function testAllMenuTitlesAreCorrect() {
    $menus = $this->menus['test'];
    foreach ($menus as $menu => $config) {
      try {
        $this->assertEquals(
          $config['title'],
          $this->menus['system'][$menu]['title'],
          "Failed asserting that {$config['title']} is the correct title in {$menu}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all menus passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllMenuTitlesAreNotIncorrect().
   *
   * Verify if wrong titles are not set in the system.
   */
  public function testAllMenuTitlesAreNotIncorrect() {
    $menus = $this->menus['test'];
    foreach ($menus as $menu => $config) {
      $fake_title = uniqid('title_', TRUE);
      try {
        $this->assertNotEquals(
          $fake_title,
          $this->menus['system'][$menu]['title'],
          "Failed asserting that {$fake_title} is a wrong title in {$menu}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all menus passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllVocabularyExists().
   *
   * Verify if all vocabulary listed in the config file,
   * exists already in the system.
   */
  public function testAllVocabularyExists() {
    $vocabulary = $this->vocabulary['test'];
    foreach ($vocabulary as $item => $config) {
      try {
        $this->assertArrayHasKey(
          $item,
          $this->vocabulary['system'],
          "Failed asserting that {$item} is a vocabulary in the system."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all vocabulary items passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testFakeVocabularyDoesNotExist().
   *
   * Verify if a wrong vocabulary does not exist in the system.
   */
  public function testFakeVocabularyDoesNotExist() {
    $vocabulary = uniqid('vocabulary_', TRUE);
    $this->assertArrayNotHasKey(
      $vocabulary,
      $this->vocabulary['system'],
      "Failed asserting that vocabulary '{$vocabulary}' does not exist."
    );
  }

  /**
   * Public function testAllFormatsExists().
   *
   * Verify if all format listed in the config file,
   * exists already in the system.
   */
  public function testAllFormatsExists() {
    $formats = $this->formats['test'];
    foreach ($formats as $format => $config) {
      try {
        $this->assertArrayHasKey(
          $format,
          $this->formats['system'],
          "Failed asserting that {$format} is a format in the system."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all formats passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testFakeFormatDoesNotExist().
   *
   * Verify if a wrong format does not exist in the system.
   */
  public function testFakeFormatDoesNotExist() {
    $format = uniqid('format_', TRUE);
    $this->assertArrayNotHasKey(
      $format,
      $this->formats['system'],
      "Failed asserting that format '{$format}' does not exist."
    );
  }

  /**
   * Public function testAllFormatNamesAreCorrect().
   *
   * Verify if all format names listed in the config file,
   * matches with the names registered in the system.
   */
  public function testAllFormatNamesAreCorrect() {
    $formats = $this->formats['test'];
    foreach ($formats as $format => $config) {
      try {
        $this->assertEquals(
          $config['name'],
          $this->formats['system'][$format]->name,
          "Failed asserting that {$config['name']} is the correct title in {$format}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all formats passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFormatNamesAreNotIncorrect().
   *
   * Verify if wrong format names are not currently set in the system.
   */
  public function testAllFormatNamesAreNotIncorrect() {
    $formats = $this->formats['test'];
    foreach ($formats as $format => $config) {
      $wrong_name = uniqid('format_', TRUE);
      try {
        $this->assertNotEquals(
          $wrong_name,
          $this->formats['system'][$format]->name,
          "Failed asserting that {$wrong_name} is a wrong title in {$format}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all formats passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFormatStatusAreCorrect().
   *
   * Verify if all format status set in the config file,
   * matches with the status registered in the system.
   */
  public function testAllFormatStatusAreCorrect() {
    $formats = $this->formats['test'];
    foreach ($formats as $format => $config) {
      try {
        $this->assertEquals(
          $config['status'],
          $this->formats['system'][$format]->status,
          "Failed asserting that {$config['status']} is correct in {$format}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all formats passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFormatStatusAreNotIncorrect().
   *
   * Verify if wrong format status are not currently set in the system.
   */
  public function testAllFormatStatusAreNotIncorrect() {
    $formats = $this->formats['test'];
    foreach ($formats as $format => $config) {
      $wrong_status = uniqid('status_', TRUE);
      try {
        $this->assertNotEquals(
          $wrong_name,
          $this->formats['system'][$format]->status,
          "Failed asserting that {$wrong_status} is a wrong status in {$format}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all formats passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFormatRolesAreCorrect().
   *
   * Verify if all format status set in the config file,
   * matches with the status registered in the system.
   */
  public function testAllFormatRolesAreCorrect() {
    $formats = $this->formats['test'];
    foreach ($formats as $format => $config) {
      foreach ($config['roles'] as $rid => $role) {
        try {
          $this->assertEquals(
            $role,
            $this->formats['system'][$format]->roles[$rid],
            "Failed asserting that {$role} is a correct role for {$format}."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all formats roles passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFormatRolesAreNotIncorrect().
   *
   * Verify if wrong format role are not currently set in the system.
   */
  public function testAllFormatRolesAreNotIncorrect() {
    $formats = $this->formats['test'];
    foreach ($formats as $format => $config) {
      foreach ($config['roles'] as $rid => $role) {
        $fake_role = uniqid('role_', TRUE);
        try {
          $this->assertNotEquals(
            $fake_role,
            $this->formats['system'][$format]->roles[$rid],
            "Failed asserting that {$fake_role} is a wrong role in {$format}."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all roles passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFormatFiltersAreCorrect().
   *
   * Verify if all format filters listed in the config file,
   * matches with the filter config registered in the system.
   */
  public function testAllFormatFiltersAreCorrect() {
    $formats = $this->formats['test'];
    foreach ($formats as $format => $config) {
      foreach ($config['filters'] as $filter => $settings) {
        if ($settings['settings']['valid_elements']) {
          $this->formats['system'][$format]
            ->filters[$filter]
            ->settings['valid_elements'] = preg_replace(
              '/\s+/',
              '',
              $this->formats['system'][$format]
              ->filters[$filter]
              ->settings['valid_elements']
            );
          $settings['settings']['valid_elements'] = preg_replace(
            '/\s+/',
            '',
            $settings['settings']['valid_elements']
          );
        }
        try {
          $this->assertEquals(
            $settings,
            (array) $this->formats['system'][$format]->filters[$filter],
            "Failed asserting that {$filter} settings are correct for {$format}."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all formats filter settings passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllFormatFiltersAreNotCorrect().
   *
   * Verify if all format filters listed in the config file,
   * has not registered a wrong config in the system.
   */
  public function testAllFormatFiltersAreNotCorrect() {
    $formats = $this->formats['test'];
    foreach ($formats as $format => $config) {
      foreach ($config['filters'] as $filter => $settings) {
        try {
          $fake_settings = array(
            'fake_conf' => uniqid('option_', TRUE)
          );
          $this->assertNotEquals(
            $fake_settings,
            (array) $this->formats['system'][$format]->filters[$filter],
            "Failed asserting that {$filter} settings are incorrect for {$format}."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all formats filter settings passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllImageStylesExists().
   *
   * Verify if all image styles listed in the config file,
   * exists already in the system.
   */
  public function testAllImageStylesExists() {
    $imgstyles = $this->imageStyles['test'];
    foreach ($imgstyles as $style => $config) {
      try {
        $this->assertArrayHasKey(
          $style,
          $this->imageStyles['system'],
          "Failed asserting that {$style} is a image_style in the system."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all image styles passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testFakeImageStyleDoesNotExist().
   *
   * Verify if a wrong image style does not exist in the system.
   */
  public function testFakeImageStyleDoesNotExist() {
    $style = uniqid('style_', TRUE);
    $this->assertArrayNotHasKey(
      $style,
      $this->imageStyles['system'],
      "Failed asserting that image style '{$style}' does not exist."
    );
  }

  /**
   * Public function testAllImageStylesLabelsAreCorrect().
   *
   * Verify if all image styles label values set in the config file,
   * matches with the status registered in the system.
   */
  public function testAllImageStylesLabelsAreCorrect() {
    $styles = $this->imageStyles['test'];
    foreach ($styles as $style => $config) {
      try {
        $this->assertEquals(
          $config['label'],
          $this->imageStyles['system'][$style]['label'],
          "Failed asserting that {$config['label']} is the correct label in {$style}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all image styles passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllImageStylesLabelsAreNotIncorrect().
   *
   * Verify if wrong image styles labels are not currently set in the system.
   */
  public function testAllImageStylesLabelsAreNotIncorrect() {
    $styles = $this->imageStyles['test'];
    foreach ($styles as $style => $config) {
      $wrong_label = uniqid('label_', TRUE);
      try {
        $this->assertNotEquals(
          $wrong_label,
          $this->imageStyles['system'][$style]['label'],
          "Failed asserting that {$wrong_label} is a wrong label in {$style}."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all image styles labels passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllImageStylesEffectsAreCorrect().
   *
   * Verify if all image styles effects config set in the config file,
   * matches with the status registered in the system.
   */
  public function testAllImageStylesEffectsAreCorrect() {
    $styles = $this->imageStyles['test'];
    foreach ($styles as $style => $config) {
      foreach ($config['effects'] as $key => $effect) {
        try {
          $this->assertContains(
            $effect,
            $this->imageStyles['system'][$style]['effects'],
            "Failed asserting that effect:{$key} config is correct in {$style}."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all image styles effects passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllImageStylesEffectsAreNotIncorrect().
   *
   * Verify if all image styles effects config set in the config file,
   * matches with the status registered in the system.
   */
  public function testAllImageStylesEffectsAreNotIncorrect() {
    $styles = $this->imageStyles['test'];
    foreach ($styles as $style => $config) {
      foreach ($config['effects'] as $key => $effect) {
        $fake_effect = array(
          'fake' => uniqid('fake_', TRUE)
        );
        try {
          $this->assertNotContains(
            $fake_effect,
            $this->imageStyles['system'][$style]['effects'],
            "Failed asserting that effect:{$key} config is incorrect in {$style}."
          );
        }
        catch (Exception $e) {
          $this->handleAssertException($e);
        }
      }
    }
    // Verify if all image styles effects passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllPathPatternsAreCorrect().
   *
   * Verify if all path patterns listed in the config file,
   * exists already in the system.
   */
  public function testAllPathPatternsAreCorrect() {
    $patterns = $this->variables['test']['search']['path']['patterns'];
    foreach ($patterns as $pattern => $value) {
      try {
        $this->assertEquals(
          $value,
          variable_get($pattern),
          "Failed asserting that {$pattern} value is correct."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all path patterns passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllPathPatternsAreNotIncorrect().
   *
   * Verify if all path patterns listed in the config file,
   * has no wrong values assigned in the system.
   */
  public function testAllPathPatternsAreNotIncorrect() {
    $patterns = $this->variables['test']['search']['path']['patterns'];
    foreach ($patterns as $pattern => $value) {
      try {
        $fake_pattern = uniqid('pattern_', TRUE);
        $this->assertNOTEquals(
          $fake_pattern,
          variable_get($pattern),
          "Failed asserting that {$pattern} value is inccorrect."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all path patterns passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testAllDateFormatsExists().
   *
   * Verify if all date formats listed in the config file,
   * exists already in the system.
   */
  public function testAllDateFormatsExists() {
    $dateFormats = $this->dateFormats['test'];
    foreach ($dateFormats as $format => $value) {
      try {
        $this->assertArrayHasKey(
          $format,
          $this->dateFormats['system'],
          "Failed asserting that {$format} date format exist."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all date formats passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testFakeDateFormatDoesNotExist().
   *
   * Verify if a wrong date format does not exist in the system.
   */
  public function testFakeDateFormatDoesNotExist() {
    $format = uniqid('format_', TRUE);
    $this->assertArrayNotHasKey(
      $format,
      $this->dateFormats['system'],
      "Failed asserting that '{$format}' date format does not exist."
    );
  }

  /**
   * Public function testAllNodeViewModesExists().
   *
   * Verify if all node view modes listed in the config file,
   * exists already in the system.
   */
  public function testAllNodeViewModesExists() {
    $view_modes = $this->entities['test']['node']['view modes'];
    foreach ($view_modes as $mode => $value) {
      try {
        $this->assertArrayHasKey(
          $mode,
          $this->entities['system']['node']['view modes'],
          "Failed asserting that {$mode} view mode exist."
        );
      }
      catch (Exception $e) {
        $this->handleAssertException($e);
      }
    }
    // Verify if all view modes passed the test.
    $this->checkAllAssertionsPassedWholeTest();
  }

  /**
   * Public function testFakeNodeViewModeDoesNotExist().
   *
   * Verify if a wrong node view mode does not exist in the system.
   */
  public function testFakeNodeViewModeDoesNotExist() {
    ctools_include('export');
    $uuid = '4a9a77c9-70cf-411c-ad6b-5bbb82927d28';
    $display  = ctools_export_load_object('panels_display', 'conditions', array('uuid' => $uuid ));
    print_r(var_export($display)); // empty array if not in DB.

    $mode = uniqid('mode_', TRUE);
    $this->assertArrayNotHasKey(
      $mode,
      $this->entities['system']['node']['view modes'],
      "Failed asserting that '{$mode}' view mode does not exist."
    );
  }

}
