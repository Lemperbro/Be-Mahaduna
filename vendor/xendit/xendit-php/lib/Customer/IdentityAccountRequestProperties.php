<?php
/**
 * IdentityAccountRequestProperties
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


use \ArrayAccess;
use \Xendit\ObjectSerializer;
use \Xendit\Model\ModelInterface;

/**
 * IdentityAccountRequestProperties Class Doc Comment
 *
 * @category Class
 * @package  Xendit
 * @implements \ArrayAccess<string, mixed>
 */
class IdentityAccountRequestProperties implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'IdentityAccountRequest_properties';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'account_number' => 'string',
        'account_holder_name' => 'string',
        'swift_code' => 'string',
        'account_type' => 'string',
        'account_details' => 'string',
        'currency' => 'string',
        'token_id' => 'string',
        'account_id' => 'string',
        'payment_code' => 'string',
        'expires_at' => 'string',
        'qr_string' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'account_number' => null,
        'account_holder_name' => null,
        'swift_code' => null,
        'account_type' => null,
        'account_details' => null,
        'currency' => null,
        'token_id' => null,
        'account_id' => null,
        'payment_code' => null,
        'expires_at' => null,
        'qr_string' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'account_number' => false,
		'account_holder_name' => true,
		'swift_code' => true,
		'account_type' => true,
		'account_details' => true,
		'currency' => false,
		'token_id' => false,
		'account_id' => false,
		'payment_code' => false,
		'expires_at' => true,
		'qr_string' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'account_number' => 'account_number',
        'account_holder_name' => 'account_holder_name',
        'swift_code' => 'swift_code',
        'account_type' => 'account_type',
        'account_details' => 'account_details',
        'currency' => 'currency',
        'token_id' => 'token_id',
        'account_id' => 'account_id',
        'payment_code' => 'payment_code',
        'expires_at' => 'expires_at',
        'qr_string' => 'qr_string'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'account_number' => 'setAccountNumber',
        'account_holder_name' => 'setAccountHolderName',
        'swift_code' => 'setSwiftCode',
        'account_type' => 'setAccountType',
        'account_details' => 'setAccountDetails',
        'currency' => 'setCurrency',
        'token_id' => 'setTokenId',
        'account_id' => 'setAccountId',
        'payment_code' => 'setPaymentCode',
        'expires_at' => 'setExpiresAt',
        'qr_string' => 'setQrString'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'account_number' => 'getAccountNumber',
        'account_holder_name' => 'getAccountHolderName',
        'swift_code' => 'getSwiftCode',
        'account_type' => 'getAccountType',
        'account_details' => 'getAccountDetails',
        'currency' => 'getCurrency',
        'token_id' => 'getTokenId',
        'account_id' => 'getAccountId',
        'payment_code' => 'getPaymentCode',
        'expires_at' => 'getExpiresAt',
        'qr_string' => 'getQrString'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('account_number', $data ?? [], null);
        $this->setIfExists('account_holder_name', $data ?? [], null);
        $this->setIfExists('swift_code', $data ?? [], null);
        $this->setIfExists('account_type', $data ?? [], null);
        $this->setIfExists('account_details', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('token_id', $data ?? [], null);
        $this->setIfExists('account_id', $data ?? [], null);
        $this->setIfExists('payment_code', $data ?? [], null);
        $this->setIfExists('expires_at', $data ?? [], null);
        $this->setIfExists('qr_string', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets account_number
     *
     * @return string|null
     */
    public function getAccountNumber()
    {
        return $this->container['account_number'];
    }

    /**
     * Sets account_number
     *
     * @param string|null $account_number Unique account identifier as per the bank records.
     *
     * @return self
     */
    public function setAccountNumber($account_number)
    {
        if (is_null($account_number)) {
            throw new \InvalidArgumentException('non-nullable account_number cannot be null');
        }
        $this->container['account_number'] = $account_number;

        return $this;
    }

    /**
     * Gets account_holder_name
     *
     * @return string|null
     */
    public function getAccountHolderName()
    {
        return $this->container['account_holder_name'];
    }

    /**
     * Sets account_holder_name
     *
     * @param string|null $account_holder_name Name of account holder as per the cardless credit account.
     *
     * @return self
     */
    public function setAccountHolderName($account_holder_name)
    {
        if (is_null($account_holder_name)) {
            array_push($this->openAPINullablesSetToNull, 'account_holder_name');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('account_holder_name', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['account_holder_name'] = $account_holder_name;

        return $this;
    }

    /**
     * Gets swift_code
     *
     * @return string|null
     */
    public function getSwiftCode()
    {
        return $this->container['swift_code'];
    }

    /**
     * Sets swift_code
     *
     * @param string|null $swift_code The SWIFT code for international payments
     *
     * @return self
     */
    public function setSwiftCode($swift_code)
    {
        if (is_null($swift_code)) {
            array_push($this->openAPINullablesSetToNull, 'swift_code');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('swift_code', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['swift_code'] = $swift_code;

        return $this;
    }

    /**
     * Gets account_type
     *
     * @return string|null
     */
    public function getAccountType()
    {
        return $this->container['account_type'];
    }

    /**
     * Sets account_type
     *
     * @param string|null $account_type Free text account type, e.g., Savings, Transaction, Virtual Account.
     *
     * @return self
     */
    public function setAccountType($account_type)
    {
        if (is_null($account_type)) {
            array_push($this->openAPINullablesSetToNull, 'account_type');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('account_type', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['account_type'] = $account_type;

        return $this;
    }

    /**
     * Gets account_details
     *
     * @return string|null
     */
    public function getAccountDetails()
    {
        return $this->container['account_details'];
    }

    /**
     * Sets account_details
     *
     * @param string|null $account_details Potentially masked account detail, for display purposes only.
     *
     * @return self
     */
    public function setAccountDetails($account_details)
    {
        if (is_null($account_details)) {
            array_push($this->openAPINullablesSetToNull, 'account_details');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('account_details', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['account_details'] = $account_details;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string|null $currency currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        if (is_null($currency)) {
            throw new \InvalidArgumentException('non-nullable currency cannot be null');
        }
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets token_id
     *
     * @return string|null
     */
    public function getTokenId()
    {
        return $this->container['token_id'];
    }

    /**
     * Sets token_id
     *
     * @param string|null $token_id The token id returned in tokenisation
     *
     * @return self
     */
    public function setTokenId($token_id)
    {
        if (is_null($token_id)) {
            throw new \InvalidArgumentException('non-nullable token_id cannot be null');
        }
        $this->container['token_id'] = $token_id;

        return $this;
    }

    /**
     * Gets account_id
     *
     * @return string|null
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     *
     * @param string|null $account_id Alphanumeric string identifying this account. Usually an email address or phone number.
     *
     * @return self
     */
    public function setAccountId($account_id)
    {
        if (is_null($account_id)) {
            throw new \InvalidArgumentException('non-nullable account_id cannot be null');
        }
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets payment_code
     *
     * @return string|null
     */
    public function getPaymentCode()
    {
        return $this->container['payment_code'];
    }

    /**
     * Sets payment_code
     *
     * @param string|null $payment_code Complete fixed payment code (including prefix)
     *
     * @return self
     */
    public function setPaymentCode($payment_code)
    {
        if (is_null($payment_code)) {
            throw new \InvalidArgumentException('non-nullable payment_code cannot be null');
        }
        $this->container['payment_code'] = $payment_code;

        return $this;
    }

    /**
     * Gets expires_at
     *
     * @return string|null
     */
    public function getExpiresAt()
    {
        return $this->container['expires_at'];
    }

    /**
     * Sets expires_at
     *
     * @param string|null $expires_at YYYY-MM-DD string with expiry date for the payment code
     *
     * @return self
     */
    public function setExpiresAt($expires_at)
    {
        if (is_null($expires_at)) {
            array_push($this->openAPINullablesSetToNull, 'expires_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('expires_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['expires_at'] = $expires_at;

        return $this;
    }

    /**
     * Gets qr_string
     *
     * @return string|null
     */
    public function getQrString()
    {
        return $this->container['qr_string'];
    }

    /**
     * Sets qr_string
     *
     * @param string|null $qr_string String representation of the QR Code image
     *
     * @return self
     */
    public function setQrString($qr_string)
    {
        if (is_null($qr_string)) {
            throw new \InvalidArgumentException('non-nullable qr_string cannot be null');
        }
        $this->container['qr_string'] = $qr_string;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


