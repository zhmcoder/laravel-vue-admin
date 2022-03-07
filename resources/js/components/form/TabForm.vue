<template>
    <div class="form-page">
        <component
            v-if="newAttrs.top"
            :is="newAttrs.top.componentName"
            :attrs="newAttrs.top"
        />
        <component
            :is="newAttrs.attrs.isDialog ? 'div' : 'el-card'"
            shadow="never"
            class="form-card"
            v-loading="loading"
        >
            <el-form
                v-if="formData"
                :ref="newAttrs.ref || 'form'"
                :model="formData"
                :class="newAttrs.attrs.className"
                :style="newAttrs.attrs.style"
                :rules="newAttrs.formRules"
                :inline="newAttrs.attrs.inline"
                :label-position="newAttrs.attrs.labelPosition"
                :label-width="newAttrs.attrs.labelWidth"
                :label-suffix="newAttrs.attrs.labelSuffix"
                :hide-required-asterisk="newAttrs.attrs.hideRequiredAsterisk"
                :show-message="newAttrs.attrs.showMessage"
                :inline-message="newAttrs.attrs.inlineMessage"
                :status-icon="newAttrs.attrs.statusIcon"
                :validate-on-rule-change="newAttrs.attrs.validateOnRuleChange"
                :size="newAttrs.attrs.size"
                :disabled="newAttrs.attrs.disabled"
            >
                <component :is="newAttrs.attrs.hideTab ? 'div' : 'el-tabs'" :tab-position="newAttrs.attrs.hideTab ? null : newAttrs.attrs.tabPosition" v-model="activeName" @tab-click="handleClick">
                    <component
                        :is="newAttrs.attrs.hideTab ? 'div' : 'el-tab-pane'"
                        :label="tab"
                        v-for="tab in newAttrs.tabs"
                        :key="tab"
                        :name="tab"
                    >
                        <template v-if="attrs.attrs.hideTab ? true : activeName == tab">
                            <template v-for="(item, index) in newAttrs.formItems">
                                <ItemIf
                                    v-if="tab == item.tab"
                                    :key="index"
                                    :form_item="item"
                                    :form_items="newAttrs.formItems"
                                    :form_data="formData"
                                >
                                    <component
                                        v-if="item.topComponent"
                                        :is="item.topComponent.componentName"
                                        :attrs="item.topComponent"
                                    />

                                    <el-form-item
                                        :prop="item.prop"
                                        :label-width="item.labelWidth"
                                        :error="item.error"
                                        :show-message="item.showMessage"
                                        :inline-message="item.inlineMessage"
                                        :size="item.size"
                                    >
                    <span slot="label" v-if="!item.hideLabel">
                        {{ item.label }}
                    </span>
                                        <template v-if="!item.component||(item.component&&item.component.type!='hidden')">
                                            <el-col :span="item.inputWidth">
                                                <template v-if="item.relationName">
                                                    <ItemDiaplsy
                                                        v-model="
                                formData[item.relationName][item.relationValueKey]
                            "
                                :default-prop-values="defaultFormData ? defaultFormData[item.relationName][item.relationValueKey] : null"

                                                        :form-item="item"
                                                        :form-items="newAttrs.formItems"
                                                        :form-data="formData"
                                                    />
                                                </template>
                                                <template v-else>
                                                    <ItemDiaplsy
                                                        v-model="formData[item.prop]"
                                                        :default-prop-values="defaultFormData ? defaultFormData[item.prop] : null"
                                                        :form-item="item"
                                                        :form-items="newAttrs.formItems"
                                                        :form-data="formData"
                                                    />
                                                </template>

                                                <div
                                                    v-if="item.help"
                                                    class="form-item-help"
                                                    v-html="item.help"
                                                ></div>
                                            </el-col>
                                        </template>
                                    </el-form-item>
                                    <component
                                        v-if="item.footerComponent"
                                        :is="item.footerComponent.componentName"
                                        :newAttrs="item.footerComponent"
                                    />
                                </ItemIf>
                            </template>
                        </template>
                    </component>
                </component>
                <component
                    :is="newAttrs.actions.fixed ? 'Affix' : 'div'"
                    :offset-bottom="20"
                >
                    <div
                        class="form-bottom-actions flex padding-tb"
                        :class="{ 'form-bottom-actions-fixedxxx': newAttrs.actions.fixed , 'form-bottom-actions_center':newAttrs.actions.buttonCenter}"
                    >
                        <div>
                            <component
                                v-for="(component, index) in newAttrs.actions.addLeftActions"
                                :key="component.componentName + index"
                                :is="component.componentName"
                                :attrs="component"
                            />
                        </div>
                        <div class="flex custom_style" :class="{'custom_style_center':newAttrs.actions.buttonCenter}">
                            <component
                                v-for="(component, index) in newAttrs.actions.addRightActions"
                                :key="component.componentName + index"
                                :is="component.componentName"
                                :attrs="component"
                            />
                            <el-button
                                v-if="newAttrs.actions.cancelButton"
                                :style="newAttrs.actions.cancelButton.style"
                                :class="newAttrs.actions.cancelButton.className"
                                :type="newAttrs.actions.cancelButton.type"
                                :size="newAttrs.actions.cancelButton.size"
                                :plain="newAttrs.actions.cancelButton.plain"
                                :round="newAttrs.actions.cancelButton.round"
                                :circle="newAttrs.actions.cancelButton.circle"
                                :disabled="newAttrs.actions.cancelButton.disabled"
                                :icon="newAttrs.actions.cancelButton.icon"
                                :autofocus="newAttrs.actions.cancelButton.autofocus"
                                :loading="loading"
                                @click="onCancel"
                            >
                                <template v-if="newAttrs.actions.cancelButton.content">{{
                                    newAttrs.actions.cancelButton.content
                                    }}
                                </template>
                            </el-button>

                            <el-button
                                v-if="newAttrs.actions.submitButton"
                                :style="newAttrs.actions.submitButton.style"
                                :class="newAttrs.actions.submitButton.className"
                                :type="newAttrs.actions.submitButton.type"
                                :size="newAttrs.actions.submitButton.size"
                                :plain="newAttrs.actions.submitButton.plain"
                                :round="newAttrs.actions.submitButton.round"
                                :circle="newAttrs.actions.submitButton.circle"
                                :disabled="newAttrs.actions.submitButton.disabled"
                                :icon="newAttrs.actions.submitButton.icon"
                                :autofocus="newAttrs.actions.submitButton.autofocus"
                                :loading="loading"
                                @click="submitForm(newAttrs.ref || 'form')"
                            >
                                <template v-if="newAttrs.actions.submitButton.content">{{
                                    newAttrs.actions.submitButton.content
                                    }}
                                </template>
                            </el-button>
                        </div>
                    </div>
                </component>
            </el-form>
        </component>
        <component
            v-if="newAttrs.bottom"
            :is="newAttrs.bottom.componentName"
            :attrs="newAttrs.bottom"
        />
    </div>
