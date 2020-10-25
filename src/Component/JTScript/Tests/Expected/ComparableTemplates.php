<?php
/**
 * This file is part of CodeGenerator
 *
 * (c) Bjoern Klemm <appsdock.enterprise@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeGenerator\Component\JTScript\Tests\Expected;


/**
 * Class ComparableTemplates
 *
 * @package CodeGenerator\Component\JTScript\Tests
 */
class ComparableTemplates
{
    public static function tsClass(): string
    {
        return <<<TS
        /**
         * This file is part of the CodeGenerator project.
         * 
         * (c) CodeGenerator <project@CodeGenerator.de>
         * 
         * For the full copyright and license information, please view the LICENSE
         * file that was distributed with this source code.
         */
        
        import {Component,Vue} from 'vue-property-decorator';
        import {getModule} from 'vuex-module-decorators';
        
        /**
         * This is a Ts Task class
         * Use this in vue js
         */
        @Component({
            compontents: {Form,Table},
            computed: ...mapState({currentApp: (state:any) => state.currentApp})
        })
        @Watch('child')
        @Prop({
            default: 'def'
        })
        export default class Task extends Vue {
            name = 'ben';
            /** LC Hook create */
            public created(namestring): void {
                let a = await this.get("/hrm");
            }
            /** LC Hook mount */
            public mounted(): void {      
            }
        }
        TS;
    }

    public static function script(): string
    {
        return <<<TS
        export const state = {


        };
        
        export const mutations = {
        
            INCREMENT_ACTIVE(state) {
                state.active++
            }
            DECREMENT_ACTIVE(state) {
                if (state.active >= 1) { state.active-- }
            }
        };
        
        TS;

    }

    public static function constant(): string
    {
        return <<<TS
        export const TASK = 'data';
        export default () => ({
            [TASKS]: [],
            [TOTAL]: [],
            [PAGINATION]: {
                page: 1,
                limit: 10,
                totalPages: 0,
                totalItems: 0
            }
        });

        TS;

    }

    public static function objects(): string
    {
        return <<<TS
        export default {
            [SET_DATA](state, data) {
                state.data = data
            },
            [SET_PAGE](state, pagination) {
                state.pagination = pagination
            },
            [SET_TOTAL](state, data) {
                state.total[state.pagination.page] = data
            }
        }
        export {*} from './state';
        export {*} from './mutations';
        export {*} from './actions';

        TS;

    }

    public static function javaClass(): string
    {
        return <<<Java
        package com.jentix.services.parking.reservation.core.command;

        import lombok.Value;
        
        @Value
        public class ConfirmReservation {
        
            String reservationId;
        }
        Java;

    }
}
