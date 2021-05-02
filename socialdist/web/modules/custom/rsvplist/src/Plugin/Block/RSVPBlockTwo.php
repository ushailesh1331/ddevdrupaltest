<?php

namespace Drupal\rsvplist\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides a 'RSVP Block Two dude.
 *
 * @Block(
 *   id = "rsvpblocktwo",
 *   admin_label = @Translation("RSVP block two mister"),
 *   category = @Translation("RSVP"),
 * )
 */

class RSVPBlockTwo extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array('#markup' => $this->t('My RSVP List Block Two'));
  }

}