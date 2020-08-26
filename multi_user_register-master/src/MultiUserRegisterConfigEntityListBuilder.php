<?php


namespace Drupal\multi_user_register;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\Element\EntityAutocomplete;
use Drupal\Core\Entity\EntityInterface;
use Drupal\user\Entity\User;

/**
 * Provides a listing of multi user register entities.
 */
class MultiUserRegisterConfigEntityListBuilder extends ConfigEntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Label');
    $header['url'] = $this->t('URL');
    $header['username'] = $this->t('Username');
    $header['password'] = $this->t('Password');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['url'] = $entity->get_url();
    $row['username'] = $entity->get_username();
    $row['password'] = '**********';
    return $row + parent::buildRow($entity);
  }

}
