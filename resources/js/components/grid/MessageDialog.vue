<template>
  <el-dialog
    :title="attrs.title"
    :visible.sync="dialogVisible"
    :width="attrs.width"
    :center="attrs.center"
  >
    <div class="dialog-content">{{attrs.content}}</div>
    <span slot="footer" class="dialog-footer" v-if="attrs.footer">
      <el-button v-if="attrs.cancelShow" @click="dialogVisible = false">{{attrs.cancelText}}</el-button>
      <el-button v-if="attrs.okShow" type="primary" @click="dialogVisible = false">{{attrs.okText}}</el-button>
    </span>
  </el-dialog>
</template>
<script>
/**
 * attrs
 * @param { attrs.title } 弹窗显示title
 * @param { attrs.width } 弹窗显示的宽度
 * @param { attrs.footer } 是否有底部footer
 * @param { attrs.center } 是否居中
 * @param { attrs.cancelText } 按钮名称cancel
 * @param { attrs.cancelShow } 是否显示按钮cancel
 * @param { attrs.okText } 按钮名称ok
 * @param { attrs.okShow } 是否显示按钮ok
 * @param { attrs.content } 展示内容
 */
export default {
  name: "HomeModal",
  props: {
    attrs: Object,
  },
  data() {
    return {
      dialogVisible: false,
    };
  },
  mounted() {
    console.log("进入到首页");
    this.dialogVisible = true;
  },
};
</script>
<style scoped>
.dialog-content{
    margin: 10px 20px;
}
</style>