<?php
/**
 * This file is part of JTGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JTGenerator\Contracts;


/**
 * Interface CommentInterface
 *
 * @package JTGenerator\Contracts
 */
interface CommentInterface
{
    /**
     * @param string $comment
     *
     * @return $this
     */
    public function addComment(string $comment): self;

    /**
     * @return string|null
     */
    public function getComment(): ?string;

    /**
     * @param string $comment
     *
     * @return $this
     */
    public function setComment(string $comment): self;

    /**
     * @return bool
     */
    public function hasComment(): bool;

    /**
     * @return string
     */
    public function formatComment(): string;
}
