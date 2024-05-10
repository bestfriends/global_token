<?php

namespace Drupal\global_tokens\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'advanced_text_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "global_tokens_text",
 *   module = "global_tokens",
 *   label = @Translation("Global Token Text"),
 *   field_types = {
 *     "string",
 *     "string_long",
 *     "text",
 *     "text_long",
 *     "text_with_summary",
 *   },
 *   quickedit = {
 *     "editor" = "plain_text"
 *   }
 * )
 */
class GlobalTokenTextFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $token_data = [
      $items->getEntity()->getEntityTypeId() => $items->getEntity(),
    ];

    foreach ($items as $delta => $item) {
      $output = \Drupal::token()->replace($item->value, $token_data, ['clear' => TRUE]);
      $elements[$delta] = [
        '#markup' => $output,
        '#langcode' => $item->getLangcode(),
      ];
    }

    return $elements;
  }

}
