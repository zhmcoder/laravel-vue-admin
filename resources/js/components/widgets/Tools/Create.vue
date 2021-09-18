<template>
  <div class="tool-button">
    <el-button
        :type="attrs.type"
        :size="attrs.size"
        :plain="attrs.plain"
        :round="attrs.round"
        :circle="attrs.circle"
        :disabled="attrs.disabled"
        :icon="attrs.icon"
        :autofocus="attrs.autofocus"
        @click="onCreate"
    >{{ attrs.content }}
    </el-button
    >
  </div>
</template>
<script>
	export default {
		props: {
			attrs: Object,
		},
		methods: {
			onCreate() {
				if (this.attrs.isDialog) {
					this.$bus.emit("showDialogGridFrom", {isShow: true,addOrEdit:'add'});
				} else {
					let version = new Date().getTime();
					// deep-admin start
					if (this.attrs.params == null || this.attrs.params == '') {
						this.$router.push(this.$route.path + "/create" + "?version=" + version);
					} else {
						if (this.attrs.params instanceof Object) {
							this.$router.push(this.$route.path + "/create" + "?version=" + version + "&params=" + JSON.stringify(this.attrs.params));
						} else {
							this.$router.push(this.$route.path + "/create" + "?version=" + version + "&" + this.attrs.params);
						}

					}

				}
			},
		},
	};
</script>
