<?php

declare(strict_types = 1);

namespace Drupal\assesmentone\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses.
 */
final class Assesment1Controller extends ControllerBase {

  /**
   * Function.
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * Function.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * Function.
   */
  public function task() {
    $query = $this->database->select('assessment_information')
      ->fields('assessment_information',
      ['firstname', 'lastname', 'email', 'gender', 'phone'])
      ->execute();
    $result = [];
    foreach ($query as $row) {
      $result[] = [
        '#markup' => $this->t(' @first | @last | @email | @gender | @phone', [
          '@first' => $row->firstname,
          '@last' => $row->lastname,
          '@email' => $row->email,
          '@gender' => $row->gender,
          '@phone' => $row->phone,
        ]),

      ];
    }
    return [
      '#theme' => 'custom_theme',
      '#rows' => $result,
    ];
  }

}
