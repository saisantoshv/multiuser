<?php

namespace Drupal\multi_user_register\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\multi_user_register\MultiUserRegisterConfigEntityInterface;

/**
 * Defines the Multi User Register entity.
 *
 * @ConfigEntityType(
 *   id = "multi_user_reg_config_entity",
 *   label = @Translation("Multi User Register"),
 *   handlers = {
 *     "list_builder" = "Drupal\multi_user_register\MultiUserRegisterConfigEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\multi_user_register\Form\MultiUserRegisterConfigEntityForm",
 *       "edit" = "Drupal\multi_user_register\Form\MultiUserRegisterConfigEntityForm",
 *       "delete" = "Drupal\multi_user_register\Form\MultiUserRegisterConfigEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\multi_user_register\MultiUserRegisterConfigEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "multi_user_reg_config_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *     "username" = "username",
 *     "password" = "password",
 *     "url" = "url"
 *   },
 *   links = {
 *     "canonical" = "/admin/people/multi_user_reg_config_entity/{multi_user_reg_config_entity}",
 *     "add-form" = "/admin/people/multi_user_reg_config_entity/add",
 *     "edit-form" = "/admin/people/multi_user_reg_config_entity/{multi_user_reg_config_entity}/edit",
 *     "delete-form" = "/admin/people/multi_user_reg_config_entity/{multi_user_reg_config_entity}/delete",
 *     "collection" = "/admin/people/multi_user_reg_config_entity"
 *   }
 * )
 */
class MultiUserRegisterConfigEntity extends ConfigEntityBase implements MultiUserRegisterConfigEntityInterface {

  /**
   * The Multi User Register ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Multi User Register site label.
   *
   * @var string
   */
  protected $label;

  /**
   * The Multi User Register site url.
   *
   * @var string
   */
  protected $url;

  /**
   * The Multi User Register site username.
   *
   * @var string
   */
  protected $username;

  /**
   * The Multi User Register site password.
   *
   * @var string
   */
  protected $password;

  /**
   * {@inheritdoc}
   */
  public function get_username() {
    return $this->username;
  }

  /**
   * {@inheritdoc}
   */
  public function get_password() {
    return $this->password;
  }

  /**
   * {@inheritdoc}
   */
  public function get_url() {
    return $this->url;
  }

}
