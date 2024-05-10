<?php

declare(strict_types=1);

namespace Drupal\global_tokens;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a global token entity type.
 */
interface GlobalTokenInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
