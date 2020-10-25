<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Contracts\Common;


use CodeGenerator\Contracts\Common\CommentInterface;

/**
 * Trait CommentTrait
 *
 * @package CodeGenerator\Structure
 */
trait CommentTrait
{
    private string $comment = '';

    /**
     * @param string $comment
     *
     * @return CommentInterface
     */
    public function addComment(string $comment): CommentInterface
    {
        $this->comment .= $this->comment ? PHP_EOL . $comment : $comment;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     *
     * @return CommentInterface
     */
    public function setComment(string $comment): CommentInterface
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasComment(): bool
    {
        return $this->comment !== null;
    }

    /**
     * @return string
     */
    public function formatComment(): string
    {
        if ($this->comment === '') {
            return '';
        }

        if (strpos($this->comment, PHP_EOL) === false) {
            return "/** {$this->comment} */" . PHP_EOL;
        }
        return str_replace(PHP_EOL, PHP_EOL . ' * ', '/**'.PHP_EOL.$this->comment) . PHP_EOL . ' */' .PHP_EOL;
    }
}
