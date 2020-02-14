<?php

declare(strict_types=1);

namespace Gubler\UuidEncoder;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidEncoder
{
    public const DEFAULT_CHARSET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    /** @var string */
    private $charset;

    public function __construct(string $charset = self::DEFAULT_CHARSET)
    {
        $this->charset = $charset;
    }

    /**
     * Parse input and return a UUID if possible
     *
     * - If a UUID is provided, will return the UUID,
     * - If a UUID String is provided, will convert to a UUID
     * - If an encoded UUID string (from this class's encode method) is provided, will decode and return UUID
     *
     * @param UuidInterface|string $id
     */
    public function parse($id): UuidInterface
    {
        if ($id instanceof UuidInterface) {
            return $id;
        }

        if (Uuid::isValid($id)) {
            return Uuid::fromString($id);
        }

        return $this->decode($id);
    }

    /**
     * Encode a UUID to a shorter string.
     *
     * The provided $uuid will be parsed before encoding
     *
     * @param UuidInterface|string $uuid
     */
    public function encode($uuid): string
    {
        $source = $this->parse($uuid);

        $number = (string) $source->getInteger();

        $encode = '';

        while (bccomp($number, '0') === 1) {
            $mod = bcmod($number, (string) strlen($this->charset));
            $encode .= $this->charset[(int) $mod];
            $number = bcdiv(bcsub($number, $mod), (string) strlen($this->charset));
        }

        return strrev($encode);
    }

    /**
     * Decode a string generated by UuidEncoder::encode() back into a UUID.
     *
     * Note that the same charset used to encode the UUID must be used to decode the string.
     */
    public function decode(string $encodedUuid): UuidInterface
    {
        $length = strlen($encodedUuid);
        $array = array_flip(str_split($this->charset));
        $number = 0;

        for ($i = 0; $i < $length; ++$i) {
            $number = bcadd(
                (string) $number,
                bcmul(
                    (string) $array[$encodedUuid[$i]],
                    bcpow(
                        (string) strlen($this->charset),
                        (string) ($length - $i - 1)
                    )
                )
            );
        }

        return Uuid::fromInteger($number);
    }
}