</template>
<script>
    import {BaseComponent} from "@/mixins.js";
    import ItemDiaplsy from "./ItemDiaplsy";
    import ItemIf from "./ItemIf";
    import {isNull} from "../../utils";
    import Affix from "../widgets/common/affix";

    export default {
        mixins: [BaseComponent],
        components: {
            ItemDiaplsy,
            ItemIf,
            Affix,
        },
        props: {
            attrs: Object,
        },
        computed: {
            isEdit() {
                return this.attrs.mode == "edit";
            },
            ignoreKey() {
                return this._.map(
                    this.newAttrs.formItems.filter(
                        (e) => !e.ignoreEmpty || !isNull(this.formData[e.prop])
                    ),
                    "prop"
                );
            },
        },
        data() {
            return {
                loading: false,
                init: false,
                formData: null,
                newAttrs:this._.cloneDeep(this.attrs),
                activeName:null,
                defaultFormData:null
            };
        },
        created(){
            this.newAttrs = this._.cloneDeep(this.attrs);
            this.activeName = this.attrs.tabValue;
        },
        mounted() {
            this.formData = this._.cloneDeep(this.attrs.defaultValues);
            this.isEdit && this.getEditData();

            this.$bus.on("resetFormData", () => {
                this.formData = this._.cloneDeep(this.attrs.defaultValues);
            });
            this.$bus.on('setDefaultFormData',(data)=>{
                this.defaultFormData = data;
            });

            //监听select是否调用了后台数据返回
            this.$bus.on("changeTabData", (data) => {
                // 保存原有的newAttrs里面的数据formItems
                var orgFormItem = this._.cloneDeep(this.newAttrs).formItems;
                var newData = this._.cloneDeep(data);
                // 保存formItems
                var formItems = newData.formItems;
                var newFormItems = [];
                formItems.forEach(item=>{
                    orgFormItem.forEach(citem=>{
                        if(item.tab == '基本信息' && citem.tab=='基本信息' && item.prop==citem.prop){
                            item = citem;
                        }
                    })
                    newFormItems.push(item);
                })
                newData.formItems = newFormItems;
                this.newAttrs = newData;
            });
        },
        destroyed() {
            this.formData = this._.cloneDeep(this.attrs.defaultValues);
            //取消监听
            try {
                this.$bus.off("resetFormData");
            } catch (e) {
            }
        },
        methods: {
            handleClick(tab, event){
                this.activeName = tab.name;
            },
            getEditData() {
                this.loading = true;
                this.init = false;
                this.$http
                    .get(this.attrs.dataUrl, {
                        params: {
                            get_data: true,
                        },
                    })
                    .then(({data}) => {
                        let temp_data = JSON.parse(JSON.stringify(data));
                        //处理远程接口下拉
                        console.log('attrs');
                        console.log(this.attrs);
                        this.newAttrs['formItems'].forEach(item => {
                            if (item['component'] && item['component']['isRelatedSelect']) {
                                let select_related = item['component']['relatedSelectRef'];
                                let select_related_value = data[select_related];
                                data[select_related] = null;
                                this.newAttrs['formItems'].forEach(select_item => {
                                    if (select_item['prop'] == select_related) {
                                        if (select_item['component'] && select_item['component']['remoteUrl']) {
                                            this.$http
                                                .get(select_item['component']['remoteUrl'], {
                                                    params: {
                                                        [item.prop]: temp_data[item.prop]
                                                    }
                                                })
                                                .then(res => {
                                                    const select_data = res.data.data || res.data;
                                                    if (select_data.length) {
                                                        let length = select_item['component']['options'].length;
                                                        for (let i = 0; i < length; i++) {
                                                            select_item['component']['options'].splice(0, 1);
                                                        }
                                                    }
                                                    select_item['component']['options'].push(...select_data);

                                                    data[select_related] = select_related_value*1;
                                                });
                                        }

                                    }
                                })
                            }
                        })
                        this.formData = data;
                        this.init = true;

                        //发送表单编辑数据加载完毕事件
                        this.$nextTick(() => {
                            this.$bus.emit("EditDataLoadingCompleted");
                        });
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        console.log('触发校验');
                        this.loading = true;
                        const formatData = this._.pick(this.formData, this.ignoreKey);
                        if (this.isEdit) {
                            this.$http
                                .put(this.attrs.action, formatData)
                                .then(({data, code, message}) => {
                                    if (code == 200) {
                                        if (this.attrs.attrs.isDialog) {
                                            this.closeDialog();
                                            this.$bus.emit("tableReload");
                                        } else {
                                            this.successRefData();
                                        }
                                    }
                                })
                                .finally(() => {
                                    this.loading = false;
                                });
                        } else {
                            this.$http
                                .post(this.attrs.action, formatData)
                                .then(({data, code, message}) => {
                                    if (code == 200) {
                                        if (this.attrs.attrs.isDialog) {
                                            this.closeDialog();
                                            this.$bus.emit("tableReload");
                                        } else {
                                            this.successRefData();
                                        }
                                    }
                                })
                                .finally(() => {
                                    this.loading = false;
                                });
                        }
                    } else {
                        return false;
                    }
                });
            },
            successRefData() {
                if (this.attrs.formRefData.successRefData) {
                    this.$bus.emit(this.attrs.formRefData.successRefData.ref, {
                        data: this.attrs.formRefData.successRefData.data,
                        self: this,
                    });
                } else {
                    this.$router.go(-1);
                }
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            onCancel() {
                this.attrs.attrs.isDialog ? this.closeDialog() : this.$router.go(-1);
            },
            closeDialog() {
                this.$bus.emit("showDialogGridFrom", {isShow: false});
                this.$bus.emit("closeDialog");
            },
        },
    };
</script>
<style lang="scss">
    .form-page {
        .form-card {
            min-height: 200px;
        }

        .form-bottom-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .form-bottom-actions_center{
            justify-content: center;
        }
        //deep admin start
        .custom_style {
            padding-right: 100px;
        }
        .custom_style_center{
            padding-right: 0px;
        }

        //deep admin end
        .admin-affix {
            .form-bottom-actions {
                padding: 6px;
                background: #ffffff;
                border-radius: 4px;
                border: 1px solid #ebeef5;
            }
        }

        .form-item-help {
            color: #999;
        }

        .is-left {
            max-height: calc(100vh - 250px);
            overflow-y: scroll;
            overflow-x: hidden;
        }
    }
</style>
