<?php

namespace Drupal\multi_user_register\Form;

use Drupal\Core\Entity\Element\EntityAutocomplete;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\user\Entity\User;
use Drupal\views\Plugin\views\filter\InOperator;

/**
 * Class MultiUserRegisterConfigEntityForm.
 *
 * @package Drupal\multi_user_register\Form
 */
class MultiUserRegisterConfigEntityForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $multi_user_reg_config_entity = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $multi_user_reg_config_entity->label(),
      '#description' => $this->t("Label for the Multi User Register Site."),
      '#required' => TRUE,
    ];
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $multi_user_reg_config_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\multi_user_register\Entity\MultiUserRegisterConfigEntity::load',
      ],
      '#disabled' => !$multi_user_reg_config_entity->isNew(),
    ];
    $form['multi_user_register'] = [
      '#type' => 'fieldset',
      '#title' => t('Site Settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    ];
    $form['multi_user_register']['url'] = [
      '#title' => $this->t('URL'),
      '#type' => 'textfield',
      '#size' => 64,
      '#description' => $this->t("Enter site url."),
      '#required' => TRUE,
      '#default_value' => $multi_user_reg_config_entity->get_url(),
    ];
    $form['multi_user_register']['username'] = [
      '#title' => $this->t('Username'),
      '#type' => 'textfield',
      '#description' => $this->t("Enter site username."),
      '#required' => TRUE,
      '#default_value' => $multi_user_reg_config_entity->get_username(),
    ];
    $form['multi_user_register']['password'] = [
      '#title' => $this->t('password'),
      '#type' => 'textfield',
      '#description' => $this->t("Enter site password."),
      '#required' => TRUE,
      '#default_value' => $multi_user_reg_config_entity->get_password(),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    //Get User input values.
    $input = $form_state->getUserInput();
    $multi_user_reg_config_entity = $this->entity;
    $status = $multi_user_reg_config_entity->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Multi User Register site details.', [
              '%label' => $multi_user_reg_config_entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Multi User Register site details.', [
              '%label' => $multi_user_reg_config_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($multi_user_reg_config_entity->urlInfo('collection'));
  }

}
