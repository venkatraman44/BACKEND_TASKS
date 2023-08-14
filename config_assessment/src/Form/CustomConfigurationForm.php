<?php

declare(strict_types = 1);

namespace Drupal\config_assessment\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Config assessment settings for this site.
 */
class CustomConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'config_assessment_custom_config';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return ['config_assessment.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['example'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Example'),
      '#default_value' => $this->config('config_assessment.settings')->get('example'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    // @todo Validate the form here.
    // Example:
    // @code
    //   if ($form_state->getValue('example') === 'wrong') {
    //     $form_state->setErrorByName(
    //       'message',
    //       $this->t('The value is not correct.'),
    //     );
    //   }
    // @endcode
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->config('config_assessment.settings')
      ->set('example', $form_state->getValue('example'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
