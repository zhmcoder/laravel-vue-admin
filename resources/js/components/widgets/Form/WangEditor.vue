<template>
  <div class="wangeditor-main flex-sub">
    <div ref="toolbar" class="toolbar"></div>
    <div v-if="attrs.component">
      <component
        :is="attrs.component.componentName"
        :attrs="attrs.component"
        :editor.sync="editor"
      />
    </div>
    <div ref="editor" :style="attrs.style" :class="attrs.className"></div>
  </div>
</template>
<script>
import E from "wangeditor";
import { FormItemComponent } from "@/mixins.js";
export default {
  mixins: [FormItemComponent],
  props: ["defaultPropValues"],
  data() {
    return {
      editor: null,
      initHtml: false,
      defaultValue: ""
    };
  },
  mounted() {
    this.defaultValue = this._.cloneDeep(this.attrs.componentValue);

    this.editor = new E(this.$refs.toolbar, this.$refs.editor);
    this.editor.customConfig.menus = this.attrs.menus;
    this.editor.customConfig.zIndex = this.attrs.zIndex;
    this.editor.customConfig.uploadImgShowBase64 = this.attrs.uploadImgShowBase64;
    if (this.attrs.uploadImgServer) {
      this.editor.customConfig.uploadImgServer = this.attrs.uploadImgServer;

      this.editor.customConfig.uploadImgParams = {
        _token: Admin.token
      };
    }
    //自定义 fileName
    if (this.attrs.uploadFileName) {
      this.editor.customConfig.uploadFileName = this.attrs.uploadFileName;
    }
    //自定义 header
    if (this.attrs.uploadImgHeaders) {
      this.editor.customConfig.uploadImgHeaders = this.attrs.uploadImgHeaders;
    }

    this.editor.customConfig.onchange = html => {
      this.onChange(html);
    };

    this.$nextTick(() => {
      this.editor.create();
      this.editor.txt.html(this.defaultValue);
      console.log('获取value====',this.value);
      if(this.value){
        this.editor && this.editor.txt.html(this.value);
      }
    });
    //编辑数据加载完毕设置编辑器的值
    this.$bus.on("EditDataLoadingCompleted", () => {
      this.editor && this.editor.txt.html(this.value);
    });
  },
  watch:{
    defaultPropValues(value){
      if ((value !== this.editor.txt.html()) && value) {
        this.editor.txt.html(JSON.parse(JSON.stringify(String(value))));
      }
    },
  },
  destroyed() {
    try {
      this.$bus.off("EditDataLoadingCompleted");
    } catch (e) {}
  }
};
</script>
<style lang="scss">
.wangeditor-main {
  border: 1px solid #dcdcdc;
  .toolbar {
    background: #f7f7f7;
  }
  .w-e-text-container{
    position: relative;
    .w-e-text{
      position: absolute;
      left: 0px;
      top: 0px;
      right: 0px;
      bottom: 0px;
    }
  }
  .w-e-text-container {
    // 文本框里面的层级调低
    z-index: 1 !important;
  }
  .w-e-toolbar {
    // 给工具栏换行
    flex-wrap: wrap;
  }
  .w-e-menu {
    // 最重要的一句代码
    z-index: auto !important;

    .w-e-droplist {
      // 触发工具栏后的显示框调高
      z-index: 2 !important;
    }
  }
}

</style>
