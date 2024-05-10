<?php

/**
 * @file
 * Provides token integration for global tokens.
 */

use Drupal\Core\Render\BubbleableMetadata;

/**
 * Implements hook_token_info().
 */
function global_tokens_token_info() {
  if ($global_tokens = \Drupal::entityTypeManager()->getStorage('global_token')->loadByProperties(['status' => TRUE])) {
    $types['global'] = [
      'name' => t("Global"),
      'description' => t("Global type grouping for tokens"),
    ];

    foreach ($global_tokens as $global_token) {
      $tokens[$global_token->getKey()] = [
        'name' => $global_token->label(),
        'description' => $global_token->getDescription(),
      ];
    }

    return [
      'types' => $types,
      'tokens' => [
        'global' => $tokens,
      ],
    ];
  }
}

/**
 * Implements hook_tokens().
 */
function global_tokens_tokens($type,
 $tokens,
 array $data,
 array $options,
 BubbleableMetadata $bubbleable_metadata) {

  $replacements = [];
  if ($type == 'global') {
    foreach ($tokens as $name => $original) {
      $global_token = \Drupal::entityTypeManager()->getStorage('global_token')
        ->loadByProperties(['key' => $name, 'status' => TRUE]);
      if ($global_token) {
        $replacements[$original] = $global_token[key($global_token)]->getValue();
      }
    }
  }

  return $replacements;
}
