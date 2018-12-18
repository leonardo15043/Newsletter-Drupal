<?php
/**
 * @file
 * Contains \Drupal\newsletter\Form\NewsletterForm.
 */

namespace Drupal\newsletter\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class NewsletterForm extends FormBase {

  public function getFormId() {
    return 'newsletter_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Nombre:'),
      '#required' => TRUE,
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => t('E-mail:'),
      '#required' => TRUE,
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Enviar'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $mailManager = \Drupal::service('plugin.manager.mail');
    $to = $form_state->getValue('candidate_mail');
    $langcode = "es";
    $send = TRUE;
    $params = array();
    $result = $mailManager->mail('newsletter','send_mail', $to, $langcode, $params, NULL, $send);

    if(!$result){
      drupal_set_message("No se puedo enviar el correo", "error");
    }else{
      drupal_set_message("registro completado");

      $values = [
        'name' => $form_state->getValue('name'),
        'email' => $form_state->getValue('email'),
      ];

      return \Drupal::database()->insert('newsletter')->fields($values)->execute();

    }

  }

}
