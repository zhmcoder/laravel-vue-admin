<template>
  <mavon-editor
      :style="attrs.style"
      :class="attrs.className"
      v-model="content"
      :language="attrs.language"
      :fontSize="attrs.fontSize"
      :scrollStyle="attrs.scrollStyle"
      :boxShadow="attrs.boxShadow"
      :boxShadowStyle="attrs.boxShadowStyle"
      :transition="attrs.transition"
      :toolbarsBackground="attrs.toolbarsBackground"
      :previewBackground="attrs.previewBackground"
      :editable="attrs.editable"
      :subfield="attrs.subfield"
      :defaultOpen="attrs.defaultOpen"
      :toolbarsFlag="attrs.toolbarsFlag"
      :placeholder="attrs.placeholder"
      :codeStyle="attrs.codeStyle"
      :navigation="attrs.navigation"
      :shortCut="attrs.shortCut"
      :ishljs="attrs.ishljs"
      :tabSize="attrs.tabSize"
      :html="attrs.html"
      :toolbars="attrs.toolbars"
      @change="onChange"

  />
</template>
<script>
	import {mavonEditor} from "mavon-editor";
	import {BaseComponent} from "@/mixins.js";
	import "mavon-editor/dist/css/index.css";
	import E from "wangeditor";

	export default {
		components: {
			MavonEditor: mavonEditor,
		},
		mixins: [BaseComponent],
		props: {
			attrs: Object,
			value: null
		},
		data() {
			return {
				content: '',
			};
		},
		mounted() {
			this.$bus.on("EditDataLoadingCompleted", () => {
				this.content = this.value;
			});
		},
		watch: {},
		methods: {
			onChange(value, render) {
				console.log('content');
				this.$emit("change", value);
			}
		}
	};
</script>
