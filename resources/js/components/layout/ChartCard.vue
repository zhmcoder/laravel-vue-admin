<template>
    <div class="grid-container">
        <el-card shadow="never" :body-style="{ padding: 0 }" v-loading="loading">
            <div class="bottom-border" ref="toolbarsView">
                <div class="grid-top-container">
                    <div class="grid-top-container-left">
                        <div class="search-view mr-10">
                            {{attrs.title}}
                        </div>
                    </div>
                    <div class="grid-top-container-right">
                        <component
                            v-for="(component, index) in attrs.filters"
                            :value="value"
                            :ref="component.ref"
                            :key="component.componentName + index"
                            :is="component.componentName"
                            :attrs="component"
                            @change="onChange"
                            style="padding-left: 10px"
                        />
                    </div>
                </div>
            </div>
            <div>
                <component
                    v-if="attrs.chart"
                    :is="attrs.chart.componentName"
                    :attrs="attrs.chart"
                    ref="chart"
                />
            </div>
        </el-card>

    </div>
</template>

<script>
    import { BaseComponent } from "@/mixins.js";

    export default {
        mixins: [BaseComponent],
        components: {

        },
        props: {
            attrs: Object,
            value: {
                default: 1,
            },
        },
        data() {
            return {
                value:this.value,
            };
        },
        mounted() {

        },
        destroyed() {

        },
        methods: {
            onChange(value){
                console.log('card');
                console.log(value);
                console.log(this.$refs);
                console.log(this.$refs.chart);

                this.$http
                    .get(this.attrs.data_url, {
                        params: {
                            ...this.meta,
                            query: this.query,
                            depend: this.depend,
                            extUrlParams: this.extUrlParams
                        }
                    })
                    .then(res => {
                        this.attrs.chart.data=res;
                        this.$refs.chart.chart_data(res);
                        console.log(res);
                    });
            }
        },
        computed: {

        },
    };
</script>

<style lang="scss">
    .grid-container {
        .bottom-border {
            border-bottom: 1px solid #ebeef5;
        }
        .grid-top-container {
            padding: 8px;
            display: flex;
            justify-content: space-between;
            min-height: 32px;
            .grid-top-container-left {
                display: flex;
                align-items: center;
            }
            .grid-top-container-right {
                display: flex;
                align-items: center;
                .icon-actions {
                    display: flex;
                    align-items: center;
                    margin-left: 5px;
                    i {
                        font-size: 20px;
                        margin-right: 10px;
                    }
                }
            }
        }
        .el-tabs__header {
            padding: 0;
            margin: 0;
        }
        .el-tabs__item {
            padding: 0 15px;
            height: 50px;
            line-height: 50px;
        }
        .el-tabs--top .el-tabs__item.is-top:nth-child(2) {
            padding-left: 15px;
        }
        .el-tabs__nav-wrap::after {
            height: 1px;
            background-color: #ebeef5;
        }
        .filter-form {
            padding: 10px;
            background-color: #ffffff;
            .el-form-item {
                margin-bottom: 0px;
                .el-form-item__label {
                    padding: 0;
                }
            }
        }
    }
</style>
