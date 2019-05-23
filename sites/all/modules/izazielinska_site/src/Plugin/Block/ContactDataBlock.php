<?php

namespace Drupal\izazielinska_site\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "contact_data_block",
 *   admin_label = @Translation("ContactDataBlock"),
 * )
 */
class ContactDataBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $phone = \Drupal::config('system.site')->get('contact_phone');
    $email = \Drupal::config('system.site')->get('contact_email');
    return [
      '#markup' => '<span>' . $this->t('Phone: :phone, email: <a href="mailto:@email">@email</a>', [':phone' => $phone, '@email' => $email]) . '</span>',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['contact_data_block_settings'] = $form_state->getValue('contact_data_block_settings');
  }
}