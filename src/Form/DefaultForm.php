<?php

/**
 * @file
 * Contains \Drupal\form_test\Form\DefaultForm.
 */

namespace Drupal\form_test\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DefaultForm.
 *
 * @package Drupal\form_test\Form
 */
class DefaultForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'test_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['trigger_select'] = [
      '#type' => 'select',
      '#title' => 'trigger',
      '#options' => [
        '' => '',
        'a' => 'Form a',
        'b' => 'Form b',

      ],
      '#required' => TRUE,
      '#ajax' => array(
        'wrapper' => 'container-id',
        'callback' => '::ajaxCallback',

      ),
    ];
    $form['trigger2'] = $form['trigger_select'];
    $form['container'] = [
      '#type' => 'container',
      '#prefix' => '<div id="container-id">',
      '#suffix' => '</div>',
    ];
    $trigger = $form_state->getTriggeringElement();
    $mode = $form_state->getValue($trigger['#name']);
    if ($mode == 'a') {
      $form['container']['element_a'] = [
        '#type' => 'select',
        '#title' => 'A',
        '#options' => ['1' => 'one', '2' => 'two'],
      ];
      $form['container']['element_d'] = [
        '#type' => 'textfield',
        '#title' => 'D',

      ];
    }
    elseif ($mode == 'b') {
      $form['container']['element_b'] = [
        '#type' => 'select',
        '#title' => 'B',
        '#options' => ['3' => 'three', '4' => 'four'],
      ];
    }
    else {
      $form['container']['element_c'] = [
        '#type' => 'select',
        '#title' => 'c',
        '#options' => ['5' => 'five', '6  ' => 'six'],
      ];
    }

    $form['text'] = [
      '#type' => 'textfield',
      '#title' => 'dfasd',
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Save',
    ];

    return $form;
  }

  public function ajaxCallback(array $form, FormStateInterface $form_state) {
    return $form['container'];
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
