<?php
/*
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Contracts\JTScript;


/**
 * Interface CommentInterface
 *
 * @package CodeGenerator\Contracts
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
