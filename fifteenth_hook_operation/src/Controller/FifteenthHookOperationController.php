<?php

declare(strict_types = 1);

namespace Drupal\fifteenth_hook_operation\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * Returns responses for Fifteenth hook operation routes.
 */
final class FifteenthHookOperationController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function title(Node $node) {
    $title = $node->getTitle();
    $build['content'] = [
      '#markup' => $title,
    ];

    return $build;
  }

}
