<?php

namespace Drupal\task4\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements the example form.
 */
class NodeForm extends ConfigFormBase {
  const RESULT = "task4.settings";

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'token_form';
  }

  /**
   * Function.
   */
  protected function getEditableConfigNames() {
    return [
      static::RESULT,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::RESULT);
    $form['subject'] = [
      '#type' => 'textfield',
      '#title' => 'Subject',
      '#default_value' => $config->get("subject"),
    ];

    $text_format = 'full_html';
    if ($config->get('text')['format']) {
      $text_format = $config->get('text')['format'];
    }
    $form['text'] = [
      '#type' => 'text_format',
      '#title' => 'Text',
      '#format' => $text_format,
      '#default_value' => $config->get("text")['value'],
    ];

    if (\Drupal::moduleHandler()->moduleExists('token')) {
      $form['tokens'] = [
        '#title' => $this->t('Tokens'),
        '#type' => 'container',
      ];
      $form['tokens']['help'] = [
        '#theme' => 'token_tree_link',
        '#token_types' => [
          'node',
        ],
        '#global_types' => FALSE,
        '#dialog' => TRUE,
      ];
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config(static::RESULT);
    $config->set("subject", $form_state->getValue('subject'));
    $config->set("text", $form_state->getValue('text'));
    $config->save();
  }

}
