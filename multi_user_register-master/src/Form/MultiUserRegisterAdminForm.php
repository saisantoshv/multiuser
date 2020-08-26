<?php

/**
 * @file
 * Contains \Drupal\multi_user_register\Form\MultiUserRegisterAdminForm.
 */

namespace Drupal\multi_user_register\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;

class MultiUserRegisterAdminForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'multi_user_register_admin_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $options = array();
    // Supported Default fields.
    $support = array(
      'language',
      'preferred_langcode',
      'name',
      'mail',
      'timezone',
      'status',
      'roles',
      'default_langcode',
      'path',
    );
    $field_definitions = \Drupal::entityManager()->getFieldDefinitions('user', 'user');
    foreach ($field_definitions as $key => $value) {
      if (strpos($key, 'field_') !== false) {
        $options[$key] = $value->getLabel();
      }
      if (in_array($key, $support)) {
        if ($value->getLabel() instanceof TranslatableMarkup) {
          $options[$key] = $value->getLabel()->getUntranslatedString();
        }
        else {
          $options[$key] = $value->getLabel();
        }
      }
    }
    // Get configuration value.
    $multi_user_register_config = \Drupal::config('multi_user_register.term_name_settings')->get('multi_user_register_config');
    $form['fields'] = [
      '#type' => 'checkboxes',
      '#title' => t('Select Fields to register'),
      '#options' => $options,
      '#required' => TRUE,
      '#default_value' => isset($multi_user_register_config['fields']) ? $multi_user_register_config['fields'] : 0,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Save',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values['fields'] = $form_state->getValue(['fields']);
    // Set multi_user_register_config variable.
    \Drupal::configFactory()->getEditable('multi_user_register.term_name_settings')->set('multi_user_register_config', $values)->save();
    drupal_set_message(t('Configurations saved successfully!'));
  }

}
