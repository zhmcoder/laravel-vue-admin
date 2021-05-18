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
                loading: false, //是否加载
                sort: {}, //排序对象
                tableData: [], //表格数据
                pageData: {
                    pageSize: this.attrs.perPage,
                    total: 0,
                    currentPage: 1,
                    lastPage: 1,
                },
                page: 1, //当前页
                quickSearch: null, //快捷搜索内容
                quickFilter: '', //快捷筛选内容 <!--deep admin-->
                selectionRows: [], //已选择的row
                filterFormData: null, //表单搜索数据
                tabsSelectdata: {},
                tabsActiveName: "all",
                topViewHeight: 0,
                toolbarsViewHeight: 0
            };
        },
        mounted() {
            // //初始化默认设置值
            // this.filterFormData = this._.cloneDeep(this.attrs.filter.filterFormData);
            // this.sort = this._.cloneDeep(this.attrs.defaultSort);
            // //deep admin start
            // if(this.attrs.quickFilter){
            //     this.quickFilter = this._.cloneDeep(
            //         this.attrs.quickFilter.defaultValue
            //     );
            // }
            // //deep admin end
            // //初始化vuex状态值
            // if (this.$store.getters.thisPage.grids.page) {
            //     this.page = this._.cloneDeep(this.$store.getters.thisPage.grids.page);
            //
            //     if (this.attrs.attributes.dataVuex) {
            //         this.tableData = this._.cloneDeep(
            //             this.$store.getters.thisPage.grids.tableData
            //         );
            //     }
            //
            //     this.pageData = this._.cloneDeep(
            //         this.$store.getters.thisPage.grids.pageData
            //     );
            //
            //     this.quickSearch = this._.cloneDeep(
            //         this.$store.getters.thisPage.grids.quickSearch
            //     );
            //
            //     this.filterFormData = this._.cloneDeep(
            //         this.$store.getters.thisPage.grids.filterFormData
            //     );
            //
            //     this.sort = this._.cloneDeep(this.$store.getters.thisPage.grids.sort);
            // }
            //
            // //加载数据
            // if (this.tableData.length <= 0 || !this.attrs.attributes.dataVuex) {
            //     this.getData();
            // }
            //
            // //监听事件
            // this.$bus.on("tableReload", () => {
            //     this.getData();
            // });
            // this.$bus.on("tableSetLoading", (status) => {
            //     this.loading = status;
            // });
            //
            // this.$bus.on("showDialogGridFrom", ({ isShow, key }) => {
            //     this.$refs["DialogGridFrom"].dialogVisible = isShow;
            //     this.$refs["DialogGridFrom"].key = key;
            // });
            //
            // this.$nextTick(() => {
            //     this.topViewHeight = this.$refs.topView.offsetHeight;
            //     this.toolbarsViewHeight = this.$refs.toolbarsView.offsetHeight;
            // });
        },
        destroyed() {
            //取消监听
            // try {
            //     this.$bus.off("tableReload");
            //     this.$bus.off("tableSetLoading");
            //     this.$bus.off("showDialogGridFrom");
            // } catch (e) {}
        },
        methods: {
            onChange(value){
                console.log('card');
                console.log(value);
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
                        console.log(res);
                    });
            }
            // onTabClick(e) {
            //     const name = this._.split(e.name, "----");
            //     this.tabsSelectdata[name[0]] = name[1];
            //
            //     this.getData();
            // },
            // //表单过滤提交
            // onFilterSubmit() {
            //     // deep admin start
            //     this.page = 1;
            //     // deep admin end
            //     this.getData();
            // },
            // //表单还原
            // onFilterReset() {
            //     this.filterFormData = this._.cloneDeep(this.attrs.filter.filterFormData);
            //     this.quickSearch = null;
            //     // deep admin start
            //     this.page = 1;
            //     // deep admin end
            //     this.getData();
            // },
            // //获取数据
            // getData() {
            //     this.loading = true;
            //     this.$http
            //         [this.attrs.method](this.attrs.dataUrl, {
            //         params: {
            //             get_data: true,
            //             page: this.page,
            //             per_page: this.pageData.pageSize,
            //             ...this.sort,
            //             ...this.q_search,
            //             ...this.quick_filter, //deep admin
            //             ...this.filterFormData,
            //             ...this.tabsSelectdata,
            //             ...this.$route.query,
            //         },
            //     })
            //         .then(({ data }) => {
            //             if (!this.attrs.hidePage) {
            //                 this.tableData = data.data;
            //                 this.pageData.pageSize = data.per_page;
            //                 this.pageData.currentPage = data.current_page;
            //                 this.pageData.total = data.total;
            //                 this.pageData.lastPage = data.last_page;
            //
            //                 this.$store.commit("setGridData", { key: "sort", data: this.sort });
            //                 this.$store.commit("setGridData", { key: "page", data: this.page });
            //                 this.$store.commit("setGridData", {
            //                     key: "pageData",
            //                     data: this.pageData,
            //                 });
            //             } else {
            //                 this.tableData = data;
            //             }
            //
            //             //**保存 Grid状态 */
            //             if (this.attrs.attributes.dataVuex) {
            //                 this.$store.commit("setGridData", {
            //                     key: "tableData",
            //                     data: this.tableData,
            //                 });
            //             }
            //
            //             this.$store.commit("setGridData", {
            //                 key: "quickSearch",
            //                 data: this.quickSearch,
            //             });
            //             //deep admin start
            //             this.$store.commit("setGridData", {
            //                 key: "quickFilter",
            //                 data: this.quickFilter,
            //             });
            //             //deep admin end
            //             this.$store.commit("setGridData", {
            //                 key: "filterFormData",
            //                 data: this.filterFormData,
            //             });
            //             /** */
            //         })
            //         .finally(() => {
            //             this.loading = false;
            //         });
            // },
            // //当表格的排序条件发生变化的时候会触发该事件
            // onTableSortChange({ column, prop, order }) {
            //     if (order) {
            //         this.sort.sort_field = column.columnKey; //后端排序字段
            //         this.sort.sort_prop = column.property; //表格排序字段
            //         this.sort.sort_order = order == "ascending" ? "asc" : "desc";
            //     } else {
            //         this.sort = {};
            //     }
            //     this.getData();
            // },
            // //当选择项发生变化时会触发该事件
            // onTableselectionChange(selection) {
            //     this.selectionRows = selection;
            //     this.$store.commit("setGridData", {
            //         key: "selectionKeys",
            //         data: this.keys,
            //     });
            // },
            // //每页大小改变时
            // onPageSizeChange(per_page) {
            //     this.page = 1;
            //     this.pageData.pageSize = per_page;
            //     this.getData();
            // },
            // //页码改变时
            // onPageCurrentChange(page) {
            //     this.page = page;
            //     this.getData();
            // },
            // downMove(sort) {
            //     // 当前操作项index
            //     let index = this.tableData.findIndex(function(item) {
            //         return item.sort == sort;
            //     });
            //     // sort属性index
            //     let cIndex = this.attrs.columnAttributes.findIndex(function(item) {
            //         return item.columnKey === 'sort';
            //     });
            //     let downItem = this.tableData[index + 1];
            //     let curItem = this.tableData[index]
            //     // 当前页最后一项下移重新加载列表
            //     if (index + 1 === this.tableData.length) {
            //         this.setSort(this.attrs.columnAttributes[cIndex].displayComponentAttrs.setSortAction, 'down', curItem.id, '', true)
            //     } else {
            //         this.tableData[index].sort = this.tableData[index+1].sort
            //         this.tableData[index+1].sort = sort
            //         this.tableData[index + 1] = this.tableData[index];
            //         this.tableData[index] = downItem;
            //         this.$set(this.tableData, index+1, curItem);
            //         this.$set(this.tableData, index, downItem);
            //         this.setSort(this.attrs.columnAttributes[cIndex].displayComponentAttrs.setSortAction, 'down', curItem.id, downItem.id, false)
            //     }
            // },
            // upMove(sort) {
            //     // 当前操作项index
            //     let index = this.tableData.findIndex(function(item) {
            //         return item.sort == sort;
            //     });
            //     // sort属性index
            //     let cIndex = this.attrs.columnAttributes.findIndex(function(item) {
            //         return item.columnKey === 'sort';
            //     });
            //     let downItem = this.tableData[index - 1];
            //     let curItem = this.tableData[index]
            //     // 当前页第一项上移重新加载列表
            //     if (index === 0) {
            //         this.setSort(this.attrs.columnAttributes[cIndex].displayComponentAttrs.setSortAction, 'up', curItem.id, '', true)
            //     } else {
            //         this.tableData[index].sort = this.tableData[index-1].sort
            //         this.tableData[index-1].sort = sort
            //         this.tableData[index - 1] = this.tableData[index];
            //         this.tableData[index] = downItem;
            //         this.$set(this.tableData, index-1, curItem);
            //         this.$set(this.tableData, index, downItem);
            //         this.setSort(this.attrs.columnAttributes[cIndex].displayComponentAttrs.setSortAction, 'up', curItem.id, downItem.id, false)
            //     }
            // },
            // setSort(url, type, curId, changeId, refreshTable) {
            //     let param = {
            //         sort_type: type,
            //         current_id: curId
            //     }
            //     if (changeId) {
            //         Object.assign(param, { change_id: changeId })
            //     }
            //     this.onRequest(url, param, refreshTable)
            // },
            // /**
            //  * uri 接口路径
            //  * params 请求参数
            //  * refreshTable 是否重新请求table数据
            //  */
            // onRequest(uri, params, refreshTable) {
            //     this.$http.post(uri, params)
            //         .then((res) => {
            //             if (res.code == 200) {
            //                 if (refreshTable) {
            //                     this.tableData = []
            //                     this.getData()
            //                 }
            //             }
            //         })
            // }
        },
        computed: {
            // keys() {
            //     return this.selectionRows
            //         .map((item) => {
            //             return item[this.attrs.keyName];
            //         })
            //         .join(",");
            // },
            // //当前路径
            // path() {
            //     return this.$route.path;
            // },
            // //
            // columns() {
            //     return this.column_attributes.map((attributes) => {
            //         return attributes;
            //     });
            // },
            // //默认排序
            // default_sort_get() {
            //     let defaultSort = {}
            //     // 有sort按sort排序
            //     if (this.attrs.columnAttributes.map(a => a.prop).indexOf('sort') > -1) {
            //         defaultSort = {
            //             prop: 'sort',
            //             order: this.sort && this.sort.sort_order == "asc" ? "ascending" : "descending",
            //         }
            //     } else if(this.sort) {
            //         defaultSort = {
            //             prop: this.sort.sort_prop,
            //             order: this.sort.sort_order == "asc" ? "ascending" : "descending",
            //         }
            //     }
            //     return defaultSort
            //     // return this.sort
            //     //   ? {
            //     //       prop: this.sort.sort_prop,
            //     //       order: this.sort.sort_order == "asc" ? "ascending" : "descending",
            //     //     }
            //     //   : {};
            // },
            // //搜索处理
            // q_search() {
            //     const q_search = new Object();
            //     this.attrs.quickSearch &&
            //     (q_search[this.attrs.quickSearch.searchKey] = this.quickSearch);
            //     return q_search;
            // },
            // //deep admin start
            // quick_filter() {
            //     const quick_filter = new Object();
            //     this.attrs.quickFilter &&
            //     (quick_filter[this.attrs.quickFilter.filterKey] = this.quickFilter);
            //     return quick_filter;
            // },
            // //deep admin end
            // gridHeight() {
            //     if (this.attrs.attributes.height == "auto") {
            //         return (
            //             window.innerHeight -
            //             55 -
            //             window.rootFooterHeight -
            //             (this.topViewHeight > 0 ? this.topViewHeight + 10 : 0) -
            //             25 -
            //             this.toolbarsViewHeight
            //         );
            //     }
            //     return this.attrs.attributes.height;
            // },
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
