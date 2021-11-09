<template>
    <el-checkbox
        :value="value"
        :style="attrs.style"
        :class="attrs.className"
        :label="attrs.label"
        :true-label="attrs.trueLabel"
        :false-label="attrs.falseLabel"
        :disabled="attrs.disabled"
        :border="attrs.border"
        :size="attrs.size"
        :checked="attrs.checked"
        :indeterminate="attrs.indeterminate"
        @change="onChange"
    >{{ attrs.title }}
    </el-checkbox
    >
</template>
<script>
import {FormItemComponent} from '@/mixins.js'

export default {
    mixins: [FormItemComponent],
};
</script>
