<?php

namespace Drupal\rsvplist\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides a 'RSVP Block.
 *
 * @Block(
 *   id = "rsvpblock",
 *   admin_label = @Translation("RSVP block"),
 *   category = @Translation("RSVP"),
 * )
 */

class RSVPBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */ 
  public function build() {
  /*  return array('#markup' => $this->t('My RSVP List Block Two'));*/
    return \Drupal::formBuilder()->getForm('Drupal\rsvplist\Form\RSVPForm');
  }
 
  public function blockAccess(AccountInterface $account) {
    /** @var\Drupal\node\Entity\Node $node   */
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = $node->nid->value;
    $enabler = \Drupal::service('rsvplist.enabler');
    if(is_numeric($nid)) {
      if ($enabler->isEnabled($node)) {
        return AccessResult::allowedIfHasPermission($account, 'view rsvplist');
      }
    }  
    return AccessResult::forbidden();
  }

}