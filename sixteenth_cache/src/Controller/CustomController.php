<?php

namespace Drupal\sixteenth_cache\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Cache\Cache;
use Drupal\node\Entity\Node;

/**
 * Returns responses for Fifteenth hook operation routes.
 */
final class CustomController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function title(Node $node) {
    $nid = $node->id();
    $cid = 'markneww:' . $nid;
    if ($item = \Drupal::cache()->get($cid)) {
      return $item->data;
    }

    // Build up the markdown array we're going to use later.
    $node = Node::load($nid);
    $title = $node->getTitle();
    $markneww = [
      '#markup' => $title,
    ];

    // Set the cache so we don't need to do this work again until $node changes.
    \Drupal::cache()->set($cid, $markneww, Cache::PERMANENT, $node->getCacheTags());

    return $markneww;
  }

}
