<template>
  <div style="display: inline;margin: 10px">
    <el-button
        :type="action.type"
        :size="action.size"
        :plain="action.plain"
        :round="action.round"
        :circle="action.circle"
        :disabled="action.disabled"
        :icon="action.icon"
        :autofocus="action.autofocus"
        @click="dialogVisible = true"
        class="action-button"
    >{{action.content}}
    </el-button>

    <el-dialog
        title="删除提示"
        :visible.sync="dialogVisible"
        :modal-append-to-body='false'
        width="30%">
      <span style="margin: 20px">{{action.message}}</span>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">取 消</el-button>
        <el-button type="primary" :loading="loading" :icon="action.icon" @click="onHandle">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>
<script>
	export default {
		props: {
			scope: Object,
			action: Object,
			key_name: String
		},
		data() {
			console.log(this.scope);
			console.log(this.action);
			console.log(this.key_name);
			return {
				loading: false,
				dialogVisible: false
			};
		},
		methods: {
			onHandle() {
				this.loading = true;
				this.$http
					//deep admin start
					.delete(this.action.resource + "/" + this.key + '?' + this.action.params)
					//depp admin end
					.then(({code}) => {
						if (code === 200) this.$bus.emit("tableReload");
					})
					.finally(() => {
						this.loading = false;
						this.dialogVisible = false;
					});
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
			}
		}
	};
</script>
<style lang="scss" scoped>
  .dialog-footer {
    width: 100%;
    text-align: center;
  }
</style>
