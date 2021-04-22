<template>
  <div class="tool-button">
    <el-tooltip
      :content="attrs.tooltip"
      placement="top"
      :disabled="!attrs.tooltip"
    >
      <el-popconfirm
        placement="top"
        :title="attrs.message"
        @onConfirm="onClick"
        v-if="attrs.message"
      >
        <el-button
          slot="reference"
          :type="attrs.type"
          :size="attrs.size"
          :plain="attrs.plain"
          :round="attrs.round"
          :circle="attrs.circle"
          :disabled="attrs.disabled"
          :icon="attrs.icon"
          :autofocus="attrs.autofocus"
          :loading="loading"
          >{{ attrs.content }}
        </el-button>
      </el-popconfirm>
      <el-button
        v-else
        :type="attrs.type"
        :size="attrs.size"
        :plain="attrs.plain"
        :round="attrs.round"
        :circle="attrs.circle"
        :disabled="attrs.disabled"
        :icon="attrs.icon"
        :autofocus="attrs.autofocus"
        :loading="loading"
        @click="onClick"
        >{{ attrs.content }}
      </el-button>
    </el-tooltip>
    <el-dialog
      v-if="attrs.dialog"
      :title="attrs.dialog.title"
      :visible.sync="dialogTableVisible"
      :width="attrs.dialog.width"
      :fullscreen="attrs.dialog.fullscreen"
      :top="attrs.dialog.top"
      :modal="attrs.dialog.modal"
      :lock-scroll="attrs.dialog.lockScroll"
      :custom-class="attrs.dialog.customClass"
      :show-close="attrs.dialog.showClose"
      :center="attrs.dialog.center"
      :close-on-click-modal="attrs.dialog.closeOnClickModal"
      :close-on-press-escape="attrs.dialog.closeOnPressEscape"
      append-to-body
      destroy-on-close
    >
      <component
        v-if="attrs.dialog.slot"
        :is="attrs.dialog.slot.componentName"
        :attrs="attrs.dialog.slot"
      />
    </el-dialog>
  </div>
</template>
<script>
export default {
  props: {
    attrs: Object,
      // deep-admin start
      //filterData:Object
      filterData: {
          type: [Object, Array]
      }
      // deep-admin end
  },
  data() {
    return {
      loading: false,
      dialogTableVisible: false,
    };
  },
  mounted() {
    this.$bus.on("closeDialog", (data) => {
      this.dialogTableVisible = false;
    });
  },
  destroyed() {
    this.$bus.off("closeDialog");
  },
  methods: {
    onClick() {
      if (this.attrs.dialog) {
        this.dialogTableVisible = true;
        return;
      }
        // deep-admin start
      let params = null;
      if(this.attrs.isFilterFormData == true){
          params = Object.assign(this.filterData, this.attrs.params);;
      }
        // deep-admin end
      switch (this.attrs.handler) {
        case "route":
          // deep-admin start
          let version = new Date().getTime();
          // deep-admin end
          this.$router.push(this.attrs.uri + "&version=" + version);
          break;
        case "link":
            // deep-admin start
            // todo 参数传递需优化
          window.location.href = this.attrs.uri + "?params=" + JSON.stringify(params);
            // deep-admin end
          break;
        case "request":
            // deep-admin start
          this.onRequest(this.attrs.uri,this.attrs.requestMethod,params);
            // deep-admin end
          break;
        default:
          this.$message.warning("响应类型未定义");
          break;
      }
    },
      // deep-admin start
    onRequest(uri,requestMethod,params) {
        this.loading = true;
        this.$http[requestMethod](uri, {
            params: params
        })
        .then((res) => {
            if (res.code == 200) {
            }
        })
        .finally(() => {
            this.loading = false;
        });

    },
      // deep-admin end
  },
};
</script>
