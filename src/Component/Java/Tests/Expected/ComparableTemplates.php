<?php
/**
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\Java\Tests\Expected;


/**
 * Class ComparableTemplates
 *
 * @package CodeGenerator\Component\JTScript\Tests
 */
class ComparableTemplates
{
    public static function javaClass(): string
    {
        return <<<Java
        package com.jentix.services.parking.reservation.core.command;

        import org.springframework.web.bind.annotation.RequestMapping;
        import org.axonframework.spring.stereotype.Aggregate;
        
        @Aggregate
        @RequestMapping
        public class Task extends Parent {
            String reservationId;
            public void create(String name) {
            }
        }
        Java;

    }
}
