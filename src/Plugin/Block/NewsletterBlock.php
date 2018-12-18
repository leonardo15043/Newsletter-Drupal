<?php

/**
 * @file
 * Contains \Drupal\newsletter\Plugin\Block\NewsletterBlock.
 */

namespace Drupal\newsletter\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
/**
 * Provides a 'newsletter' block.
 *
 * @Block(
 *   id = "newsletter_block",
 *   admin_label = @Translation("Newsletter block"),
 *   category = @Translation("Newsletter block")
 * )
 */
class NewsletterBlock extends BlockBase {

  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\newsletter\Form\NewsletterForm');
    return $form;
   }
}
