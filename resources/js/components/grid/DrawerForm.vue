<template>
    <el-drawer
        :title="key == null ? dialogTitle[0] || '添加' : dialogTitle[1] || '编辑'"
        :width="dialogFormWidth"
        :visible.sync="dialogVisible"
        :close-on-click-modal="false"
        :center="dialogTitleCenter"
        :before-close="onClose">
        <component
            v-if="showForm"
            :is="dialogForm.componentName"
            :attrs="selfDialogForm"
        />
    </el-drawer>
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
            direction: 'rtl',
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
        dialogForm(){
            this.selfDialogForm = this._.cloneDeep(this.dialogForm);
        },
        dialogVisible(val) {
            this.selfDialogForm = this._.cloneDeep(this.dialogForm);
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
                    let action = this.dialogForm.action.split('?');
                    if(action[1]){
                        this.selfDialogForm.action = action[0] + "/" + this.key + '?' + action[1];
                    }else{
                        this.selfDialogForm.action = this.dialogForm.action + "/" + this.key;
                    }
                }
                this.showForm = true;
            }

        }
    },
    methods: {
        onClose(done) {
            done();
            this.showForm = false;
            this.key = null;
            this.selfDialogForm = this._.cloneDeep(this.dialogForm);
            this.$bus.emit("resetFormData");
        },
    },
}
</script>
<style scoped>

</style>