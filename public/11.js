(window.webpackJsonp=window.webpackJsonp||[]).push([[11],{Jfbn:function(t,a,o){"use strict";o.r(a);var n=o("stgD"),e=o("b3nO"),s=(o("ZOF2"),o("GguQ"),{components:{MavonEditor:n.mavonEditor},mixins:[e.a],props:{attrs:Object,value:null},data:function(){return{content:""}},mounted:function(){var t=this;this.$bus.on("EditDataLoadingCompleted",(function(){t.content=t.value}))},watch:{},methods:{onChange:function(t,a){console.log("content"),this.$emit("change",t)}}}),r=o("KHd+"),l=Object(r.a)(s,(function(){var t=this,a=t.$createElement;return(t._self._c||a)("mavon-editor",{class:t.attrs.className,style:t.attrs.style,attrs:{language:t.attrs.language,fontSize:t.attrs.fontSize,scrollStyle:t.attrs.scrollStyle,boxShadow:t.attrs.boxShadow,boxShadowStyle:t.attrs.boxShadowStyle,transition:t.attrs.transition,toolbarsBackground:t.attrs.toolbarsBackground,previewBackground:t.attrs.previewBackground,editable:t.attrs.editable,subfield:t.attrs.subfield,defaultOpen:t.attrs.defaultOpen,toolbarsFlag:t.attrs.toolbarsFlag,placeholder:t.attrs.placeholder,codeStyle:t.attrs.codeStyle,navigation:t.attrs.navigation,shortCut:t.attrs.shortCut,ishljs:t.attrs.ishljs,tabSize:t.attrs.tabSize,html:t.attrs.html,toolbars:t.attrs.toolbars},on:{change:t.onChange},model:{value:t.content,callback:function(a){t.content=a},expression:"content"}})}),[],!1,null,null,null);a.default=l.exports}}]);