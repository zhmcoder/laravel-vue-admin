<template>
  <mavon-editor
    :style="attrs.style"
    :class="attrs.className"
    :value="attrs.content"
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

  />
</template>
<script>
import { mavonEditor } from "mavon-editor";
import { BaseComponent } from "@/mixins.js";
import "mavon-editor/dist/css/index.css";
export default {
  components: {
    MavonEditor: mavonEditor,
  },
  mixins: [BaseComponent],
  props: {
    attrs: Object,
  },
};
</script>
