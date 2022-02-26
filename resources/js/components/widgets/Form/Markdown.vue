<template>
  <mavon-editor
      ref=md
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
      @imgAdd="$imgAdd"

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
			},
			// 绑定@imgAdd event
			$imgAdd(pos, $file){
				// 第一步.将图片上传到服务器
        console.log('image url:'+this.attrs.imageUploadUrl);
				var formdata = new FormData();
				formdata.append('file', $file);
				// this.$http.post('/user?ID=12345')
				// 	.then(function (response) {
				// 		console.log(response);
				// 	})
				// 	.catch(function (error) {
				// 		console.log(error);
				// 	});
				this.axios({
					url: this.attrs.imageUploadUrl,
					method: 'post',
					data: formdata,
					headers: { 'Content-Type': 'multipart/form-data' },
				}).then((respose) => {
					if(respose.code ==200){
						let data = respose.data;
						this.$refs.md.$img2Url(pos, data.url);
          }
				})
			}
		}
	};
</script>
