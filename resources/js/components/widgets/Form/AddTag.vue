<template>
  <div>
    <el-tag
      :key="tag.label"
      v-for="tag in dynamicTags"
      :disable-transitions="false"
      :type="attrs.type"
      :closable="attrs.closable || true"
      :hit="attrs.hit"
      :color="attrs.color"
      :effect="attrs.effect"
      :size="attrs.size"
      :class="!attrs.size && 'new-tag-height'"
      @close="handleClose(tag)"
    >
      {{ tag }}
    </el-tag>
    <el-input
      class="input-new-tag"
      v-if="inputVisible"
      v-model="inputValue"
      ref="saveTagInput"
      size="small"
      @keyup.enter.native="handleInputConfirm"
      @blur="handleInputConfirm"
    >
    </el-input>
    <el-button v-else class="button-new-tag" size="small" @click="showInput"
      > {{ attrs.btnName || "New Tag" }}</el-button
    >
  </div>
</template>
<script>
/**
 * size:tag标签大小 medium / small / mini
 * type:类型 success/info/warning/danger
 * closable: 是否可以关闭
 * disable-transitions:是否禁用渐变动画
 * hit:是否有边框描边
 * color:背景色
 * effect:主题 dark / light / plain
 * btnName:添加按钮文本
 * dynamicTags:编辑时的原始数据，Array['第一'，第二]
 */
import { FormItemComponent } from "@/mixins.js";
export default {
  mixins: [FormItemComponent],
  props: {
    attrs: Object,
    dynamicTags: {
      default: [],
    },
  },
  data() {
    return {
      inputVisible: false,
      inputValue: "",
    };
  },
  methods: {
    handleClose(tag) {
      this.dynamicTags.splice(this.dynamicTags.indexOf(tag), 1);
    },
    showInput() {
      this.inputVisible = true;
      this.$nextTick((_) => {
        this.$refs.saveTagInput.$refs.input.focus();
      });
    },

    handleInputConfirm() {
      let inputValue = this.inputValue;
      if (inputValue) {
        this.dynamicTags.push(inputValue);
      }
      this.inputVisible = false;
      this.inputValue = "";
      this.onChange(this.dynamicTags);
    },
  },
};
</script>
<style>
.el-tag + .el-tag {
  margin-left: 10px;
}
.button-new-tag {
  margin-left: 10px;
  height: 32px;
  line-height: 30px;
  padding-top: 0;
  padding-bottom: 0;
}
.new-tag-height{
  height: 100% !important;
  line-height: 32px;
}
.input-new-tag {
  width: 90px;
  margin-left: 10px;
  vertical-align: bottom;
}
</style>
