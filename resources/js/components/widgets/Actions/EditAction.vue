<template>
  <span>
    <el-button
      :type="action.type"
      :size="action.size"
      :plain="action.plain"
      :round="action.round"
      :circle="action.circle"
      :disabled="action.disabled"
      :icon="action.icon"
      :autofocus="action.autofocus"
      :loading="loading"
      @click="onHandle"
      >{{ action.content }}</el-button
    >
    <el-popconfirm
      v-if="this.action.tipsType==2"
      placement="top"
      :title="action.message"
      @confirm="onHandle"
    >
      <el-button
        slot="reference"
        type="text"
        size="mini"
        :icon="action.icon"
        :loading="loading"
        class="action-button"
      >{{action.content}}</el-button>
    </el-popconfirm>
  </span>
</template>
<script>
/***
 * tipsType 1:confirm模式的气泡确认框提示 2:el-popconfirm模式的提示 
 */
export default {
  props: {
    scope: Object,
    action: Object,
    key_name: String,
  },
  data() {
    return {
      loading: false,
			dialogVisible: false
    };
  },
  methods: {
    onHandle() {
      // 编辑时message有值有弹窗确认
      if(this.action.message &&this.action.tipsType==1 ){
          this.$confirm(this.action.message, '提示', {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: 'warning'
          }).then(() => {
            if (this.action.isDialog) {
              this.$bus.emit("showDialogGridFrom", { isShow: true, key: this.key , addOrEdit:'edit' });
            } else {
              this.$router.push(this.$route.path + "/" + this.key + "/edit" + '?' + this.action.params);
            }
          }).catch(() => {         
          });
      }else{
        if (this.action.isDialog) {
          this.$bus.emit("showDialogGridFrom", { isShow: true, key: this.key , addOrEdit:'edit' });
        } else {
          //deep admin start
          this.$router.push(this.$route.path + "/" + this.key + "/edit" + '?' + this.action.params);
          //deep admin end
        }
      }      
    },
  },
  computed: {
    colum() {
      return this.scope.colum;
    },
    row() {
      return this.scope.row;
    },
    key() {
      return this.scope.row[this.key_name];
    },
  },
};
</script>
<style lang="scss" scoped></style>
