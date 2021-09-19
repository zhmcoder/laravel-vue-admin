<template>
  <el-dialog
      :title="key == null ? dialogTitle[0] || '添加' : dialogTitle[1] || '编辑'"
      :width="dialogFormWidth"
      :visible.sync="dialogVisible"
      :close-on-click-modal="false"
	  :center="dialogTitleCenter"
      @closed="onClose"
  >
    <component
        v-if="showForm"
        :is="dialogForm.componentName"
        :attrs="selfDialogForm"
    />
  </el-dialog>
</template>
<script>
	export default {
		props: {
			dialogForm: Object,
			dialogFormWidth: String,
			dialogTitle: Array,
			dialogTitleCenter:Boolean
		},
		data() {
			return {
				dialogVisible: false,
				showForm: false,
				key: null,
				selfDialogForm: {},
			};
		},
		mounted() {
			this.selfDialogForm = this._.cloneDeep(this.dialogForm);
		},
		watch: {
			dialogVisible(val) {
				console.log(this.dialogForm.dataUrl);
				if (val) {
					if (this.key) {
						this.selfDialogForm.mode = "edit";
						let path = this.dialogForm.dataUrl.split('?');
						if (path[1]) {
							this.selfDialogForm.dataUrl =
								path[0] + "/" + this.key + "/edit?" + path[1];
						} else {
							this.selfDialogForm.dataUrl =
								this.dialogForm.dataUrl + "/" + this.key + "/edit";
						}
						this.selfDialogForm.action = this.dialogForm.action + "/" + this.key;
					}
					this.showForm = true;
				}
			},
			dialogForm(val){
				this.selfDialogForm = this._.cloneDeep(this.dialogForm);
			}
		},
		methods: {
			onClose() {
				this.showForm = false;
				this.key = null;
				this.selfDialogForm = this._.cloneDeep(this.dialogForm);
				this.$bus.emit("resetFormData");
			},
		},
	};
</script>
