<template>
    <div class="grid-container">
        <el-card shadow="never" :body-style="{ padding: 0 }">
            <div class="bottom-border" ref="toolbarsView">
                <div class="grid-top-container">
                    <div class="grid-top-container-left">
                        <div class="search-view mr-10">
                            {{attrs.title}}
                        </div>
                    </div>
                    <div class="grid-top-container-right">

                        <component
                            v-if="attrs.filters"
                            v-for="(filter, index) in attrs.filters"
                            :key="filter.componentName + index"
                            v-model="attrs.filterData[filter.ref]"
                            :is="filter.componentName"
                            :attrs="filter"
                            :form-data="attrs.filterData"
                            @change="onChange"
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
        },
        data() {
            return {
                formData:null,
                value: ''
            };
        },

        mounted() {
            this.formData = {date_time:null}
            console.log(this.formData);
        },
        destroyed() {

        },
        methods: {
            onChange(value){
                console.log('card');
                console.log(value);
                // console.log(this.$refs);
                console.log(this.attrs.filterData);


                this.$http
                    .get(this.attrs.data_url, {
                        params: {
                            ...this.meta,
                            ...this.attrs.filterData,
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
