<template>
  <div v-if="ifVif && ivEval">
    <slot></slot>
  </div>
</template>
<script>
export default {
  props: {
    form_item: Object,
    form_items: Array,
    form_data: Object,
  },
  mounted() {},
  computed: {
    ifVif() {
      let key = this.form_item.vif.key;
      let value = this.form_item.vif.value;
      let anyValue = this.form_item.vif.anyValue;

      if (key) {
        let cValue = window._.get(this.form_data, key);
        try {
          if(value && value != 'undefined' && typeof(JSON.parse(value))=='object'){
            // 假设后台返回的是可以转为数据的value，对后台返回来的value进行处理
            var newValue=[];
            let arr = JSON.parse(value);
            arr.map(item=>{
              newValue.push(String(item));
            })
          }
        } catch (error) {
          // JSON.parse报错的则不处理value
        }
        if (cValue == value || (cValue && anyValue) || (newValue && cValue && typeof(newValue)=='object' && newValue.indexOf(String(cValue))>-1)) {
          return true;
        } else {
          return false;
        }
      }

      return !anyValue;
    },
    ivEval() {
      try {
        if (!this.form_item.vifEval) {
          return true;
        }
        let expression = this.form_item.vifEval.expression;
        let props = this.form_item.vifEval.props;
        props.map((prop) => {
          window._.get(this.form_data, prop);
        });
        if (expression) {
          return eval(expression);
        }
        return true;
      } catch (error) {
        console.error("表达式错误：" + error);
        return true;
      }
    },
  },
};
</script>
