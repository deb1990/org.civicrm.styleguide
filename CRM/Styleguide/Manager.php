<?php

class CRM_Styleguide_Manager {

  /**
   * @var array
   */
  private $all = NULL;

  /**
   * Get the definition of specific style-guide by name.
   *
   * @param string $name
   * @return array|NULL
   *   If the style-guide exists, it is an array with properties:
   *     - name: string
   *     - label: string
   */
  public function get($name) {
    $all = $this->getAll();
    return isset($all[$name]) ? $all[$name] : NULL;
  }

  /**
   * Get a list of all style guides.
   *
   * @return array
   */
  public function getAll() {
    if ($this->all === NULL) {
      $extPath = CRM_Core_Resources::singleton()->getPath('org.civicrm.styleguide');

      $this->all = array(
        'crmstar' => array(
          'label' => ts('crm-*'),
          'path' => "{$extPath}/guides/crmstar",
        ),
        'bootstrap' => array(
          'label' => ts('Bootstrap'),
          // FIXME: 'path' => "{$extPath}/guides/bootstrap",
          'path' => "{$extPath}/partials",
        ),
        'bootstrapcivicrm' => array(
          'label' => ts('Bootstrap-CiviCRM'),
          'path' => "{$extPath}/guides/bootstrapcivicrm",
        ),
        // FIXME: Consider moving declaration to another extension.
        'bootstrapcivihr' => array(
          'label' => ts('Bootstrap-CiviHR'),
          'path' => "{$extPath}/guides/bootstrapcivihr",
        ),
      );

      CRM_Utils_Hook::singleton()->invoke(1, $this->all,
        CRM_Utils_Hook::$_nullObject,
        CRM_Utils_Hook::$_nullObject,
        CRM_Utils_Hook::$_nullObject,
        CRM_Utils_Hook::$_nullObject,
        CRM_Utils_Hook::$_nullObject,
        'civicrm_styleGuides'
      );

      foreach ($this->all as $name => &$value) {
        $value['name'] = $name;
      }
    }
    return $this->all;
  }

}
