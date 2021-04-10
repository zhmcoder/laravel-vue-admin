<template>
  <div>
    <component
      v-if="formItem.componentTopComponent"
      :is="formItem.componentTopComponent.componentName"
      :attrs="formItem.componentTopComponent"
    />
    <div class="flex align-center input-view">
      <component
        v-if="formItem.componentLeftComponent"
        :is="formItem.componentLeftComponent.componentName"
        :attrs="formItem.componentLeftComponent"
      />
      <component
        v-if="attrs"
        :value="value"
        :is="attrs.componentName"
        :attrs="attrs"
        :form-data="formData"
        :form-items="formItems"
        :form-item="formItem"
        @change="onChange"
        @changeRelation="onChangeRelation"
      />
      <component
        v-if="formItem.componentRightComponent"
        :is="formItem.componentRightComponent.componentName"
        :attrs="formItem.componentRightComponent"
      />
    </div>
    <component
      v-if="formItem.componentBottomComponent"
      :is="formItem.componentBottomComponent.componentName"
      :attrs="formItem.componentBottomComponent"
    />
  </div>
</template>
<script>
import { BaseComponent } from "@/mixins.js";
import { getArrayValue } from "../../utils";
export default {
  mixins: [BaseComponent],
  props: {
    value: {
      default: null,
    },
    formItems: Array,
    //fromItem数据
    formItem: Object,
    //当前表单数据
    formData: Object,
  },
  data() {
    return {};
  },
  model: {
    prop: "value",
    event: "change",
  },
  computed: {
    attrs() {
      return this.formItem.component;
    },
  },
  methods: {
      <!-- deep admin start-->
      onChangeRelation(attrs,resValue){
          console.log('onChangeRelation');
          if(attrs['isRelatedSelect'] == true){
              let form_item = null;
              this.formItems.forEach(item=>{
                  if(item.prop==attrs['relatedSelectRef']){
                      form_item = item;
                      return;
                  }
              })
              this.$http
                  .get(form_item['component']['remoteUrl'], {
                      params: {
                          [form_item.prop]:resValue
                      }
                  })
                  .then(res => {
                      const data = res.data.data || res.data;
                      if (data.length) {
                          let length = form_item['component']['options'].length;
                          for(let i=0;i<length;i++){
                              form_item['component']['options'].splice(0,1);
                          }
                          this.$emit("onClearValue");
                          form_item['component']['options'].push(...data);
                          form_item['component'].paginate=0;
                      }
                  });
          }
      },
      <!-- deep admin end-->
    onChange(value) {
      this.$emit("change", value);

      //触发动态注入
      this.$nextTick(() => {
        if (this.formItem.refData) {
          this.$bus.emit(this.formItem.refData.ref, {
            data: this.formItem.refData.data,
            self: this,
          });
          return;
        }
      });
    },
  },
};
</script>
<style lang="scss" scoped>
.el-form-item__content {
  .input-view {
    min-height: 40px;
  }
}
.el-form-item--medium {
  .input-view {
    min-height: 36px;
  }
}
.el-form-item--small {
  .input-view {
    min-height: 32px;
  }
}
.el-form-item--mini {
  .input-view {
    min-height: 28px;
  }
}
</style>
