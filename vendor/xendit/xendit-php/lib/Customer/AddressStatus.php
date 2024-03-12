<?php
/**
 * AddressStatus
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  Xendit
 */

/**
 * XENDIT SDK openapi spec
 *
 * The version of the OpenAPI document: 1.0.0
 */

/**
 * NOTE: This class is auto generated.
 * Do not edit the class manually.
 */

namespace Xendit\Customer;

use \Xendit\ObjectSerializer;
use \Xendit\Model\ModelInterface;

/**
 * AddressStatus Class Doc Comment
 *
 * @category Class
 * @package  Xendit
 */
class AddressStatus
{
    /**
     * Possible values of this enum
     */
    
    public const ACTIVE = 'ACTIVE';
    
    public const DELETED = 'DELETED';
    
    public const XENDIT_ENUM_DEFAULT_FALLBACK = 'UNKNOWN_ENUM_VALUE';

    private $value;

    public function __construct($value = null) {
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        if (!self::isValid($value)) {
            throw new \InvalidArgumentException(sprintf('Invalid value for enum AddressStatus: %s', $value));
        }
        $this->value = $value;
    }

    public function __toString() {
        return (string)$this->value;
    }

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::ACTIVE,
            self::DELETED,
            self::XENDIT_ENUM_DEFAULT_FALLBACK
        ];
    }
}


