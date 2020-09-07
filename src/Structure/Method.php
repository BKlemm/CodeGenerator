<?php
/*
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Structure;

use JTGenerator\Contracts\CommentInterface;
use JTGenerator\Delegate\CommentTrait;
use JTGenerator\Delegate\MemberTrait;
use JTGenerator\Delegate\NameTrait;
use JTGenerator\Exception\RenderAssertion;

/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


/**
 * Class Method
 *
 * @package JTGenerator\Structure
 */
class Method implements CommentInterface
{
    use CommentTrait;
    use NameTrait;
    use MemberTrait;

    private string $body;

    private bool $abstract = false;

    /**
     * @var Parameter[]
     */
    private array $parameters = [];

    private ?string $returnType = null;

    private bool $async = false;

    private bool $static = false;

    /**
     * Method constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setReturnType(string $type): self
    {
        $this->returnType = $type;

        return $this;
    }

    /**
     * @param string $body
     *
     * @return $this
     */
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param Parameter ...$parameters
     */
    public function setParameters(Parameter ...$parameters): void
    {
        foreach ($parameters as $parameter) {
            $this->parameters[$parameter->getName()] = $parameter;
        }
    }

    /**
     * @param string $name
     * @param null   $value
     *
     * @return $this
     */
    public function addParameter(string $name, $value = null): self
    {
        if (!isset($this->parameters[$name])) {
            $this->parameters[$name] = (new Parameter($name))->setValue($value);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }


    public function validate(): void
    {
        RenderAssertion::assertName($this->getName());
    }

    /**
     * @return bool
     */
    public function isAbstract(): bool
    {
        return $this->abstract;
    }

    /**
     * @return Parameter[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return string|null
     */
    public function getReturnType(): ?string
    {
        return $this->returnType;
    }

    /**
     * @param Parameter $param
     *
     * @return $this
     */
    public function setParameter(Parameter $param): self
    {
        if (!isset($this->parameters[$param->getName()])) {
            $this->parameters[$param->getName()] = $param;
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @return Parameter|null
     */
    public function getParameter(string $name): ?Parameter
    {
        if (\array_key_exists($name, $this->parameters)) {
            return $this->parameters[$name];
        }
        return null;
    }

    /**
     * @param bool $async
     *
     * @return $this
     */
    public function setAsync(bool $async = true): self
    {
        $this->async = $async;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAsync(): bool
    {
        return $this->async;
    }

    /**
     * @return bool
     */
    public function hasBody(): bool
    {
        return $this->body !== null && \strlen($this->body) > 1;
    }

    /**
     * @param bool $state
     *
     * @return $this
     */
    public function setStatic(bool $state = true): self
    {
        $this->static = $state;

        return $this;
    }

    /**
     * @return bool
     */
    public function isStatic(): bool
    {
        return $this->static;
    }
}
